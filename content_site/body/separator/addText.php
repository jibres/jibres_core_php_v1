<?php
namespace content_site\body\separator;


class addText
{
	public static function el($_text, $_svg, $_height, $_color, $_bg)
	{
		$html = '';

		if($_text || $_svg)
		{
			$topOffset = str_replace('px', '', $_height);
			$topOffset = round(intval($topOffset) / 2) - 1;
			// $topOffset = $topOffset + 25;

			$textStyle = 'position:absolute;top:0;right:0;left:0;margin:0 auto;';
			$textStyle .= 'display:inline-block;line-height:30px;height:30px;max-width:100px;padding:0 10px;';
			$textStyle .= 'margin-top:'. $topOffset.'px;';
			$textStyle .= 'color:'. $_color. ';';
			$textStyle .= 'font-size:28px;';
			if($_bg)
			{
				$textStyle .= $_bg;
			}
			else
			{
				$textStyle .= 'background-color:#fff';
			}

			$html .= '<span';
			$html .= ' style="'. $textStyle. '"';
			$html .= '>';
			{
				if($_svg)
				{
					// $svgSrc = 'data:image/svg+xml,'. rawurlencode($_svg);
					// $imgStyle = 'max-height:30px;display:block; margin:0 auto;';
					// $html .= '<img alt="separator" src="'. $svgSrc. '" style="'. $imgStyle. '">';

					$html .= $_svg;
				}
				else
				{
					$html .= $_text;
				}
			}
			$html .= '</span>';
		}


		return $html;
	}
}
?>