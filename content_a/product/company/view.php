<?php
namespace content_a\product\company;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Company of products'));
		\dash\data::page_desc(T_('You can manage your company manually.'). ' '. T_("Don't worry! we are add company automatically on add new product"));
		\dash\data::page_pictogram('eye-galsses');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product company'));

		}

		if(\dash\data::removeMode())
		{
			$allCompany = \lib\app\product\company::list(null, ['pagenation' => false]);
			\dash\data::allCompany($allCompany);
		}

		if(\dash\data::removeMode() || \dash\data::editMode())
		{
			\dash\data::badge_text(T_('Back to product company list'));
			\dash\data::badge_link(\dash\url::that());
		}

	}
}
?>