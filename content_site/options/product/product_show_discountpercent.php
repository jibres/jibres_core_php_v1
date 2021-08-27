<?php
namespace content_site\options\product;


class product_show_discountpercent
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_discount'));
		return $data;
	}

	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('product_show_discountpercent');



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_product_show_discountpercent" value="1">';

			$html .= \content_site\options\generate::checkbox('show_discount', T_('Display product discount percent'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>