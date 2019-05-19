<?php
namespace content_a\product\comment;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Company of products'));
		\dash\data::page_desc(T_('You can manage your comment manually.'). ' '. T_("Don't worry! we are add comment automatically on add new product"));
		\dash\data::page_pictogram('eye-galsses');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product comment'));

		}

		if(\dash\data::removeMode())
		{
			$allCompany = \lib\app\product\comment::list();
			\dash\data::allCompany($allCompany);
		}

		if(\dash\data::removeMode() || \dash\data::editMode())
		{
			\dash\data::badge_text(T_('Back to product comment list'));
			\dash\data::badge_link(\dash\url::that());
		}

	}
}
?>