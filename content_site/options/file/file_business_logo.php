<?php
namespace content_site\options\file;


class file_business_logo extends file
{

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

	public static function file_action_meta()
	{
		return ['use_as_logo' => 'custom_logo'];
	}


	public static function admin_html()
	{
		$use_as_logo = \content_site\section\view::get_current_index_detail('use_as_logo');

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			$title = self::title();
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$name       = 'use_as_logo';


			$html .= '<div class="flex">';
			{
				$html .= '<div class="flex-1">';
				{
					$html .= "<label>$title</label>";
				}
				$html .= '</div>';

				$data_response_hide = null;

				if($use_as_logo === 'custom_logo')
				{
					$data_response_hide = 'data-response-hide';
				}

				// open data-response and close after heading input
				$html .= "<div data-response='$name' data-response-where='business_logo' $data_response_hide>";
				{
					$html .= '<a target="_blank" class="link-secondary text-xs leading-6 block" href="'. \lib\store::admin_url(). '/a/setting/general">'. T_("Manage"). ' <i class="sf-external-link pLa5"></i> </a>';
				}
				$html .= '</div>';

			}
			$html .= '</div>';



			$radio_html = '';

			if(self::have_none())
			{
				$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'none', T_("None"), (($use_as_logo === 'none')? true : false));
			}
			$radio_html .= \content_site\options\generate::radio_line_itemText($name, 'business_logo', T_("Business"), (($use_as_logo === 'business_logo')? true : false));
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