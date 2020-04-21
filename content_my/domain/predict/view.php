<?php
namespace content_my\domain\predict;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Predict Late Payments"));

		// btn
		\dash\data::back_text(T_('Dashboard'));
		\dash\data::back_link(\dash\url::this());


		$args =
		[
			'order'   => \dash\request::get('order'),
			'sort'    => \dash\request::get('sort'),
			'predict' => true,
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

		$get_setting = \lib\db\nic_usersetting\get::my_setting(\dash\user::id());

		if(isset($get_setting['autorenewperiod']))
		{
			$autorenewperiod = $get_setting['autorenewperiod'];
		}
		else
		{
			$autorenewperiod = \lib\app\nic_usersetting\defaultval::autorenewperiod();
		}
		\dash\data::autorenewperiod($autorenewperiod);

		if(isset($get_setting['domainlifetime']))
		{
			$domainlifetime = $get_setting['domainlifetime'];
		}
		else
		{
			$domainlifetime = \lib\app\nic_usersetting\defaultval::domainlifetime();
		}

		$life_time   = \lib\app\nic_usersetting\defaultval::get_time($domainlifetime);

	}
}
?>
