<?php
namespace content_site\options;


class style
{
	public static function admin_html()
	{
		$html = '';
		$url = \dash\url::that(). '/style'. \dash\request::full_get();


		$html .= '<nav class="items long mT20">';
		{
		 		$html .= '<ul>';
		 		{
		   		$html .= '<li>';
		   		{
		      		$html .= "<a class='item f' href='$url'>";
		      		{
		        		$html .= '<img class="bg-gray-100 hover:bg-gray-200 p-2" src="'. \dash\utility\icon::url('Wand'). '">';
		        		$html .= '<div class="key">'. T_("Personalization Desgin"). '</div>';
		        		$html .= '<div class="go"></div>';
		      		}
		      		$html .= '</a>';
		   		}
		   		$html .= '</li>';
		 		}
		 		$html .= '</ul>';
		}
		$html .= '</nav>';

		return $html;
	}

		/**
	 * Everywhere need backgroun pack option use this function
	 *
	 * @return     array  The pack option list.
	 */
	public static function option_list($_model = null)
	{
		$list = [];

		switch ($_model)
		{
			case 'blog':
				$list =
				[
					'background_pack',


					'height',
					'coverratio',

					// skip draw this option in html
					'background_color',

					'background_position',
					'background_repeat',
					'background_size',
					'background_attachment',

					'background_image',

					'background_gradient',
					'background_gradient_type',

					'background_gradient_from',
					'background_gradient_via',
					'background_gradient_to',

					'background_gradient_attachment',
					'background_color_random',

					'color_text',

					'font',
					'btn_viewall_mode',
					'link_mode',

					'type',
				];
				break;


			default:
				$list =
				[
					'background_pack',


					'height',
					'coverratio',

					// skip draw this option in html
					'background_color',

					'background_position',
					'background_repeat',
					'background_size',
					'background_attachment',

					'background_image',

					'background_gradient',
					'background_gradient_type',

					'background_gradient_from',
					'background_gradient_via',
					'background_gradient_to',

					'background_gradient_attachment',
					'background_color_random',

					'color_text',

					'font',

					'type',
				];
				break;
		}

		// set current option list
		\content_site\options\background\background_pack::current_background_pack_option($list);

		return $list;
	}





}
?>