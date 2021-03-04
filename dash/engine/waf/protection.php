<?php
namespace dash\engine\waf;

class protection
{
	public static function start()
	{
		// dont run on some condition
		blacklist::dont_run_exception();

		// start dog
		self::dog();

		// block baby to not allow to harm yourself :/
		\dash\engine\waf\baby::block();

		// check ip
		\dash\engine\waf\ip::monitor();

		// disallow flood
		\dash\engine\waf\race::escort();
	}


	private static function dog()
	{
		// ip
		\dash\engine\dog\ip::inspection();

		// agent
		\dash\engine\dog\agent::inspection();

		// cookie
		\dash\engine\dog\cookie::inspection();

		// headers
		\dash\engine\dog\headers::inspection();

		// get
		\dash\engine\dog\get::inspection();

		// method
		\dash\engine\dog\method::inspection();

		// file
		\dash\engine\dog\file::inspection();

		// need to check
		//
		// post field
		// url
		// request
		// phpinput
		// cookie
		// referer
	}
}
?>
