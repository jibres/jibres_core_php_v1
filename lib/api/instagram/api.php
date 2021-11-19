<?php
namespace lib\api\instagram;

class api
{
	private static $instagram = null;


	private static function config()
	{
		$args =
		[
			'apiKey'      => '1098204907431178',
			'apiSecret'   => 'ceb1b49b17b0e75683fbb0ec9ff999b4',
			'apiCallback' => 'https://jibres.ir/hook/ig/',
		];

		try
		{
			$instagram = new \lib\api\instagram\Instagram($args);
		}
		catch (\Exception $e)
		{
			\dash\notif::error($e->getMessage());
			return false;
		}

		self::$instagram = $instagram;

		return true;

	}



	/**
	 * Gets the login url.
	 *
	 * @return     <type>  The login url.
	 */
	public static function getLoginUrl($_token = null)
	{
		if(!self::config())
		{
			return false;
		}

	    $url = self::$instagram->getLoginUrl(['basic', 'user_profile', 'user_media'], $_token);

	    return $url;
	}


	public static function getOAuthToken($_code = null)
	{
		if(!self::config())
		{
			return false;
		}

	    $result = self::$instagram->getOAuthToken($_code);

	    return $result;
	}


	public static function getUserMedia($_access_token, $_user_id)
	{
		if(!self::config())
		{
			return false;
		}

		self::$instagram->setAccessToken($_access_token);

	    $result = self::$instagram->getUserMedia($_user_id);

	    return $result;
	}







}
?>