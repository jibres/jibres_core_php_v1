<?php
namespace content_domain\dns;


class view
{
	public static function config()
	{
		\dash\data::page_title(T_("DNS list"));

		\dash\data::page_special(true);


		// btn
		\dash\data::page_btnText(T_('Add dns'));
		\dash\data::page_btnLink(\dash\url::this(). '/add');

		// btn
		\dash\data::page_backText(T_('Back'));
		\dash\data::page_backLink(\dash\url::here());

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

		$list = \lib\app\nic_dns\search::list($search_string, $args);
		\dash\data::dataTable($list);

		\dash\data::filterBox(\lib\app\nic_dns\search::filter_message());

		$isFiltered = \lib\app\nic_dns\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\data::page_title(\dash\data::page_title() . '  '. T_('Filtered'));
		}
	}
}
?>