<?php
namespace lib\app;

/**
 * Class for inout.
 */
class inout
{
	public static $sort_field =
	[
		'cat_id',
		'datetime',
		'jib_id',
		'minus',
		'plus',
		'discount',
		'thirdparty',
		'status',
		'datecreated',
		'datemodified',
	];


	public static function get($_id)
	{
		$id = \dash\coding::decode($_id);
		if(!$id)
		{
			return false;
		}

		$result = \lib\db\inout::get(['id' => $id, 'limit' => 1]);
		$temp = [];
		if(is_array($result))
		{
			$temp = self::ready($result);
		}
		return $temp;
	}


	/**
	 * check args
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function check($_id = null)
	{



		$date = \dash\app::request('date');

		if($date)
		{
			$date = \dash\date::db($date);
			if($date === false)
			{
				\dash\notif::error(T_("Invalid date"), 'date');
				return false;
			}

			if(\dash\utility\jdate::is_jalali($date))
			{
				$date = \dash\utility\jdate::to_gregorian($date);
			}
		}

		if(!$date)
		{
			$date = date("Y-m-d");
		}

		$time = \dash\app::request('time');
		if($time)
		{
			$time = \dash\date::make_time($time);
			if($time === false)
			{
				\dash\notif::error(T_("Invalid time"), 'time');
				return false;
			}
		}

		if(!$time)
		{
			$time = date("H:i:s");
		}

		$thirdparty = \dash\app::request('thirdparty');
		if($thirdparty && mb_strlen($thirdparty) > 150)
		{
			\dash\notif::error(T_("Please set thirdparty less than 150 character"), 'thirdparty');
			return false;
		}

		$isplus = \dash\app::request('isplus') ? true : false;


		$price = \dash\app::request('price');
		$price = \dash\utility\convert::to_en_number($price);
		if(!$price)
		{
			\dash\notif::error(T_("Please set price"), 'price');
			return false;
		}

		if(!is_numeric($price))
		{
			\dash\notif::error(T_("Please set price as a number"), 'price');
			return false;
		}

		$price = intval($price);
		if($price > 1E+9)
		{
			\dash\notif::error(T_("Price is out of range"), 'price');
			return false;
		}

		$discount = \dash\app::request('discount');
		$discount = \dash\utility\convert::to_en_number($discount);

		if($discount && !is_numeric($discount))
		{
			\dash\notif::error(T_("Please set discount as a number"), 'discount');
			return false;
		}

		if($discount)
		{
			$discount = intval($discount);
			if($discount > 1E+9)
			{
				\dash\notif::error(T_("Discount is out of range"), 'discount');
				return false;
			}
		}

		$jib = \dash\app::request('jib');
		if($jib)
		{
			$jib = \dash\coding::decode($jib);
			if(!$jib)
			{
				\dash\notif::error(T_("Invalid jib"), 'jib');
				return false;
			}

			$check = \lib\db\jib::get(['user_id' => \dash\user::id(), 'id' => $jib, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid jib"), 'jib');
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Please choose jib"), 'jib');
			return false;
		}


		$cat = \dash\app::request('cat');
		if($cat)
		{
			$cat = \dash\coding::decode($cat);
			if(!$cat)
			{
				\dash\notif::error(T_("Invalid cat"), 'cat');
				return false;
			}

			$check = \lib\db\category::get(['user_id' => \dash\user::id(), 'id' => $cat, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid cat"), 'cat');
				return false;
			}
		}
		else
		{
			$parent = \dash\app::request('parent');
			$title  = \dash\app::request('title');
			if(!$parent && !$title)
			{
				\dash\notif::error(T_("Please choose category"), 'category');
				return false;
			}
			else
			{
				$master_request = \dash\app::request();
				$new_request    =
				[
					'parent' => $parent,
					'title'  => $title,
					'type'   => 'cat',
					'in'     => $isplus ? 1 : null,
				];

				$new_cat        = \lib\app\category::add($new_request);
				if(isset($new_cat['cat_id']))
				{
					$cat = $new_cat['cat_id'];
					\dash\notif::clean();
					\dash\app::variable($master_request);
				}
				else
				{
					return false;
				}
			}
		}


		$status        = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'deleted', 'expire', 'lost','useless']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc          = \dash\app::request('desc');

		$args               = [];

		$args['datetime']   = $date .' '. $time;

		$args['thirdparty'] = $thirdparty;

		if($isplus)
		{
			$args['plus']  = $price;
			$args['minus'] = null;
		}
		else
		{
			$args['minus'] = $price;
			$args['plus']  = null;
		}

		$args['discount']   = $discount;

		$args['jib_id']     = $jib;
		$args['cat_id']     = $cat;
		$args['status']     = $status;
		$args['desc']       = $desc;

		return $args;

	}



	/**
	 * ready data of user to load in api
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
				case 'jib_id':
				case 'cat_id':
					$result[$key] = \dash\coding::encode($value);
					break;

				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}



	public static function add($_args, $_option = [])
	{
		\dash\app::variable($_args);


		$default_option =
		[
			'debug'    => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);


		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		// check args
		$args = self::check();

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		$return  = [];

		if(!$args['status'])
		{
			$args['status'] = 'enable';
		}

		$args['user_id'] = \dash\user::id();

		$inout = \lib\db\inout::insert($args);

		if(!$inout)
		{
			\dash\log::set('noWayToAddInOut');
			\dash\notif::error(T_("No way to insert inout"));
			return false;
		}

		\dash\log::set('iAddInOut', ['code' => $inout]);

		return $return;
	}


	public static function list($_string = null, $_args = [])
	{

		if(!\dash\user::id())
		{
			\dash\notif::error(T_("User not found"), 'user');
			return false;
		}

		$default_args =
		[
			'order' => null,
			'sort'  => null,
		];

		if(!is_array($_args))
		{
			$_args = [];
		}

		$option = [];
		$option = array_merge($default_args, $_args);

		if($option['order'])
		{
			if(!in_array($option['order'], ['asc', 'desc']))
			{
				unset($option['order']);
			}
		}

		if($option['sort'])
		{
			if(!in_array($option['sort'], self::$sort_field))
			{
				unset($option['sort']);
			}
		}


		$option['i_inout.user_id'] = \dash\user::id();

		$result = \lib\db\inout::search($_string, $option);

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


	public static function edit($_args, $_id)
	{
		\dash\app::variable($_args);

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Can not access to edit inout"), 'inout');
			return false;
		}

		if(!\dash\user::id())
		{
			return false;
		}

		// check args
		$args = self::check($id);

		if($args === false || !\dash\engine\process::status())
		{
			return false;
		}

		if(!\dash\app::isset_request('date')) unset($args['datetime']);
		if(!\dash\app::isset_request('time')) unset($args['datetime']);
		if(!\dash\app::isset_request('thirdparty')) unset($args['thirdparty']);
		if(!\dash\app::isset_request('price')) unset($args['plus']);
		if(!\dash\app::isset_request('price')) unset($args['minus']);
		if(!\dash\app::isset_request('discount')) unset($args['discount']);
		if(!\dash\app::isset_request('jib')) unset($args['jib_id']);
		if(!\dash\app::isset_request('cat')) unset($args['cat_id']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);


		if(!empty($args))
		{
			\lib\db\inout::update($args, $id);
			\dash\log::set('iEditInOut', ['code' => $id]);
		}

		return true;
	}
}
?>