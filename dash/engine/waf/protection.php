<?php
namespace dash\engine\waf;

class protection
{
	public static function start()
	{
		// start dog
		self::dog();

		// block baby to not allow to harm yourself :/
		\dash\engine\waf\baby::block();

		// check ip
		\dash\engine\waf\ip::checkLimit();

		// disallow flood
		\dash\engine\waf\race::escort();
	}


	private static function dog()
	{
		// ip
		\dash\engine\dog\ip::inspection(\dash\server::ip());

		// agent
		\dash\engine\dog\agent::inspection(\dash\agent::agent(false));
	}
}
?>
