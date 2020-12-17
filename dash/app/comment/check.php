<?php
namespace dash\app\comment;


class check
{
	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'content'     => 'desc',
			'for'         => ['enum' => ['page','post','product']],
			'status'      => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter']],
			'displayname' => 'displayname',
			'user_id'     => 'id',
			'post_id'     => 'code',
			'product_id'  => 'id',
			'factor_id'   => 'id',
			'mobile'      => 'mobile',
			'gallery'     => 'string_500', // need to fix
			'title'       => 'title',
			'parent'      => 'code',
			'star'        => ['enum' => [1,2,3,4,5]],
			'email'       => 'email',
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

			$check_ok_post = \dash\db\posts\get::by_id($data['post_id']);
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

			if(a($check_ok_post, 'type') === 'page')
			{
				$data['for'] = 'page';
			}
			else
			{
				$data['for'] = 'post';
			}
		}
		else
		{
			$data['post_id'] = null;
		}


		if($data['product_id'])
		{
			$data['for'] = 'product';
		}


		if($data['parent'])
		{
			$data['parent'] = \dash\coding::decode($data['parent']);
			if(!$data['parent'])
			{
				\dash\notif::error(T_("Invalid comment parent id"));
				return false;
			}
		}

		if(!$data['status'])
		{
			$data['status'] = 'awaiting';
		}


		return $data;
	}

}
?>