<?php
namespace content_a\form\find\print;


class model
{
	public static function post()
	{
		if(\dash\request::post('print') === 'print')
		{
			$answer_id = \dash\request::get('aid');
			$form_id = \dash\request::get('id');

			view::fillIDS();

			$printed = \dash\data::ids();
			$tag_id = $printed->printed;

			$load_tag = \lib\app\form\tag\get::get($tag_id);

			\lib\app\form\tag\add::public_answer_tag_plus(a($load_tag, 'title'), $answer_id, $form_id);

			\dash\notif::ok(T_('Saved'));

			\dash\redirect::to(\dash\url::current(). \dash\request::full_get(['print' => 'auto']));
		}


	}
}
?>