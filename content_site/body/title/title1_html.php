<?php
namespace content_site\body\title;


class title1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= '<h2>'. a($_args, 'heading'). '</h1>';
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}

}
?>