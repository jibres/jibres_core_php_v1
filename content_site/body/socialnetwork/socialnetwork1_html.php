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
                // set social media links
          $html .= \content_site\assemble\wrench\socialnetworks::type1($_args);
      }
      $html .= "</div>";
    }
    $html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}


}
?>