<?php
namespace content_site\body\application;


class application1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
  			$title   = a($_args, 'heading');
  			$desc    = a($_args, 'description');
  			$logoSrc = a($_args, 'logo');

        $color_heading    = a($_args, 'color_heading:full_style');

        $link_googleplay  = a($_args, 'link_googleplay');
        $android_apk_link = a($_args, 'android_apk_link');
        $link_myket       = a($_args, 'link_myket');
        $link_cafebazar   = a($_args, 'link_cafebazar');


        $html .= '<div class="flex">';
        {
          $html .= '<div class="w-1/12"></div>';
          $html .= '<div class="w-4/12">';
          {
            $figureStyle = 'margin-top:-100px;margin-bottom:-80px;';
            $html .= '<figure style="'. $figureStyle. '">';
            {
              $html .= '<img loading="lazy" data-src="https://cdn.jibres.ir/img/homepage/jibres-app.png">';
            }
            $html .= '</figure>';
          }
          $html .= '</div>';

          $html .= '<div class="w-7/12 py-36">';
          {
            $html .= '<h2';
            $html .= ' class="font-bold text-3xl"';
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
              // direct download
              // cafebazaar
              // mayket
              // pwa
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