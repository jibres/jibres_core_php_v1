<?php
namespace content\free;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Why is Jibres free?'));
		\dash\face::desc(T_('The #1 question that users almost always ask us is: "Why is Jibres free? The answer is probably not what you think.'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());

		\dash\face::cover(\dash\url::cdn(). '/img/cover/Jibres-cover-free-1.jpg');

	}
}
?>