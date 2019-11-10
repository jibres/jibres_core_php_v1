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


	public static function detail()
	{
		// no subdomain
		$subdomain        = \dash\url::subdomain();

		if(!$subdomain)
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

			$detail            = [];
			$detail['id']      = $get_store_id;
			$detail['store']   = $get_store_detail;
			$detail['db_name'] = $db_name;
			return $detail;
		}

		return null;
	}


	public static function config()
	{
		$store_detail = self::detail();
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