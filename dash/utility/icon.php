<?php
namespace dash\utility;

class icon
{
    // based on shopify polaris icon pack
    // https://polaris-icons.shopify.com/

    public static function svg($_name, $_pack = null, $_fill = null, $_class = null, $_args = null)
    {
        $svgData = null;
        $filePath = YARD.'talambar_cdn'. self::generateFileName($_name, $_pack);

        if(is_file($filePath))
        {
            $svgData = file_get_contents($filePath);

            $svgData = self::prepareSVG($svgData, $_pack, $_fill, $_class, $_args);
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


    private static function prepareSVG($_data, $_pack = null, $_fill = null, $_class = null, $_args = null)
    {
        switch ($_pack)
        {
            case 'major':
            case 'minor':
            default:
                if($_fill)
                {
                    $_data = str_replace('#5C5F62', $_fill, $_data);
                }
                break;

            case 'bootstrap':
                if($_fill)
                {
                    $_data = str_replace('currentColor', $_fill, $_data);
                }
                if(a($_args, 'width'))
                {
                    $_data = str_replace('width="16"', 'width="'. a($_args, 'width'). '" ', $_data);
                }
                else
                {
                    $_data = str_replace('width="16" ', '', $_data);
                }
                if(a($_args, 'height'))
                {
                    $_data = str_replace('height="16"', 'height="'. a($_args, 'height'). '" ', $_data);
                }
                else
                {
                    $_data = str_replace('height="16" ', '', $_data);
                }
                break;

        }
        if($_class)
        {
            if(\dash\str::strpos($_data, ' class="') === false)
            {
                $class = '<svg class="'. $_class. '" ';
                $_data = str_replace('<svg ', $class, $_data);
            }
            else
            {
                $class = ' class="'. $_class. ' ';
                $_data = str_replace(' class="', $class, $_data);
            }
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

            case 'bootstrap':
                $fileName .= $_pack. '/';
                $_name = str_replace(' ', '-', $_name);
                $_name = strtolower($_name);
                $fileName .= $_name;
                break;

            case 'pack':
            case 'social':
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


    public static function bootstrap($_name, $_class = null, $_args = null)
    {
        $fill = null;
        if(a($_args, 'fill'))
        {
            $fill = a($_args, 'fill');
        }

        return self::svg($_name, 'bootstrap', $fill, $_class, $_args);
    }



    /**
     * Delete icon
     *
     * @return     <type>  ( description_of_the_return_value )
     */
    public static function svg_delete()
    {
        return self::svg('trash', 'bootstrap', null, 'text-red-500');
    }
}
?>