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

		$checked = $default ? ' checked' : null;

		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{
			$html .= '<input type="hidden" name="multioption" value="multi">';
			$html .= '<input type="hidden" name="opt_product_show_image" value="1">';

			$html .= '<div class="check1 py-0">';
			{
				$html .= '<input type="checkbox" name="show_image" id="product_show_image"'.$checked.'>';
				$html .= '<label for="product_show_image">'. T_('Display product image'). '</label>';
			}
			$html .= '</div>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>