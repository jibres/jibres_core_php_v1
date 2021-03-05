<?php
namespace dash\waf;

class dog
{
	public static function bark()
	{
		// ip
		\dash\waf\dog\ip::inspection();

		// agent
		\dash\waf\dog\agent::inspection();

		// cookie
		\dash\waf\dog\cookie::inspection();

		// headers
		\dash\waf\dog\headers::inspection();

		// get
		\dash\waf\dog\get::inspection();

		// method
		\dash\waf\dog\method::inspection();

		// file
		\dash\waf\dog\file::inspection();

		// phpinput
		\dash\waf\dog\phpinput::inspection();

		// post
		\dash\waf\dog\post::inspection();

		// needless to check request. the request is merge of get,post
	}
}
?>
