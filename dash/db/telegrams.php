<?php
namespace dash\db;

/** telegrams managing **/
class telegrams
{
	public static function insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_insert('telegrams', $_args);
	}


	public static function multi_insert($_args)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_multi_insert('telegrams', $_args);
	}


	public static function update($_args, $_id)
	{
		$_args = \dash\safe::safe($_args, 'raw-nottrim');
		return \dash\db\config::public_update('telegrams', $_args, $_id);
	}


	public static function get($_where, $_option = [])
	{
		return \dash\db\config::public_get('telegrams', $_where);
	}


	public static function search($_string = null, $_option = [])
	{
		$default =
		[

		];

		if(isset($_option['join_user']))
		{


			$default['public_show_field'] =
			"
				telegrams.*,
				users.displayname,
				users.mobile,
				users.avatar
			";

			$default['master_join'] =
			"
				LEFT JOIN users ON users.id = telegrams.user_id
			";

		}
		elseif(isset($_option['group_by_chatid']))
		{

			$default['public_show_field'] =
			"
				COUNT(*) AS `count`,
				telegrams.chatid AS `chatid`,
				MIN(telegrams.user_id) AS `user_id`
			";
			$default['group_by'] =
			"
				GROUP BY telegrams.chatid
			";
			$default['order_raw'] = " `count` DESC";

		}

		unset($_option['group_by_chatid']);
		unset($_option['join_user']);

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default, $_option);

		$result = \dash\db\config::public_search('telegrams', $_string, $_option);
		return $result;
	}

}
?>
