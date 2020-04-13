<?php
namespace content_love\application\edit;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$detail = \lib\app\application\queue::load_by_id($id);
			\dash\data::dataRow($detail);
		}
	}
}
?>