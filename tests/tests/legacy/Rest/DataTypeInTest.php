<?php
/**
 * Created by IntelliJ IDEA.
 * User: Michi
 * Date: 11.11.2010
 * Time: 10:35:07
 */


class TestSuite_Rest_DataTypeTest extends Pimcore_Test_Case {

    static $seed;

    static $restObject;

    public $o;


    public function setUp() {

        parent::setUp();


        $object = Object_Class::create();
        $object->setName('DataType');

        $objectlayout = new Object_Class_Layout();


        $fields = array(
            array('field' => "input"),
            array('field' => "numeric"),
            array('field' => "textarea"),
            array('field' => "slider"),
            array('field' => "href"),
            array('field' => "multihref"),
            array('field' => "image"),
            array('field' => "hotspotimage"),
            #   array('field' => "language"),
            array('field' => "country"),
            array('field' => "date"),
            array('field' => "datetime"),
            array('field' => "time"),
            array('field' => "select"),
            array('field' => "multiselect"),
            array('field' => "user"),
            array('field' => "checkbox"),
            array('field' => "wysiwyg"),
            array('field' => "password"),
            array('field' => "countrymultiselect"),
            array('field' => "table"),
            array('field' => "link"),
            # array('field' => "structuredTable"),
            array('field' => "objects"),
            array('field' => "objectsMetadata"),
            array('field' => "input"),
            array('field' => "objects"),
            array('field' => "keyValue"),
            # array('field' => "objectbricks")
        );

        foreach($fields as $v) {
            $class = 'Object_Class_Data_'. ucfirst($v['field']);
            $data = new $class;
            $data->setTitle($v['field']);
            $data->setName($v['field']);
            $objectlayout->addChild($data);
        }



        $object->setLayoutDefinitions($objectlayout);
        $object->setUserOwner(1);
        $object->save();

        // this will create a couple of objects which can be used for references
        Pimcore_Test_Helper_Tool::createEmptyObjects('DataType');




        $object = new Object_DataType();
        $object->setOmitMandatoryCheck(true);
        $object->setParentId(1);
        $object->setUserOwner(1);
        $object->setUserModification(1);
        $object->setCreationDate(time());
        $object->setKey('unittest');


        $object->setInput('content1');
        $object->setNumeric(124);
        $object->setTextarea('textarea!');
        $object->setSlider(5);

        /*
            TODO also test all other types.
            Especially there are problems with "language" and "country"
        */
/*
        Multihref
        fillImage
        HotspotImage
        Language
        Country
        Date
        Time
        Select
        MultiSelect
        User
        Checkbox
        Wysiwyg
        Password
        MultiSelect
        MultiSelect
        Geopoint
        Geobounds
        Geopolygon
        Table
        Link
        Objects
        ObjectsWithMetadata
        Input
        Objects
        KeyValue
        Bricks
        FieldCollection
*/



        $response = $this->getRestClient()->createObjectConcrete($object);
        if (!$response->success) {
            throw new Exception("could not create test object");
        }

        $this->o = Object_Abstract::getById($response->id);
    }


    public function testInput() {
        $this->assertEquals($this->o->getInput(), "content1");
    }

    public function testNumeric() {
        $this->assertEquals($this->o->getNumeric(), 124);
    }

    public function testTextarea() {
        $this->assertEquals($this->o->getTextarea(), 'textarea!');
    }

    public function testSlider() {
        $this->assertEquals($this->o->getSlider(), 5);
    }




}
