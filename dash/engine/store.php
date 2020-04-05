<?php
namespace dash\engine;


class store
{
	/**
	 * save store loaded detail to get from fuel
	 *
	 * @var        array
	 */
	private static $store_loaded_detail = [];

	/**
	 * CHECKING THE STORE IS LOADED OR NO
	 *
	 * @var        boolean
	 */
	private static $IN_SOTE  = false;


	/**
	 * CHECK DOMAIN LOADED IS A CUSTOMER DOMAIN OR NOT
	 *
	 * @var        boolean
	 */
	private static $inCustomerDomain = false;


	/**
	 * if not found store detail file check store detail in database one time
	 *
	 * @var        boolean
	 */
	private static $check_db = false;


	/**
	 * this function use in every where need to check the store is loaded or no
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function inStore()
	{
		return self::$IN_SOTE;
	}


	public static function inCustomerDomain()
	{
		return self::$inCustomerDomain;
	}

	/**
	 * Stores a detail.
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function store_detail()
	{
		return self::$store_loaded_detail;
	}


	public static function config()
	{
		self::privacy_domain_check();

		$store     = \dash\url::store();
		$subdomain = \dash\url::subdomain();

		if($store)
		{
			self::config_by_store_id();
		}
		elseif($subdomain)
		{
			self::config_by_subdomain();
		}
	}


	private static function privacy_domain_check()
	{
		$store     = \dash\url::store();
		$subdomain = \dash\url::subdomain();

		if($subdomain && $store)
		{
			if($subdomain === 'api' && \dash\url::content() === 'v2')
			{
				// no problem
			}
			else
			{
				\dash\header::status(409, T_("Subdomain and store code conflict!"));
			}
		}

		if(self::inCustomerDomain())
		{
			if($subdomain)
			{
				\dash\header::status(409, T_("Can not route subdomain in your domain!"));
			}

			if($store)
			{
				\dash\header::status(409, T_("Domain and store code conflict!"));
			}

			// not route any content in customer domain
			if(\dash\url::content())
			{
				\dash\header::status(409, T_("Can not route this address from your domain!"));
			}
		}
	}


	/**
	 * call from \dash\engine\power
	 */
	private static function config_by_store_id()
	{
		$store        = \dash\url::store();

		if(!$store)
		{
			return;
		}

		$store_id = \dash\store_coding::decode($store);

		$user_id = \dash\user::id();

		$lock = self::init_by_id($store_id);

		if(!$lock)
		{
			\dash\header::status(404, T_("Store not found"));
		}

		if(self::inStore())
		{
			if(!\dash\user::is_init_store_user())
			{
				\dash\user::store_init($user_id);
			}
		}
	}


	public static function free_subdomain($_subdomain = null)
	{
		if(!$_subdomain)
		{
			$_subdomain        = \dash\url::subdomain();
		}

		$free_subdomain =
		[
			'developers',
			'api',
			'core',
		];

		if(in_array($_subdomain, $free_subdomain))
		{
			return true;
		}

		return false;
	}



	private static function config_by_subdomain()
	{
		$subdomain        = \dash\url::subdomain();

		if(!$subdomain)
		{
			return;
		}

		if(self::free_subdomain())
		{
			return;
		}

		$user_id = \dash\user::id();

		self::init_subdomain($subdomain);

		if(self::inStore())
		{
			if(!\dash\user::is_init_store_user())
			{
				\dash\user::store_init($user_id);
			}
		}
	}



	/**
	 * call from API
	 * on the API we have the store code and decode it
	 * if have a number and lenght of this number is ok init store by id
	 *
	 * @param      <int>   $_store_id  The store identifier
	 *
	 * @return     boolean
	 */
	public static function init_by_id($_store_id)
	{
		$get_store_detail = \dash\file::read(self::detail_addr(). $_store_id);

		if(!$get_store_detail)
		{
			if(!self::$check_db)
			{
				self::$check_db = true;
				// check from database
				$get_store_detail = self::check_db($_store_id, 'id');
				if(isset($get_store_detail['id']))
				{
					$_store_id = $get_store_detail['id'];
				}
			}
		}

		if(is_string($get_store_detail))
		{
			$get_store_detail = json_decode($get_store_detail, true);
		}

		if(!is_array($get_store_detail))
		{
			return false;
		}

		return self::lock($_store_id, $get_store_detail);
	}


