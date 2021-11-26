<?php
namespace content_site\body\application;


class addDownloadLinks
{
	public static function all($_args)
	{
    $link_googleplay  = a($_args, 'link_googleplay');
    $link_directdl    = a($_args, 'android_apk_link');
    $link_myket       = a($_args, 'link_myket');
    $link_cafebazar   = a($_args, 'link_cafebazar');

		$html = '';
    $html .= '<div class="dl">';
    {
      // dl link of all type
      // google play
      $html .= self::createDlLink('googleplay', a($_args, 'link_googleplay'));
      $html .= self::createDlLink('downloadapk', a($_args, 'android_apk_link'));
      $html .= self::createDlLink('myket', a($_args, 'link_myket'));
      $html .= self::createDlLink('cafebazar', a($_args, 'link_cafebazar'));
    }

		return $html;
	}


  private static function createDlLink($_type, $_link)
  {
    if(!$_link)
    {
      return null;
    }

    $myEl   = '<a target="_blank" rel="noopener" class="" href="'. $_link. '">';
    $imgSrc = \dash\url::cdn(). '/img/app/get/'. $_type;
    if(\dash\language::current() === 'fa')
    {
      $imgSrc .= '-fa';
    }
    $imgSrc .= '.png';

    // set img alt
    $imgAlt = T_("Download App");
    switch ($_type)
    {
      case 'googleplay':
        $imgAlt = T_('Download from Google Play');
        break;

      case 'myket':
        $imgAlt = T_('Download from Myket');
        break;

      case 'cafebazar':
        $imgAlt = T_('Download from CafeBazar');
        break;

      case 'downloadapk':
        $imgAlt = T_('Direct download');
        break;

      default:
        break;
    }

    $myEl .= '<img src="'. $imgSrc. '" alt="'. $imgAlt. '" class="">';
    $myEl .= '</a>';

    return $myEl;
  }
}
?>