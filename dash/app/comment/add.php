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

		$ip_id    = \dash\utility\ip::id();
		$agent_id = \dash\agent::get(true);

		$args['user_id']     = \dash\user::id();
		$args['ip_id']       = $ip_id;
		$args['agent_id']    = $agent_id;
		$args['datecreated'] = date("Y-m-d H:i:s");

		$is_duplicate = self::is_duplicate($args);
		if($is_duplicate)
		{
			return false;
		}


		if(\dash\user::id())
		{
			$count_awaiting_comment_per_user = \dash\db\comments\get::count_awaiting_comment_per_user(\dash\user::id());

			if($count_awaiting_comment_per_user > 100)
			{
				\dash\notif::error(T_("Please wait until your comment was approved"));

				\dash\waf\ip::isolateIP(1, 'user max comment');

                return false;
			}
		}
		else
		{
			if(!$ip_id || !$agent_id)
			{
				\dash\notif::error(T_("Who are you?"));

				\dash\waf\ip::isolateIP(1, 'ip_id or agent id is null!');

	            return false;
			}

			$count_awaiting_comment_per_ip = \dash\db\comments\get::count_awaiting_comment_per_ip($ip_id);

			if($count_awaiting_comment_per_ip > 20)
			{
				\dash\notif::error(T_("Please wait until your comment was approved or login to add more"));

				\dash\waf\ip::isolateIP(1, 'ip max comment');

                return false;
			}
			else
			{
				$count_awaiting_comment_per_ip_agent = \dash\db\comments\get::count_awaiting_comment_per_ip_agent($ip_id, $agent_id);

				if($count_awaiting_comment_per_ip_agent > 10)
				{
					\dash\notif::error(T_("Please wait until your comment was approved or login to add more"));

					\dash\waf\ip::isolateIP(1, 'ip agent max comment');

	                return false;
				}
			}

		}

 		$comment_id = \dash\db\comments\insert::new_record($args);

		if(!$comment_id)
		{
			\dash\log::oops('dbCommentNotInserted', T_("No way to add new data"));
			return false;
		}

		if(isset($args['parent']) && $args['parent'])
		{
			\dash\notif::ok(T_("Your comment successfully added"));
		}
		else
		{
			\dash\notif::ok(T_("Your comment successfully added"));

		}

		$return       = [];

		$return['id'] = $comment_id;

		return $return;

	}

	/**
	 * The quote contain start and content
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function quote($_args)
	{
		$args = \dash\app\comment\check::variable($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['datecreated'] = date("Y-m-d H:i:s");

 		$comment_id = \dash\db\comments\insert::new_record($args);

		if(!$comment_id)
		{
			\dash\log::oops('dbCommentNotInserted', T_("No way to add new data"));
			return false;
		}

		return $comment_id;

	}



	public static function answer($_answer, $_id)
	{

		$load = \dash\app\comment\get::inline_get($_id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}


		$args =
		[
			'content'        => a($_answer, 'content'),
			'title'          => a($_answer, 'title'),
			'parent'         => $_id,
			'for'            => a($load, 'for'),
			'post_id'        => a($load, 'post_id'),
			'product_id'     => a($load, 'product_id'),
			'factor_id'      => a($load, 'factor_id'),
			'pagebuilder_id' => a($load, 'pagebuilder_id'),
		];

		if(\dash\permission::check('cmsManageComment'))
		{
			$args['status']  = 'approved';
		}

		return self::add($args);
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
			$check_duplicate['ip_id']       = $args['ip_id'];

			// not check duplicate in api mode. for example user try to move all comment from other site to jibres
			if(\dash\temp::get('isApi'))
			{
				return false;
			}
		}

		if(isset($args['post_id']) && $args['post_id'])
		{
			$check_duplicate['post_id'] = $args['post_id'];
		}

		if(isset($args['parent']) && $args['parent'])
		{
			$check_duplicate['parent'] = $args['parent'];
		}

		if(isset($args['product_id']) && $args['product_id'])
		{
			$check_duplicate['product_id'] = $args['product_id'];
		}

		$check_duplicate = \dash\db\comments\get::get_one($check_duplicate);

		if(isset($check_duplicate['id']))
		{
			\dash\notif::error(T_("You can not send comment on this page!"), 'content');
			return true; // yes, Is duplicate
		}

		return false;

	}
}
?>