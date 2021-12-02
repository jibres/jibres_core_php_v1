<?php
namespace content_site\options\count;


class count
{


	public static function validator($_data)
	{
		$data = \dash\validate::int($_data);

		if(!in_array($data, self::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function db_key()
	{
		return 'count';
	}


	public static function title()
	{
		return T_("Count Show");
	}


	public static function admin_html()
	{
		$option_name = \content_site\utility::className(__CLASS__);

		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		if(!$default)
		{
			$default = self::default();
		}

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider('opt_'. $option_name, self::this_range(), $default, self::title());
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>