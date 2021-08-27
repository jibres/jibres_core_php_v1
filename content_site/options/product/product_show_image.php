<?php
namespace content_site\options\product;


class product_show_image
{
	public static function validator($_data)
	{
		$data = \dash\validate::bit(a($_data, 'show_image'));
		return $data;
	}



	public static function admin_html()
	{
		$default = \content_site\section\view::get_current_index_detail('product_show_image');



		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= \content_site\options\generate::multioption();
			$html .= '<input type="hidden" name="opt_product_show_image" value="1">';

			$html .= \content_site\options\generate::checkbox('show_image',  T_('Display product image'), $default);

		}

  		$html .= '</form>';

		return $html;
	}

}
?>