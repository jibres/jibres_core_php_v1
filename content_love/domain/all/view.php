<?php
namespace content_love\domain\all;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\domains\filter::list('admin_mode'));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\domains\filter::sort_list());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'user'   => \dash\request::get('user'),
			'expireat'   => \dash\request::get('expireat'),
		];

		\dash\temp::set('disableDomainFetch', true);

		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_domain\search::list_admin($search_string, $args);

		\dash\data::dataTable($list);


		$isFiltered = \lib\app\nic_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
