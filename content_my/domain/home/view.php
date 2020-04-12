<?php
namespace content_my\domain\home;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('NIC Notification'));
		\dash\data::action_link(\dash\url::this(). '/poll');

		\dash\face::btnImport(\dash\url::this().'/import');
		// \dash\face::btnExport(\dash\url::this().'/export');
		\dash\face::help(\dash\url::support().'/domain');

		$id = \dash\request::get('resultid');
		$id = \dash\coding::decode($id);
		if($id)
		{
			$detail = \lib\app\nic_domain\get::by_id($id);
			\dash\data::dataRow($detail);
		}


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

		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

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
