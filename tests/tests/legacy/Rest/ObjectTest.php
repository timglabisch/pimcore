<?php

class TestSuite_Rest_ObjectTest extends Pimcore_Test_Case {


    public function setUp() {

        parent::setUp();

        $object = Object_Class::create();
        $object->setName('ObjectTest');

        $objectlayout = new Object_Class_Layout();

        $data = new Object_Class_Data_Textarea();
        $data->setTitle('keyvaluepairs');
        $data->setName('keyvaluepairs');

        $objectlayout->addChild($data);

        $object->setLayoutDefinitions($objectlayout);
        $object->setUserOwner(1);
        $object->save();


        if(!Object_Folder::getByPath('/')) {
            $rootFolder = new Object_Folder();
            $rootFolder->setId(1);
            $rootFolder->setPath('/');
            $rootFolder->setKey('');
            $rootFolder->save();
        }
    }

    /**
     * creates a class called "unittest" containing all Object_Class_Data Types currently available.
     * @return void
     */
    public function testObjectList() {
        $list = $this->getRestClient()->getObjectList();

        $this->assertEquals(1, count($list), "expected 1 list item");

        $this->assertEquals("folder", $list[0]->getType(), "expected type to be folder");
    }

    public function testObjectGet() {
        $object = $this->getRestClient()->getObjectById(1);
        $this->assertEquals("folder", $object->getType(), "expected type to be folder");
        $this->assertEquals(1, $object->getId(), "wrong id");

        $originalCount = Pimcore_Test_Helper_Tool::getObjectCount();

        $emptyObject = Pimcore_Test_Helper_Tool::createEmptyObject("ObjectTest");
        $id = $emptyObject->getId();
        $this->assertTrue(Pimcore_Test_Helper_Tool::getObjectCount() == $originalCount + 1);
        $object = $this->getRestClient()->getObjectById($id);
        $this->assertNotNull($object, "expected new object");
    }


    public function testCreateObjectConcrete() {
        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getObjectCount());

        $unsavedObject = Pimcore_Test_Helper_Tool::createEmptyObject("ObjectTest", "", false);
        // object not saved, object count must still be one
        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getObjectCount());

        $time = time();

        $result = $this->getRestClient()->createObjectConcrete($unsavedObject);
//        var_dump($result);
        $this->assertTrue($result->success, "request not successful . " . $result->msg);
        $this->assertEquals(2, Pimcore_Test_Helper_Tool::getObjectCount());

        $id = $result->id;
        $this->assertTrue($id > 1, "id must be greater than 1");

        $objectDirect = Object_Abstract::getById($id);
        $creationDate = $objectDirect->getCreationDate();
        $this->assertTrue($creationDate >= $time, "wrong creation date");

        // as the object key is unique there must be exactly one object with that key
        $list = $this->getRestClient()->getObjectList("o_key = '" . $unsavedObject->getKey() . "'");
        $this->assertEquals(1, count($list));
    }

    public function testDelete() {

        $savedObject = Pimcore_Test_Helper_Tool::createEmptyObject("ObjectTest");

        $savedObject = Object_Abstract::getById($savedObject->getId());
        $this->assertNotNull($savedObject);

        $response = $this->getRestClient()->deleteObject($savedObject->getId());
        $this->assertTrue($response->success, "request wasn't successful");

        // this will wipe our local cache
        Pimcore::collectGarbage();

        $savedObject = Object_Abstract::getById($savedObject->getId());
        $this->assertTrue($savedObject == null, "object still exists");
    }

    public function testFolder() {

        // create folder but don't save it
        $folder = Pimcore_Test_Helper_Tool::createEmptyObject("ObjectTest", "myfolder", false);
        $folder->setType("folder");

        $fitem = Object_Abstract::getById($folder->getId());
        $this->assertNull($fitem);

        $response = $this->getRestClient()->createObjectFolder($folder);
        $this->assertTrue($response->success, "request wasn't successful");

        $id = $response->id;
        $this->assertTrue($id > 1, "id not set");

        $folderDirect = Object_Abstract::getById($id);
        $this->assertTrue($folderDirect->getType() == "folder");

        $folderRest = $this->getRestClient()->getObjectById($id);
        $this->assertTrue(Pimcore_Test_Helper_Tool::objectsAreEqual($folderRest, $folderDirect, false), "objects are not equal");

        $this->getRestClient()->deleteObject($id);

        Pimcore::collectGarbage();
        $folderDirect = Object_Abstract::getById($id);
        $this->assertNull($folderDirect, "folder still exists");
    }


}
