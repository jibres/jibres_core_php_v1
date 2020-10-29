<?php
namespace content_crm\permission\edit;


class model
{
	public static function post()
	{
		$post = \dash\request::post();

		$edit = [];

		foreach ($post as $key => $value)
		{
			if(substr($key, 0, 10) === 'runaction_')
			{
				$myKey = substr($key, 10);
				$edit[$myKey] = \dash\request::post($myKey);
			}
		}

		\dash\app\permission\edit::edit($edit, \dash\request::get('id'));


	}
}
?>