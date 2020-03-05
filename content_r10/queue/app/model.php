<?php
namespace content_r10\queue\app;


class model
{
	public static function post()
	{
		$status = \dash\request::post('status');
		$id     = \dash\request::post('id');
		\lib\app\application\queue::set_status($id, $status);
	}
}
?>