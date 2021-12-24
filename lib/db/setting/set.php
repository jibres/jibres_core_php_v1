<?php
namespace lib\db\setting;


class set
{


	public static function platform_cat_key_value($_platform, $_cat, $_key, $_value)
	{
		$_args =
		[
			'platform' => $_platform,
			'cat'      => $_cat,
			'key'      => $_key,
			'value'    => $_value,
		];

		return \dash\pdo\query_template::insert('setting', $_args);
	}


	public static function cat_key_value($_cat, $_key, $_value)
	{
		$_args =
		[
			'cat'      => $_cat,
			'key'      => $_key,
			'value'    => $_value,
		];

		return \dash\pdo\query_template::insert('setting', $_args);
	}


}
?>