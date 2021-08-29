<?php
namespace content_site\options\product;


class product_show_price
{
	public static function validator($_data)
	{
		$data = \dash\validate::bool(a($_data, 'show_price'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('product_show_price');



		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_product_show_price" value="1">';

			$html .= \content_site\options\generate::checkbox('show_price',  T_('Display product price'), $default);

		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>