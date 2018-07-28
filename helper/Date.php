<?php


class Date
{
    public static function today(){
        return date("Y-m-d");
    }

    public static function now(){
        return date("Y-m-d h:i a");
    }

    public static function timestamp($string){
        return strtotime($string);
    }
}