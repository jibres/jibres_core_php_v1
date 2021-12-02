<?php
namespace content_site\options\product;


class product_show_title
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'show_title'));
		if(self::check_image_and_title() && !$data)
		{
			if(!\content_site\section\view::get_current_index_detail('product_show_image'))
			{
				\dash\notif::error(T_("Can not hide product title and image together"));
				\content_site\utility::need_redirect(true);
				return false;
			}
		}

		return $data;
	}

	public static function db_key()
	{
		return 'product_show_title';
	}


	public static function check_image_and_title()
	{
		return false;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(self::db_key());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('show_title',  T_('Display product title'), $default);

		}

  		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>