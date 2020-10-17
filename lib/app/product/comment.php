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
			'name'       => 'displayname',
			'mobile'     => 'mobile',
			'title'      => 'string_200',
			'username'   => 'bit',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		if($data['username'])
		{
			\dash\header::status(404, T_("What are you doing?"));
			return false;
		}


		if(!$data['content'] && !$data['star'])
		{
			if($_id)
			{
				// nothing
			}
			else
			{
				\dash\notif::error(T_("Please fill the comment text or set your rate"), 'comment');
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


	public static function customer_review($_product_id)
	{
		$product_id = \dash\validate::id($_product_id);

		if(!$product_id)
		{
			return false;
		}

		$product_detail = \lib\app\product\get::inline_get($product_id);
		if(!$product_detail)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$customer_review = \lib\db\productcomment\get::customer_review($product_id);
		if(!is_array($customer_review))
		{
			$customer_review = [];
		}

		$result =
		[
			'count'  => null,
			'avg'    => null,
			'star_1' => null,
			'star_2' => null,
			'star_3' => null,
			'star_4' => null,
			'star_5' => null,
		];

		$result = array_merge($result, $customer_review);

		$count = floatval($result['count']);
		if(!$count)
		{
			$count = 1;
		}
		$result['avg'] = round($result['avg'], 1);
		$result['star_1_percent'] = round((floatval($result['star_1']) * 100) / $count);
		$result['star_2_percent'] = round((floatval($result['star_2']) * 100) / $count);
		$result['star_3_percent'] = round((floatval($result['star_3']) * 100) / $count);
		$result['star_4_percent'] = round((floatval($result['star_4']) * 100) / $count);
		$result['star_5_percent'] = round((floatval($result['star_5']) * 100) / $count);

		return $result;
	}


	public static function get_count($_product_id)
	{
		$product_id = \dash\validate::id($_product_id);

		if(!$product_id)
		{
			\dash\notif::error(T_("Invalid product id"));
			return false;
		}

		$load_count = \lib\db\productcomment\get::count_product($product_id);
		if(!is_numeric($load_count))
		{
			$load_count = 0;
		}

		return floatval($load_count);
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

		// if(!\dash\user::id())
		// {
		// 	\dash\notif::error(T_("Please login to continue"));
		// 	return false;
		// }

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

		if(\dash\user::id())
		{
			$args['user_id']     = \dash\user::id();
		}
		else
		{
			if($args['mobile'])
			{
				$user_id = \dash\app\user::quick_add(['mobile' => $args['mobile'], 'displayname' => $args['name']]);
				if($user_id)
				{
					$args['user_id']     = $user_id;
				}
			}
		}


		unset($args['name']);
		unset($args['mobile']);

		$args['ip']          = \dash\server::ip(true);
		$args['datecreated'] = date("Y-m-d H:i:s");

		if(!$args['status'])
		{
			$args['status'] = 'awaiting';
		}

		$only_star = false;
		if($args['content'] === null)
		{
			$only_star = true;
			$args['status'] = 'approved';
		}

		if($only_star)
		{
			// if(isset($args['product_id']))
			// {
			// 	if(isset($args['user_id']) && $args['user_id'])
			// 	{
			// 		$check_duplicate_star = \lib\db\productcomment\get::check_duplicate_star($args['user_id'], $args['product_id']);
			// 	}
			// 	else
			// 	{

			// 	}
			// }
			// var_dump($args);exit();
		}

		// // check duplicate
		// $check_duplicate = \lib\db\productcomment\get::check_duplicate(\dash\user::id(), $args['product_id']);
		// if(isset($check_duplicate['id']))
		// {
		// 	$id = $check_duplicate['id'];
		// 	$update = [];
		// 	if($check_duplicate['content'] != $args['content'])
		// 	{
		// 		$update['content'] = $args['content'];
		// 	}

		// 	if($check_duplicate['star'] != $args['star'])
		// 	{
		// 		$update['star'] = $args['star'];
		// 	}

		// 	if(empty($update))
		// 	{
		// 		\dash\notif::info(T_("No change in your product comment"));
		// 	}
		// 	else
		// 	{
		// 		$update = \lib\db\productcomment\update::update($update, $id);

		// 		if($update)
		// 		{
		// 			\dash\log::set('productCommentUpdated', ['old' => $check_duplicate, 'change' => $args]);

		// 			\dash\notif::ok(T_("The comment successfully updated"));

		// 		}
		// 		else
		// 		{
		// 			\dash\log::set('productcommentDbCannotUpdate');
		// 			\dash\notif::error(T_("Can not update your product comment"));
		// 			return false;
		// 		}
		// 	}

		// }
		// else
		// {

		// 	$id = \lib\db\productcomment\insert::new_record($args);
		// 	if(!$id)
		// 	{
		// 		\dash\log::set('productCommentDbErrorInsert');
		// 		\dash\notif::error(T_("No way to insert data"));
		// 		return false;
		// 	}

		// 	\dash\notif::ok(T_("Comment successfully added"));

		// }



		$id = \lib\db\productcomment\insert::new_record($args);
		if(!$id)
		{
			\dash\log::set('productCommentDbErrorInsert');
			\dash\notif::error(T_("No way to insert data"));
			return false;
		}

		\dash\notif::ok(T_("Comment successfully added"));


		$result       = [];
		$result['id'] = \dash\coding::encode($id);
		return $result;
	}



	public static function answer($_answer, $_id)
	{
		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$answer = \dash\validate::desc($_answer, false);

		if(!$answer)
		{
			\dash\notif::error(T_("Please fill the answer box"));
			return false;
		}

		if(array_key_exists('parent', $load) && is_null($load['parent']))
		{
			// no problem
		}
		else
		{
			// if need can answer in 3 level or 4 level change here code by check master parent
			\dash\notif::error(T_("Can not answer to this comment. This comment is answer of another!"));
			return false;
		}

		$insert_answer =
		[
			'product_id'  => $load['product_id'],
			'user_id'     => \dash\user::id(),
			'content'     => $answer,
			'parent'      => $load['id'],
			'ip'          => \dash\server::ip(true),
			'datecreated' => date("Y-m-d H:i:s"),
			'status'      => 'approved',
		];

		$id = \lib\db\productcomment\insert::new_record($insert_answer);

		\dash\notif::ok(T_("Your answer was saved"));
		return true;

	}


	public static function answer_list($_id)
	{

		$load = self::inline_get($_id);

		if(!isset($load['id']))
		{
			\dash\notif::error(T_("Invalid comment id"));
			return false;
		}

		$load_asnwer_list = \lib\db\productcomment\get::by_parent($load['id']);

		if(!is_array($load_asnwer_list))
		{
			$load_asnwer_list = [];
		}

		$load_asnwer_list = array_map(['self', 'ready'], $load_asnwer_list);

		return $load_asnwer_list;
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


		unset($args['name']);
		unset($args['mobile']);


		$args = \dash\cleanse::patch_mode($_args, $args);

		if(array_key_exists('status', $args) && !$args['status'])
		{
			\dash\notif::error(T_("Status of product comment cannot be null"));
			return false;
		}

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
				$args['datemodified'] = date("Y-m-d H:i:s");

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


	public static function get_public_list($_product_id)
	{
		return self::list(null, ['status' => 'approved', 'have_content' => true, 'product_id' => $_product_id], ['check_login' => false]);
	}


	public static function list($_query_string, $_args, $_option = [])
	{
		$default_option =
		[
			'check_login' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if($_option['check_login'])
		{
			if(!\dash\user::id())
			{
				\dash\notif::error(T_("Please login to continue"));
				return false;
			}
		}

		$condition =
		[
			'order'      => 'order',
			'sort'       => ['enum' => ['title', 'status']],
			'status'     => ['enum' => ['spam', 'deleted', 'unapproved', 'approved', 'awaiting']],
			'product_id' => 'id',
			'have_content' => 'bit',
		];

		$require = [];

		$meta    = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and         = [];
		$meta        = [];
		$or          = [];

		$meta['limit'] = 20;

		$order_sort  = null;

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " productcomment.content LIKE '%$query_string%' ";
		}


		if($data['sort'] && !$order_sort)
		{
			if(in_array($data['sort'], ['title', 'status']))
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
			$order_sort = " ORDER BY productcomment.id DESC";
		}

		if($data['have_content'])
		{
			$and[] = " productcomment.content IS NOT NULL ";
		}

		if($data['product_id'])
		{
			$and[] =
			"
				(
					productcomment.product_id = $data[product_id] OR
					productcomment.product_id IN (SELECT products.id FROM products WHERE products.parent = $data[product_id]) OR
					productcomment.product_id IN (SELECT products.id FROM products WHERE products.parent = (SELECT products.parent FROM products WHERE products.id = $data[product_id]))
				)
			";
		}

		if($data['status'])
		{
			$and[] = "productcomment.status = '$data[status]' ";

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

		$_data = \dash\app::fix_avatar($_data);

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
				case 'user_id':
				case 'parent':
					if(isset($value))
					{
						$result[$key] = \dash\coding::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'ip':
					if(isset($value))
					{
						$result[$key] = long2ip($value);
					}
					else
					{
						$result[$key] = null;
					}
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


				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}

}
?>