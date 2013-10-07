<?php

class ControllerTest extends Pimcore_Test_Case {


    public function testDispatchStart() {
        $res = $this->dispatch('/');
        $this->assertNotEmpty($res->getBody());
    }

}
