<?php
namespace content_site\body\application;


class application1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args, null, ['allowOverflow' => true]);
		{
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
  			$title   = a($_args, 'heading');
  			$desc    = a($_args, 'description');
  			$logoSrc = a($_args, 'logo');

        $color_heading    = a($_args, 'color_heading:full_style');

        $link_googleplay  = a($_args, 'link_googleplay');
        $link_directdl    = a($_args, 'android_apk_link');
        $link_myket       = a($_args, 'link_myket');
        $link_cafebazar   = a($_args, 'link_cafebazar');


        $html .= '<div class="flex">';
        {
          $html .= '<div class="w-4/12 px-4 md:px-6 lg:px-10">';
          {
            $figureStyle = 'margin-top:-100px;margin-bottom:-80px;';
            $figureStyle = '';
            $html .= '<figure style="'. $figureStyle. '">';
            {
              $html .= '<img loading="lazy" data-src="https://cdn.jibres.ir/img/homepage/jibres-app.png">';
            }
            $html .= '</figure>';
          }
          $html .= '</div>';

          $html .= '<div class="w-6/12 pt-28">';
          {
            $html .= '<h2';
            $html .= ' class="font-bold text-4xl"';
            if($color_heading)
            {
              $html .= $color_heading;
            }
            $html .= '>';
            $html .= $title;
            $html .= '</h2>';

            $html .= '<p';
            $html .= ' class="leading-7"';
            if($color_heading)
            {
              $html .= $color_heading;
            }
            $html .= '>';
            $html .= $desc;
            $html .= '</p>';


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
            $html .= '</div>';

          }
          $html .= '</div>';

        }
        $html .= '</div>';
      }
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>