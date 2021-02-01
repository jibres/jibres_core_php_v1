<?php
namespace content_business\f\home;

class model
{
	public static function post()
	{
		$post  = \dash\request::post();
		$files = \dash\request::files();

		$answer              = [];
		$answer['form_id']   = \dash\data::formId();
		$answer['startdate'] = \dash\request::post('startdate');
		$answer['user_id']   = \lib\store::in_store() ? \dash\user::id() : null;
		$answer['answer'] = [];
		foreach ($post as $key => $value)
		{
			if(preg_match("/^a_(\d+)$/", $key, $split))
			{
				$answer['answer'][$split[1]] = $value;
			}
		}
		foreach ($files as $key => $value)
		{
			if(preg_match("/^a_(\d+)$/", $key, $split))
			{
				$answer['answer'][$split[1]] = 1; // get the file in other place
			}
		}

		\lib\app\form\answer\add::public_new_answer($answer);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>