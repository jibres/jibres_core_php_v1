<?php
namespace dash\utility;


class convert
{
	private static $en = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
	private static $ar = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
	private static $fa = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];


	public static function to_en_number($_string)
    {
        $result = str_replace(self::$fa, self::$en, strval($_string));
        $result = str_replace(self::$ar, self::$en, $result);
        return $result;
    }


    public static function to_fa_number($_string)
    {
        $result = str_replace(self::$en, self::$fa, strval($_string));
        $result = str_replace(self::$ar, self::$fa, $result);
        return $result;
    }

    public static function ar_to_fa_number($_string)
    {
        $result = str_replace(self::$ar, self::$fa, strval($_string));
        return $result;
    }


    public static function to_ar_number($_string)
    {
        $result = str_replace(self::$en, self::$ar, strval($_string));
        $result = str_replace(self::$fa, self::$ar, $result);
        return $result;
    }


    public static function to_barcode($_barcode)
    {
    	$result = self::to_en_number($_barcode);
    	$wrong  = ['چ', 'ژ', 'ز'];
        $right  = [']', 'C', 'C'];
        $result = str_replace($wrong, $right, $result);
        return $result;
    }


	public static function mb_to_byte(int $_mb)
	{
		return $_mb * 1024 * 1024;
	}


	public static function gb_to_byte(int $_gb)
	{
		return self::mb_to_byte($_gb) * 1024;
	}


	public static function byte_to_mb($_byte)
	{
		return $_byte / 1024 / 1024;
	}

}
?>