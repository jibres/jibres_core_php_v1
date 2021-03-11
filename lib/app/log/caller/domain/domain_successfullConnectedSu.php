<?php
namespace lib\app\log\caller\domain;



class domain_successfullConnectedSu extends \lib\app\log\caller\domain\domain_successfullConnected
{
	public static function site($_args = [])
	{
		$result              = [];
		$result['title']     = T_("Customer domain connected to business");
		$result['icon']      = 'flag';
		$result['cat']       = T_("Domain");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;
	}



	public static function send_to()
	{
		return ['supervisor'];
	}
}
?>