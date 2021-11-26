<?php
namespace content_site\body\separator;


class separatorSVG_html
{
	public static function html($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args, ['class' => 'text-center']);
			{
				$height = '5px';
				$color = '#004bb0';
				$text = '§';
				$rafieiSVG = '<svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="300" height="142" preserveAspectRatio="meet"><g fill="#333"><path d="M66.2 24.3C57.3 33.2 50 41 50 41.5s7.3 8.3 16.2 17.2L82.5 75l16.7-16.7L116 41.5l16.8 16.8L149.5 75l16.8-16.7L183 41.5l16.8 16.8L216.5 75l16.8-16.7L250 41.5l-16.7-16.7L216.5 8l-16.7 16.7L183 41.5l-16.7-16.8L149.5 8l-16.7 16.7L116 41.5 99.2 24.7 82.5 8 66.2 24.3z"/><path d="M32.7 83.8L16 100.5l16.8 16.8L49.5 134l16.8-16.7L83 100.5l16.8 16.8 16.7 16.7 16.8-16.7 16.7-16.8 16.8 16.8 16.7 16.7 16.8-16.7 16.7-16.8 16.8 16.8 16.7 16.7 16.3-16.3c8.9-8.9 16.2-16.7 16.2-17.2s-7.3-8.3-16.2-17.2L250.5 67l-16.7 16.7-16.8 16.8-16.7-16.8L183.5 67l-16.7 16.7-16.8 16.8-16.8-16.8L116.5 67 99.7 83.7 83 100.5 66.2 83.7 49.5 67 32.7 83.8z"/></g></svg>';

				$svg = $rafieiSVG;


				$hrStyle = 'border:none;width:100%;display:block;margin:10px 0;';
				$hrStyle .= 'height:'. $height. ';';
				$hrStyle .= 'background-image:linear-gradient(to right,rgba(0,0,0,0),'. $color. ',rgba(0,0,0,0));';

				$html .= '<hr';
				$html .= ' style="'. $hrStyle. '"';
				$html .= '>';

				if($text)
				{
					$topOffset = str_replace('px', '', $height);
					$topOffset = round(intval($topOffset) / 2) - 1;
					$topOffset = $topOffset + 25;

					$textStyle = 'position:relative;display:inline-block;line-height:30px;height:30px;max-width:200px;padding:0 10px;';
					$textStyle .= 'top:-'. $topOffset.'px;';
					$textStyle .= 'color:'. $color. ';';
					$textStyle .= 'font-size:28px;';
					if(a($_args, 'background:style'))
					{
						$textStyle .= a($_args, 'background:style');
					}
					else
					{
						$textStyle .= 'background-color:#fff';
					}

					$html .= '<span';
					$html .= ' style="'. $textStyle. '"';
					$html .= '>';
					{
						if($svg)
						{
							$imgStyle = 'max-height:30px;';
							$svgSrc = 'data:image/svg+xml,'. rawurlencode($svg);
							$html .= '<img alt="separator" src="'. $svgSrc. '" style="'. $imgStyle. '">';
						}
						else
						{
							$html .= $text;
						}
					}
					$html .= '</span>';
				}
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>