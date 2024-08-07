<?php
namespace content_site\options\background;


class background_attachment
{

	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'fixed', 'title' => T_('Fixed')];
		$enum[] = ['key' => 'local', 'title' => T_('Local')];
		$enum[] = ['key' => 'scroll', 'title' => T_('Scroll')];

		return $enum;
	}

	public static function extends_option()
	{
		return background_pack::extends_option();
	}


	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Background Attachment')]);
		return $data;
	}


	public static function default()
	{
		return 'fixed';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('background_attachment');

		if(!$default)
		{
			$default = static::default();
		}



		$title = T_('Background Attachment');

		$html = '';
		$html .= \content_site\options\generate::form();
		{

			$html .= "<label>$title</label>";

			$name       = 'opt_background_attachment';

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