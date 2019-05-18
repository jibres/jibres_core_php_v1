<?php
namespace lib\app\product;


class comment
{

	private static function check($_id = null)
	{
		$title = \dash\app::request('title');
		if(!$title && $title !== '0')
		{
			\dash\notif::error(T_("Plese fill the comment name"), 'comment');
			return false;
		}

		if(mb_strlen($title) > 100)
		{
			\dash\notif::error(T_("Comment name is too large!"), 'comment');
			return false;
		}

		$args            = [];
		$args['title']   = $title;

		return $args;

	}


	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		// user must be login
		// and if not have record in userstore
		// first add this user to userstore and then get userstore id to save in comment


		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$args['store_id'] = \lib\store::id();

		$id = \lib\db\productcomment::insert($args);
		if(!$id)
		{
			\dash\log::set('productCommentDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

				{
			\dash\notif::ok(T_("Comment successfully added"));
		}

		$result       = [];
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}


	public static function remove($_id)
	{
		if(!\dash\permission::check('productCommentDelete'))
		{
			return false;
		}

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		\dash\log::set('productCommentDeleted', ['old' => $load]);

		\lib\db\productcomment::delete($id);

		\dash\notif::ok(T_("Comment successfully removed"));

		return true;
	}


	public static function inline_get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$load = \lib\db\productcomment::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		return $load;
	}


	public static function get($_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productCommentListView');

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$load = \lib\db\productcomment::get_one(\lib\store::id(), $id);
		if(!$load)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$load = self::ready($load);
		return $load;
	}



	public static function edit($_args, $_id)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\permission::check('productCommentListEdit'))
		{
			return false;
		}

		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$get_comment = \lib\db\productcomment::get_one(\lib\store::id(), $id);


		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('title')) unset($args['title']);


		if(!empty($args))
		{
			foreach ($get_comment as $field => $value)
			{
				if(array_key_exists($field, $args) && $args[$field] == $value)
				{
					unset($args[$field]);
				}
			}

			if(empty($args))
			{
				\dash\notif::info(T_("No change in your product comment"));
				return null;
			}
			else
			{
				$update = \lib\db\productcomment::update($args, $id);

				if($update)
				{
					\dash\log::set('productCommentUpdated', ['old' => $get_comment, 'change' => $args]);

					if(array_key_exists('title', $args))
					{
						// update all product by this comment
						\lib\db\products\comment::update_all_product_comment_title(\lib\store::id(), $id, $args['title']);
					}

					\dash\notif::ok(T_("The comment successfully updated"));
					return true;
				}
				else
				{
					\dash\log::set('productcommentDbCannotUpdate');
					\dash\notif::error(T_("Can not update your product comment"));
					return false;
				}
			}
		}
		else
		{
			\dash\notif::error(T_("No data received!"));
			return false;
		}
	}

	public static function list($_string = null, $_args = [])
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		\dash\permission::access('productCommentListView');


		$result = \lib\db\productcomment::get_page_list(\lib\store::id(), $_string);

		$temp            = [];


		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}




	private static function ready($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = \dash\coding::encode($value);
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