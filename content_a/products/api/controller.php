<?php
namespace content_a\products\api;


class controller
{
	public static function routing()
	{
		$result = '[{"id": 1,"text": "Option 1" }, {"id": 2,"text": "Option 2" }]';

		\dash\notif::add_index('results', json_decode($result, true));
		\dash\code::end();
		\dash\permission::access('ProductAdd');
	}
}
?>
