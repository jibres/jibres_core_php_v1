<?php
namespace lib\app\product;

trait export
{

	public static function export($_file_name)
	{
		$list = \lib\db\products::get_all_product(\lib\store::id());
		\lib\utility\export::csv(['name' => $_file_name, 'data' => $list]);
		\lib\code::exit();

	}
}
?>