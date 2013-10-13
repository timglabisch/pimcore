<?php

class TestSuite_Rest_DocumentTest extends Pimcore_Test_Case {


    public function testCreate() {
        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getDocoumentCount());

        $unsavedObject = Pimcore_Test_Helper_Tool::createEmptyDocumentPage("", false);
        // object not saved, object count must still be one
        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getDocoumentCount());

        $time = time();

        $result = $this->getRestClient()->createDocument($unsavedObject);
        $this->assertTrue($result->success, "request not successful");
        $this->assertEquals(2, Pimcore_Test_Helper_Tool::getDocoumentCount());

        $id = $result->id;
        $this->assertTrue($id > 1, "id must be greater than 1");

        $objectDirect = Document::getById($id);
        $creationDate = $objectDirect->getCreationDate();
        $this->assertTrue($creationDate >= $time, "wrong creation date");


        // as the object key is unique there must be exactly one document with that key
        $list = $this->getRestClient()->getDocumentList("`key` = '" . $unsavedObject->getKey() . "'");


        $this->assertEquals(1, count($list));
    }



    public function testDelete() {
        $document = Pimcore_Test_Helper_Tool::createEmptyDocumentPage();

        $savedDocument = Document::getById($document->getId());
        $this->assertNotNull($savedDocument);

        $response = $this->getRestClient()->deleteDocument($document->getId());
        $this->assertTrue($response->success, "request wasn't successful");

        // this will wipe our local cache
        Pimcore::collectGarbage();

        $dd = Document::getById(2);

        // do not use assertNull, otherwise phpunit will dump the entire bloody object
        $this->assertTrue($dd == null, "document still exists");
    }


    public function testFolder() {

        // create folder but don't save it
        $folder = Pimcore_Test_Helper_Tool::createEmptyDocumentPage("myfolder", false);
        $folder->setType("folder");

        $fitem = Document::getById($folder->getId());
        $this->assertNull($fitem);

        $response = $this->getRestClient()->createDocumentFolder($folder);
        $this->assertTrue($response->success, "request wasn't successful");

        $id = $response->id;
        $this->assertTrue($id > 1, "id not set");

        $folderDirect = Document::getById($id);
        $this->assertTrue($folderDirect->getType() == "folder");

        $folderRest = $this->getRestClient()->getDocumentById($id);
        $this->assertTrue(Pimcore_Test_Helper_Tool::documentsAreEqual($folderRest, $folderDirect, false), "documents are not equal");

        $this->getRestClient()->deleteDocument($id);

        Pimcore::collectGarbage();
        $folderDirect = Document::getById($id);
        $this->assertNull($folderDirect, "folder still exists");
    }

}
