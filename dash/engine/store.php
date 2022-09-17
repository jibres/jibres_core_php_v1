<?php
namespace dash\engine;


class store
{
	/**
	 * Config file extention
	 *
	 * @var        string
	 */
	public static $ext = '.conf';

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
	private static $IN_STORE  = false;


	/**
	 * CHECK DOMAIN LOADED IS A CUSTOMER DOMAIN OR NOT
	 *
	 * @var        boolean
	 */
	private static $inCustomerDomain       = false;
	private static $customerDomainDetail   = [];
	private static $customerDomainStore_id = null;


	/**
	 * if not found store detail file check store detail in database one time
	 *
	 * @var        boolean
	 */
	private static $check_db = false;


	public static function cache_file()
	{
		return false;
	}

	/**
	 * this function use in every where need to check the store is loaded or no
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function inStore()
	{
		return self::$IN_STORE;
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


	/**
	 * Like jibres.com/$jb2js
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function inBusinessAdmin()
	{
		if(self::inStore())
		{
			// api.jibres.com/$jb2dj
			if(self::free_subdomain())
			{
				// admin.jibres.com/$jb2js
				if(\dash\url::subdomain() === self::admin_subdomain() && \dash\url::store())
				{
					return true;
				}

				return false;
			}

			if(\dash\url::store())
			{
				return true;
			}
			else
			{
				return false;
			}

		}
		else
		{
			return false;
		}
	}


	/**
	 * Like bitty.jibres.ir/
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function inBusinessSubdomain()
	{
		if(self::inStore())
		{
			// like shop.customerdomain.com
			if(self::inCustomerDomain())
			{
				return false;
			}

			// no every subdomain is business subdomain
			// for example api.jibres.com is not a store subdomain
			if(self::free_subdomain())
			{
				return false;
			}

			if(\dash\url::subdomain())
			{
				return true;
			}
			else
			{
				return false;
			}

		}
		else
		{
			return false;
		}
	}


	/**
	 * Like bitty.ir
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	public static function inBusinessDomain()
	{
		return self::inCustomerDomain();
	}

	/**
	 * Return true if butty.ir or bitty.jibres.ir
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function inBusinessWebsite()
	{
		if(self::inBusinessDomain() || self::inBusinessSubdomain())
		{
			return true;
		}

		return false;
	}



	public static function active_domain_for_business()
	{
		return 'jibres.me';
	}



	public static function enable_plugin_admin_special_domain()
	{

		if(\lib\app\plan\planCheck::access('adminOnDomain'))
		{
			$master_domain = \lib\store::master_domain();


			if($master_domain === \dash\url::base())
			{
				return true;
			}
		}

		return false;
	}


	/**
	 * This function all in all master controller in contents
	 */
	public static function gate($_content = null)
	{
		// check store id loaded by any way. Subdomain, specail domain, url, id ,...

		if(!\lib\store::id())
		{
			\dash\header::status(404, T_("Store not found"));
		}

		if(self::enable_plugin_admin_special_domain())
		{
			// ok can load in any model
		}
		else
		{
			if(!\dash\url::store())
			{
				\dash\redirect::to(\dash\url::kingdom());
			}

			if(self::admin_subdomain())
			{
				\dash\redirect::admin_subdomain();
			}
		}
	}


