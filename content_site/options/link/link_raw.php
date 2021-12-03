<?php
namespace content_site\options\link;


class link_raw
{
	public static function validator($_data)
	{
		$data = \dash\validate::absolute_url($_data, true);
		return $data;
	}


	public static function name()
	{
		return 'link_raw';
	}


	public static function title()
	{
		return T_("Link");
	}


	public static function db_key()
	{
		return 'link';
	}


	public static function visible()
	{
		return true;
	}


	public static function placeholder()
	{
		return null;
	}


	public static function admin_html()
	{
		if(!static::visible())
		{
			return '';
		}

		$default = \content_site\section\view::get_current_index_detail(static::name());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::not_redirect();
			$html .= \content_site\options\generate::text('opt_'. static::name(), $default, static::title(), static::placeholder(), 'ltr', 'url');
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>