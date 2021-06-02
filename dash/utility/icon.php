<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function svg($_name = null)
    {
        $filePath = YARD.'talambar_cdn'. self::generateFileName($_name);

        if(is_file($filePath))
        {
            return file_get_contents($filePath);
        }
        return null;
    }


    public static function url($_name = null)
    {
        return \dash\url::cdn(). self::generateFileName($_name);
    }


    public static function src($_name = null)
    {
        $fileContent = self::svg($_name);
        if($fileContent)
        {
            return 'data:image/svg+xml,'. rawurlencode($fileContent);
        }
        return null;
    }


    private static function generateFileName($_name)
    {
        $fileName = '/img/svg/icon/';
        $fileName .= str_replace(' ', '', $_name);
        $fileName .= 'Major';
        $fileName .= '.svg';

        return $fileName;
    }
}
?>