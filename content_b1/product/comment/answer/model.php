<?php
namespace content_b1\product\comment\answer;


class model
{
	public static function post()
	{
		$id = \dash\request::get('id');

		$answer = \content_b1\tools::input_body('answer');

		if(!$answer)
		{
			\dash\notif::error(T_("Please fill the answer box"));
			return false;
		}

		$result = \lib\app\product\comment::answer($answer, $id);


		\content_b1\tools::say($result);

	}


}
?>