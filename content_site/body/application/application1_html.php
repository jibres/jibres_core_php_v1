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

            $html .= addDownloadLinks::all($_args);

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