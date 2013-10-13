<?php


class TestSuite_Rest_DataTypeOutTest extends Pimcore_Test_Case {

    protected $o;

    public function setUp() {

        parent::setUp();


        $object = Object_Class::create();
        $object->setName('DataTypeOut');

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


        $object = new Object_DataTypeOut();
        $object->setOmitMandatoryCheck(true);
        $object->setParentId(1);
        $object->setUserOwner(1);
        $object->setUserModification(1);
        $object->setCreationDate(time());
        $object->setKey('unittest');


        $object->setInput('input!');
        $object->setNumeric(124);
        $object->setTextarea('textarea!');
        $object->setSlider(5);
        $object->save();

        $this->o = self::getRestClient()->getObjectById($object->getId());
    }

    public function testInput() {
        $this->assertEquals($this->o->getInput(), 'input!');
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

    public function testHref() {
        $this->markTestIncomplete();
    }

    public function testMultiHref() {
        $this->markTestIncomplete();
    }

    public function testImage() {
        $this->markTestIncomplete();
    }

    public function testHotspotImage() {
        $this->markTestIncomplete();
    }

    public function testLanguage() {
        $this->markTestIncomplete();
    }

    public function testCountry() {
        $this->markTestIncomplete();
    }

    public function testDate() {
        $this->markTestIncomplete();
    }

    public function testDateTime() {
        $this->markTestIncomplete();
    }

    public function testSelect() {
        $this->markTestIncomplete();
    }

    public function testMultiSelect() {
        $this->markTestIncomplete();
    }

    public function testUser() {
        $this->markTestIncomplete();
    }

    public function testCheckbox() {
        $this->markTestIncomplete();
    }

    public function testTime() {
        $this->markTestIncomplete();
    }

    public function testWysiwyg() {
        $this->markTestIncomplete();
    }

    public function testPassword() {
        $this->markTestIncomplete();
    }

    public function testCountryMultiSelect() {
        $this->markTestIncomplete();
    }

    public function testLanguageMultiSelect() {
        $this->markTestIncomplete();
    }

    public function testGeopoint() {
        $this->markTestIncomplete();
    }

    public function testGeobounds() {
        $this->markTestIncomplete();
    }

    public function testGeopolygon() {
        $this->markTestIncomplete();
    }

    public function testTable() {
        $this->markTestIncomplete();
    }

    public function testLink() {
        $this->markTestIncomplete();
    }

    public function testStructuredTable() {
        $this->markTestIncomplete();
    }

    public function testObjects() {
        $this->markTestIncomplete();
    }

    public function testObjectsWithMetadata() {
        $this->markTestIncomplete();
    }

    public function testLInput() {
        $this->markTestIncomplete();
    }

    public function testLObjects() {
        $this->markTestIncomplete();
    }

    public function testKeyValue() {
        $this->markTestIncomplete();
    }

    public function testBricks() {
        $this->markTestIncomplete();
    }

    public function testFieldCollection() {
        $this->markTestIncomplete();
    }

}
