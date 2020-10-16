<?php
namespace content_love\business\question;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Store analytics"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$chartDetail = \lib\app\store\analytics::answer_question();
		\dash\data::chartDetail($chartDetail);

	}
}
?>
