<?php
namespace content_site\options\post;


class post_show_excerpt
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_excerpt'));
		return $data;
	}


	public static function default()
	{
		return true;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_excerpt');

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_post_show_excerpt" value="1">';

			$html .= \content_site\options\generate::checkbox('show_excerpt', T_('Display post summary'), $checked);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>