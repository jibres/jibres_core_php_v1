<?php
namespace content_a\product\warehouse;


class view
{
	public static function config()
	{
		\dash\permission::access('aProductEdit');

		$myProduct = \lib\app\product::get(\dash\request::get('id'));
		\dash\data::product($myProduct);

		\dash\data::listCats(\lib\app\product\cat::list());
		\dash\data::listCompanies(\lib\app\product::company_list());
		\dash\data::listUnits(\lib\app\product\unit::list());

		$productTitle = '';
		if(isset($myProduct['title']))
		{
			$productTitle = $myProduct['title'];
		}

		\dash\data::page_title(T_('General setting | :name', ['name' => $productTitle]));
		\dash\data::page_desc(T_('Manage warehouse setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.'));


		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
