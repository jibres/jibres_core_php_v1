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


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		if(\dash\request::get('status'))
		{
			$args['filter_status'] = \dash\request::get('status');
		}

		if(\dash\request::get('addcdnpanel'))
		{
			$args['filter_addcdnpanel'] = \dash\request::get("addcdnpanel");
		}

		if(\dash\request::get('dns'))
		{
			$args['filter_dns'] = \dash\request::get("dns");
		}

		if(\dash\request::get('https'))
		{
			$args['filter_https'] = \dash\request::get("https");
		}


		$search_string = \dash\request::get('q');

		$list = \lib\app\business_domain\search::list($search_string, $args);

		\dash\data::dataTable($list);

		\dash\data::filterBox(\lib\app\business_domain\search::filter_message());

		$isFiltered = \lib\app\business_domain\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}
	}
}
?>
