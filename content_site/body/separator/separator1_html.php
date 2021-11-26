<?php
namespace content_site\body\separator;


class separator1_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-center']);
			{
				$height = '10px';
				$style = 'solid';
				$color = '#358ab1';
				$text = '§';
				$svg = null;

				$hrStyle = 'border:none;width:100%;display:block;margin:10px 0;';
				$hrStyle .= 'border-bottom:'. $height. ' '. $style. ' '. $color. ';';

				$html .= '<div class="relative">';
				{
					$html .= '<hr';
					$html .= ' style="'. $hrStyle. '"';
					$html .= '>';
				}
				$html .= addText::el($text, $svg, $height, $color, a($_args, 'background:style'));
				$html .= "</div>";
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>