	/**
	 * Init store by subdomain
	 * called from \lib\store and \engine\power
	 *
	 * @param      <string>  $_subdomain  The subdomain
	 *
	 */
	public static function init_subdomain($_subdomain = null)
	{
		$subdomain_addr   = self::subdomain_addr(). $_subdomain;
		$detail_addr      = self::detail_addr();

		$get_store_id     = null;
		$get_store_detail = null;

		if(file_exists($subdomain_addr))
		{
			$get_store_id = \dash\file::read($subdomain_addr);
			$get_store_id = trim($get_store_id);
			if(is_numeric($get_store_id))
			{
				$detail_addr .= $get_store_id;
				if(file_exists($detail_addr))
				{
					$get_store_detail = \dash\file::read($detail_addr);
					if(is_string($get_store_detail))
					{
						$get_store_detail = json_decode($get_store_detail, true);
					}
				}
			}
		}


		if(!$get_store_id || !$get_store_detail)
		{
			if(!self::$check_db)
			{
				self::$check_db = true;
				// check from database
				$get_store_detail = self::check_db($_subdomain, 'subdomain');
				if(isset($get_store_detail['id']))
				{
					$get_store_id = $get_store_detail['id'];
				}
			}
		}

		if($get_store_id)
		{
			$result = self::lock($get_store_id, $get_store_detail);
			return $result;
		}

		return false;
	}


	/**
	 * Makes a database name.
	 * call every where need to connect to customer database
	 *
	 * @param      <type>  $_store_id  The store identifier
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function make_database_name($_store_id)
	{
		$db_name           = 'jibres_'. $_store_id;

		// if(\dash\url::isLocal())
		// {
		// 	$db_name           = 'jibresLocal_'. $_store_id;
		// }

		return $db_name;
	}


	private static function lock($_store_id, $_store_detail)
	{
		if($_store_id)
		{
			$db_name           = self::make_database_name($_store_id);

			$detail              = [];
			$detail['id']        = $_store_id;
			$detail['store']     = $_store_detail;
			$detail['db_name']   = $db_name;
			$detail['subdomain'] = isset($_store_detail['subdomain']) ? $_store_detail['subdomain'] : null;
			$detail['fuel']      = isset($_store_detail['fuel']) ? $_store_detail['fuel'] : null;

			self::$store_loaded_detail = $detail;

			self::$IN_SOTE = true;

			return $detail;
		}

		return null;
	}



	/**
	 * check store record is exsist on db and if exists create the file
	 *
	 * @param      <string | int>  $_key   the subdomain or store id
	 */
	private static function check_db($_key, $_type)
	{
		if($_type === 'subdomain')
		{
			$store_detail = \lib\app\store\get::by_subdomain($_key);
		}
		elseif($_type === 'id')
		{
			$store_detail = \lib\app\store\get::by_id($_key);
		}
		else
		{
			return;
		}

		if(isset($store_detail['id']) && isset($store_detail['subdomain']))
		{
			if(!is_dir(self::subdomain_addr()))
			{
				\dash\file::makeDir(self::subdomain_addr(), null, true);
			}

			if(!is_dir(self::detail_addr()))
			{
				\dash\file::makeDir(self::detail_addr(), null, true);
			}

			\dash\file::write(self::subdomain_addr(). $store_detail['subdomain'], $store_detail['id']);
			\dash\file::write(self::detail_addr(). $store_detail['id'], json_encode($store_detail, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			return $store_detail;
		}
	}


	public static function is_customer_domain($_domain)
	{
		if(self::$inCustomerDomain)
		{
			return true;
		}

		$customer_domain = self::customer_domain_addr(). $_domain;
		if(!is_file($customer_domain))
		{
			return false;
		}

		$load_detail = \dash\file::read($customer_domain);
		$load_detail = trim($load_detail);

		if($load_detail && is_numeric($load_detail))
		{
			self::init_by_id($load_detail);
			\dash\engine\content::set('content_subdomain');
			self::$inCustomerDomain = true;
			return true;
		}
	}



	public static function customer_domain_addr()
	{
		return YARD. 'jibres_temp/stores/domain/';
	}

	/**
	 * subdomain folder addr
	 * use in this file and app store add
	 *
	 * @return     string
	 */
	public static function subdomain_addr()
	{
		return YARD. 'jibres_temp/stores/subdomain/';
	}


	/**
	 * detail folder addr
	 * use in this file and app store add
	 *
	 * @return     string
	 */
	public static function detail_addr()
	{
		return YARD. 'jibres_temp/stores/detail/';
	}


	/**
	 * setting folder addr
	 * use in this file and \lib\store
	 *
	 * @return     string
	 */
	public static function setting_addr()
	{
		return YARD. 'jibres_temp/stores/setting/';
	}


	/**
	 * cache folder addr
	 * use \lib\app\cache
	 *
	 * @return     string
	 */
	public static function cache_addr()
	{
		return YARD. 'jibres_temp/stores/cache/';
	}
}
?>