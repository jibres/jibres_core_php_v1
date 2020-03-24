<?php
namespace content_a\units;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Unit of products'));

		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product unit'));

		}

		if(\dash\data::removeMode())
		{
			$allCompany = \lib\app\product\unit::list(null, ['pagenation' => false]);
			\dash\data::allCompany($allCompany);
		}

		if(\dash\data::removeMode())
		{
			\dash\data::page_title(T_('Remove product unit'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product unit'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>