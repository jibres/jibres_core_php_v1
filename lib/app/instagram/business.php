<?php
namespace lib\app\instagram;

class business
{

	/**
	 * Call jibres api to get login url
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function login_url()
	{
		$url = \lib\api\jibres\api::get_instagram_login_url();

		var_dump($url);exit;
		if(!$url || !isset($url['result']['login_url']))
		{
			return false;
		}

		return $url['result']['login_url'];
	}
}
?>