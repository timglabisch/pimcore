<?php

class TestSuite_Datatypes_KeyValueTest extends Pimcore_Test_Case {

    public function setUp() {

        parent::setUp();

        $object = Object_Class::create();
        $object->setName('UnittestDatatypesKeyvalue');

        $objectlayout = new Object_Class_Layout();

        $data = new Object_Class_Data_Textarea();
        $data->setTitle('keyvaluepairs');
        $data->setName('keyvaluepairs');

        $objectlayout->addChild($data);

        $object->setLayoutDefinitions($objectlayout);
        $object->setUserOwner(1);
        $object->save();
    }

    public function testUninitialized() {

        $object = Pimcore_Test_Helper_Tool::createEmptyObject('UnittestDatatypesKeyvalue');
        $data = $object->getKeyvaluepairs();
        $fd = $object->getClass()->getFieldDefinition("keyvaluepairs");

        // make sure that this call does not bomb out
        $fd->getDiffDataForEditMode($data, $object);
    }

}
