<?php
namespace content_a\product\general;


class view
{
	public static function config()
	{
		\dash\permission::access('aProductEdit');

		$myProduct = \lib\app\product::get(['id' => \dash\request::get('id')]);
		\dash\data::product($myProduct);

		\dash\data::listCats(\lib\app\product::cat_list());
		\dash\data::listCompanies(\lib\app\product::company_list());
		\dash\data::listUnits(\lib\app\product::unit_list());

		$productTitle = '';
		if(isset($myProduct['title']))
		{
			$productTitle = $myProduct['title'];
		}

		\dash\data::page_title(T_('General setting | :name', ['name' => $productTitle]));
		\dash\data::page_desc(T_('Manage general setting of product like name, category, price and etc.') .' '. T_('You can change another setting by choose another type of setting.'));


		\dash\data::badge_text(T_('Back to product list'));
		\dash\data::badge_link(\dash\url::this());
	}
}
?>
