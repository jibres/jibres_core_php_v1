<?php
namespace lib\app;

/**
 * Class for checkbook.
 */
class checkbook
{
	public static $sort_field =
	[
		'bank_id',
		'desc',
		'firstserial',
		'number',
		'pagecount',
		'title',

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

		$result = \lib\db\checkbook::get(['id' => $id, 'limit' => 1]);
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

		$title          = \dash\app::request('title');
		if(!$title)
		{
			\dash\notif::error(T_("Plese set title"), 'title');
			return false;
		}

		if(mb_strlen($title) > 150)
		{
			\dash\noitf::error(T_("Pleas set title name less than 150 character"), 'title');
			return false;
		}


		$bank = \dash\app::request('bank');
		if($bank)
		{
			$bank = \dash\coding::decode($bank);
			if(!$bank)
			{
				\dash\notif::error(T_("Invalid bank"), 'bank');
				return false;
			}

			$check = \lib\db\bank::get(['user_id' => \dash\user::id(), 'id' => $bank, 'limit' => 1]);
			if(!isset($check['id']))
			{
				\dash\notif::error(T_("Invalid bank"), 'bank');
				return false;
			}
		}
		else
		{
			\dash\notif::error(T_("Please choose bank"), 'bank');
			return false;
		}

		$status        = \dash\app::request('status');
		if($status && !in_array($status, ['enable', 'disable', 'deleted', 'expire', 'lost','useless']))
		{
			\dash\notif::error(T_("Invalid status"), 'status');
			return false;
		}

		$desc      = \dash\app::request('desc');

		$firstserial = \dash\app::request('firstserial');
		$firstserial = \dash\utility\convert::to_en_number($firstserial);

		if($firstserial && !is_numeric($firstserial))
		{
			\dash\notif::error(T_("Please set firstserial as a number"), 'firstserial');
			return false;
		}

		if($firstserial)
		{
			$firstserial = intval($firstserial);
			if($firstserial > 1E+20)
			{
				\dash\notif::error(T_("firstserial is out of range"), 'firstserial');
				return false;
			}
		}

		$number = \dash\app::request('number');
		$number = \dash\utility\convert::to_en_number($number);

		if($number && !is_numeric($number))
		{
			\dash\notif::error(T_("Please set number as a number"), 'number');
			return false;
		}

		if($number)
		{
			$number = intval($number);
			if($number > 1E+20)
			{
				\dash\notif::error(T_("number is out of range"), 'number');
				return false;
			}
		}


		$pagecount = \dash\app::request('pagecount');
		$pagecount = \dash\utility\convert::to_en_number($pagecount);

		if($pagecount && !is_numeric($pagecount))
		{
			\dash\notif::error(T_("Please set pagecount as a number"), 'pagecount');
			return false;
		}

		if($pagecount)
		{
			$pagecount = intval($pagecount);
			if($pagecount > 1E+4)
			{
				\dash\notif::error(T_("pagecount is out of range"), 'pagecount');
				return false;
			}
		}


		$args                = [];
		$args['title']       = $title;
		$args['bank_id']     = $bank;
		$args['status']      = $status;
		$args['number']      = $number;
		$args['firstserial'] = $firstserial;
		$args['pagecount']   = $pagecount;
		$args['desc']        = $desc;

		return $args;

	}


	public static function my_list()
	{
		return self::list();
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
				case 'bank_id':
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


	/**
	 * add new user
	 *
	 * @param      array          $_args  The arguments
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
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

		$checkbook = \lib\db\checkbook::insert($args);

		if(!$checkbook)
		{
			\dash\log::set('noWayToAddCheckBook');
			\dash\notif::error(T_("No way to insert checkbook"));
			return false;
		}

		\dash\log::set('iAddCheckBook', ['code' => $checkbook]);

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


		$option['i_checkbook.user_id'] = \dash\user::id();


		$result = \lib\db\checkbook::search($_string, $option);

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
			\dash\notif::error(T_("Can not access to edit checkbook"), 'checkbook');
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


		if(!\dash\app::isset_request('title')) unset($args['title']);
		if(!\dash\app::isset_request('bank_id')) unset($args['bank_id']);
		if(!\dash\app::isset_request('status')) unset($args['status']);
		if(!\dash\app::isset_request('number')) unset($args['number']);
		if(!\dash\app::isset_request('firstserial')) unset($args['firstserial']);
		if(!\dash\app::isset_request('pagecount')) unset($args['pagecount']);
		if(!\dash\app::isset_request('desc')) unset($args['desc']);

		if(!empty($args))
		{
			\lib\db\checkbook::update($args, $id);
			\dash\log::set('iEditCheckBook', ['code' => $id]);
		}

		return true;
	}
}
?>