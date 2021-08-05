<?php
namespace content_site\assemble;


class background
{

	public static function full_style($_data)
	{
		$style = self::style($_data);

		return "style='$style' ";
	}


	/**
	 * Get all style in backgroun
	 *
	 * @param      <type>  $_data  The backgroun pack array
	 */
	public static function style($_data)
	{
		$pack    = a($_data, 'background_pack');

		$style    = [];

		switch ($pack)
		{
			case 'solid';
				if(!a($_data, 'background_color'))
				{
					$_data['background_color'] = \content_site\options\background\background_color::default();
				}

				$style[] = 'background:'. $_data['background_color']. ';';
				break;

			case 'image';

				// background file
				if(a($_data, 'file'))
				{
					$style[] = 'background-image: url('.\lib\filepath::fix($_data['file']).');';
				}

				// backgroun repreat
				if(!a($_data, 'background_repeat'))
				{
					$_data['background_repeat'] = \content_site\options\background\background_repeat::default();
				}

				$style[] = 'background-repeat:'. $_data['background_repeat']. ';';


				// backgroun attachemnt
				if(!a($_data, 'background_attachment'))
				{
					$_data['background_attachment'] = \content_site\options\background\background_attachment::default();
				}

				$style[] = 'background-attachment:'. $_data['background_attachment']. ';';

				// backgroun position
				if(!a($_data, 'background_position'))
				{
					$_data['background_position'] = \content_site\options\background\background_position::default();
				}

				$style[] = 'background-position:'. $_data['background_position']. ';';


				// backgroun size
				if(!a($_data, 'background_size'))
				{
					$_data['background_size'] = \content_site\options\background\background_size::default();
				}

				$style[] = 'background-size:'. $_data['background_size']. ';';
				break;

			case 'gradient';
				// backgroun gradient type
				if(!a($_data, 'background_gradient_type'))
				{
					$_data['background_gradient_type'] = \content_site\options\background\background_gradient_type::default();
				}

				$gradient_type = $_data['background_gradient_type'];


				// backgroun gradient from
				if(!a($_data, 'background_gradient_from'))
				{
					$_data['background_gradient_from'] = \content_site\options\background\background_gradient_from::default();
				}

				$from = $_data['background_gradient_from'];

				// backgroun gradient via
				if(!a($_data, 'background_gradient_via'))
				{
					$_data['background_gradient_via'] = \content_site\options\background\background_gradient_via::default();
				}

				$via =  $_data['background_gradient_via'];


				// backgroun gradient to
				if(!a($_data, 'background_gradient_to'))
				{
					$_data['background_gradient_to'] = \content_site\options\background\background_gradient_to::default();
				}

				$to = $_data['background_gradient_to'];

				$style[] = "background: linear-gradient($gradient_type, $from, $via, $to);";

				break;


			// case 'video';
			// 	// background video
			// 	if(a($_data, 'video'))
			// 	{
			// 		$element .= '<style type="text/css">#page_background_video { right: 0;  bottom: 0;  min-width: 100%;  min-height: 100%; }</style>';
			// 		$element .= '<video playsinline autoplay muted loop  id="page_background_video">';
			// 		{
			// 			$element .= '<source src="'.\lib\filepath::fix($_data['video']).'" type="video/mp4">';
			// 		}
			// 		$element .= '</video>';
			// 	}
			// 	break;

			case 'none';
			default:
				// no backgroun style
				return null;
				break;
		}

		return implode(' ', $style);
	}
}
?>