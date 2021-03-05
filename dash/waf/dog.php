<?php
namespace dash\waf;

class dog
{
	public static function bark()
	{
		// ip
		\dash\waf\gate\ip::inspection();

		// agent
		\dash\waf\gate\agent::inspection();

		// cookie
		\dash\waf\gate\cookie::inspection();

		// headers
		\dash\waf\gate\headers::inspection();

		// get
		\dash\waf\gate\get::inspection();

		// method
		\dash\waf\gate\method::inspection();

		// file
		\dash\waf\gate\file::inspection();

		// phpinput
		\dash\waf\gate\phpinput::inspection();

		// post
		\dash\waf\gate\post::inspection();

		// needless to check request. the request is merge of get,post
	}
}
?>
