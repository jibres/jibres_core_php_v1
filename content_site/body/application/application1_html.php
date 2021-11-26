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


        $html .= '<div class="flex flex-wrap">';
        {
          $html .= '<div class="w-full sm:w-4/12">';
          {
            $figureStyle = 'margin-top:-100px;margin-bottom:-80px;';
            $figureStyle = '';
            $html .= '<figure style="'. $figureStyle. '">';
            {
              $imgSrc = \dash\url::cdn(). '/img/homepage/jibres-app.png';
              $html .= '<img loading="lazy" data-src="'. $imgSrc. '" class="mx-auto w-44 sm:w-48 md:w-52 lg:w-60" alt="'. $title. '">';
            }
            $html .= '</figure>';
          }
          $html .= '</div>';

          $html .= '<div class="w-full sm:w-8/12 py-2 sm:py-16 lg:py-28 text-center">';
          {
            $html .= '<h2';
            $html .= ' class="font-bold text-lg sm:text-2xl md:text-3xl lg:text-4xl"';
            if($color_heading)
            {
              $html .= $color_heading;
            }
            $html .= '>';
            $html .= $title;
            $html .= '</h2>';

            $html .= '<p';
            $html .= ' class="leading-7 text-xs md:text-base mb-1"';
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