	/**
	 * This content allow to route by customer domain
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function allow_content($_admin_mode = false)
	{
		$content = \dash\url::content();

		$allow_content = [];

		$allow_content[] = 'enter';
		$allow_content[] = 'pay';
		$allow_content[] = 'n';
		$allow_content[] = 'api'; // cronjob need this

		if(self::enable_plugin_admin_special_domain())
		{
			$_admin_mode = true;
		}

		if($_admin_mode)
		{
			$allow_content[] = 'a';
			$allow_content[] = 'cms';
			$allow_content[] = 'site';
			$allow_content[] = 'crm';
			$allow_content[] = 'hook'; // cronjob need this
			$allow_content[] = 'account'; // we have one link from business to account. in accoutn controller redirect
			$allow_content[] = 'my'; // we have one link from business to account. in accoutn controller redirect
		}

		if(in_array($content, $allow_content))
		{
			return true;
		}
		else
		{
			return false;
		}
	}


	public static function config()
	{
		self::privacy_domain_check();

		$store     = \dash\url::store();
		$subdomain = \dash\url::subdomain();

		if($store)
		{
			self::config_by_store_id();
			\dash\engine\runtime::set('engineStoreConf', 'inStore');
		}
		elseif(self::inCustomerDomain() && self::$customerDomainStore_id)
		{
			self::init_by_id(self::$customerDomainStore_id);
			\dash\engine\runtime::set('engineStoreConf', 'inCustomerDomain');
		}
		elseif($subdomain)
		{
			self::config_by_subdomain();
			\dash\engine\runtime::set('engineStoreConf', 'inSubdomain');
		}

	}


	private static function privacy_domain_check()
	{
		$store     = \dash\url::store();
		$subdomain = \dash\url::subdomain();

		if($subdomain && $store)
		{
			if($subdomain === 'api' && in_array(\dash\url::content(), ['v2', 'v3']))
			{
				// no problem
				// https://api.jibres.com/$jb2jr/v2/cart/add
			}
			elseif($subdomain === 'business' && \dash\url::content() === 'b1')
			{
				// no problem
				// https://business.jibres.com/$jb2jr/b1/product/add
			}
			elseif($subdomain === self::admin_subdomain() && in_array(\dash\url::content(), ['a', 'enter', 'crm', 'cms', 'site', 'pay', 'account', '']))
			{
				// no problem
				// https://admin.jibres.com/$jb2jr/a
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
				if(isset(self::$customerDomainDetail['subdomain']) && self::$customerDomainDetail['subdomain'] === $subdomain)
				{
					// no problem.
					// the user point shop.example.com to jibres
				}
				else
				{
					\dash\header::status(409, T_("Can not route subdomain in your domain!"));
				}
			}

			if($store)
			{
				\dash\header::status(409, T_("Domain and store code conflict!"));
			}

			// not route any content in customer domain
			if(\dash\url::content())
			{
				if(self::allow_content(false))
				{
					// the user can login by custom domain
				}
				else
				{
					\dash\header::status(409, T_("Can not route this address from your domain!"));
				}
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

		$lock = self::init_by_id($store_id);

		if(!$lock)
		{
			\dash\header::status(404, T_("Store not found"));
		}
	}


	/**
	 * The admin subdomain
	 * admin.jibres.com
	 * admin.jibres.com/$jb2jr
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function admin_subdomain()
	{
		return null;
		return 'my';
	}


	public static function free_subdomain($_subdomain = null)
	{
		if(!$_subdomain)
		{
			$_subdomain        = \dash\url::subdomain();
		}

		// shop.mydomain.com is not a free subdomain!
		if(\dash\url::root() !== 'jibres')
		{
			return false;
		}

		$free_subdomain =
		[
			'developers',
			'api',
			'core',
			'business',
			'shop',
			self::admin_subdomain(),
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
		self::init_subdomain($subdomain);
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
		$get_store_detail = null;

		if(\dash\engine\store::cache_file())
		{
			$get_store_detail = \dash\file::read(self::detail_addr(). $_store_id. self::$ext);
		}

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
		$subdomain_addr   = self::subdomain_addr(). $_subdomain. self::$ext;
		$detail_addr      = self::detail_addr();

		$get_store_id     = null;
		$get_store_detail = null;

		if(file_exists($subdomain_addr) && \dash\engine\store::cache_file())
		{
			$get_store_id = \dash\file::read($subdomain_addr);
			$get_store_id = trim($get_store_id);
			if(is_numeric($get_store_id))
			{
				$detail_addr .= $get_store_id. self::$ext;
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


			$all_store_setting = \lib\store::detail();

			if(isset($all_store_setting['store_data']['redirect_jibres_subdomain_to_master']) && $all_store_setting['store_data']['redirect_jibres_subdomain_to_master'])
			{
				if(\dash\url::isLocal())
				{
					// nohting
				}
				else
				{
					\dash\engine\runtime::set('engineStoreConf', 'sub46');
					$new_url = \lib\store::master_domain(true);

					if($new_url)
					{
						\dash\redirect::to($new_url);
						return false;
					}
				}
			}
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
		$db_name           = 'business_'. $_store_id;
		return $db_name;
	}


	/**
	 * Cronjob in one request lock force to all store!
	 *
	 * @param      <type>  $_store_detail  The store detail
	 */
	public static function force_lock($_store_detail)
	{
		if(isset($_store_detail['id']))
		{
			self::unlock();
			self::lock($_store_detail['id'], $_store_detail, true);
		}
	}


