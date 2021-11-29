<?php
namespace content_site\body\application;


class add_download_links
{
	public static function all($_args, $_opt = null)
	{

		$html = '';

    $navClass = 'my-2 lg:my-4';
    if(a($_opt, 'navClass'))
    {
      $navClass = a($_opt, 'navClass');
    }

    $appDetail = \lib\app\application\detail::get_android();

    $html .= '<nav class="dl '. $navClass. '">';
    {
      // dl link of all type
      // google play

      if(a($appDetail, 'googleplay'))
      {
        $html .= self::createDlLink('googleplay', a($appDetail, 'googleplay'), $_opt);
      }

      $html .= self::createDlLink('downloadapk', \lib\store::android_apk_url(), $_opt);

      if(a($appDetail, 'myket'))
      {
        $html .= self::createDlLink('myket', a($appDetail, 'myket'), $_opt);
      }

      if(a($appDetail, 'cafebazar'))
      {
        $html .= self::createDlLink('cafebazar', a($appDetail, 'cafebazar'), $_opt);
      }
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
    $myEl .= '<img src="'. \dash\sample\img::blank() .'" data-src="'. $imgSrc. '" alt="'. $imgAlt. '" class="'. $imgClass. '">';
    $myEl .= '</a>';

    return $myEl;
  }
}
?>