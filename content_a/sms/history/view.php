<?php
namespace content_a\sms\history;


class view
{

	public static function config()
	{
		\dash\face::title(T_("sms charge history"));

		// back
		\dash\data::back_text(T_('sms'));
		\dash\data::back_link(\dash\url::this());

		\dash\data::listEngine_start(true);

		$search_string = \dash\validate::search_string();
		$args          =
			[

				'business_id'    => \lib\store::id(),

				'page'        => \dash\request::get('page'),

			];

		$result = \lib\api\jibres\api::sms_charge_list($args);

		$dataTable = a($result, 'result');

		if(!is_array($dataTable))
		{
			$dataTable = [];
		}

		\dash\data::dataTable($dataTable);

		$pagenation = a($result, 'pagination');


		\dash\utility\pagination::initFromAPI($pagenation);


	}

}
