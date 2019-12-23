<?php
namespace lib\app\factor;


class check
{


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		$desc = \dash\app::request('desc');
		if($desc && mb_strlen($desc) > 1000)
		{
			\dash\notif::error(T_("Description of factor out of range"), 'desc');
			return false;
		}


		$type = \dash\app::request('type');
		if($type && !in_array($type, ['buy','sale','prefactor','lending','backbuy','backfactor','waste']))
		{
			\dash\notif::error(T_("Invalid type of factor"), 'type');
			return false;
		}

		if(!$type)
		{
			$type = 'sale';
		}

		$customer = \dash\app::request('customer');
		if(!$customer || $customer === '')
		{
			$customer = null;
		}

		if($customer)
		{
			$customer_id = \dash\coding::decode($customer);
			if($customer_id)
			{
				$customer_detail = \lib\db\userstores::get(['id' => $customer_id, 'store_id' => \lib\store::id(), 'limit' => 1]);
				if(!isset($customer_detail['id']))
				{
					\dash\notif::error(T_("Customer detail is invalid"), 'customer');
					return false;
				}
				else
				{
					$customer = $customer_detail['id'];
				}
			}
			else
			{
				// search in displayname of userstore
				$customer_detail = \lib\db\userstores::search_customer($customer, \lib\store::id());
				if(isset($customer_detail['id']))
				{
					$customer = $customer_detail['id'];
				}
				else
				{
					$customer = null;
				}
			}

			if($type === 'sale')
			{
				// everyone sell one time, is customer
				if(isset($customer_detail['id']) && !isset($customer_detail['customer']))
				{
					\lib\db\userstores::update(['customer' => 1], $customer_detail['id']);
				}
			}
		}

		if(!$customer)
		{
			$mobile      = \dash\app::request('mobile');
			if($mobile)
			{
				$mobile = \dash\utility\filter::mobile($mobile);
				if(!$mobile)
				{
					\dash\notif::error(T_("Invalid mobile"), 'mobile');
					return false;
				}
			}

			$gender      = \dash\app::request('gender');

			if($gender && !in_array($gender, ['male', 'female']))
			{
				\dash\notif::error(T_("Invalid gender"), 'gender');
				return false;
			}

			$displayname = \dash\app::request('displayname');

			if($mobile)
			{
				$customer_user_id = \dash\db\users::signup(['mobile' => $mobile, 'gender' => $gender, 'displayname' => $displayname]);
				if($customer_user_id)
				{
					$check_in_store = \lib\db\userstores::get(['store_id' => \lib\store::id(), 'user_id' => $customer_user_id, 'limit' => 1]);
					if(isset($check_in_store['id']))
					{
						$customer = $check_in_store['id'];

						$update_current_customer = [];

						if(array_key_exists('displayname', $check_in_store) && !$check_in_store['displayname'] && $displayname)
						{
							$update_current_customer['displayname'] = $displayname;
						}

						if(array_key_exists('gender', $check_in_store) && !$check_in_store['gender'] && $gender)
						{
							$update_current_customer['gender'] = $gender;
						}

						if(!empty($update_current_customer))
						{
							\lib\db\userstores::update($update_current_customer, $customer);
						}
					}
					else
					{
						$insert_new_user_store =
						[
							'store_id'    => \lib\store::id(),
							'user_id'     => $customer_user_id,
							'gender'      => $gender,
							'mobile'      => $mobile,
							'displayname' => $displayname,
						];

						if($type === 'sale')
						{
							$insert_new_user_store['customer'] = 1;
						}

						$customer = \lib\db\userstores::insert($insert_new_user_store);
					}
				}
			}
			else
			{
				if($displayname)
				{
					$check_exist_displayname = \lib\db\userstores::get(['displayname' => $displayname, 'mobile' => null, 'limit' => 1]);
					if(isset($check_exist_displayname['id']))
					{
						\dash\notif::error(T_("This thirdparyt already added to your store. plase set her mobile or change the name"), 'displayname');
					}
					else
					{
						$customer_user_id = \dash\db\users::signup(['mobile' => null, 'gender' => $gender, 'displayname' => $displayname]);

						$insert_new_user_store =
						[
							'store_id'    => \lib\store::id(),
							'user_id'     => $customer_user_id,
							'gender'      => $gender,
							'displayname' => $displayname,
						];

						if($type === 'sale')
						{
							$insert_new_user_store['customer'] = 1;
						}

						$customer = \lib\db\userstores::insert($insert_new_user_store);
					}
				}
			}
		}

		$args                   = [];
		$args['customer']       = $customer;
		$args['type']           = $type;
		$args['seller']         = \dash\user::id();
		$args['date']           = date("Y-m-d H:i:s");
		$args['title']          = null;
		$args['pre']            = null;
		$args['transport']      = null;
		$args['pay']            = null;
		$args['detailsum']      = null;
		$args['detaildiscount'] = null;
		$args['detailtotalsum'] = null;
		$args['item']           = null;
		$args['qty']            = null;
		$args['vat']            = null;
		$args['discount']       = null;
		$args['sum']            = null;
		$args['status']         = null;
		$args['desc']           = $desc;

