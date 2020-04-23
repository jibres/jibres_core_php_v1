<?php
namespace content_my\domain\search;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());

		self::makeSort();

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');

		$urlGetList = \dash\request::get('list');

		switch ($urlGetList)
		{
			case 'renew':
				\dash\data::action_text(T_('Renew Domain'));
				\dash\data::action_link(\dash\url::this(). '/renew');
				break;
			case 'import':
				\dash\face::btnImport(null);
				\dash\data::action_text(T_('Import domain'));
				\dash\data::action_link(\dash\url::this(). '/import');
				break;

			default:
				\dash\data::action_text(T_('Register Domain'));
				\dash\data::action_link(\dash\url::this(). '/buy');
				break;
		}

		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'list'    => \dash\request::get('list'),
			'lock'      => \dash\request::get('lock'),
			'autorenew' => \dash\request::get('autorenew'),
			// 'status' => \dash\request::get('status'),

		];

		$search_string = \dash\request::get('q');

		if(\lib\nic\mode::api())
		{
			$args['q'] = $search_string;

			$get_api    = new \lib\nic\api();
			$list       = $get_api->domain_fetch($args);
			$filterBox  = $get_api->meta('filter_message');
			$isFiltered = $get_api->meta('is_filtered');
		}
		else
		{

			$list          = \lib\app\nic_domain\search::list($search_string, $args);
			$filterBox     = \lib\app\nic_domain\search::filter_message();
			$isFiltered    = \lib\app\nic_domain\search::is_filtered();

		}

		$count_group_by_status = \lib\app\nic_domain\dashboard::count_group_by_status();
		\dash\data::groupByStatus($count_group_by_status);

		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

		\dash\data::isFiltered($isFiltered);


		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::that());
		\dash\data::sortLink($sortLink);

	}


	private static function makeSort()
	{
		$sort =
		[
			[
				'sort'  => 'name',
				'order' => 'asc',
				'title' => T_("Domain Name ASC"),
			],
			[
				'sort'  => 'name',
				'order' => 'desc',
				'title' => T_("Domain Name DESC"),
			],

			[
				'sort'  => 'dateexpire',
				'order' => 'asc',
				'title' => T_("Expredate ASC"),
			],
			[
				'sort'  => 'dateexpire',
				'order' => 'desc',
				'title' => T_("Expredate DESC"),
			],

			[
				'sort'  => 'dateregister',
				'order' => 'asc',
				'title' => T_("Date register ASC"),
			],
			[
				'sort'  => 'dateregister',
				'order' => 'desc',
				'title' => T_("Date register DESC"),
			],

			[
				'sort'  => 'dateupdate',
				'order' => 'asc',
				'title' => T_("Date update ASC"),
			],
			[
				'sort'  => 'dateupdate',
				'order' => 'desc',
				'title' => T_("Date update DESC"),
			],

		];

		$all_get = \dash\request::get();
		unset($all_get['sort']);
		unset($all_get['order']);

		foreach ($sort as $key => $value)
		{
			$my_get = array_merge($all_get, ['order' => $value['order'], 'sort' => $value['sort']]);

			$sort[$key]['link'] = http_build_query($my_get);
		}

		\dash\data::mySort($sort);

	}
}
?>
