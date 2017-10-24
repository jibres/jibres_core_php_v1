<?php
namespace lib\app\store;
use \lib\utility;
use \lib\debug;
use \lib\db\logs;

trait get
{
	public static $logo_urls = [];

	/**
	 * ready data of store to load in api
	 *
	 * @param      <type>  $_data  The data
	 */
	public static function ready_store($_data, $_options = [])
	{
		$default_options =
		[
			'check_is_my_store' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		$result = [];
		foreach ($_data as $key => $value)
		{

			switch ($key)
			{
				case 'id':
				case 'creator':
				// case 'parent':
					if(isset($value))
					{
						$result[$key] = \lib\utility\shortURL::encode($value);
					}
					else
					{
						$result[$key] = null;
					}
					break;

				case 'slug':
					$result[$key] = isset($value) ? (string) $value : null;
					$result['url'] = isset($value) ? Protocol. '://'. $value. '.jibres.'. Tld : null;
					break;

				case 'country':
				case 'city':
				case 'province':
				case 'zipcode':
				case 'name':
				case 'website':
				case 'desc':
				case 'alias':
				case 'status':
					$result[$key] = isset($value) ? (string) $value : null;
					break;
				case 'lang':
					$result['language'] = isset($value) ? (string) $value : null;
					break;

				case 'logo':
					if($value)
					{
						// $result['logo'] = self::host('file'). '/'. $value;
					}
					else
					{
						// $result['logo'] = self::host('siftal_image');
					}
					break;

				case 'createdate':
					$result[$key] = $value;
					$date_now = new \DateTime("now");
					$start    = new \DateTime($value);
					$result['day_use']    = $date_now->diff($start)->days;
					$result['day_use']++;
					break;

				case 'telegram_id':
					$result['telegram'] = $value ? true : false;
					break;

				case 'plan':
					$result[$key] = $value;
					break;
				default:
					continue;
					break;
			}
		}

		return $result;
	}


	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function get_list_store($_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}

		$meta            = [];
		$meta['creator'] = \lib\user::id();
		$result          = \lib\db\stores::search(\lib\user::id(), $meta);
		$temp            = [];
		foreach ($result as $key => $value)
		{
			$check = self::ready_store($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}


	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function get_list_store_child($_args = [])
	{
		if(!\lib\user::id())
		{
			return false;
		}
	}

	/**
	 * Gets the store.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The store.
	 */
	public static function get_store($_options = [])
	{
		$default_options =
		[
			'debug' => true,
		];

		if(!is_array($_options))
		{
			$_options = [];
		}

		$_options = array_merge($default_options, $_options);

		if($_options['debug'])
		{
			debug::title(T_("Operation Faild"));
		}

		$log_meta =
		[
			'data' => null,
			'meta' =>
			[
				'input' => utility::request(),
			]
		];

		if(!\lib\user::id())
		{
			// return false;
		}

		$id = utility::request("id");
		$id = \lib\utility\shortURL::decode($id);

		$shortname = utility::request('shortname');

		if(!$id && !$shortname)
		{
			if($_options['debug'])
			{
				logs::set('api:store:id:shortname:not:set', \lib\user::id(), $log_meta);
				debug::error(T_("Store id or shortname not set"), 'id', 'arguments');
			}
			return false;
		}

		if($id && $shortname)
		{
			logs::set('api:store:id:shortname:together:set', \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not set store id and shortname together"), 'id', 'arguments');
			}
			return false;
		}

		if($id)
		{
			$result = \lib\db\stores::access_store_id($id, \lib\user::id(), ['action' => 'view']);
		}
		else
		{
			$result = \lib\db\stores::access_store($shortname, \lib\user::id(), ['action' => 'view']);
		}

		if(!$result)
		{
			if($id)
			{
				$result = \lib\db\stores::get(['id' => $id, 'limit' => 1]);
			}
			elseif($shortname)
			{
				$result = \lib\db\stores::get(['shortname' => $shortname, 'limit' => 1]);
			}

			if($result)
			{
				if(\lib\permission::access('load:all:store', null, \lib\user::id()))
				{
					$result = $result;
				}
				else
				{
					\lib\temp::set('store_access_denied', true);
					\lib\temp::set('store_exist', true);
					$result = false;
				}
			}
		}

		if(!$result)
		{
			logs::set('api:store:access:denide', \lib\user::id(), $log_meta);
			if($_options['debug'])
			{
				debug::error(T_("Can not access to load this store details"), 'store', 'permission');
			}
			return false;
		}

		if($_options['debug'])
		{
			debug::title(T_("Operation complete"));
		}

		$result = self::ready_store($result);

		return $result;
	}
}
?>