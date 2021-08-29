<?php
namespace content_site\options\post;


class post_show_image
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'show_image'));
		return $data;
	}


	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('post_show_image');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);

			$html .= \content_site\options\generate::checkbox('show_image', T_('Display featured image'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>