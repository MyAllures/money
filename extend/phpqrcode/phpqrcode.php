<?php

namespace phpqrcode;

class phpqrcode {

    public function png($data) {
        require_once dirname(__FILE__) . '/phpqrcode/phpqrcode.php';
        $url = urldecode($data);
       \QRcode::png($url);
    }

}
