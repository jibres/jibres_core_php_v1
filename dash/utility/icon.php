<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function svg($_name, $_pack = null, $_fill = null, $_class = null)
    {
        $svgData = null;
        $filePath = YARD.'talambar_cdn'. self::generateFileName($_name, $_pack);

        if(is_file($filePath))
        {
            $svgData = file_get_contents($filePath);

            $svgData = self::prepareSVG($svgData, $_pack, $_fill, $_class);
        }

        return $svgData;
    }


    public static function url($_name, $_pack = null)
    {
        return \dash\url::cdn(). self::generateFileName($_name, $_pack);
    }


    public static function src($_name, $_pack = null, $_fill = null, $_class = null)
    {
        $fileContent = self::svg($_name, $_pack);
        if($fileContent)
        {
            $fileContent = self::prepareSVG($fileContent, $_pack, $_fill, $_class);

            return 'data:image/svg+xml,'. rawurlencode($fileContent);
        }
        return null;
    }


    private static function prepareSVG($_data, $_pack = null, $_fill = null, $_class = null)
    {
        if($_fill)
        {
            switch ($_pack)
            {
                case 'major':
                case 'minor':
                    $_data = str_replace('#5C5F62', $_fill, $_data);
                    break;

                case 'bootstrap2':
                    $_data = str_replace('currentColor', $_fill, $_data);
                    break;

                default:
                    break;
            }
        }
        if($_class)
        {
            $class = '<svg class="'. $_class. '" ';
            $_data = str_replace('<svg ', $class, $_data);
        }

        return $_data;
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

            case 'pack':
            case 'social':
            case 'bootstrap':
                $fileName .= $_pack. '/';
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