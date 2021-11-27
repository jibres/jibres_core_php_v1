<?php
namespace content_site\body\application;


class app2_html
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


        $html .= '<div class="flex flex-wrap align-center py-1 md:py-2">';
        {
          $html .= '<div class="w-full lg:w-4/12">';
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

          $html .= '<div class="w-full lg:w-8/12 txtRa">';
          {

            $dlLinkOpt =
            [
              'linkClass' => 'inline-block rounded-lg overflow-hidden m-0.5 lg:m-1 transition hover:shadow-lg w-36 opacity-80 hover:opacity-90 focus:opacity-100',
            ];
            $html .= add_download_links::all($_args, $dlLinkOpt);

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