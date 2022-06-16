<?php
namespace content_site\body\text;


class layout
{


	/**
	 * Layout blog html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		$html = \content_site\assemble\wrench\section::element_start($_args);
		{
			$html .= \content_site\assemble\wrench\section::container($_args);
			{
				$color_text = a($_args, 'color_text:style');
				$style = "style='". $color_text. ";'";
				$class = "class='leading-relaxed'";
				if(\dash\language::current() === 'fa')
				{
					$class = "class='leading-loose'";
				}
				$html .= "<div $style $class>";
				{
					$html .= a($_args, 'html_text');
				}
				$html .= "</div>";
			}
			$html .= "</div>";
		}
		$html .= \content_site\assemble\wrench\section::element_end($_args);

		return $html;
	}
}
?>