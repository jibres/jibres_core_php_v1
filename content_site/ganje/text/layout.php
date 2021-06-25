<?php
namespace content_site\ganje\text;


class layout
{


	/**
	 * Layout text html
	 *
	 * @param      <type>  $_args  The data
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function layout($_args)
	{

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

					if(isset($_args['imagelist']) && is_array($_args['imagelist']))
					{
						$html .= '<div class="row">';

						foreach ($_args['imagelist'] as $key => $value)
						{
							$file = \dash\utility\icon::url('Image', 'major');

							if(isset($value['file']) && $value['file'])
							{
								$file = \lib\filepath::fix($value['file']);
							}

							$html .= '<div class="c-xs-12 c-sm-4">';
							$html .= '<img src="'. $file. '" alt="'. a($value, 'alt'). '">';
							$html .= '</div>';
						}
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