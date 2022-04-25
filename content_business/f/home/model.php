<?php
namespace content_business\f\home;

class model
{
	public static function edit_mode()
	{
		return false;
	}

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

		$meta = [];

		if(static::edit_mode())
		{
			$meta['edit_mode'] = true;
			$meta['answer_id'] = \dash\request::get('aid');
			$answer['form_id'] = \dash\request::get('id');
		}

		\lib\app\form\answer\add::public_new_answer($answer, $meta);

		if(\dash\engine\process::status())
		{
			if(a($post, 'notredirect'))
			{
				// nothing
			}
			else
			{
				\dash\redirect::pwd();
			}
		}
	}
}
?>