<?php
namespace content_love\application\edit;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		if($id)
		{
			\lib\app\application\queue::update_status_id(\dash\request::post('status'), $id);
			\dash\redirect::pwd();
		}
	}
}
?>