	/**
	 * Load store detail and lock on that
	 *
	 * @param      <type>  $_store_id  The store identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function force_lock_id($_store_id)
	{
		$store_detail = \lib\db\store\get::by_id($_store_id);
		if($store_detail)
		{
			return self::force_lock($store_detail);
		}

		return false;
	}


	/**
	 * Unlock from store
	 */
	public static function unlock()
	{
		\lib\store::force_clean();
		self::$IN_STORE = false;
		self::$store_loaded_detail = [];
	}


	private static function lock($_store_id, $_store_detail, $_force = false)
	{
		if($_store_id)
		{

			$db_name           = self::make_database_name($_store_id);

			if(!$_force)
			{
				// check business status
				if(isset($_store_detail['status']) && $_store_detail['status'] === 'transfer')
				{
					\dash\engine\prepare::html_raw_page('transfer');
					return false;
				}

				// check business status
				if(isset($_store_detail['status']) && $_store_detail['status'] !== 'enable')
				{
					\dash\header::status(404, T_("This business is currently unavailable!"));
					return false;
				}
			}

			$detail              = [];
			$detail['id']        = $_store_id;
			$detail['store']     = $_store_detail;
			$detail['db_name']   = $db_name;
			$detail['subdomain'] = isset($_store_detail['subdomain']) ? $_store_detail['subdomain'] : null;
			$detail['fuel']      = isset($_store_detail['fuel']) ? $_store_detail['fuel'] : null;

			self::$store_loaded_detail = $detail;

			self::$IN_STORE = true;
			if(!\dash\url::store())
			{
				$store_data = self::store_data($_store_id);

				if(isset($store_data['lang']) && $store_data['lang'] && mb_strlen($store_data['lang']) === 2)
				{
					\dash\language::set_language($store_data['lang']);
				}
			}

			return $detail;
		}

		return null;
	}


