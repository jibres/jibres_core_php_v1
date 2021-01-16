<?php
namespace lib\app\business_domain;

class business
{

	public static function domain_list($_store_id)
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
			$load = \dash\file::read($addr);
			$load = json_decode($load, true);
			if(is_array($load))
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

			$domain_list = \lib\db\business_domain\get::by_store_id($_store_id);
			if(!is_array($domain_list))
			{
				$domain_list = [];
			}

			$json = json_encode($domain_list, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);

			\dash\file::write($addr, $json);
		}

		return $domain_list;
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