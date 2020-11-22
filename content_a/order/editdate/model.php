<?php
namespace content_a\order\editdate;


class model
{

	public static function post()
	{
		$date         = [];

		$date[]       = \dash\request::post('date');
		$date[]       = \dash\request::post('time');
		$date         = trim(implode(' ', $date));

		$post         = [];
		$post['date'] = $date;


		\lib\app\factor\edit::edit_factor($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}


	}
}
?>
