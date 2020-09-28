<?php
namespace content_love\business\domain\action;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Action list"));

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::that());



		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];


		$search_string = \dash\request::get('q');

		$list = \lib\app\business_domain\action::list($search_string, $args);

		\dash\data::dataTable($list);

		\dash\data::filterBox(\lib\app\business_domain\action::filter_message());

		$isFiltered = \lib\app\business_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
?>
