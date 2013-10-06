<?php

class ControllerTest extends Pimcore_Test_Case {


    public function testParentIdentical() {

        $res = $this->dispatch('/');
        $a = $res;
    }

}
