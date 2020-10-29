<?php
namespace content_crm\permission\setting;


class model
{
	public static function post()
	{
		$post          = [];
		$post['title'] = \dash\request::post('title');

		$result = \dash\app\permission\edit::edit_title($post, \dash\request::get('id'));

		if(isset($result['id']))
		{
			\dash\redirect::pwd();
		}


	}
}
?>