<?php
namespace content_love\telegram\sending;


class view
{
	public static function config()
	{
		\dash\face::title(T_("Sms sending list"));

		// btn
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::this());


		$args =
		[
			'order'  => \dash\request::get('order'),
			'sort'   => \dash\request::get('sort'),

		];

		$search_string = \dash\validate::search_string();

		$list = \dash\app\telegram\search::telegram_sending_list($search_string, $args);

		\dash\data::dataTable($list);

		$sortLink = \dash\app\sort::make_sortLink(['name', 'dateexpire', 'dateregister', 'dateupdate'], \dash\url::this());
		\dash\data::sortLink($sortLink);



		$isFiltered = \dash\app\telegram\search::is_filtered();

		\dash\data::isFiltered($isFiltered);

		if($isFiltered)
		{
			\dash\face::title(\dash\face::title() . '  '. T_('Filtered'));
		}

		if(\dash\request::get('manual') === 'run')
		{
			$result = \dash\app\telegram\queue::send_real_time(true);
			\dash\code::jsonBoom($result);
		}

	}
}
?>