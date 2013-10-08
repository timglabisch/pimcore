<?php
/**
 * Created by IntelliJ IDEA.
 * User: Michi
 * Date: 11.11.2010
 * Time: 10:35:07
 */


class TestSuite_Rest_DataTypeTest extends Pimcore_Test_Case {

    static $seed;

    static $localObject;

    static $restObject;


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
            array('field' => "language"),
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
            array('field' => "objectbricks")
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

        self::$seed = 1;

        $tmpObject = Pimcore_Test_Helper_Tool::createFullyFledgedObject('DataType', "local", false, self::$seed);

        $response = $this->getRestClient()->createObjectConcrete($tmpObject);
        if (!$response->success) {
            throw new Exception("could not create test object");
        }
        self::$localObject = Object_Abstract::getById($response->id);
        self::$restObject = $tmpObject;
    }


    public function testInput() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertInput(self::$localObject, "input", self::$seed));
    }

    public function testNumber() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertNumber(self::$localObject, "number", self::$seed));
    }

    public function testTextarea() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertTextarea(self::$localObject, "textarea", self::$seed));
    }

    public function testSlider() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertSlider(self::$localObject, "slider", self::$seed));
    }

    public function testHref() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertHref(self::$localObject, "href", self::$seed));
    }

    public function testMultiHref() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertMultihref(self::$localObject, "multihref", self::$seed));
    }

    public function testImage() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertImage(self::$localObject, "image", self::$seed));
    }

    public function testLanguage() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertLanguage(self::$localObject, "languagex", self::$seed));
    }

    public function testCountry() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertCountry(self::$localObject, "country", self::$seed));
    }

    public function testDate() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertDate(self::$localObject, "date", self::$seed));
    }

    public function testDateTime() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertDate(self::$localObject, "datetime", self::$seed));
    }


    public function testSelect() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertSelect(self::$localObject, "select", self::$seed));
    }

    public function testMultiSelect() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertMultiSelect(self::$localObject, "multiselect", self::$seed));
    }

    public function testUser() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertUser(self::$localObject, "user", self::$seed));
    }

    public function testCheckbox() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertCheckbox(self::$localObject, "checkbox", self::$seed));
    }

    public function testTime() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertTime(self::$localObject, "time", self::$seed));
    }

    public function testWysiwyg() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertWysiwyg(self::$localObject, "wysiwyg", self::$seed));
    }

    public function testCountryMultiSelect() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertCountryMultiSelect(self::$localObject, "countries", self::$seed));
    }

    public function testLanguageMultiSelect() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertCountryMultiSelect(self::$localObject, "languages", self::$seed));
    }

    public function testGeopoint() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertGeopoint(self::$localObject, "point", self::$seed));
    }

    public function testGeobounds() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertGeobounds(self::$localObject, "bounds", self::$restObject, self::$seed));
    }

    public function testGeopolygon() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertGeopolygon(self::$localObject, "poly", self::$restObject, self::$seed));
    }

    public function testTable() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertTable(self::$localObject, "table", self::$restObject, self::$seed));
    }

    public function testLink() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertLink(self::$localObject, "link", self::$restObject, self::$seed));
    }

    public function testStructuredTable() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertStructuredTable(self::$localObject, "structuredtable", self::$restObject, self::$seed));
    }

    public function testObjects() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertObjects(self::$localObject, "objects", self::$restObject, self::$seed));
    }

    public function testObjectsWithMetadata() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertObjectsWithmetadata(self::$localObject, "objectswithmetadata", self::$restObject, self::$seed));
    }

    public function testLInput() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertInput(self::$localObject, "linput", self::$seed, "en"));
        $this->assertTrue(Pimcore_Test_Helper_Data::assertInput(self::$localObject, "linput", self::$seed, "de"));
    }

    public function testLObjects() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertObjects(self::$localObject, "lobjects", self::$restObject, self::$seed, "en"));
        $this->assertTrue(Pimcore_Test_Helper_Data::assertObjects(self::$localObject, "lobjects", self::$restObject, self::$seed, "de"));
    }

    public function testKeyValue() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertKeyValue(self::$localObject, "keyvaluepairs", self::$seed));
    }

    public function testBricks() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertBricks(self::$localObject, "mybricks", self::$seed));
    }

    public function testFieldCollection() {
        $this->assertTrue(Pimcore_Test_Helper_Data::assertFieldCollection(self::$localObject, "myfieldcollection", self::$seed));
    }

}
