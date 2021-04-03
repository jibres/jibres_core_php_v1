<?php
namespace lib\app\store;


class reserve
{

	public static function get($_subdomain, $_creator, $_fuel)
	{
		\dash\db::transaction();

		$store_id = \lib\db\store\get::reserved_business();

		if(!$store_id || !is_numeric($store_id))
		{
			\dash\db::commit();
			return false;
		}


		$update_stire                = [];
		$update_stire['subdomain']   = $_subdomain;
		$update_stire['fuel']        = $_fuel;
		$update_stire['creator']     = $_creator;
		$update_stire['status']      = 'creating';
		$update_stire['ip']          = \dash\server::iplong();
		$update_stire['ip_id']       = \dash\utility\ip::id();
		$update_stire['agent_id']    = \dash\agent::get(true);
		$update_stire['datecreated'] = date("Y-m-d H:i:s");

		\lib\db\store\update::record($update_stire, $store_id);

		\dash\db::commit();

		return $store_id;
	}

}
?>