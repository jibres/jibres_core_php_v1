<?php
namespace lib\app;
use \lib\utility;
use \lib\debug;

/**
 * Class for factor.
 */
class factor
{

	use \lib\app\factor\add;
	use \lib\app\factor\edit;
	use \lib\app\factor\datalist;
	use \lib\app\factor\get;
	use \lib\app\factor\dashboard;


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check_factor($_option = [])
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

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => \lib\app::request(),
			]
		];

		$customer = \lib\app::request('customer');
		$customer = trim($customer);
		if(!$customer || $customer === '')
		{
			$customer = null;
		}

		if($customer)
		{
			$customer = \lib\utility\shortURL::decode($customer);
			if(!$customer)
			{
				\lib\app::log('api:factor:customer:invalid', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Customer detail is invalid"), 'customer');
				return false;
			}

			$customer_detail = \lib\db\userstores::get(['id' => $customer, 'store_id' => \lib\store::id(), 'limit' => 1]);
			if(!isset($customer_detail))
			{
				\lib\app::log('api:factor:customer:invalid:id:not:found', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Customer detail is invalid"), 'customer');
				return false;
			}
		}

		$desc = \lib\app::request('desc');
		if($desc && mb_strlen($desc) > 1000)
		{
			\lib\app::log('api:factor:desc:max:lenght', \lib\user::id(), \lib\app::log_meta());
			\lib\debug::error(T_("Description of factor out of range"), 'desc');
			return false;
		}

		$args                   = [];
		$args['customer']       = $customer;
		$args['seller']         = \lib\userstore::id();
		$args['date']           = date("Y-m-d H:i:s");
		$args['shamsidate']     = \lib\utility\jdate::date("Ymd", time(), false);
		$args['title']          = null;
		$args['pre']            = null;
		$args['transport']      = null;
		$args['pay']            = null;
		$args['detailsum']      = null;
		$args['detaildiscount'] = null;
		$args['detailtotalsum'] = null;
		$args['detailcount']    = null;
		$args['vat']            = null;
		$args['discount']       = null;
		$args['sum']            = null;
		$args['status']         = 'enable';

		$args['desc']           = $desc;
		return $args;

	}




	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	private static function check_factor_detail($_option = [])
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

		$list = \lib\app::request();

		$decode_list   = [];
		$allproduct_id = [];

		foreach ($list as $key => $value)
		{
			$product_id = null;
			if(isset($value['product']))
			{
				$product_id = \lib\utility\shortURL::decode($value['product']);
			}

			if(!$product_id)
			{
				\lib\app::log('api:factor:detail:product_id:invalid', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			if(isset($value['count']) && !is_numeric($value['count']))
			{
				\lib\app::log('api:factor:detail:product:count:not:numberic', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Invalid proudct count in factor :key", ['key' => $key]), 'count');
				return false;
			}


			if(isset($value['discount']) && $value['discount'] &&  !is_numeric($value['discount']))
			{
				\lib\app::log('api:factor:detail:product:discount:not:numberic', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Invalid proudct discount in factor :key", ['key' => $key]), 'discount');
				return false;
			}

			$list[$key]['product_id'] = $product_id;

			$allproduct_id[] = $product_id;
		}

		$check_true_product = \lib\db\products::check_multi_product_id($allproduct_id, \lib\store::id());
		$true_product_ids   = array_column($check_true_product, 'id');
		$check_true_product = array_combine($true_product_ids, $check_true_product);

		$factor_detail = [];

		foreach ($list as $key => $value)
		{

			$temp = [];

			if(!isset($check_true_product[$value['product_id']]))
			{
				\lib\app::log('api:factor:detail:product_id:not:true', \lib\user::id(), \lib\app::log_meta());
				\lib\debug::error(T_("Invalid proudct in factor :key", ['key' => $key]), 'product');
				return false;
			}

			$this_proudct = $check_true_product[$value['product_id']];

			if(!array_key_exists('price', $this_proudct))
			{
				$price = 0;
			}
			else
			{
				$price = intval($this_proudct['price']);
			}

			$temp['price']    = $price;
			$temp['count']    = $value['count'];
			$temp['discount'] = $value['discount'];
			$temp['sum']      = (floatval($price) - floatval($value['discount'])) * intval($value['count']);

			$factor_detail[] = $temp;
		}


		var_dump($factor_detail);
		var_dump($allproduct_id);exit();

		$args['factor_id']  = null;
		$args['product_id'] = null;
		$args['price']      = null;
		$args['count']      = null;
		$args['discount']   = null;
		$args['sum']        = null;

		return $args;

	}


	/**
	 * ready data of factor to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready($_data)
	{
		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				default:
					$result[$key] = isset($value) ? (string) $value : null;
					break;
			}
		}

		return $result;
	}
}
?>