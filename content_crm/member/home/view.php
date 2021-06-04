<?php
namespace content_crm\member\home;

class view
{

	public static function config()
	{
		\dash\face::title(T_("Customers List"));

		\dash\data::action_link(\dash\url::this(). '/add');
		\dash\data::action_icon('plus');
		\dash\data::action_text(T_('Add New Customers'));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\user\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\user\filter::sort_list());


		$args =
		[
			'order'      => \dash\request::get('order'),
			'sort'       => \dash\request::get('sort'),
			'status'     => \dash\request::get('status'),
			'permission' => \dash\request::get('permission'),
			'hm'         => \dash\request::get('hm'),
			'ho'         => \dash\request::get('ho'),
			'hc'         => \dash\request::get('hc'),
			'hp'         => \dash\request::get('hp'),
			'show_type'  => 'all',
		];

		if(\dash\url::module() === 'staff')
		{
			$args['show_type'] = 'staff';

		}



		$search_string   = \dash\validate::search_string();
		$userList = \dash\app\user\search::list($search_string, $args);

		\dash\data::dataTable($userList);

		$isFiltered = \dash\app\user\search::is_filtered();
		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>