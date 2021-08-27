<?php
namespace content_site\options\product;


class product_show_price
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_price'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('product_show_price');

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_product_show_price" value="1">';

			$html .= \content_site\options\generate::checkbox('show_price',  T_('Display product price'), $checked);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>