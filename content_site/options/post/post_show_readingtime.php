<?php
namespace content_site\options\post;


class post_show_readingtime
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'show_readingtime'));
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
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('show_readingtime', T_('Display estimated reading time'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>