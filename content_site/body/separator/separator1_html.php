<?php
namespace content_site\body\separator;


class separator1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$hrStyle = 'border:none'
			$html .= '<hr';
			$html .= ' style="'. $hrStyle. '"';
			$html .= '>';
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}

}
?>