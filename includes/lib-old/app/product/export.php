<?php
namespace lib\app\product;

class export
{

	public static function all($_file_name)
	{
		$list = \lib\db\products::get_all_product(\lib\store::id());
		\dash\utility\export::csv(['name' => $_file_name, 'data' => $list]);
		\dash\code::boom();

	}
}
?>