<?php
namespace lib\app\business_domain;

class business
{

	public static function domain_list($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return [];
		}

		$addr = \dash\engine\store::domain_list_addr();
		$addr .= $_store_id;
		$addr .= \dash\engine\store::$ext;

		$domain_list = [];

		if(is_file($addr) && \dash\engine\store::cache_file())
		{
			$load = \dash\file::read($addr);
			$domain_list = json_decode($load, true);
			if(!is_array($domain_list))
			{
				$domain_list = [];
			}
		}
		else
		{
			if(!is_dir(\dash\engine\store::domain_list_addr()))
			{
				\dash\file::makeDir(\dash\engine\store::domain_list_addr(), null, true);
			}

			$domain_list = self::domain_list_once($_store_id);

			if(!is_array($domain_list))
			{
				$domain_list = [];
			}

			$json = json_encode($domain_list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			\dash\file::write($addr, $json);
		}

		return $domain_list;
	}

	private static $domain_list_once = [];
	private static function domain_list_once($_id)
	{
		if(!isset(self::$domain_list_once[$_id]))
		{
			self::$domain_list_once[$_id] = \lib\db\business_domain\get::by_store_id($_id);
		}

		return self::$domain_list_once[$_id];
	}



	public static function reset_list($_store_id)
	{
		if(!$_store_id || !is_numeric($_store_id))
		{
			return false;
		}

		$addr = \dash\engine\store::domain_list_addr();
		$addr .= $_store_id;
		$addr .= \dash\engine\store::$ext;

		$domain_list = [];

		if(is_file($addr))
		{
			\dash\file::delete($addr);
		}
	}

}
?>