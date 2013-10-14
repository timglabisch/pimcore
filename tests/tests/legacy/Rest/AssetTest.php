<?php


class TestSuite_Rest_AssetTest extends Pimcore_Test_Case {

    public function setUp() {
        parent::setUp();

        if(!Asset_Folder::getByPath('/')) {
            $rootFolder = new Asset_Folder();
            $rootFolder->setId(1);
            $rootFolder->setPath('/');
            $rootFolder->setFilename('');
            $rootFolder->save();
        }
    }


    public function testCreateAssetFile() {

        $originalContent = file_get_contents(__DIR__ . "/../../../fixtures/assets/images/image5.jpg");

        $this->assertTrue(strlen($originalContent) > 0);

        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getAssetCount());


        $asset = Pimcore_Test_Helper_Tool::createImageAsset("", $originalContent, false);
        // object not saved, asset count must still be one
        $this->assertEquals(1, Pimcore_Test_Helper_Tool::getAssetCount());

        $time = time();

        $result = $this->getRestClient()->createAsset($asset);

        // create asset gibt nur das Data objekt zurück, ist wohl doch nötig die RestClient api einzuhalten

        $this->assertTrue($result->id > 0, "request not successful");
        $this->assertEquals(2, Pimcore_Test_Helper_Tool::getAssetCount());

        $id = $result->id;
        $this->assertTrue($id > 1, "id must be greater than 1");

        $assetDirect = Asset::getById($id);
        $creationDate = $assetDirect->getCreationDate();
        $this->assertTrue($creationDate >= $time, "wrong creation date");
        $properties = $asset->getProperties();
        $this->assertEquals(1, count($properties), "property count does not match");
        $property = $properties[0];
        $this->assertEquals("bla", $property->getData());

        // as the asset key is unique there must be exactly one object with that key
        $list = $this->getRestClient()->getAssetList("filename = '" . $asset->getKey() . "'");
        $this->assertEquals(1, count($list));

        // now check if the file exists
        $filename = PIMCORE_ASSET_DIRECTORY . "/" . $asset->getFilename();

        $savedContent = file_get_contents($filename);

        $this->assertEquals($originalContent, $savedContent, "asset was not saved correctly");
    }

    public function testDelete() {

        $originalContent = file_get_contents(__DIR__ . "/../../../fixtures/assets/images/image5.jpg");
        $savedAsset = Pimcore_Test_Helper_Tool::createImageAsset("", $originalContent, true);

        $savedAsset = Asset::getById($savedAsset->getId());
        $this->assertNotNull($savedAsset);

        $response = $this->getRestClient()->deleteAsset($savedAsset->getId());
        $this->assertTrue($response->success, "request wasn't successful");

        // this will wipe our local cache
        Pimcore::collectGarbage();

        $savedAsset = Asset::getById($savedAsset->getId());
        $this->assertTrue($savedAsset == null, "asset still exists");
    }

    public function testFolder() {

        // create folder but don't save it
        $folder = Pimcore_Test_Helper_Tool::createImageAsset("myfolder", file_get_contents(__DIR__ . "/../../../fixtures/assets/images/image5.jpg"), false);
        $folder->setType("folder");

        $fitem = Asset::getById($folder->getId());
        $this->assertNull($fitem);

        $response = $this->getRestClient()->createAssetFolder($folder);
        $this->assertTrue($response->id > 0, "request wasn't successful");

        $id = $response->id;
        $this->assertTrue($id > 1, "id not set");

        $folderDirect = Asset::getById($id);
        $this->assertTrue($folderDirect->getType() == "folder");

        $folderRest = $this->getRestClient()->getAssetById($id);
        $this->assertTrue(Pimcore_Test_Helper_Tool::assetsAreEqual($folderRest, $folderDirect, false), "assets are not equal");

        $this->getRestClient()->deleteAsset($id);

        Pimcore::collectGarbage();
        $folderDirect = Asset::getById($id);
        $this->assertNull($folderDirect, "folder still exists");
    }

}
