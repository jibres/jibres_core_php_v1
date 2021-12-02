<?php
namespace content_site\options\product;


class product_show_discountpercent
{
	public static function validator($_data)
	{
		$data = \dash\validate::checkbox(a($_data, 'show_discount'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('product_show_discountpercent');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(get_called_class());

			$html .= \content_site\options\generate::checkbox('show_discount', T_('Display product discount percent'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>