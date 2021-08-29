<?php
namespace content_site\options\file;


trait file_business_logo
{
	use file;


	public static function db_key()
	{
		return 'logo';
	}

	public static function add_form_element()
	{
		return false;
	}

	public static function validator($_data)
	{
		$result = [];

		$file_path = self::validator_upload_file($_data);
		if($file_path || $file_path === null)
		{
			$result[self::db_key()] = $file_path;
		}

		$result['use_as_logo'] = \dash\validate::enum(a($_data, 'use_as_logo'), false, ['enum' => ['none', 'business_logo', 'custom_logo']]);

		return $result;

	}


	public static function title()
	{
		return T_("Logo");
	}

	public static function have_none()
	{
		return false;
	}


	public static function admin_html()
	{
		$use_as_logo = \content_site\section\view::get_current_index_detail('use_as_logo');

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			$title = self::title();
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_'.\content_site\utility::className(__CLASS__).'" value="1">';
			$html .= "<label>$title</label>";

			$name       = 'use_as_logo';


			$radio_html = '';

			if(self::have_none())
			{
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'none', T_("None"), (($use_as_logo === 'none')? true : false));
			}
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_logo', T_("Business Logo"), (($use_as_logo === 'business_logo')? true : false));
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'custom_logo', T_("Custom"), (($use_as_logo === 'custom_logo')? true : false));


			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);

			$data_response_hide = null;

			if($use_as_logo !== 'custom_logo')
			{
				$data_response_hide = 'data-response-hide';
			}

			$html .= "<div data-response='$name' data-response-where='custom_logo' $data_response_hide>";
			{
				$html .= self::html_upload_file(...func_get_args());
			}

			$html .= '</div>';
		}
		$html .= \content_site\options\generate::_form();

		return $html;

	}

}
?>