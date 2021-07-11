<?php
namespace content_site\options;


class heading
{

	public static function validator($_data)
	{
		$new_data            = [];
		$heading             = a($_data, 'heading');
		$new_data['heading'] = \dash\validate::string_100($heading);

		$heading_position             = a($_data, 'heading_position');
		$new_data['heading_position'] = \dash\validate::enum($heading_position, true, ['enum' => ['left', 'center', 'right'], 'field_title' => T_('Heading Position')]);

		return $new_data;
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


	public static function admin_html($_section_detail)
	{
		$default          = \content_site\section\view::get_current_index_detail('heading');
		$default_position = \content_site\section\view::get_current_index_detail('heading_position');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="not_redirect" value="1">';
		    $html .= '<label for="heading">'. T_("Heading"). '</label>';

			$html .= '<div class="input">';
			{
				$realtime = '';
				if(a($_section_detail, 'id'))
				{
					$realtime = 'data-sync="heading-'. a($_section_detail, 'id'). '"';
				}
	    		$html .= "<input type='text' name='opt_heading' value='$default' placeholder='' $realtime>";
	    		$html .= '<label class="addon btn light" data-kerkere=".showHeadingOption">...</label>';
			}
			$html .= "</div>";

			$html .= '<div class="showHeadingOption" data-kerkere-content="hide">';
			{

				$radio_html = '';
				$radio_html .= \content_site\options\generate_radio_line::itemText('heading_position', 'left', T_("Left"), (($default_position === 'left')? true : false));
				$radio_html .= \content_site\options\generate_radio_line::itemText('heading_position', 'center', T_("Center"), (($default_position === 'center' || !$default_position)? true : false));
				$radio_html .= \content_site\options\generate_radio_line::itemText('heading_position', 'right', T_("Right"), (($default_position === 'right')? true : false));

				$html .= \content_site\options\generate_radio_line::add_ul('heading_position', $radio_html);
			}
			$html .= "</div>";
		}
  		$html .= '</form>';

		return $html;
	}

}
?>