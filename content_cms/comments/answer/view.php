<?php
namespace content_cms\comments\answer;

class view
{
	public static function config()
	{

		\dash\face::title(T_("Answer to comment"));

		\dash\data::back_link(\dash\url::this(). '/comment?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));


		$answer_list = \lib\app\product\comment::answer_list($id);
		\dash\data::answerList($answer_list);

	}
}
?>