<?php
namespace content_a\setting\domain;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Domain'));

		// back
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this());



		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\business_domain\search::my_business_list($search_string, $args);


		if($list)
		{
			\dash\face::btnSetting(\dash\url::that(). '/setting');
					// back
			\dash\data::action_text(T_('Add new domain'));
			\dash\data::action_link(\dash\url::that(). '/add');
		}
		else
		{
			$myDomainList = \lib\app\business_domain\get::my_domain_not_connected_list();
			\dash\data::myDomainList($myDomainList);
		}

		\dash\data::dataTable($list);

		\dash\data::filterBox(\lib\app\business_domain\search::filter_message());

		$isFiltered = \lib\app\business_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}





	}
}
?>