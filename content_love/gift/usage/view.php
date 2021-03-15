<?php
namespace content_love\gift\usage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card usage"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\gift\usage\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['dateexpire', 'datecreated'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		$isFiltered = \lib\app\gift\usage\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
