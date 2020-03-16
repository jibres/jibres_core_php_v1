<?php
namespace content_a\company;

class view
{
	public static function config()
	{
		\dash\data::page_title(T_('Company of products'));
		\dash\data::page_desc(T_('You can manage your company manually.'). ' '. T_("Don't worry! we are add company automatically on add new product"));



		// back
		\dash\data::back_text(T_('Products'));
		\dash\data::back_link(\lib\backlink::products());


		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product company'));

		}

		if(\dash\data::removeMode())
		{
			$allCompany = \lib\app\product\company::list(null, ['pagenation' => false]);
			\dash\data::allCompany($allCompany);
		}

		if(\dash\data::removeMode())
		{
			\dash\data::page_title(T_('Remove product company'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

		if(\dash\data::editMode())
		{
			\dash\data::page_title(T_('Edit product company'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>