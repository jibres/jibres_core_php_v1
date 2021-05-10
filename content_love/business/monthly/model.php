<?php
namespace content_love\business\monthly;

class model
{
	public static function post()
	{

		if(\dash\request::post('calc') === 'again')
		{
			$result = \lib\app\store\stats_monthly::calculate();

			if($result)
			{
				\dash\notif::ok(T_("Operation complete"));
				\dash\redirect::pwd();
			}
		}


	}
}
?>