<?php
namespace content_a\cart\home;


class view
{
	public static function config()
	{
		// check expire cart
		\lib\app\cart\remove::expired();


		\dash\face::title(T_('Cart'));

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::here());

		// action
		\dash\data::action_text(T_('Add new cart'));
		\dash\data::action_icon('plus');
		\dash\data::action_link(\dash\url::this(). '/add');

		$args =
		[
			'order' => \dash\request::get('order'),
			'sort'  => \dash\request::get('sort'),
			'hu'    => \dash\request::get('hu'),
		];

		$q = \dash\request::get('q');

		$dataTable = \lib\app\cart\search::list($q, $args);



		$filterBox     = \lib\app\cart\search::filter_message();
		$isFiltered    = \lib\app\cart\search::is_filtered();

		\dash\data::filterBox($filterBox);
		\dash\data::isFiltered($isFiltered);


		\dash\data::dataTable($dataTable);

		\dash\data::myData(\lib\app\cart\dashboard::admin());

		self::makeSort();

	}


	private static function makeSort()
	{
		$sort =
		[
			[
				'sort'  => 'item',
				'order' => 'asc',
				'title' => T_("Items ASC"),
			],
			[
				'sort'  => 'item',
				'order' => 'desc',
				'title' => T_("Items DESC"),
			],

			[
				'sort'  => 'count',
				'order' => 'asc',
				'title' => T_("Count produts ASC"),
			],
			[
				'sort'  => 'count',
				'order' => 'desc',
				'title' => T_("Count produts DESC"),
			],

			[
				'sort'  => 'date',
				'order' => 'asc',
				'title' => T_("Date ASC"),
			],
			[
				'sort'  => 'date',
				'order' => 'desc',
				'title' => T_("Date DESC"),
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
