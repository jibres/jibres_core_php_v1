<?php
namespace dash\app\comment;

class add
{

	public static function add($_args)
	{
		// check args
		$args = \dash\app\comment\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['user_id']     = \dash\user::id();
		$args['ip']          = \dash\server::ip(true);
		$args['agent_id']    = \dash\agent::get(true);
		$args['datecreated'] = date("Y-m-d H:i:s");

		$is_duplicate = self::is_duplicate($args);
		if($is_duplicate)
		{
			return false;
		}

 		$comment_id = \dash\db\comments\insert::new_record($args);

		if(!$comment_id)
		{
			\dash\log::oops('dbCommentNotInserted', T_("No way to add new data"));
			return false;
		}

		\dash\notif::ok(T_("Your comment successfully added"));

		$return       = [];

		$return['id'] = \dash\coding::encode($comment_id);

		return $return;

	}


	private static function is_duplicate($args)
	{
		$check_duplicate = [];

		if(isset($args['user_id']) && is_numeric($args['user_id']) && $args['user_id'])
		{
			$check_duplicate['user_id'] = $args['user_id'];
			$check_duplicate['content'] = $args['content'];
		}
		else
		{
			$check_duplicate['agent_id'] = $args['agent_id'];
			$check_duplicate['ip']       = $args['ip'];
		}

		if(isset($args['post_id']) && $args['post_id'])
		{
			$check_duplicate['post_id'] = $args['post_id'];
		}

		if(isset($args['product_id']) && $args['product_id'])
		{
			$check_duplicate['product_id'] = $args['product_id'];
		}

		$check_duplicate = \dash\db\comments\get::get_one($check_duplicate);

		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("This text is duplicate and you are sended something like this before!"), 'content');
			return true; // yes, Is duplicate
		}

		return false;

	}
}
?>