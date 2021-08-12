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

			$id          = a($_args, 'id');
		$type        = a($_args, 'type');
		$coverRatio  = \content_site\options\coverratio::get_class(a($_args, 'coverratio'));
		$font_class  = \content_site\assemble\font::class($_args);
		// $type        = 'b1';

		$height           = \content_site\options\height::class_name(a($_args, 'height'));
		$background_style = \content_site\assemble\background::full_style($_args);
		$text_color       = \content_site\assemble\text_color::full_style($_args);
		$section_id       = \content_site\assemble\tools::section_id($type, $id);


		$containerMaxWidth = 'max-w-screen-lg px-2 sm:px-4 lg:px-4';


		// element type
		$cnElement = 'div';
		if(a($_args, 'heading') !== null)
		{
			$cnElement = 'section';
		}
		$classNames = $height;
		if($font_class)
		{
			$classNames .= ' '. $font_class;
		}

		$html .= "<$cnElement data-type='$type' class='$classNames'$background_style $section_id>";
		{
			$html .= "<div class='$containerMaxWidth m-auto'>";
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

							if(isset($value['image']) && $value['image'])
							{
								$file = \lib\filepath::fix($value['image']);
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