	private static function store_data($_store_id)
	{
		\dash\engine\runtime::set('engineStore', 'fileDataBefore');
		$result = \lib\store::file_store_data(['id' => $_store_id]);
		\dash\engine\runtime::set('engineStore', 'fileDataLoaded');
		return $result;
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

			\dash\file::write(self::subdomain_addr(). $store_detail['subdomain']. self::$ext, $store_detail['id']);
			\dash\file::write(self::detail_addr(). $store_detail['id']. self::$ext, json_encode($store_detail, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			return $store_detail;
		}
	}

	public static function is_customer_domain_cache_file($_domain)
	{
		if(self::$inCustomerDomain)
		{
			return true;
		}

		$customer_domain = self::customer_domain_addr(). $_domain. self::$ext;

		if(!is_dir(self::customer_domain_addr()))
		{
			\dash\file::makeDir(self::customer_domain_addr(), null, true);
		}

		return is_file($customer_domain);

	}

	public static function is_customer_domain($_domain)
	{
		if(self::$inCustomerDomain)
		{
			return true;
		}

		$customer_domain = self::customer_domain_addr(). $_domain. self::$ext;

		if(!is_dir(self::customer_domain_addr()))
		{
			\dash\file::makeDir(self::customer_domain_addr(), null, true);
		}

		$load_detail = [];

		if(!is_file($customer_domain) || !\dash\engine\store::cache_file())
		{
			$check_db = \lib\app\business_domain\get::is_customer_domain($_domain);
			$load_detail = $check_db;

			if(isset($check_db['store_id']))
			{
				\dash\file::write($customer_domain, json_encode($check_db, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			}
		}
		else
		{
			$load_detail = \dash\file::read($customer_domain);
			$load_detail = json_decode($load_detail, true);
		}



		self::$customerDomainDetail = $load_detail;

		if($load_detail && isset($load_detail['store_id']))
		{
			if(isset($load_detail['master']) && $load_detail['master'])
			{
				return self::set_customer_domain($load_detail);
			}
			else
			{
				if(isset($load_detail['redirecttomaster']) && $load_detail['redirecttomaster'] === '0')
				{
					return self::set_customer_domain($load_detail);
				}
				else
				{
					// @reza @todo check deleted domain
					// must redirect to master
					$master_domain = \lib\db\business_domain\get::by_store_id_master_domain($load_detail['store_id']);

					if(isset($master_domain['domain']))
					{
						$new_url = \dash\url::protocol(). '://';
						$new_url .= $master_domain['domain'];
						$new_url .= \dash\url::path();
						if($new_url !== \dash\url::pwd())
						{
							\dash\redirect::to($new_url);
						}

					}
					else
					{
						return self::set_customer_domain($load_detail);
					}
				}
			}
		}
		elseif(isset($load_detail['domain_id']))
		{
			$load_default_parking_page = true;
			// check verified domain only by one user
			if(floatval(\lib\db\nic_domain\get::count_verified_user_domain($_domain)) === floatval(1))
			{
				$domain_detail = \lib\db\nic_domain\get::verified_user_domain($_domain);

				if(a($domain_detail, 'user_id'))
				{
					$load_user_setting = \lib\db\nic_usersetting\get::my_setting($domain_detail['user_id']);
					if(a($load_user_setting, 'domain_parking'))
					{
						$load_default_parking_page = false;

						$load_detail['store_id']         = $load_user_setting['domain_parking'];
						$load_detail['domain_parking']   = $load_user_setting['domain_parking'];
						$load_detail['redirecttomaster'] = '0';
						return self::set_customer_domain($load_detail);

					}
				}
			}


			if($load_default_parking_page)
			{
				\dash\engine\prepare::html_raw_page('domainRegistered');
			}
		}
		elseif(isset($load_detail['id']))
		{
			\dash\engine\prepare::html_raw_page('domainOnlyConnected');
		}
		else
		{
			// remove old file
			\dash\file::delete($customer_domain);
		}
	}


	private static function set_customer_domain($load_detail)
	{
		self::init_by_id($load_detail['store_id']);

		if(self::allow_content(false))
		{
			// nothing
		}
		else
		{
			\dash\engine\content::set('content_business');
		}

		self::$inCustomerDomain = true;

		self::$customerDomainStore_id = $load_detail['store_id'];

		return true;
	}


	/**
	 * Detect store by code
	 *
	 * @param      <type>         $_store_code  The store code
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function detect_store_by_code($_store_code)
	{
		$store_id = \dash\store_coding::decode($_store_code);
		if(!$store_id)
		{
			return false;
		}

		$store_detail = \lib\app\store\get::by_id($store_id);

		if(!$store_detail)
		{
			return false;
		}

		$result            = [];
		$result['db_name'] = \dash\engine\store::make_database_name($store_id);
		$result['fuel']    = a($store_detail, 'fuel');
		$result['detail']  = $store_detail;
		return $result;

	}


	/**
	 * The business domain detail file
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function customer_domain_addr()
	{
		return YARD. 'jibres_temp/stores/domain/';
	}


	/**
	 * Get list of business domain
	 *
	 * @return     string  ( description_of_the_return_value )
	 */
	public static function domain_list_addr()
	{
		return YARD. 'jibres_temp/stores/domainlist/';
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
	 *
	 * @return     string
	 */
	public static function cache_addr()
	{
		return YARD. 'jibres_temp/stores/cache/';
	}



	/**
	 * website folder addr
	 * use \dash\layout\business
	 *
	 * @return     string
	 */
	public static function website_addr()
	{
		return YARD. 'jibres_temp/stores/website/';
	}
}
?>