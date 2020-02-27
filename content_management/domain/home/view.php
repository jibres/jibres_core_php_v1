<?php
namespace content_management\domain\home;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('Log'));
		\dash\data::action_link(\dash\url::this(). '/log');


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'dns'  => \dash\request::get('dns'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_domain\search::list_admin($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_domain\search::filter_message());

		$isFiltered = \lib\app\nic_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}

		// user search anything and no result founded
		if($search_string && !$list)
		{
			if(\lib\app\nic_domain\check::syntax($search_string))
			{
				\dash\data::myDomain($search_string);
				$check = \lib\app\nic_domain\check::check($search_string);
				\dash\data::checkResult($check);
			}
		}
	}
}
?>
