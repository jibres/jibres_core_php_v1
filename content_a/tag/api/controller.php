<?php
namespace content_a\tag\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		$result = \lib\app\tag\search::list(\dash\request::get('q'), []);


		if(!is_array($result))
		{
			$result = [];
		}

		$my_result = [];

		foreach ($result as $key => $value)
		{
			$my_result[] =
			[
				'id'    => a($value, 'id'),
				'text' => a($value, 'title'),
			];
		}

		\dash\notif::results($my_result);

		\dash\notif::api('Hi :)');
	}
}
?>
