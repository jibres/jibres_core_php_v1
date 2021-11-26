<?php
namespace content_site\body\application;


class addDownloadLinks
{
	public static function all($_args)
	{
		$html = '';
    $html .= '<nav class="dl my-4">';
    {
      // dl link of all type
      // google play
      $html .= self::createDlLink('googleplay', a($_args, 'link_googleplay'));
      $html .= self::createDlLink('downloadapk', a($_args, 'android_apk_link'));
      $html .= self::createDlLink('myket', a($_args, 'link_myket'));
      $html .= self::createDlLink('cafebazar', a($_args, 'link_cafebazar'));
    }
    $html .= '</nav>';

		return $html;
	}


  private static function createDlLink($_type, $_link)
  {
    if(!$_link && false)
    {
      return null;
    }
    $linkClass = 'inline-block rounded-lg overflow-hidden m-0.5 lg:m-1 transition hover:shadow-lg w-36 opacity-80 hover:opacity-90 focus:opacity-100';
    $myEl   = '<a target="_blank" rel="noopener" class="'. $linkClass. '" href="'. $_link. '">';
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

    $imgClass = 'block rounded-lg';
    $myEl .= '<img src="'. $imgSrc. '" alt="'. $imgAlt. '" class="'. $imgClass. '">';
    $myEl .= '</a>';

    return $myEl;
  }
}
?>