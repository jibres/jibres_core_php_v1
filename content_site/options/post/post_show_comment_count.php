<?php
namespace content_site\options\post;


class post_show_comment_count
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'comment_count'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_comment_count');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_post_show_comment_count" value="1">';

			$html .= \content_site\options\generate::checkbox('comment_count', T_('Display Comment count'), $default);
		}

  		$html .= '</form>';

		return $html;
	}

}
?>