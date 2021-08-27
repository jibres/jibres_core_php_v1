<?php
namespace content_site\options\heading;


trait heading
{

	public static function validator($_data)
	{
		$new_data            = [];
		$heading             = a($_data, \content_site\utility::className(__CLASS__));
		$new_data['heading'] = \dash\validate::string_100($heading);

		$heading_position             = a($_data, 'heading_position');
		$new_data['heading_position'] = \dash\validate::enum($heading_position, true, ['enum' => ['left', 'center', 'right'], 'field_title' => T_('Heading Position')]);

		// var_dump($_data, $new_data);exit;
		return $new_data;
	}


	public static function have_text_position()
	{
		return false;
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


	public static function admin_html($_section_detail)
	{
		$default          = \content_site\section\view::get_current_index_detail('heading');
		$default_position = \content_site\section\view::get_current_index_detail('heading_position');

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$myId = 'heading';

			if(a($_section_detail, 'id'))
			{
				$myId = 'heading-'. a($_section_detail, 'id');
			}

			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="not_redirect" value="1">';
		    $html .= '<label for="'.$myId.'">'. T_("Heading"). '</label>';

			$html .= '<div class="input">';
			{
	    		$html .= "<input type='text' name='opt_".\content_site\utility::className(__CLASS__)."' value='$default' data-sync='$myId' id='$myId' placeholder=''>";

	    		if(self::have_text_position())
				{
	    			$html .= '<label class="addon btn light" data-kerkere=".showHeadingOption">...</label>';
	    		}
			}

			$html .= "</div>";

			if(self::have_text_position())
			{
				$html .= '<div class="showHeadingOption" data-kerkere-content="hide">';
				{

					$radio_html = '';
					$radio_html .= \content_site\options\generate::radio_line_itemText('heading_position', 'left', \dash\utility\icon::svg('TextAlignmentLeft'), (($default_position === 'left')? true : false));
					$radio_html .= \content_site\options\generate::radio_line_itemText('heading_position', 'center', \dash\utility\icon::svg('TextAlignmentCenter'), (($default_position === 'center' || !$default_position)? true : false));
					$radio_html .= \content_site\options\generate::radio_line_itemText('heading_position', 'right', \dash\utility\icon::svg('TextAlignmentRight'), (($default_position === 'right')? true : false));

					$html .= \content_site\options\generate::radio_line_add_ul('heading_position', $radio_html, true);
				}
				$html .= "</div>";
			}
		}
  		$html .= '</form>';

		return $html;
	}

}
?>