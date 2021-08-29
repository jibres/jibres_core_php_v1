<?php
namespace content_site\options\slider;


class slider_loop
{
	public static function validator($_data)
	{
		$data = \dash\validate::bool(a($_data, 'loop'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('slider_loop');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_slider_loop" value="1">';
			$html .= \content_site\options\generate::checkbox('loop',  T_('Loop'), $default);


		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>