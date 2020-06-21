<?php
namespace content_a\company;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Company of products'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::here(). '/setting/product');


		if(\dash\data::editMode())
		{
			\dash\face::title(T_('Edit product company'));

		}

		if(\dash\data::removeMode())
		{
			$allCompany = \lib\app\product\company::list(null, ['pagenation' => false]);
			\dash\data::allCompany($allCompany);
		}

		if(\dash\data::removeMode())
		{
			\dash\face::title(T_('Remove product company'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

		if(\dash\data::editMode())
		{
			\dash\face::title(T_('Edit product company'));
			\dash\data::back_text(T_('Back'));
			\dash\data::back_link(\dash\url::this());
		}

	}
}
?>