<?php
namespace content_site\options\product;


trait product_show_title_price_magicbox
{
	public static function validator($_data)
	{
		$new_data = \content_site\options\magicbox\magicbox_title_position::validator($_data);
		$new_data['product_show_title'] = product_show_title::validator($_data);
		$new_data['product_show_image'] = product_show_image::validator($_data);

		if(!$new_data['product_show_image'] && !$new_data['product_show_title'])
		{
			$new_data['magicbox_title_position'] = 'hide';
			\content_site\utility::need_redirect(true);
		}
		return $new_data;
	}


	public static function db_key()
	{
		return 'product_show_title_price_magicbox';
	}


	public static function check_image_and_title()
	{
		return false;
	}

	public static function admin_html()
	{
		$default_title = \content_site\section\view::get_current_index_detail('product_show_title');
		$default_image = \content_site\section\view::get_current_index_detail('product_show_image');


		$magicbox_title_position_key = \content_site\options\magicbox\magicbox_title_position::db_key();
		$magicbox_title_position_value = \content_site\section\view::get_current_index_detail($magicbox_title_position_key);


		$html = '';
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::multioption();
			$html .= \content_site\options\generate::opt_hidden(__CLASS__);


			$html .= \content_site\options\magicbox\magicbox_title_position::only_el();


			$data_response_hide = null;

			if($magicbox_title_position_value === 'hide')
			{
				$data_response_hide = 'data-response-hide';
			}
			$html .= "<div data-response='$magicbox_title_position_key' data-response-where-not='hide' $data_response_hide>";
			{
				$html .= \content_site\options\generate::checkbox('show_title',  T_('Display product title'), $default_title);
				$html .= \content_site\options\generate::checkbox('show_image',  T_('Display product image'), $default_image);

			}
			$html .= '</div>';


		}

  		$html .= \content_site\options\generate::_form();



		return $html;
	}

}
?>