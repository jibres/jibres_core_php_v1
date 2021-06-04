<?php
namespace content_love\business\domain\alllist;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Business domains"));


		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that());


		\dash\data::action_text(T_('Add New domain'));
		\dash\data::action_link(\dash\url::that(). '/add');



		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::current());
		\dash\data::listEngine_filter(\lib\app\business_domain\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\business_domain\filter::sort_list());

		$args =
		[
			'order'              => \dash\request::get('order'),
			'sort'               => \dash\request::get('sort'),


			'ws'                 => \dash\request::get('ws'),
			'md'                 => \dash\request::get('md'),
			'rtmd'               => \dash\request::get('rtmd'),
			'hdid'               => \dash\request::get('hdid'),
			'cb'                 => \dash\request::get('cb'),
			'checkdns'           => \dash\request::get('checkdns'),
			'dnsok'              => \dash\request::get('dnsok'),
			'cdnpanale'          => \dash\request::get('cdnpanale'),
			'httpsrequest'       => \dash\request::get('httpsrequest'),
			'httpsverify'        => \dash\request::get('httpsverify'),
			'cdn'                => \dash\request::get('cdn'),
			'status'             => \dash\request::get('status'),

		];

		$search_string = \dash\validate::search_string();
		$list          = \lib\app\business_domain\search::list($search_string, $args);

		\dash\data::dataTable($list);

		$isFiltered = \lib\app\business_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}
	}
}
?>
