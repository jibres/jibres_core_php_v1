<?php
namespace dash\utility;

class random
{


    public static function string($_length = 10, string $_alphabet = null) : string
    {
        if(!$_alphabet)
        {
            $characters  = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        }
        else
        {
            $characters = $_alphabet;
        }
        $charactersLength = strlen($characters);
        $randomString     = '';

        for ($i = 0; $i < $_length; $i++)
        {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
?>