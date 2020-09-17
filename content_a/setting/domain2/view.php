<?php
namespace content_a\setting\domain2;

class view
{
	public static function config()
	{
		\dash\face::title(T_('Setting'). ' | '. T_('Domain'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here(). '/website');

				// back
		\dash\data::action_text(T_('Add new domain'));
		\dash\data::action_link(\dash\url::that(). '/add');



		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\business_domain\search::my_business_list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


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