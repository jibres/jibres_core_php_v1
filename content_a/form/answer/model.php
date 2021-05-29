<?php
namespace content_a\form\answer;


class model
{
	public static function post()
	{
		if(\dash\request::post('mark') === 'all')
		{
			\lib\app\form\answer\edit::makr_all_as_review(\dash\request::get('id'));
			\dash\redirect::pwd();
		}

		if(\dash\request::post('remove') === 'answer')
		{
			$answer_id = \dash\request::post('id');
			if($answer_id)
			{
				\lib\app\form\answer\remove::remove($answer_id);
				\dash\notif::ok(T_("Answer removed"));
				\dash\redirect::pwd();
			}
		}

	}

}
?>
