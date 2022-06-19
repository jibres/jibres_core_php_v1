<?php
namespace content_a\form\answer\note;


class controller
{
	public static function routing()
	{

		$form_id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($form_id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::formDetail($load);

		$answer_id = \dash\request::get('aid');
		$note_id   = \dash\request::get('noteid');


		$load_comment = \lib\app\form\comment\get::check_trust_comment($form_id, $answer_id, $note_id);

		if(!$load_comment)
		{
			\dash\header::status(404, T_("Comment not found"));
		}

		\dash\data::dataRow($load_comment);

	}

}
?>
