<?php
namespace content_crm\sms\datalist;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Send sms history"));

		\dash\data::back_link(\dash\url::this());
		\dash\data::back_text(T_('SMS'));

		\dash\data::back_link(\dash\url::here());
		\dash\data::back_text(T_('CRM'));


		\dash\data::listEngine_start(true);
		\dash\data::listEngine_search(\dash\url::that());
		\dash\data::listEngine_filter(\lib\app\sms\filter::list());
		\dash\data::listEngine_sort(true);
		\dash\data::sortList(\lib\app\sms\filter::sort_list());


		$args =
		[
			'order' => \dash\request::get('order'),
            'sort' => \dash\request::get('sort'),
            'status' => \dash\request::get('status'),
            'mobile' => \dash\request::get('mobile'),
            'notsend' => \dash\request::get('notsend'),

		];

		$search_string = \dash\validate::search_string();

		$list = \lib\app\sms\search::list($search_string, $args);

		\dash\data::dataTable($list);

		if($list && \dash\request::get('status') === 'moneylow')
		{
            \dash\data::listEngine_before(__DIR__ . '/display-before.php');
		}

		$isFiltered = \lib\app\sms\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

	}
}
