<?php
namespace dash\app;

class comment
{

	public static $sort_field =
	[
		'id',
		'plus',
		'minus',
		'datecreated',
		'status',
		'mobile',
		'author',
		'email',
	];

	public static function get_post_comment()
	{
		$comments = [];
		$args = func_get_args();
		if(isset($args[0]))
		{
			$args = $args[0];
		}

		// get post id
		if(!isset($args['post_id']))
		{
			if(\dash\data::datarow_id())
			{
				$args['post_id'] = \dash\data::datarow_id();
			}
		}
		// count of show comments
		$limit = 6;
		if(isset($args['limit']))
		{
			$limit = $args['limit'];
		}

		// get comments
		if(isset($args['post_id']))
		{
			$post_id = \dash\coding::decode($args['post_id']);
			if($post_id)
			{
				$comments = \dash\db\comments::get_comment($post_id, $limit, \dash\user::id());
			}
		}
		return $comments;
	}

	public static  function get_comment_counter($_args)
	{
		$comment_counter     = \dash\db\comments::get_comment_counter($_args);
		if(is_array($comment_counter))
		{
			$comment_counter['all'] = array_sum($comment_counter);
		}

		return $comment_counter;
	}

	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}
		$get = \dash\db\comments::get(['id' => $id, 'limit' => 1]);
		if(is_array($get))
		{
			return self::ready($get);
		}
		return false;
	}


	public static function add($_args)
	{

		// check args
		$args = self::check($_args);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		// $args['content']    = $content;

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

		// $args['visitor_id'] = \dash\utility\visitor::id();
		$args['ip']         = \dash\server::ip(true);

		$comment_id = \dash\db\comments::insert($args);

		if(!$comment_id)
		{
			\dash\notif::error(T_("No way to add new data"));
			return false;
		}
		\dash\log::set('addComment', ['code' => $comment_id, 'datalink' => \dash\coding::encode($comment_id)]);

		$return       = [];
		$return['id'] = \dash\coding::encode($comment_id);
		return $return;
	}


	public static function edit($_args, $_id)
	{

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit comment"));
			return false;
		}

		$args = self::check($_args, $id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if($args['status'] === 'deleted')
		{
			\dash\permission::check('cpCommentsDelete');
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if($args)
		{
			\dash\log::set('editComment', ['code' => $id, 'datalink' => \dash\coding::encode($id)]);

			return \dash\db\comments::update($args, $id);
		}
	}


	public static function list($_string = null, $_args = [])
	{

		$default_meta =
		[
			'pagenation' => true,
			'sort'       => null,
			'order'      => null,
			'join_user'  => false,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$_args = array_merge($default_meta, $_args);

		unset($_args['order']);
		unset($_args['sort']);

		$_string = \dash\validate::search($_string);

		$result            = \dash\db\comments::search_full($_string, $_args);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$check = \dash\app::fix_avatar($check);
				$temp[] = $check;
			}
		}

		return $temp;
	}


	public static function check($_args, $_id = null)
	{

		$condition =
		[
			'content' => 'desc',
			'status'  => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close', 'answered']],
			'author'  => 'displayname',
			'user_id' => 'id',
			'post_id' => 'code',
			'meta'    => '',
			'mobile'  => 'mobile',
			'title'   => 'title',
			'file'    => 'string',
			'parent'  => 'code',
			'via'     => ['enum' => ['site', 'telegram', 'sms', 'contact', 'admincontact', 'app']],
			'star'    => ['enum' => [1,2,3,4,5]],
			'url'     => 'url',
			'email'   => 'email',

		];



		$require = ['content'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$data['user_id'] && $data['mobile'])
		{
			$get_user = \dash\db\users::get_by_mobile($data['mobile']);
			if(isset($get_user['id']))
			{
				$data['user_id'] = $get_user['id'];
			}
		}

		if($data['post_id'])
		{
			$data['post_id'] = \dash\coding::decode($data['post_id']);

			$check_ok_post = \dash\db\posts::get(['id' => $data['post_id'], 'limit' => 1]);
			if(!isset($check_ok_post['comment']))
			{
				\dash\notif::error(T_("Invalid post id"));
				return false;
			}

			if($check_ok_post['comment'] !== 'open')
			{
				\dash\notif::error(T_("Comment of this post is closed!"));
				return false;
			}
		}
		else
		{
			$data['post_id'] = null;
		}


		if($data['parent'])
		{
			$data['parent'] = \dash\coding::decode($data['parent']);
		}

		$data['status']  = $data['status'] ? $data['status'] : 'awaiting';

		return $data;
	}


	/**
	 * ready data of classroom to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$_data = \dash\app::fix_avatar($_data);
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'user_id':
				case 'parent':
				case 'term_id':
				case 'post_id':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>