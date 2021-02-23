<?php
namespace dash\engine\waf;

class protection
{
	public static function start()
	{
		// block baby to not allow to harm yourself :/
		\dash\engine\waf\baby::block();

		// check ip
		\dash\engine\waf\ip::checkLimit();

		// disallow flood
		\dash\engine\waf\flood::stop();
	}
}
?>
