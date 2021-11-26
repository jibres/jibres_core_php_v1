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

				$hrStyle = 'border:none;width:100%;display:block;margin:10px 0;';
				$hrStyle .= 'border-bottom:'. $height. ' '. $style. ' '. $color. ';';

				$html .= '<hr';
				$html .= ' style="'. $hrStyle. '"';
				$html .= '>';

				if($text)
				{
					$topOffset = str_replace('px', '', $height);
					$topOffset = round(intval($topOffset) / 2) - 1;
					$topOffset = $topOffset + 20;

					$textStyle = 'position:relative;display:inline-block;line-height:20px;height:20px;max-width:200px;padding:0 10px;';
					$textStyle .= 'top:-'. $topOffset.'px;';
					$textStyle .= 'color:'. $color. ';';
					$textStyle .= 'font-size:28px;';
					if(a($_args, 'background:style'))
					{
						$textStyle .= a($_args, 'background:style');
					}

					$html .= '<span';
					$html .= ' style="'. $textStyle. '"';
					$html .= '>';
					{
						$html .= $text;
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