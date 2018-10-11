<?php
namespace lib\app\thirdparty;

class comment
{

	public static function add($_note, $_id)
	{
		\dash\log::set('thirdpartyNote', ['code' => $_id, 'data' => $_note]);
	}


	public static function list($_id, $_limit = 100)
	{
		$get_log =
		[
			'caller' => 'thirdpartyNote',
			'code'   => $_id,
			'limit'  => $_limit
		];

		$get_log = \dash\db\logs::get($get_log, ['join_user' => true]);
		return $get_log;

	}

}
?>