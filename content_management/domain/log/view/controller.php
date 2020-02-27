<?php
namespace content_management\domain\log\view;


class controller
{
	public static function routing()
	{
		$id = \dash\request::get('id');
		if($id)
		{
			$detail = \lib\app\nic_log\get::by_id($id);
			\dash\data::dataRow($detail);
		}
	}
}
?>