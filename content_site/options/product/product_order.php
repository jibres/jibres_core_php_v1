<?php
namespace content_site\options\product;


class product_order
{

	private static function enum()
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
		$data  = \dash\validate::enum($_data, true, ['enum' => array_column(self::enum(), 'key'), 'field_title' => T_('Product order')]);
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
		$html .= \content_site\options\generate::form();
		{
			$html .= \content_site\options\generate::select(get_called_class(), self::enum(), $default, T_("Order by"));
		}

  		$html .= \content_site\options\generate::_form();

		return $html;
	}

}
?>