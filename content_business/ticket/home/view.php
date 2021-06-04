<?php
namespace content_business\ticket\home;

class view
{


	public static function config()
	{

		\dash\face::title(T_("Tickets"));
		\dash\face::desc(T_("See list of your tickets!"));



		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		\dash\data::action_text(T_('New Ticket'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\dash\app\ticket\filter::list('website'));
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\dash\app\ticket\filter::sort_list('website'));


		$args =
		[
			'order'         => \dash\request::get('order'),
			'sort'          => \dash\request::get('sort'),
			'status'        => \dash\request::get('status'),
			'customer_mode' => true,
		];

		$search_string = \dash\validate::search_string();

		$list = \dash\app\ticket\search::list($search_string, $args, true);

		\dash\data::dataTable($list);

		$isFiltered = \dash\app\ticket\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}



	}


}
?>