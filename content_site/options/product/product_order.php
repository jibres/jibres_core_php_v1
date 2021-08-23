<?php
namespace content_site\options\product;


class product_order
{

	private static function enum_product_order()
	{
		$enum   = [];
		$enum[] = ['key' => 'newest', 		'title' => T_("Newest to Oldest (default)"),];
		$enum[] = ['key' => 'oldest', 		'title' => T_("Oldest to Newest"),];
		$enum[] = ['key' => 'random', 		'title' => T_("Random product"),];
		$enum[] = ['key' => 'expensive', 	'title' => T_("Expensive product"),];
		$enum[] = ['key' => 'inexpensive',  'title' => T_("Inexpensive product"),];

		return $enum;
	}


	public static function validator($_data)
	{
		$data  = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum_product_order(), 'key'), 'field_title' => T_('Product order')]);
		return $data;
	}


	public static function default()
	{
		return 'newest';
	}


	public static function admin_html($_section_detail)
	{
		$default = \content_site\section\view::get_current_index_detail('product_order');


		$html = '';
		$html .= '<form method="post" data-patch autocomplete="off">';
		{

	    	$html .= "<label for='product_order'>". T_("Order by") ."</label>";
	        $html .= '<select name="opt_product_order" class="select22" id="product_order">';

	        foreach (self::enum_product_order() as $key => $value)
	        {
	        	$selected = null;

	        	if($value['key'] === $default)
	        	{
	        		$selected = ' selected';
	        	}

	        	$html .= "<option value='$value[key]'$selected>$value[title]</option>";
	        }
	        $html .= '</select>';
		}

  		$html .= '</form>';

		return $html;
	}

}
?>