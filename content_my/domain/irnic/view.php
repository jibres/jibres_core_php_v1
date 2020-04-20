<?php
namespace content_my\domain\irnic;


class view
{
	public static function config()
	{
		\dash\face::title(T_("IRNIC handle list"));

		// btn
		\dash\data::action_text(T_('Add New IRNIC Handle'));
		\dash\data::action_link(\dash\url::that(). '/add');

		// btn
		\dash\data::back_text(T_('Setting'));
		\dash\data::back_link(\dash\url::this(). '/option');

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

		if(\lib\nic\mode::api())
		{
			$get_api    = new \lib\nic\api();
			$list       = $get_api->contact_fetch();
			$filterBox  = $get_api->meta('filter_message');
			$isFiltered = $get_api->meta('is_filtered');
		}
		else
		{

			$list          = \lib\app\nic_contact\search::list($search_string, $args);
			$filterBox     = \lib\app\nic_contact\search::filter_message();
			$isFiltered    = \lib\app\nic_contact\search::is_filtered();

		}

		\dash\data::filterBox($filterBox);

		\dash\data::dataTable($list);

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}


	}
}
?>