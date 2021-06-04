<?php
namespace content_my\domain\predict;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Predict Late Payments"));

		// btn
		\dash\data::back_text(T_('Domain Center'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\domains\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\domains\filter::sort_list());

		$args =
		[
			'order'         => \dash\request::get('order'),
			'sort'          => \dash\request::get('sort'),
			'predict_until' => \dash\request::get('until'),
			'predict'       => true,
			'list'      => \dash\request::get('list'),
			'lock'      => \dash\request::get('lock'),
			'reg'       => \dash\request::get('reg'),
			'autorenew' => \dash\request::get('autorenew'),
		];

		$search_string = \dash\validate::search_string();

		$list          = \lib\app\nic_domain\search::list($search_string, $args);
		$filterBox     = \lib\app\nic_domain\search::filter_message();
		$isFiltered    = \lib\app\nic_domain\search::is_filtered();

		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

		\dash\data::isFiltered($isFiltered);


		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

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


	}
}
?>
