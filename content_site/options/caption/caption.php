<?php
namespace content_site\options\caption;


trait caption
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}


	public static function name()
	{
		return \content_site\utility::className(__CLASS__);
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
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			if(self::have_specialsave())
			{
				$html .= \content_site\options\generate::specialsave();
			}

			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_'. self::name(), $default, self::title());

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>