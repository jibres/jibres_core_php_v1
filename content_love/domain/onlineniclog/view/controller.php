<?php
namespace content_love\domain\onlineniclog\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$detail = \lib\app\onlinenic\log\get::by_id($id);

			\dash\data::dataRow($detail);
		}
	}
}
?>