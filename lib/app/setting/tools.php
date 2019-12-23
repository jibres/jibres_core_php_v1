<?php
namespace lib\app\setting;


class tools
{
	public static function update($_cat, $_key, $_value)
	{
		$get = self::get($_cat, $_key);
		if(!isset($get['id']))
		{
			return self::save($_cat, $_key, $_value);
		}
		else
		{
			$result = \lib\db\setting\update::by_cat_key($_cat, $_key, $_value);
			return $result;
		}
	}

	public static function save($_cat, $_key, $_value)
	{
		$insert =
		[
			'cat'   => $_cat,
			'key'   => $_key,
			'value' => $_value,
		];

		$result = \lib\db\setting\insert::new_record($insert);
		return $result;
	}


	public static function get($_cat, $_key)
	{
		if($_cat && $_key)
		{
			$result = \lib\db\setting\get::by_cat_key($_cat, $_key);
			return $result;
		}
		return null;

	}


	public static function get_cat($_cat)
	{
		if($_cat)
		{
			$result = \lib\db\setting\get::by_cat($_cat);
			return $result;
		}

		return null;
	}
}
?>