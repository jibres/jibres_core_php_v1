<?php
namespace content_site\options\slider;


class slider_next_prev
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'next_prev'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('slider_next_prev');

		if(!$default)
		{
			$default = self::default();
		}

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_slider_next_prev" value="1">';

			$html .= \content_site\options\generate::checkbox('next_prev',  T_('Next prev'), $checked);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>