<?php
namespace content_a\form\answer\detail;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'answer')
		{
			$answer_id = \dash\request::post('id');
			if($answer_id)
			{
				\lib\app\form\view\remove::record($answer_id);
				\dash\notif::ok(T_("Answer removed"));
				\dash\redirect::to(\dash\url::that(). '?'. \dash\request::fix_get(['aid' => null]));
			}
		}

	}

}
?>
