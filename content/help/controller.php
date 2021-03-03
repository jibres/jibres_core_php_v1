<?php
namespace content\help;


class controller
{
	public static function routing()
	{
		$new_url = 'https://help.jibres.';

		if(\dash\url::tld() === 'local')
		{
			$new_url .= 'local';
		}
		elseif(\dash\url::tld() === 'com')
		{
			$new_url .= 'com';
		}
		else
		{
			$new_url .= 'ir';
		}

		\dash\redirect::to($new_url);
	}
}
?>