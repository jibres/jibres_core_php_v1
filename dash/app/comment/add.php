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

		// check duplicate comment
		// if login check by content
		// if not login check by ip and agent
		if(isset($args['user_id']) && is_numeric($args['user_id']))
		{
			$check_duplicate =
			[
				'user_id' => $args['user_id'],
				'content' => $args['content'],
				'limit'   => 1,
			];

			if(isset($args['post_id']) && $args['post_id'])
			{
				$check_duplicate['post_id'] = $args['post_id'];
			}

			if(isset($args['post_id']) && $args['post_id'])
			{
				$check_duplicate['post_id'] = $args['post_id'];
			}

			if(isset($args['parent']) && $args['parent'])
			{
				$check_duplicate['parent'] = $args['parent'];
			}

			$check_duplicate = \dash\db\comments::get($check_duplicate);

			if(isset($check_duplicate['id']))
			{
				\dash\notif::error(T_("This text is duplicate and you are sended something like this before!"), 'content');
				return false;
			}
		}

		$args['ip']          = \dash\server::ip(true);
		$args['agent_id']    = \dash\agent::get(true);
		$args['datecreated'] = date("Y-m-d H:i:s");

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
}
?>