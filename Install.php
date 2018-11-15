<?php

class Install
{
    private function htmlSpecialChars($arg) {
        $search = ['<','>','&lt','&gt','&#60;','&#62;'];
        return str_replace($search,'',$arg);

    }
    public function realEscapeHtml($arg) {
        $result = trim($this->htmlSpecialChars(stripcslashes($arg)));
        return $result;
    }
}