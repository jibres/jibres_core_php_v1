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

		$html             = '';
		$container        = \content_site\options\container::class_name(a($_args, 'container'));
		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background       = \content_site\options\background\background_pack::get_full_backgroun_class(a($_args, 'background'));
		$background_class = a($background, 'class');
		$background_attr  = a($background, 'attr');
		$element          = a($background, 'element');

		$html .= $element;

		$html .= "<div class='$container $height $background_class ' $background_attr>";
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
							$file = \dash\app::static_image_url();

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