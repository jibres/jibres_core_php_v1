<?php
namespace content_a\product\comment;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Comment of product'));
		\dash\data::page_desc(T_('You can manage your comment manually.'));
		\dash\data::page_pictogram('eye-galsses');

		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product comment'));
		}

	}
}
?>