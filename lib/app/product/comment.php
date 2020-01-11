<?php
namespace lib\app\product;


class comment
{

	private static function check($_id = null)
	{
		$args               = [];
		$content = \dash\app::request('content');

		if(mb_strlen($content) > 5000)
		{
			\dash\notif::error(T_("Comment name is too large!"), 'comment');
			return false;
		}

		$star = \dash\app::request('star');
		if($star && !in_array((string) $star, ['1','2','3','4','5']))
		{
			\dash\notif::error(T_("Invalid star number"));
			return false;
		}
		if(\dash\app::isset_request('content') || \dash\app::isset_request('star'))
		{
			if(!$content && !$star)
			{
				\dash\notif::error(T_("Plese fill the comment text or set your rate"), 'comment');
				return false;
			}
		}

		$product_id = \dash\app::request('product_id');

		if(!$product_id || !is_numeric($product_id))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load_product = \lib\db\products\get::by_id($product_id);
		if(!isset($load_product['id']))
		{
			\dash\notif::error(T_("Product not found"));
			return false;
		}

		$args['product_id'] = $load_product['id'];


		$status = \dash\app::request('status');
		if($status && !in_array($status, ['approved','awaiting','unapproved','spam','deleted','filter','close','answered']))
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		$args['content'] = $content;
		$args['star']    = $star;
		$args['status']  = $status;

		return $args;

	}

	public static function approved_of_product($_product_id, $_string = null)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$list = \lib\db\productcomment\get::get_page_list($_string, $_product_id, 'approved');

		if(is_array($list))
		{
			$list = array_map(['self', 'ready'], $list);
		}
		else
		{
			$list = [];
		}
		return $list;
	}


	public static function of_product($_product_id, $_string = null)
	{
		if(!$_product_id || !is_numeric($_product_id))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}


		$list = \lib\db\productcomment\get::get_page_list($_string, $_product_id);

		if(is_array($list))
		{
			$list = array_map(['self', 'ready'], $list);
		}
		else
		{
			$list = [];
		}
		return $list;
	}


	public static function add($_args)
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Plese login to continue"));
			return false;
		}


		\dash\app::variable($_args);

		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!isset($args['product_id']))
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$args['user_id'] = \dash\user::id();
		$args['ip']      = \dash\server::ip(true);

		if(!$args['status'])
		{
			$args['status'] = 'awaiting';
		}

		// check duplicate
		$check_duplicate = \lib\db\productcomment\get::check_duplicate(\dash\user::id(), $args['product_id']);
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
				$update = \lib\db\productcomment\update::update($update, $id);

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

			$id = \lib\db\productcomment\insert::new_record($args);
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

		\lib\db\productcomment\delete::delete($load['id']);

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

		$load = \lib\db\productcomment\get::by_id($id);
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

		$load = \lib\db\productcomment\get::get_one_by_detail($id);
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

		$get_comment = \lib\db\productcomment\get::by_id($id);


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
				$update = \lib\db\productcomment\update::update($args, $id);

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


		$result = \lib\db\productcomment\get::get_page_list($_string);

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

		$gender = isset($_data['gender']) ? $_data['gender'] : null;

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = \dash\coding::encode($value);
					break;

				case 'status':
					$result[$key]      = $value;
					$result['tstatus'] = T_($value);
					break;

				case 'displayname':
					if(!$value)
					{
						$value = T_("Whitout name");
					}
					$result[$key] = $value;
					break;

				case 'avatar':
					if(!$value)
					{
						$value = \dash\app::static_avatar_url($gender);
					}
					$result[$key] = $value;
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