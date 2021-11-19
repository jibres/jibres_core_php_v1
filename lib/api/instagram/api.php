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
			'apiCallback' => self::callback(),
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


	private static function callback()
	{
		return 'https://jibres.ir/hook/ig/';
		return 'https://jibres.com/api/instagram/a/';
		return \dash\url::kingdom().'/hook/ig/';
	}



	/**
	 * Gets the login url.
	 *
	 * @return     <type>  The login url.
	 */
	public static function getLoginUrl()
	{
		if(!self::config())
		{
			return false;
		}

	    $url = self::$instagram->getLoginUrl(['basic', 'user_profile'], 'aaaaaaaaaaabbbbbbbbbbbbbcccccccccccc');
	    return $url;
	}
}
?>