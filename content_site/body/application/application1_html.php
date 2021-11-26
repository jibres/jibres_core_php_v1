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

        $link_googleplay  = a($_args, 'link_googleplay');
        $link_cafebazar   = a($_args, 'link_cafebazar');
        $link_myket       = a($_args, 'link_myket');
        $android_apk_link = a($_args, 'android_apk_link');


        $html .= '<div class="flex">';
        {
          $html .= '<div class="w-5/12">';
          {
            $html .= '5';

          }
          $html .= '</div>';

          $html .= '<div class="w-7/12">';
          {
            $html .= '7';
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