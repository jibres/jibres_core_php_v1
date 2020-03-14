<?php
namespace content_a\units;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Unit of products'));
		\dash\data::page_desc(T_('You can manage your units manually.'). ' '. T_("Don't worry! we are add units automatically on add new product"));


		\dash\data::action_text(T_('Back to product list'));
		\dash\data::action_link(\dash\url::this());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product unit'));

		}

		if(\dash\data::removeMode())
		{
			$allUnit = \lib\app\product\unit::list(null, ['pagenation' => false]);
			\dash\data::allUnit($allUnit);
		}

		if(\dash\data::removeMode() || \dash\data::editMode())
		{
			\dash\data::action_text(T_('Back to product unit list'));
			\dash\data::action_link(\dash\url::that());
		}


		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());

	}
}
?>