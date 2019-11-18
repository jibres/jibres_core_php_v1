<?php
namespace dash\engine;


class store
{
	private static $check_db = false;


	private static function subdomain_addr()
	{
		return root. 'includes/stores/subdomain/';
	}


	private static function detail_addr()
	{
		return root. 'includes/stores/detail/';
	}


	public static function check_exists_id($_store_id)
	{
		if(file_exists(self::detail_addr(). $_store_id))
		{
			return true;
		}
		return false;
	}


	public static function init_id($_store_id)
	{
		if(self::check_exists_id($_store_id))
		{
			$get_store_detail = file_get_contents(self::detail_addr(). $_store_id);
			if(is_string($get_store_detail))
			{
				$get_store_detail = json_decode($get_store_detail, true);
			}

			if(!is_array($get_store_detail))
			{
				return false;
			}

			return self::make_ready_array($_store_id, $get_store_detail);
		}

		return false;
	}


	public static function init_subdomain($_subdomain = null)
	{
		// no subdomain
		$subdomain        = \dash\url::subdomain();

		if(!$subdomain)
		{
			if($_subdomain)
			{
				$subdomain = $_subdomain;
			}
			else
			{
				return null;
			}
		}

		\lib\app\store\subdomain::$debug = false;

		if(!\lib\app\store\subdomain::validate($subdomain))
		{
			return null;
		}

		$subdomain_addr   = self::subdomain_addr(). $subdomain;
		$detail_addr      = self::detail_addr();
		$get_store_id     = null;
		$get_store_detail = null;

		if(file_exists($subdomain_addr))
		{
			$get_store_id = file_get_contents($subdomain_addr);
			$get_store_id = trim($get_store_id);
			if(is_numeric($get_store_id))
			{
				$detail_addr .= $get_store_id;
				if(file_exists($detail_addr))
				{
					$get_store_detail = file_get_contents($detail_addr);
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
				$get_store_detail = self::check_db($subdomain);
				if(isset($get_store_detail['id']))
				{
					$get_store_id = $get_store_detail['id'];
				}
			}
		}

		return self::make_ready_array($get_store_id, $get_store_detail);

	}


	private static function make_ready_array($_store_id, $_store_detail)
	{
		if($_store_id)
		{
			$db_name           = 'jibres_'. $_store_id;

			if(\dash\url::isLocal())
			{
				$db_name = db_name. '_'. $db_name;
			}

			$detail              = [];
			$detail['id']        = $_store_id;
			$detail['store']     = $_store_detail;
			$detail['db_name']   = $db_name;
			$detail['subdomain'] = isset($_store_detail['subdomain']) ? $_store_detail['subdomain'] : null;

			\dash\db::$jibres_db_name = $db_name;

			return $detail;
		}

		return null;
	}


	public static function config($_subdomain = null)
	{
		self::init_subdomain($_subdomain);
	}


	// check store record is exsist on db and if exists create the file
	private static function check_db($_subdomain)
	{
		$store_detail = \lib\app\store\get::subdomain($_subdomain);
		if(isset($store_detail['id']))
		{
			if(!is_dir(self::subdomain_addr()))
			{
				\dash\file::makeDir(self::subdomain_addr(), null, true);
			}

			if(!is_dir(self::detail_addr()))
			{
				\dash\file::makeDir(self::detail_addr(), null, true);
			}

			\dash\file::write(self::subdomain_addr(). $_subdomain, $store_detail['id']);
			\dash\file::write(self::detail_addr(). $store_detail['id'], json_encode($store_detail, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
			return $store_detail;
		}

	}
}
?>