<?php
/**
 * Created by IntelliJ IDEA.
 * User: Michi
 * Date: 11.11.2010
 * Time: 10:35:07
 */


class TestSuite_Rest_ClassTest extends Pimcore_Test_Case {

    public function setUp() {

        parent::setUp();

        $object = Object_Class::create();
        $object->setName('UnittestClass');

        $objectlayout = new Object_Class_Layout();

        $data = new Object_Class_Data_Textarea();
        $data->setTitle('keyvaluepairs');
        $data->setName('keyvaluepairs');

        $objectlayout->addChild($data);

        $object->setLayoutDefinitions($objectlayout);
        $object->setUserOwner(1);
        $object->save();
    }

    public function estGetClass() {
        $object = Pimcore_Test_Helper_Tool::createEmptyObject('UnittestClass');
        $classId = $object->getClassId();

        $this->assertEquals("UnittestClass", Object_Class::getById($classId)->getName());
        $restClass1 = $this->getRestClient()->getClassById($classId);
        $this->assertEquals("UnittestClass", $restClass1->getName());
    }

    public function testObjectMetaById() {
        $object = Pimcore_Test_Helper_Tool::createEmptyObject('UnittestClass');

        $restClass2 = $this->getRestClient()->getObjectMetaById($object->getId());
        $this->assertEquals("UnittestClass", $restClass2->getName());
    }

}
