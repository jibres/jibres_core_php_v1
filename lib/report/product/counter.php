<?php
namespace lib\report\product;


class counter
{
	public static function all()
	{
		$result = \lib\db\products\get::count_all();
		if($result && is_numeric($result))
		{
			return floatval($result);
		}
		return 0;
	}
}
?>