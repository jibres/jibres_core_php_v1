<?php
namespace dash\waf;

class protection
{
	public static function start()
	{
		// dont run on some condition
		blacklist::dont_run_exception();

		// start dog
		\dash\waf\dog::bark();

		// block baby to not allow to harm yourself :/
		\dash\engine\runtime::set('waf', 'babyStart');
		\dash\waf\baby::block();
		\dash\engine\runtime::set('waf', 'babyEnd');

		// check ip
		\dash\waf\ip::monitor();

		// disallow flood
		\dash\waf\race::escort();
	}
}
?>