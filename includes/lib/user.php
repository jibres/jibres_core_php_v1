<?php
namespace lib;

class user
{

	public static function user_in_all_table($_user_id)
	{

		$result                = [];

		$result['stores']     =
		[
			'count'  => \lib\db\stores::get_count(['creator' => $_user_id]),
			'link'   => \dash\url::kingdom(). '/c/store?all=true&creator=',
			'encode' => false,
		];

		$result['userstores']    =
		[
			'count'  => \lib\db\userstores::get_count(['user_id' => $_user_id]),
			'link'   => null,
			'encode' => false,
		];


		return $result;
	}
}
?>
