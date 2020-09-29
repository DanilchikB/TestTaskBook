<?php

namespace Core;

class Form{
    public static function linePreparation(string $str) : string{
        return htmlspecialchars(trim($str));
    }
}