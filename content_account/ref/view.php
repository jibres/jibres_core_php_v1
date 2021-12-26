<?php
namespace content_account\ref;

class view
{
	public static function config()
	{
		// Referral Program
		// Nobody can tell the Jibres story better than our customers.
		$result = self::get_ref();
		if(is_array($result))
		{
			foreach ($result as $key => $value)
			{
				\dash\data::set($key, $value);
			}
		}
	}

	public static function get_ref()
	{
		if(!\dash\user::login())
		{
			return null;
		}

		$meta =
		[
			'get_count' => true,
			'data'  => \dash\user::id(),
		];
		$result = [];

		return $result;
	}
}
?>