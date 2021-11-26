<?php
namespace content_site\body\application;


class enterpriseRafiei_html
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

        $color_heading = a($_args, 'color_heading:full_style');
        $color_text    = a($_args, 'color_text:full_style');


        $html .= '<div class="flex flex-wrap align-center">';
        {
          $html .= '<div class="w-full sm:w-6/12">';
          {
            $html .= '<h2';
            $html .= ' class="font-bold text-lg sm:text-xl"';
            if($color_heading)
            {
              $html .= $color_heading;
            }
            $html .= '>';
            $html .= $title;
            $html .= '</h2>';

            $html .= '<p';
            $html .= ' class="leading-7 text-sm mb-1"';
            if($color_text)
            {
              $html .= $color_text;
            }
            $html .= '>';
            $html .= $desc;
            $html .= '</p>';

          }
          $html .= '</div>';

          $html .= '<div class="w-full sm:w-6/12 text-center">';
          {

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