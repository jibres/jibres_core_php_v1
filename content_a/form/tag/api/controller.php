<?php
namespace content_a\form\tag\api;


class controller
{
	public static function routing()
	{

		$args = [];

		$args['form_id'] = \dash\request::get('id');

		// show dropdown of product list
		$result = \lib\app\form\tag\search::list(\dash\validate::search_string(), $args);


		if(!is_array($result))
		{
			$result = [];
		}

		$my_result = [];

		foreach ($result as $key => $value)
		{
			$temp =
			[
				'id'   => a($value, 'id'),
				'text' => a($value, 'title'),
			];

			if(!\dash\request::get('getid'))
			{
				$temp['id'] = $temp['text'];
			}

			$my_result[] = $temp;
		}

		\dash\notif::results($my_result);

		\dash\notif::api('Hi :)');
	}
}
?>
