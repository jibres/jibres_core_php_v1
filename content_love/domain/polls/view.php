<?php
namespace content_love\domain\polls;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domain polls"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];


		$search_string = \dash\validate::search_string();

		$list = \lib\app\nic_poll\search::list($search_string, $args);

		\dash\data::dataTable($list);


		\dash\data::filterBox(\lib\app\nic_poll\search::filter_message());

		$isFiltered = \lib\app\nic_poll\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);


	}
}
?>
