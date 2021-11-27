<?php
namespace content_site\body\separator;


class separator2_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-center']);
			{
				$height = a($_args, 'height_separator'). 'px';
				$color  = a($_args, 'color');

				$svg = null;
				if(a($_args, 'separator_icon'))
				{
					if($_args['separator_icon'] === 'rafiei')
					{
						$svg = \content_site\options\separator\separator_icon::rafiei_svg();
					}
					else
					{
						$svg = \dash\utility\icon::bootstrap(a($_args, 'separator_icon'), 'mx-auto', ['height' => 30]);
					}
				}


				$text = '§';
				$text = null;

				$hrStyle = 'border:none;width:100%;display:block;margin:15px 0;';
				$hrStyle .= 'height:'. $height. ';';
				$hrStyle .= 'background-image:linear-gradient(to right,rgba(0,0,0,0),'. $color. ',rgba(0,0,0,0));';

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