<?php
namespace content_crm\permission\advance;


class model
{
	public static function post()
	{
		$post       = \dash\request::post();

		$myGroup    = \dash\request::get('group');

		if(\dash\request::post('advance') === 'advance')
		{
			$advance        = [];
			$advance_caller = [];

			foreach ($post as $key => $value)
			{
				if(substr($key, 0, 2) === 'c_')
				{
					$advance_caller[substr($key, 2)] = $value;
				}
			}

			$advance[$myGroup] = $advance_caller;

			\dash\app\permission\edit::advance_edit($advance, \dash\request::get('id'));
		}
		else
		{

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

			\dash\redirect::pwd();
		}

	}
}
?>