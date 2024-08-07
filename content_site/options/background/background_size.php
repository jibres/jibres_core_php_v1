<?php
namespace content_site\options\background;


class background_size
{

	public static function enum()
	{
		$enum   = [];
		$enum[] = ['key' => 'auto', 'title' => T_('Auto')];
		$enum[] = ['key' => 'cover', 'title' => T_('Cover')];
		$enum[] = ['key' => 'contain', 'title' => T_('Contain')];

		return $enum;
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Size')]);
		\content_site\utility::need_redirect(true);
		return $data;
	}


	public static function default()
	{
		return 'cover';
	}

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function get_value()
	{
		$default = \content_site\section\view::get_current_index_detail('background_size');

		if(!$default)
		{
			$default = static::default();
		}

		return $default;
	}


	public static function admin_html()
	{

		$default = static::get_value();


		$title = T_("Background size");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= "<label>$title</label>";

			$name       = 'opt_background_size';

			$radio_html = '';

			foreach (static::enum() as $key => $value)
			{
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