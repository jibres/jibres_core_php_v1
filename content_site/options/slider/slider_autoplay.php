<?php
namespace content_site\options\slider;


class slider_autoplay
{

	public static function this_range()
	{
		return [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
	}


	public static function validator($_data)
	{
		$data = \dash\validate::string_50($_data);

		if(!in_array($data, static::this_range()))
		{
			\dash\notif::error(T_("This range is not defined!"));
			return false;
		}

		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('slider_autoplay');

		$html = '';

		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::rangeslider('opt_slider_autoplay', static::this_range(), $default, T_("Autoplay delay"));
		}
  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>