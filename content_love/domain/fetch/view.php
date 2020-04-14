<?php
namespace content_love\domain\fetch;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::action_text(T_('Log'));
		\dash\data::action_link(\dash\url::this(). '/log');


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];



		$search_string = \dash\request::get('q');

		$list = \lib\app\domains\search::list_admin($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\domains\search::filter_message());

		$isFiltered = \lib\app\domains\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
