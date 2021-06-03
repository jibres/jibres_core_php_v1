<?php
namespace content_api\torob;


class controller
{

	public static function routing()
	{
		if(!self::route())
		{
			\dash\header::status(404);
			return;
		}

		\dash\open::get();


	}


	private static function route()
	{
		if(!\dash\engine\store::inStore())
		{
			return false;
		}

		if(!\dash\url::child())
		{
			return false;
		}

		if(!\dash\validate::md5(\dash\url::child()))
		{
			return false;
		}

		if(md5(\lib\store::url('raw')) === \dash\url::child())
		{
			// ok
		}
		else
		{
			return false;
		}

		if(!\lib\store::detail('torob_api'))
		{
			return false;
		}

		return true;
	}
}
?>