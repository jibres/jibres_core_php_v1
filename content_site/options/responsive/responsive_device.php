<?php
namespace content_site\options\responsive;


class responsive_device
{

	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'all', 'title' => T_('All')];
		$enum[] = ['key' => 'desktop', 'title' => T_('Desktop')];
		$enum[] = ['key' => 'mobile', 'title' => T_('Mobile')];



		return $enum;
	}

	public static function validator($_data)
	{
		$new_data = [];
		$new_data['device'] =  \dash\validate::enum(a($_data, 'device'), true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);


		return $new_data;
	}


	public static function default()
	{
		return 'all';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('device');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Device");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);
			$html .= \content_site\options\generate::multioption();

			$html .= "<label>$title</label>";



			$radio_html = '';

			foreach (self::enum() as $key => $value)
			{
				if(isset($value['system']) && $value['system'])
				{
					continue;
				}

				$selected = false;

				if($default === $value['key'])
				{
					$selected = true;
				}

				$radio_html .= \content_site\options\generate::radio_line_itemText('device', $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul('device', $radio_html);
		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>