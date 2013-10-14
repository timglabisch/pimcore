<?php

class ControllerTest extends Pimcore_Test_Case {

    public function setUp() {
        parent::setUp();

        if(!Document::getByPath('/')) {
            $d = new Document_Page();
            $d->setPath('/');
            $d->setKey('');
            $d->setPublished(true);
            $d->setId(1);
            $d->save();
        }
    }

    public function testDispatchStart() {
        $res = $this->dispatch('/');
        $this->assertNotEmpty($res->getBody());
    }

}
