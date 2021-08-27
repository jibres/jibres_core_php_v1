<?php
namespace content_site\options\post;


class post_show_read_more
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_author'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_read_more');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_post_show_read_more" value="1">';

			$html .= \content_site\options\generate::checkbox('show_author', T_('Display Read more link'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>