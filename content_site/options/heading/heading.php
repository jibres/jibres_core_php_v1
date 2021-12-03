<?php
namespace content_site\options\heading;


class heading
{

	public static function validator($_data)
	{
		$new_data            = [];
		$heading             = a($_data, \content_site\utility::className(get_called_class()));
		$new_data['heading'] = \dash\validate::string_100($heading);

		$heading_position             = a($_data, 'heading_position');
		$new_data['heading_position'] = \dash\validate::enum($heading_position, true, ['enum' => ['left', 'center', 'right'], 'field_title' => T_('Heading Position')]);

		$use_as_heading             = a($_data, 'use_as_heading');
		$new_data['use_as_heading'] = \dash\validate::enum($use_as_heading, true, ['enum' => ['business_heading', 'custom_heading', ], 'field_title' => T_('Heading')]);

		// var_dump($_data, $new_data);exit;
		return $new_data;
	}



	public static function db_key()
	{
		return 'heading';
	}


	public static function class_name($_args)
	{
		$class_name = null;

		switch(a($_args, 'heading_position'))
		{
			case 'left':
				$class_name = 'text-left';
				break;

			case 'right':
				$class_name = 'text-right';
				break;

			case 'center':
			default:
				$class_name = 'text-center';
				break;
		}

		return $class_name;
	}

	public static function title()
	{
		return T_("Heading");
	}

	public static function include_business_title()
	{
		return false;
	}


	public static function admin_html($_section_detail)
	{
		$default          = \content_site\section\view::get_current_index_detail('heading');
		$default_position = \content_site\section\view::get_current_index_detail('heading_position');
		$use_as_heading   = \content_site\section\view::get_current_index_detail('use_as_heading');
		$title            = static::title();

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			if(static::include_business_title())
			{
				$name       = 'use_as_heading'
				;
				$html .= \content_site\options\generate::opt_hidden(get_called_class());

				$html .= '<div class="flex">';
				{
					$html .= '<div class="flex-1">';
					{
						$html .= "<label>$title</label>";
					}
					$html .= '</div>';

					$data_response_hide = null;

					if($use_as_heading === 'custom_heading')
					{
						$data_response_hide = 'data-response-hide';
					}

					// open data-response and close after heading input
					$html .= "<div data-response='$name' data-response-where='business_heading' $data_response_hide>";
					{
						$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/general/title">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';

				$radio_html = '';

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_heading', T_("Business"), (($use_as_heading === 'business_heading')? true : false));
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom_heading', T_("Custom"), (($use_as_heading === 'custom_heading')? true : false));


				$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

				$data_response_hide = null;

				if($use_as_heading !== 'custom_heading')
				{
					$data_response_hide = 'data-response-hide';
				}

				// open data-response and close after heading input
				$html .= "<div data-response='$name' data-response-where='custom_heading' $data_response_hide>";


			}

			$myId = 'heading';

			if(a($_section_detail, 'id'))
			{
				$myId = 'heading-'. a($_section_detail, 'id');
			}

			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::not_redirect();

			// in this model title already exist in html
			if(!static::include_business_title())
			{
		    	$html .= '<label for="'.$myId.'">'. $title. '</label>';
			}

			$html .= '<div class="input">';
			{
	    		$html .= "<input type='text' name='opt_".\content_site\utility::className(get_called_class())."' value='$default' data-sync='$myId' id='$myId' placeholder=''>";
			}

			$html .= "</div>";

			// close div data-response
			if(static::include_business_title())
			{
				$html .= '</div>';
			}
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>