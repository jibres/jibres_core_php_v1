<?php
namespace content_site\body\application;


class addDownloadLinks
{
	public static function all($_args, $_opt = null)
	{

		$html = '';

    $navClass = 'my-2 lg:my-4';
    if(a($_opt, 'navClass'))
    {
      $navClass = a($_opt, 'navClass');
    }

    $html .= '<nav class="dl '. $navClass. '">';
    {
      // dl link of all type
      // google play
      $html .= self::createDlLink('googleplay', a($_args, 'link_googleplay'), $_opt);
      $html .= self::createDlLink('downloadapk', a($_args, 'android_apk_link'), $_opt);
      $html .= self::createDlLink('myket', a($_args, 'link_myket'), $_opt);
      $html .= self::createDlLink('cafebazar', a($_args, 'link_cafebazar'), $_opt);
    }
    $html .= '</nav>';

		return $html;
	}


  private static function createDlLink($_type, $_link, $_opt)
  {
    if(!$_link && false)
    {
      return null;
    }
    $linkClass = 'inline-block rounded-lg overflow-hidden m-0.5 lg:m-1 transition hover:shadow-lg w-36 sm:w-40 md:w-52 lg:w-40 opacity-80 hover:opacity-90 focus:opacity-100';
    if(a($_opt, 'linkClass'))
    {
      $linkClass = a($_opt, 'linkClass');
    }

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
    if(a($_opt, 'imgClass'))
    {
      $imgClass = a($_opt, 'imgClass');
    }
    $myEl .= '<img src="'. $imgSrc. '" alt="'. $imgAlt. '" class="'. $imgClass. '">';
    $myEl .= '</a>';

    return $myEl;
  }
}
?>