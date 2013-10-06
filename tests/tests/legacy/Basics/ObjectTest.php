<?php

class TestSuite_Basics_ObjectTest extends Pimcore_Test_Case {


    public function setUp() {

        parent::setUp();

        $object = Object_Class::create();
        $object->setName('Unittest');

        $objectlayout = new Object_Class_Layout();

        $inputfield = new Object_Class_Data_Textarea();
        $inputfield->setTitle('title');
        $inputfield->setName('InputField');

        $objectlayout->addChild($inputfield);

        $object->setLayoutDefinitions($objectlayout);
        $object->setUserOwner(1);
        $object->save();

        $resource = $object->getResource();

        if(is_callable(array($resource, '__destruct')))
            $resource->__destruct();
    }

    /**
     * Verifies that a object with the same parent ID cannot be created.
     */
    public function testParentIdentical() {

        $savedObject = Pimcore_Test_Helper_Tool::createEmptyObject();
        $this->assertTrue($savedObject->getId() > 0);

        $savedObject->setParentId($savedObject->getId());
        try {
            $savedObject->save();
            $this->fail("Expected an exception");
        } catch (Exception $e) {

        }
    }

    /**
     * Parent ID of a new object cannot be 0
     */
    public function testParentIs0() {

        $savedObject = Pimcore_Test_Helper_Tool::createEmptyObject("", false);
        $this->assertTrue($savedObject->getId() == 0);

        $savedObject->setParentId(0);
        try {
            $savedObject->save();
            $this->fail("Expected an exception");
        } catch (Exception $e) {

        }
    }

}
