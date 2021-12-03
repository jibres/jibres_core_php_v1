<?php
namespace content_site\options\responsive;


class responsive_layout
{

	public static function enum()
	{
		$enum   = [];

		$enum[] = ['key' => 'oneline', 'title' => T_('Show in one line')];
		$enum[] = ['key' => 'break', 'title' => T_('Break item')];
		$enum[] = ['key' => 'scroll', 'title' => T_('Scroll')];




		return $enum;
	}


	public static function validator($_data)
	{
		return \dash\validate::enum($_data, true, ['enum' => array_column(static::enum(), 'key'), 'field_title' => T_('Position')]);
	}


	public static function default()
	{
		return 'break';
	}



	public static function admin_html()
	{
		$html = '';

		$default = \content_site\section\view::get_current_index_detail('responsive_layout');

		if(!$default)
		{
			$default = static::default();
		}

		$title = T_("Dispaly in mobile");

		$name       = 'opt_responsive_layout';

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), static::enum(), $default, $title);
		}
		$html .= \content_site\options\generate::_form();


		return $html;

	}
}
?>