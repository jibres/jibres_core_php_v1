<?php
namespace dash\waf;

class protection
{
	public static function start()
	{
		// dont run on some condition
		blacklist::dont_run_exception();

		// start dog
		self::dog();

		// block baby to not allow to harm yourself :/
		\dash\waf\baby::block();

		// check ip
		\dash\waf\ip::monitor();

		// disallow flood
		\dash\waf\race::escort();
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

		// phpinput
		\dash\engine\dog\phpinput::inspection();

		// post
		\dash\engine\dog\post::inspection();

		// needless to check request. the request is merge of get,post
	}
}
?>
