<?php
namespace content_a\setting\logo;


class model
{
	public static function post()
	{
		if(\dash\request::post('skip') === 'skip')
		{
			// skip this step
		}
		else
		{
			$result = \lib\app\setting\setup::upload_logo();
			if($result)
			{
				\dash\notif::ok(T_("Your setting was saved"));
				\lib\store::refresh();
				\dash\notif::direct();
			}
			else
			{
				return false;
			}
		}


		\dash\redirect::pwd();
	}

}
?>
