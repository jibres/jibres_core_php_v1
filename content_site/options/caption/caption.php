<?php
namespace content_site\options\caption;


class caption
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function name()
	{
		return \content_site\utility::className(get_called_class());
	}

	public static function db_key()
	{
		return 'title';
	}


	public static function title()
	{
		return T_("Caption");
	}


	public static function have_specialsave()
	{
		return false;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			if(static::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_'. static::name(), $default, static::title());

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>