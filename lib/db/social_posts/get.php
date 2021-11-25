<?php
namespace lib\db\social_posts;

class get
{

	public static function by_id($_id)
	{
		$query  = "SELECT * FROM social_posts WHERE social_posts.id = :id LIMIT 1 ";
		$param  = [':id' => $_id];
		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}



	public static function by_post_id_multi($_post_ids)
	{
		$query  = "SELECT * FROM social_posts WHERE social_posts.post_id IN (:post_ids) ";
		$param  = [':post_ids' => implode(',', $_post_ids)];
		$result = \dash\pdo::get($query, $param);
		return $result;
	}



	public static function by_social_message_id($_social, $_messageid)
	{
		$query  = "SELECT * FROM social_posts WHERE social_posts.social = :social  AND social_posts.messageid = :messageid LIMIT 1 ";
		$param  =
		[
			':social' => $_social,
			':messageid' => $_messageid,
		];

		$result = \dash\pdo::get($query, $param, null, true);
		return $result;
	}






}
?>