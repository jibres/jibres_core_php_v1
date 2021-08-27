<?php
namespace content_site\options\slider;


class slider_loop
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'loop'));
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

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_slider_loop" value="1">';
			$html .= \content_site\options\generate::checkbox('loop',  T_('Loop'), $default);


		}

  		$html .= '</form>';

		return $html;
	}

}
?>