		return $args;
	}



	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function factor_detail($_option = [])
	{
		$default_option =
		[
			'debug' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		$list    = \dash\app::request();

		$decode_list   = [];
		$allproduct_id = [];
		$new_list      = [];

		$have_warn     = [];

		foreach ($list as $key => $value)
		{
			$product_id = null;
			if(isset($value['product']))
			{
				$product_id = $value['product'];
			}

			if(!$product_id)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(!array_key_exists('count', $value))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			$value['count'] = \dash\number::clean($value['count']);

			if(!is_numeric($value['count']))
			{
				$have_warn[] = $key + 1;
				continue;
			}

			if(floatval($value['count']) == 0)
			{
				$have_warn[] = $key + 1;
				continue;
			}

			/**
			 * @CHECK @REZA
			 * Need to get from store or set manually
			 */
			$maxproductcount = 9999;

			if($maxproductcount && floatval($value['count']) > floatval($maxproductcount))
			{
				\dash\notif::error(T_("The maximum count product in factor in your store is :val", ['val' => \dash\utility\human::fitNumber($maxproductcount)]), $key + 1);
				return false;
			}

			$continue = false;

			switch ($_option['type'])
			{
				case 'sale':
					if(isset($value['discount']) && $value['discount'] &&  !is_numeric($value['discount']))
					{
						$have_warn[] = $key + 1;
						$continue    = true;
						break;
					}
					break;

				case 'buy':
					// if(!array_key_exists('buyprice', $value))
					// {
					// 	$have_warn[] = $key + 1;
					// 	$continue = true;
					// 	break;
					// }

					// if($value['buyprice'] &&  !is_numeric($value['buyprice']))
					// {
					// 	$have_warn[] = $key + 1;
					// 	$continue = true;
					// 	break;
					// }

					// $new_buyprice      = floatval($value['buyprice']);

					// $price_change                    = [];

					// $price_change['buyprice']        = $new_buyprice;

					// \lib\app\product\buyprice::check($product_id, $price_change, true);

					break;

					// -------------------- prefactor
					case 'prefactor':
						// no thing
						break;

					// -------------------- backbuy
					case 'lending':

						break;

					// -------------------- backbuy
					case 'backbuy':
						break;

					// -------------------- backfactor
					case 'backfactor':

						break;

					// -------------------- wast
					case 'waste':

						break;

					// invalid type
				default:
						\dash\notif::error(T_("Invalid factor type"), 'type');
						return false;
					break;
			}

			if($continue)
			{
				continue;
			}

			$new_list[$key]['count']      = floatval($value['count']);
			$new_list[$key]['discount']   = (isset($value['discount'])) ? intval($value['discount']) : null;
			$new_list[$key]['product_id'] = $product_id;

			$allproduct_id[]              = $product_id;
		}

		if(count($allproduct_id) <> count(array_unique($allproduct_id)))
		{
			\dash\notif::error(T_("Duplicate product in one factor founded"));
			return false;
		}

		$allproduct_id      = array_unique($allproduct_id);

		if(empty($allproduct_id))
		{
			\dash\notif::error(T_("No valid products found in your list"));
			return false;
		}


		if(!empty($have_warn))
		{
			\dash\notif::warn(T_("Invalid product detail in some record of this factor, [:key]", ['key' => implode(',', $have_warn)]));
		}

		$check_true_product = \lib\db\products\get::by_multi_id($allproduct_id);
		$true_product_ids   = array_column($check_true_product, 'id');
		$check_true_product = array_combine($true_product_ids, $check_true_product);

		$factor_detail = [];

		foreach ($new_list as $key => $value)
		{
			$temp = [];

			if(!isset($check_true_product[$value['product_id']]))
			{
				\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

			$price = 0;

			switch ($_option['type'])
			{
				case 'sale':
					if(!array_key_exists('discount', $this_proudct))
					{
						\dash\notif::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
						return false;
					}

					if(array_key_exists('price', $this_proudct))
					{
						$price = floatval($this_proudct['price']);
					}

					$temp['discount']   = $value['discount'] === null ? $this_proudct['discount'] : $value['discount'];
					$temp['sum']        = (floatval($price) - floatval($value['discount'])) * floatval($value['count']);
					break;

				case 'buy':
					// if(array_key_exists('buyprice', $this_proudct))
					// {
					// 	$price = floatval($this_proudct['buyprice']);
					// }

					// $temp['sum'] = floatval($price) * floatval($value['count']);
					break;

				case 'prefactor':
				case 'lending':
				case 'backbuy':
				case 'backfactor':
				case 'waste':

					break;
			}

			$temp['product_id'] = $value['product_id'];
			$temp['price']      = $price;
			$temp['count']      = $value['count'] === null ? 1 : $value['count'];

			$factor_detail[] = $temp;
		}

		return $factor_detail;
	}
}
?>