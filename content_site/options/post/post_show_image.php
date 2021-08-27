<?php
namespace content_site\options\post;


class post_show_image
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_image'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_image');

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_post_show_image" value="1">';

			$html .= \content_site\options\generate::checkbox('show_image', T_('Display featured image'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>