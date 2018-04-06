<?php
namespace lib\utility;
/**
 * Class for plan.
 * check plan feachers
 *
 */
class plan
{


	/**
	 * if user added new store
	 * for 10 days can use from standard plan
	 *
	 * @var        string
	 */
	public static $plan_first = 'free';
	public static $plan_first_days = 10;

	// all plans feachers
	public static $plans      = [];
	// current store id
	public static $store_id    = 0;
	// current store short name
	public static $shortname  = null;
	// current feacher
	public static $current    = [];
	// list of plans name
	public static $plans_name = [];


	/**
	 * load store data
	 * find the plan of the store
	 * check if user not paid the plan money
	 * return false to disable all feacher
	 * in this time the store simillar the free store plans
	 */
	private static function config_load()
	{
		self::list();
		if(self::$store_id)
		{
			// self::$store_id = \dash\coding::decode(self::$store_id);
			$store_detail   = \lib\store::detail();
		}

		if(isset($store_detail['plan']))
		{
			$temp = array_flip(self::$plans_name);
			if(isset($temp[$store_detail['plan']]))
			{
				self::$current = self::$plans[$temp[$store_detail['plan']]];
				return true;
			}
		}
	}


	/**
	 * Gets the details.
	 *
	 * @param      <type>  $_plan_code  The plan code
	 *
	 * @return     <type>  The details.
	 */
	public static function get_detail($_plan_code)
	{
		$list = self::list();

		if(isset($list[$_plan_code]))
		{
			return $list[$_plan_code];
		}
		return null;
	}


	/**
	 * check access this store to this caller or no
	 *
	 * @param      <type>   $_caller  The caller
	 * @param      <type>   $_store    The store
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function access($_caller, $_store = null, $_type = 'id')
	{
		if(!$_store && !self::$store_id && !self::$shortname)
		{
			return false;
		}

		if($_type === 'id')
		{
			if(!$_store)
			{
				$_store = self::$store_id;
			}
			self::$store_id = $_store;
		}

		if($_type === 'shortname')
		{
			if(!$_store)
			{
				$_store = self::$shortname;
			}
			self::$shortname = $_store;
		}

		if(empty(self::$current))
		{
			if(!self::config_load())
			{
				return false;
			}
		}

		if(array_key_exists($_caller,  self::$current['contain']) && self::$current['contain'][$_caller] === true)
		{
			return true;
		}
		return false;
	}


	/**
	 * list of access plans
	 */
	public static function list($_quike = false, $_filip = false)
	{
		$plan             = self::feature_list();

		self::$plans_name = array_combine(array_keys($plan), array_column($plan, 'name'));

		self::$plans      = $plan;

		if($_quike)
		{
			$name = array_column($plan, 'name');
			$plan = array_combine(array_keys($plan), $name);
			if($_filip)
			{
				$plan = array_flip($plan);
			}
			return $plan;
		}

		return $plan;
	}


	/**
	 * get the plan name by get the plan code
	 * alias of storeplans plan name
	 *
	 * @param      <type>  $_plan_code  The plan code
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function plan_name($_plan_code)
	{
		return \lib\db\storeplans::plan_name($_plan_code);
	}


	/**
	 * get the plan code by get the plan name
	 * alias of storeplans plan code
	 *
	 * @param      <type>  $_plan_name  The plan name
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function plan_code($_plan_name)
	{
		return \lib\db\storeplans::plan_code($_plan_name);
	}


	/**
	 * feacher list
	 *
	 * @return     array  ( description_of_the_return_value )
	 */
	public static function feature_list()
	{
		$plan = [];
		/**
		 * plan free
		 */
		$plan[1] =
		[
			'name'       => 'free',
			'detail'     => null,
			'amount'     => 0,
			'prepayment' => false,
			'contain'    =>
			[
				// no thing
			],
		];



		/**
		 * plan standard
		 */
		$plan[2] =
		[
			'name'       => 'standard',
			'detail'     => null,
			'amount'     => 70000,
			'prepayment' => true,
			'contain'    =>
			[
				'telegram:enter:msg'              => true,
				'telegram:exit:msg'               => true,
				'telegram:first:of:day:msg'       => true,
				'telegram:first:of:day:date_now'  => true,
				'telegram:first:of:day:msg:group' => true,
				'telegram:end:day:report'         => true,
				'telegram:end:day:report:group'   => true,
				'show:logo'                       => true,
			],
		];

			/**
		 * plan standard
		 */
		$plan[3] =
		[
			'name'       => 'standard_year',
			'detail'     => null,
			'amount'     => 500000,
			'prepayment' => true,
			'contain'    =>
			[
				'telegram:enter:msg'              => true,
				'telegram:exit:msg'               => true,
				'telegram:first:of:day:msg'       => true,
				'telegram:first:of:day:date_now'  => true,
				'telegram:first:of:day:msg:group' => true,
				'telegram:end:day:report'         => true,
				'telegram:end:day:report:group'   => true,
				'show:logo'                       => true,
			],
		];



		return $plan;
	}
}
?>