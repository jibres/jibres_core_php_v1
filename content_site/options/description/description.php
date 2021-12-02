<?php
namespace content_site\options\description;

/**
 * Use in another option
 */
class description
{

	public static function validator($_data)
	{
		$new_data            = [];
		$description             = a($_data, 'description');
		$new_data[self::db_key()] = \dash\validate::desc($description);


		$use_as_description             = a($_data, 'use_as_description');
		$new_data['use_as_description'] = \dash\validate::enum($use_as_description, true, ['enum' => ['business_description', 'custom_description', ], 'field_title' => T_('Description')]);


		return $new_data;
	}


	public static function db_key()
	{
		return 'description';
	}


	public static function title()
	{
		return T_("Description");
	}


	public static function simple_editor()
	{
		return false;
	}


	public static function include_business_desc()
	{
		return false;
	}


	public static function have_specialsave()
	{
		return false;
	}


	public static function admin_html()
	{

		$default            = \content_site\section\view::get_current_index_detail(self::db_key());
		$use_as_description = \content_site\section\view::get_current_index_detail('use_as_description');
		$title              = self::title();

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			if(self::include_business_desc())
			{
				$name       = 'use_as_description';


				$html .= '<div class="flex">';
				{
					$html .= '<div class="flex-1">';
					{
						$html .= "<label>$title</label>";
					}
					$html .= '</div>';

					$data_response_hide = null;

					if($use_as_description === 'custom_description')
					{
						$data_response_hide = 'data-response-hide';
					}

					// open data-response and close after heading input
					$html .= "<div data-response='$name' data-response-where='business_description' $data_response_hide>";
					{
						$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/general/title">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
					}
					$html .= '</div>';

				}
				$html .= '</div>';



				$radio_html = '';

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_description', T_("Business"), (($use_as_description === 'business_description')? true : false));
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom_description', T_("Custom"), (($use_as_description === 'custom_description')? true : false));


				$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

				$data_response_hide = null;

				if($use_as_description !== 'custom_description')
				{
					$data_response_hide = 'data-response-hide';
				}

				// open data-response and close after heading input
				$html .= "<div data-response='$name' data-response-where='custom_description' $data_response_hide>";

			}

			$html .= \content_site\options\generate::not_redirect();

			if(!self::include_business_desc())
			{
	    		$html .= '<label for="description">'. $title. '</label>';
			}
	    	$html .= '<textarea class="txt" name="description" rows="3" data-rows-min="3" data-autoResize';
	    	if(self::simple_editor())
	    	{
	    		// $html .= ' data-editor="simple"';
	    	}
	    	$html .= '>';
	    	$html .= $default;
	    	$html .= '</textarea>';

	    	if(self::include_business_desc())
	    	{
	    		$html .= '</div>';
	    	}
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>