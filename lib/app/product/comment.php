<?php
namespace lib\app\product;


class comment
{

	private static function check($_args, $_id = null)
	{
		$condition =
		[
			'content'    => 'desc',
			'star'       => ['enum' => ['1','2','3','4','5']],
			'status'     => ['enum' => ['approved','awaiting','unapproved','spam','deleted','filter','close','answered']],
			'product_id' => 'id',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if(!$data['content'] && !$data['star'])
		{
			if($_id)
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Plese fill the comment text or set your rate"), 'comment');
				return false;
			}
		}

		if($_id)
		{
			$load_product = \lib\db\products\get::by_id($_id);
		}
		elseif($data['product_id'])
		{
			$load_product = \lib\db\products\get::by_id($data['product_id']);
		}
		else
		{
			\dash\notif::error(T_("Product id not found"));
			return false;
		}

		if(!isset($load_product['id']))
		{
			\dash\notif::error(T_("Product not found"));
			return false;
		}

		return $data;

	}

	public static function approved_of_product($_product_id, $_string = null)
	{
		$_product_id = \dash\validate::id($_product_id);
		if(!$_product_id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$_string = \dash\validate::search($_string);

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
		$_product_id = \dash\validate::id($_product_id);

		if(!$_product_id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$_string = \dash\validate::search($_string);

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

		$args = self::check($_args);

		if(!$args)
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
		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
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


		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
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

		$id = \dash\validate::code($_id);
		$id = \dash\coding::decode($id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$args = self::check($_args, $id);

		if(!$args)
		{
			return false;
		}

		$args = \dash\cleanse::patch_mode($_args, $args);

		if(!empty($args))
		{
			$get_comment = \lib\db\productcomment\get::by_id($id);
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

	private static $filter_message = null;
	private static $filter_args    = [];
	private static $is_filtered    = false;


	public static function filter_message()
	{
		return self::$filter_message;
	}


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{
		if(!\dash\user::id())
		{
			\dash\notif::error(T_("Please login to continue"));
			return false;
		}

		$condition =
		[
			'order'  => 'order',
			'sort'   => ['enum' => ['title', 'ns1', 'status']],
			'status'   => ['enum' => ['spam', 'deleted', 'unapproved', 'approved', 'awaiting']],
			'product_id' => 'id'
		];

		$require = [];

		$meta =
		[
			'field_title' =>
			[

			],
		];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		$order_sort  = null;

		$query_string = \dash\validate::search($_query_string);

		if($query_string)
		{
			$or[] = " productcomment.content LIKE '%$query_string%' ";
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['title', 'ns1', 'status']))
			{

				$sort = mb_strtolower($data['sort']);
				$order = null;
				if($data['order'])
				{
					$order = mb_strtolower($data['order']);
				}

				$order_sort = " ORDER BY $sort $order";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY id DESC";
		}

		if($data['product_id'])
		{
			$and[] = "product_id = $data[product_id] ";
		}

		if($data['status'])
		{
			$and[] = "status = '$data[status]' ";

		}

		$list = \lib\db\productcomment\search::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['self', 'ready'], $list);
		}
		else
		{
			$list = [];
		}

		$filter_args_data = [];

		foreach (self::$filter_args as $key => $value)
		{
			if(isset($list[0][$key]) && substr($value, 0, 1) === '*')
			{
				$filter_args_data[substr($value, 1)] = $list[0][$key];
			}
			else
			{
				$filter_args_data[$key] = $value;
			}
		}

		self::$filter_message = \dash\app\sort::createFilterMsg($query_string, $filter_args_data);

		return $list;
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
						$value = T_("Without name");
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