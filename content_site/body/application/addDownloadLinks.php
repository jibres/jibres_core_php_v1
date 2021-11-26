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
      if($link_googleplay)
      {
        $html .= '<a target="_blank" rel="noopener" class="" href="'. $link_googleplay. '">';
        $img_googleplay = \dash\url::cdn(). '/img/app/get/googleplay';
        if(\dash\language::current() === 'fa')
        {
          $img_googleplay .= '-fa';
        }
        $img_googleplay .= '.png';

        $html .= '<img src="'. $img_googleplay. '" alt="'. T_('Download from Google Play'). '" class="">';
        $html .= '</a>';
      }

      // direct download
      if($link_directdl or 1)
      {
        $html .= '<a target="_blank" rel="noopener" class="" href="'. $link_directdl. '">';
        $img_directdl = \dash\url::cdn(). '/img/app/get/downloadapk';
        if(\dash\language::current() === 'fa')
        {
          $img_directdl .= '-fa';
        }
        $img_directdl .= '.png';

        $html .= '<img src="'. $img_directdl. '" alt="'. T_('Direct download'). '" class="">';
        $html .= '</a>';
      }

      // mayket
      if($link_myket or 1)
      {
        $html .= '<a target="_blank" rel="noopener" class="" href="'. $link_myket. '">';
        $img_myket = \dash\url::cdn(). '/img/app/get/myket';
        if(\dash\language::current() === 'fa')
        {
          $img_myket .= '-fa';
        }
        $img_myket .= '.png';

        $html .= '<img src="'. $img_myket. '" alt="'. T_('Download from Myket'). '" class="">';
        $html .= '</a>';
      }

      // cafebazaar
      if($link_cafebazar or 1)
      {
        $html .= '<a target="_blank" rel="noopener" class="" href="'. $link_cafebazar. '">';
        $img_cafebazar = \dash\url::cdn(). '/img/app/get/cafebazar';
        if(\dash\language::current() === 'fa')
        {
          $img_cafebazar .= '-fa';
        }
        $img_cafebazar .= '.png';

        $html .= '<img src="'. $img_cafebazar. '" alt="'. T_('Download from CafeBazar'). '" class="">';
        $html .= '</a>';
      }
    }

		return $html;
	}


}
?>