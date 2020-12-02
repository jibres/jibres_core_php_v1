<?php
namespace content_crm\member\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Customers List"));


		$args =
		[
			'order'     => \dash\request::get('order'),
			'sort'      => \dash\request::get('sort'),
			'status'    => \dash\request::get('status'),
			'show_type' => 'all',
		];



		$search_string   = \dash\validate::search(\dash\request::get('q'));
		$userList = \dash\app\user\search::list($search_string, $args);

		\dash\data::dataTable($userList);

		$isFiltered = \dash\app\user\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		\dash\data::action_link(\dash\url::this(). '/add');
		\dash\data::action_icon('plus');
		\dash\data::action_text(T_('Add New Customers'));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));

		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(false);
		\dash\data::listEngine_sort(false);



	}



}
?>