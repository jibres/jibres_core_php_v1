<?php
namespace content_site\options\post;


class post_show_readingtime
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_readingtime'));
		return $data;
	}


	public static function default()
	{
		return null;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_readingtime');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_post_show_readingtime" value="1">';

			$html .= \content_site\options\generate::checkbox('show_readingtime', T_('Display estimated reading time'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>