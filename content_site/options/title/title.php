<?php
namespace content_site\options\title;

/**
 * Use in another option
 */
class title
{

	public static function validator($_data)
	{
		$data = \dash\validate::string_100($_data);
		return $data;
	}

	public static function db_key()
	{
		return 'title';
	}


	public static function title()
	{
		return T_("Title");
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
	    	$html .= \content_site\options\generate::text('opt_'. \content_site\utility::className(get_called_class()), $default, static::title());

		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>