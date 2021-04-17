<?php
namespace dash\app\comment;


class check
{
	public static function variable($_args, $_id = null)
	{
		$condition =
		[
			'content'        => 'desc',
			'for'            => ['enum' => ['page','post','product', 'quote']],
			'status'         => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter']],
			'displayname'    => 'displayname',
			'user_id'        => 'id',
			'post_id'        => 'code',
			'product_id'     => 'id',
			'factor_id'      => 'id',
			'pagebuilder_id' => 'id',
			'mobile'         => 'mobile',
			'gallery'        => 'string_500', // need to fix
			'title'          => 'title',
			'parent'         => 'id',
			'star'           => ['enum' => [1,2,3,4,5]],
			'email'          => 'email',
		];

		$require = ['content'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		if($data['post_id'])
		{
			$data['post_id'] = \dash\coding::decode($data['post_id']);

			$check_ok_post = \dash\db\posts\get::by_id($data['post_id']);
			if(!isset($check_ok_post['id']))
			{
				\dash\notif::error(T_("Invalid post id"));
				return false;
			}


			if($check_ok_post['comment'] === 'closed')
			{
				\dash\notif::error(T_("Comment of this post is closed!"));
				return false;
			}
			elseif($check_ok_post['comment'] === 'open')
			{

			}
			else
			{

				$cms_setting = \lib\app\setting\get::cms_setting();
				if(isset($cms_setting['defaultcomment']) && $cms_setting['defaultcomment'] === 'open')
				{
					// ok
				}
				else
				{
					\dash\notif::error(T_("Comment of this post is closed!"));
					return false;
				}

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

			$load_product = \lib\db\products\get::by_id($data['product_id']);

			if(!$load_product)
			{
				\dash\notif::error(T_("Product id not found"));
				return false;
			}

			$product_setting = \lib\app\setting\get::product_setting();

			if(!a($product_setting, 'comment'))
			{
				\dash\notif::error(T_("Can not add comment to product in this business"));
				return false;
			}

			$data['for'] = 'product';
		}


		if($data['parent'])
		{
			$load_parent = \dash\app\comment\get::inline_get($data['parent']);
			if(!$load_parent)
			{
				\dash\notif::error(T_("Invalid parent id"));
				return false;
			}

			if(isset($load_parent['parent']) && $load_parent['parent'])
			{
				\dash\notif::error(T_("You can not answer to an answer comment!"));
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