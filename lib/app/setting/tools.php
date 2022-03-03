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

		$result = \lib\db\setting\insert::new_record($insert, true);
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


	public static function get_cat_key_user($_cat, $_key, $_user_id)
	{
		if($_cat && $_key)
		{
			$result = \lib\db\setting\get::by_cat_key_user_id($_cat, $_key, $_user_id);
			return $result;
		}
		return null;

	}


	public static function update_user($_cat, $_key, $_value, $_user_id)
	{
		$get = self::get_cat_key_user($_cat, $_key, $_user_id);

		if(!isset($get['id']))
		{
			$insert =
			[
				'cat'     => $_cat,
				'key'     => $_key,
				'value'   => $_value,
				'user_id' => $_user_id,
			];

			$result = \lib\db\setting\insert::new_record_user($insert, true);
		}
		else
		{
			$result = \lib\db\setting\update::record(['value' => $_value], $get['id']);
		}

		return $result;
	}
}
?>