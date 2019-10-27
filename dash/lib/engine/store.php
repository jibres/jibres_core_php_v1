<?php
namespace dash\engine;


class store
{
	public static function detail()
	{
		// no subdomain
		$subdomain        = \dash\url::subdomain();

		if(!$subdomain)
		{
			return null;
		}

		$subdomain_addr   = root. 'stores/subdomain/'. $subdomain;
		$detail_addr      = root. 'stores/detail/';
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
}
?>