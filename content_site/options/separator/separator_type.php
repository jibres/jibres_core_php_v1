<?php
namespace content_site\options\separator;


class separator_type
{
	private static function enum()
	{

		$enum   = [];
		$enum[] = ['key' => 'solid',     'title' =>  T_('solid'),];
		$enum[] = ['key' => 'dotted',    'title' =>  T_('dotted'),];
		$enum[] = ['key' => 'dashed',    'title' =>  T_('dashed'),];


		return $enum;
	}

	public static function validator($_data)
	{
		$data = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Type')]);
		return $data;
	}


	public static function default()
	{
		return 'solid';
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('separator_type');

		if(!$default)
		{
			$default = self::default();
		}


		$title = T_("Type");

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), self::enum(), $default, $title);
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>