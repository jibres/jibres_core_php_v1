<?php
namespace content_a\category\api;


class controller
{
	public static function routing()
	{
		// show dropdown of product list
		$result = \lib\app\category\search::list(\dash\validate::search_string(), []);


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
