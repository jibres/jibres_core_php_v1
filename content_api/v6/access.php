<?php
namespace content_api\v6;


class access
{
	public static function check()
	{
		// not send api to subdomain
		self::check_subdomain();
		// check have appkey
		self::check_appkey();
	}


	public static function check_appkey()
	{
		\content_api\v6::check_appkey();
	}


	public static function check_subdomain()
	{
		if(\dash\url::subdomain())
		{
			\content_api\v6::no(404);
		}
	}


	public static function user()
	{
		\content_api\v6::check_apikey();
	}


	public static function store()
	{
		$store = \dash\header::get('store');
		if(!$store || is_numeric($store))
		{
			\content_api\v6::no(404);
		}

		\lib\store::set_store_slug($store);

		if(!\lib\store::id())
		{
			\content_api\v6::no(404);
		}
	}
}
?>