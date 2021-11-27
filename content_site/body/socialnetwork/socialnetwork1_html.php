<?php
namespace content_site\body\socialnetwork;


class socialnetwork1_html
{
	public static function html($_args)
	{

    $html = \content_site\assemble\wrench\section::element_start($_args);
    {
      $html .= \content_site\assemble\wrench\section::container($_args);
      {
        $html .= \content_site\assemble\wrench\heading::simple1($_args);

        // add links
        $socialArg =
        [
          'navClass'  => 'justify-center',
          'linkColor' => a($_args, 'color_text'),
        ];
        $html .= \content_site\assemble\wrench\socialnetworks::type2(\lib\store::social(), null, $socialArg);
      }
      $html .= "</div>";
    }
    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>