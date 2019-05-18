<?php
namespace content_a\product\guarantee;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Guarantee of products'));
		\dash\data::page_desc(T_('You can manage your guarantee manually.'). ' '. T_("Don't worry! we are add guarantee automatically on add new product"));
		\dash\data::page_pictogram('eye-galsses');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product guarantee'));

		}

		if(\dash\data::removeMode())
		{
			$allGuarantee = \lib\app\product\guarantee::list();
			\dash\data::allGuarantee($allGuarantee);
		}

		if(\dash\data::removeMode() || \dash\data::editMode())
		{
			\dash\data::badge_text(T_('Back to product guarantee list'));
			\dash\data::badge_link(\dash\url::that());
		}

	}
}
?>