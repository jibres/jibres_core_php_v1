<?php
namespace content_site\body\gallery;


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

					if(isset($_args['image_list']) && is_array($_args['image_list']))
					{
						$html .= '<div class="row">';

						foreach ($_args['image_list'] as $key => $value)
						{
							$file = \dash\utility\icon::url('Image', 'major');

							if(isset($value['file']) && $value['file'])
							{
								$file = \lib\filepath::fix($value['file']);
							}

							$html .= '<div class="c-xs-12 c-sm-4">';
							$html .= '<img src="'. $file. '" alt="'. a($value, 'caption'). '">';
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