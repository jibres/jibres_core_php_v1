<?php
namespace content_site\options\ratio;


class ratio
{
	public static function enum()
	{
		$list = \lib\ratio::list();


		$enum   = [];

		foreach ($list as $key => $value)
		{
			$enum[] = ['key' => $key, 		'title' => a($value, 'title'), 			];
		}

		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Ratio')]);
		return $data;
	}


	public static function default()
	{
		return '1:1';
	}


	public static function admin_html()
	{

		$default = \content_site\section\view::get_current_index_detail('ratio');

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Set item ratio");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, $title);
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>