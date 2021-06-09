<?php
namespace content_site\ganje\gallery;


class layout
{


	/**
	 * Layout gallery html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{
		return;
		var_dump($_args);



		$html = '';

		$html .= '<div class="'. a($_args, 'avand').'">';
		{
			$html .= '<div class="">';
			{
				$html .= '<div class="">';
				{
					$html .= '<h2>';
					{
						$html .= a($_args, 'heading');
					}
					$html .= '</h2>';

					foreach ($data as $key => $value)
					{

						$html .= '<div>';
						$html .= a($value, 'title');
						$html .= '</div>';
					}
				}
				$html .= '</div>';
			}
			$html .= '</div>';
		}
		$html .= '</div>';


		return $html;
	}
}
?>