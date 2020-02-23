<?php
namespace content_my\domain\irnic;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("IRNIC handle list"));

		// btn
		\dash\data::action_text(T_('Add New IRNIC Handle'));
		\dash\data::action_link(\dash\url::that(). '/add');

		// btn
		\dash\data::back_text(T_('Domains'));
		\dash\data::back_link(\dash\url::this());

		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),
			// 'admin'  => \dash\request::get('admin'),
			// 'holder' => \dash\request::get('holder'),
			// 'tech'   => \dash\request::get('tech'),
			// 'bill'   => \dash\request::get('bill'),
		];

		$search_string = \dash\request::get('q');

		$list = \lib\app\nic_contact\search::list($search_string, $args);
		\dash\data::dataTable($list);

		\dash\data::filterBox(\lib\app\nic_contact\search::filter_message());

		$isFiltered = \lib\app\nic_contact\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}

	}
}
?>