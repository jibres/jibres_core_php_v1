<?php
namespace content_site\options\post;


class post_show_author
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
		$default = \content_site\section\view::get_current_index_detail('post_show_author');

		if(!$default)
		{
			$default = self::default();
		}



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_post_show_author" value="1">';

			$html .= \content_site\options\generate::checkbox('show_author', T_('Display author name'), $default);
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>