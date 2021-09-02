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
		return \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Effect')]);
	}


	public static function default()
	{
		return 'all';
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('responsive_device');

		if(!$default)
		{
			$default = self::default();
		}

		$title = T_("Device");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_responsive_device';

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

				$radio_html .= \content_site\options\generate::radio_line_itemText($name, $value['key'], $value['title'], $selected);
			}

			$html .= \content_site\options\generate::radio_line_add_ul($name, $radio_html);
		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>