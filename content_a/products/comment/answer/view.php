<?php
namespace content_a\products\comment\answer;

class view
{
	public static function config()
	{
		$id = \dash\request::get('cid');

		$detail = \lib\app\product\comment::get($id);
		if(!$detail)
		{
			\dash\header::status(404, T_("Invalid id"));
		}

		\dash\data::dataRow($detail);

		\dash\face::title(T_("Answer to comment"));

		\dash\data::back_link(\dash\url::this(). '/comment?id='. \dash\request::get('id'));
		\dash\data::back_text(T_('Back'));


		$answer_list = \lib\app\product\comment::answer_list($id);
		\dash\data::answerList($answer_list);

	}
}
?>