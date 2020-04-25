<?php
namespace content_love\gift\usage;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Gift card usage"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this(). '/view?id='. \dash\request::get('gift_id'));

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\giftusage\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['dateexpire', 'datecreated'], \dash\url::this());
		\dash\data::sortLink($sortLink);


		\dash\data::filterBox(\lib\app\giftusage\search::filter_message());

		$isFiltered = \lib\app\giftusage\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
