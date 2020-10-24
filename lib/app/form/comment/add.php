<?php
namespace lib\app\form\comment;


class add
{
	public static function add($_args)
	{
		$condition =
		[
			'comment'   => 'desc',
			'privacy'   => ['enum' => ['public', 'private']],
			'form_id'   => 'id',
			'answer_id' => 'id',
			'file'      => 'bit',
		];

		$require = ['comment', 'form_id', 'answer_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$form_id = $data['form_id'];

		$answer_id = $data['answer_id'];

		$load_form = \lib\app\form\form\get::get($form_id);
		if(!$load_form)
		{
			return false;
		}

		$load_answer = \lib\app\form\answer\get::by_id($answer_id);
		if(!$load_answer)
		{
			return false;
		}


		$insert =
		[
			'form_id'     => $form_id,
			'answer_id'   => $answer_id,
			'privacy'     => $data['privacy'],
			'content'     => $data['comment'],
			'user_id'     => \dash\user::id(),
			'file'        => null,
			'view'        => null,
			'datecreated' => date("Y-m-d H:i:s"),
		];

		\lib\db\form_comment\insert::new_record($insert);

		\dash\notif::ok(T_("Your comment was saved"));

		return true;

	}
}
?>