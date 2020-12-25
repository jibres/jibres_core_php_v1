<?php
namespace content_cms\comments\view;

class view
{
	public static function config()
	{

		$cid = \dash\request::get('cid');

		\dash\face::title(T_("Edit comment"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('Comments'));

		$answer_count = \dash\app\comment\get::answer_count($cid);
		\dash\data::answerCount($answer_count);

	}
}
?>