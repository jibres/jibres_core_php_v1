<?php
namespace content_site\options\product;


class product_filter_image
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'filter_image'));
		if(static::check_image_and_title() && !$data)
		{
			if(!\content_site\section\view::get_current_index_detail('product_show_title'))
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
		return 'product_filter_image';
	}

	public static function check_image_and_title()
	{
		return false;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail(static::db_key());

		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('filter_image',  T_('Only products with an image'), $default);

		}

  		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>