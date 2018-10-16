<?php
namespace lib\app\product;


class file
{

	public static function thumb($_file_url, $_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\products::update(['thumb' => $_file_url], $id);
		return $result;
	}
}
?>