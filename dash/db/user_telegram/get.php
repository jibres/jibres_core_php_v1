<?php
namespace dash\db\user_telegram;


class get
{
	public static function load_user_detail_chatid($_chatids)
	{
		$chatids = implode(',', $_chatids);

		$query  =
		"
			SELECT
				user_telegram.user_id,
				user_telegram.chatid,
				user_telegram.firstname AS `telegram_firstname`,
				user_telegram.lastname AS `telegram_lastname`,
				user_telegram.username AS `telegram_username`,
				users.displayname,
				users.mobile,
				users.avatar,
				users.gender
			FROM
				user_telegram
			INNER JOIN users ON users.id = user_telegram.user_id
			WHERE user_telegram.chatid IN ($chatids) ";
		$result = \dash\db::get($query);

		return $result;
	}
}
?>