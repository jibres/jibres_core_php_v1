<?php
namespace content_love\domain\log;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Domains Log"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			'type'  => \dash\request::get('type'),
			'result_code'  => \dash\request::get('result_code'),
			'user_id'  => \dash\request::get('user'),
			'ip'  => \dash\request::get('ip'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\nic_log\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::that());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\nic_log\search::filter_message());

		$isFiltered = \lib\app\nic_log\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


		// $group_by = \lib\app\nic_log\get::group_by_type();
		// if(!is_array($group_by))
		{
			$group_by =
			[
				['count' =>  5806,      'type' =>  'contact_check' ,],
				['count' =>  72,      'type' =>  'contact_info' ,],
				['count' =>  26,      'type' =>  'contact_create' ,],
				['count' =>  2153,      'type' =>  'contact_credit' ,],
				['count' =>  49682,      'type' =>  'domain_check' ,],
				['count' =>  21,      'type' =>  'domain_lock' ,],
				['count' =>  24,      'type' =>  'domain_unlock' ,],
				['count' =>  4669,      'type' =>  'domain_info' ,],
				['count' =>  1130,      'type' =>  'domain_create' ,],
				['count' =>  293,      'type' =>  'domain_update' ,],
				['count' =>  361,      'type' =>  'domain_renew' ,],
				['count' =>  20,      'type' =>  'domain_transfer' ,],
				['count' =>  148478,      'type' =>  'poll_request' ,],
				['count' =>  1225,      'type' =>  'poll_acknowledge' ,],
			];
		}
		\dash\data::groupByType($group_by);

		// $group_by_code = \lib\app\nic_log\get::group_by_code();
		// if(!is_array($group_by_code))
		{
			$group_by_code =
			[
				['count' => 51094,      'result_code' => '0'],
				['count' => 61190,      'result_code' =>  '1000',],
				['count' => 334,      'result_code' =>  '1001',],
				['count' => 97926,      'result_code' =>  '1300',],
				['count' => 1241,      'result_code' =>  '1301',],
				['count' => 208,      'result_code' =>  '2005',],
				['count' => 59,      'result_code' =>  '2100',],
				['count' => 1518,      'result_code' =>  '2102',],
				['count' => 1,      'result_code' =>  '2104',],
				['count' => 4,      'result_code' =>  '2105',],
				['count' => 34,      'result_code' =>  '2200',],
				['count' => 34,      'result_code' =>  '2201',],
				['count' => 2,      'result_code' =>  '2302',],
				['count' => 219,      'result_code' =>  '2303',],
				['count' => 18,      'result_code' =>  '2304',],
				['count' => 29,      'result_code' =>  '2306',],
				['count' => 49,      'result_code' =>  '2308',],
			];
		}
		\dash\data::groupByCode($group_by_code);
	}
}
?>
