<?php
namespace dash\engine;


class store
{
	private static $check_db = false;


	private static function subdomain_addr()
	{
		return root. 'stores/subdomain/';
	}


	private static function detail_addr()
	{
		return root. 'stores/detail/';
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
			if(isset($get_store_detail['db_name']))
			{
				\dash\db::$jibres_db_name = $get_store_detail['db_name'];
			}
			return $get_store_detail;
		}

		return false;
	}


	public static function detail($_subdomain = null)
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


		if($get_store_id)
		{
			$db_name           = 'jibres_'. $get_store_id;

			if(\dash\url::isLocal())
			{
				$db_name = db_name. '_'. $db_name;
			}

			$detail            = [];
			$detail['id']      = $get_store_id;
			$detail['store']   = $get_store_detail;
			$detail['db_name'] = $db_name;
			return $detail;
		}

		return null;
	}


	public static function config($_subdomain = null)
	{
		$store_detail = self::detail($_subdomain);
		if(isset($store_detail['db_name']))
		{
			\dash\db::$jibres_db_name = $store_detail['db_name'];
		}
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