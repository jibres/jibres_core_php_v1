<?php
namespace content_love\gift\create\review;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Review gift detail and publish"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/all');

		\content_love\gift\create\stepGuide::set();

	}
}
?>