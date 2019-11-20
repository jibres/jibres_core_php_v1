<?php
namespace lib\app\setting;


class tools
{
	public static function save($_cat, $_key, $_value)
	{
		$insert =
		[
			'cat'   => $_cat,
			'key'   => $_key,
			'value' => $_value,
		];

		$result = \lib\db\setting\db::insert($insert);
		return $result;
	}


	public static function get($_cat, $_key)
	{
		if($_cat && $_key)
		{
			$result = \lib\db\setting\db::get($_cat, $_key);
			return $result;
		}
		return null;

	}


	public static function get_cat($_cat)
	{
		if($_cat)
		{
			$result = \lib\db\setting\db::get_cat($_cat);
			return $result;
		}

		return null;
	}
}
?>