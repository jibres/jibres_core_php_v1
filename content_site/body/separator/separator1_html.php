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
				$height = a($_args, 'height_separator'). 'px';
				$style = 'solid';
				$color = '#358ab1';
				$text = '§';

				$svg = \dash\utility\icon::bootstrap('Asterisk', 'mx-auto', ['height' => 30]);

				$hrStyle = 'border:none;width:100%;display:block;margin:15px 0;';
				$hrStyle .= 'border-bottom:'. $height. ' '. $style. ' '. $color. ';';

				$html .= '<div class="relative overflow-hidden">';
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