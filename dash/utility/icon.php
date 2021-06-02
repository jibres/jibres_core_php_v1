<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function svg($_name, $_pack = null)
    {
        $filePath = YARD.'talambar_cdn'. self::generateFileName($_name, $_pack);

        if(is_file($filePath))
        {
            return file_get_contents($filePath);
        }
        return null;
    }


    public static function url($_name, $_pack = null)
    {
        return \dash\url::cdn(). self::generateFileName($_name, $_pack);
    }


    public static function src($_name, $_pack = null)
    {
        $fileContent = self::svg($_name, $_pack);
        if($fileContent)
        {
            return 'data:image/svg+xml,'. rawurlencode($fileContent);
        }
        return null;
    }


    private static function generateFileName($_name, $_pack = null)
    {
        if(!$_pack)
        {
            $_pack = 'major';
        }

        $fileName = '/img/svg/icon/';
        switch ($_pack)
        {
            case 'major':
            case 'minor':
                $fileName .= $_pack. '/';

                $_name = ucwords($_name);
                $_name = str_replace(' ', '', $_name);
                $_name .= ucwords($_pack);

                $fileName .= $_name;

                break;

            default:
                // use other folders
                break;
        }

        // add svg extention
        $fileName .= '.svg';

        return $fileName;
    }
}
?>