<?php
namespace lib\app\product;


class comment
{

	private static function check($_id = null)
	{
		$content = \dash\app::request('content');

		if(mb_strlen($content) > 5000)
		{
			\dash\notif::error(T_("Comment name is too large!"), 'comment');
			return false;
		}

		$star = \dash\app::request('star');
		if(\dash\app::isset_request('star') && !in_array((string) $star, ['1','2','3','4','5']))
		{
			\dash\notif::error(T_("Invalid star number"));
			return false;
		}

		if(!$content && !$star)
		{
			\dash\notif::error(T_("Plese fill the comment text or set your rate"), 'comment');
			return false;
		}

		$product = \dash\app::request('product');
		$product = \dash\coding::decode($product);
		if(!$product)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$status = \dash\app::request('status');
		if($status && !in_array($status, ['approved','awaiting','unapproved','spam','deleted','filter','close','answered']))
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		$load_product = \lib\db\products::get_one(\lib\store::id(), $product);
		if(!isset($load_product['id']))
		{
			\dash\notif::error(T_("Product not found"));
			return false;
		}



		$args               = [];
		$args['content']    = $content;
		$args['star']       = $star;
		$args['status']       = $status;
		$args['product_id'] = $load_product['id'];

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

		$args['store_id']     = \lib\store::id();
		$args['userstore_id'] = \lib\userstore::id();
		$args['ip']           = \dash\server::ip(true);

		if(!$args['status'])
		{
			$args['status'] = 'awaiting';
		}

		// check duplicate
		$check_duplicate = \lib\db\productcomment::check_duplicate(\lib\store::id(), \lib\userstore::id(), $args['product_id']);
		if(isset($check_duplicate['id']))
		{
			$id = $check_duplicate['id'];
			$update = [];
			if($check_duplicate['content'] != $args['content'])
			{
				$update['content'] = $args['content'];
			}

			if($check_duplicate['star'] != $args['star'])
			{
				$update['star'] = $args['star'];
			}

			if(empty($update))
			{
				\dash\notif::info(T_("No change in your product comment"));
			}
			else
			{
				$update = \lib\db\productcomment::update($update, $id);

				if($update)
				{
					\dash\log::set('productCommentUpdated', ['old' => $check_duplicate, 'change' => $args]);

					\dash\notif::ok(T_("The comment successfully updated"));

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

			$id = \lib\db\productcomment::insert($args);
			if(!$id)
			{
				\dash\log::set('productCommentDbErrorInsert');
				\dash\notif::error(T_("No way to insert data"));
				return false;
			}

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




		if(!\dash\app::isset_request('content')) unset($args['content']);
		if(!\dash\app::isset_request('star')) unset($args['star']);
		if(!\dash\app::isset_request('status')) unset($args['status']);


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
				case 'product_id':
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