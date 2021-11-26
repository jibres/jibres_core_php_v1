<?php
namespace content_site\body\separator;


class separator2_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$width = '5px';
				$style = 'double';
				$color = '#999';

				$hrStyle = 'border:none;width:100%;margin:10px 0;';
				$hrStyle .= 'border-bottom:'. $width. ' '. $style. ' '. $color. ';';

				$html .= '<hr';
				$html .= ' style="'. $hrStyle. '"';
				$html .= '>';
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>