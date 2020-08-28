<?php
namespace content_a\form\report\answer;


class view
{
	public static function config()
	{
		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}
		\dash\data::formDetail($load);

		\dash\face::title(T_('Report'). ' | '. \dash\data::formDetail_title());


		$iid = \dash\request::get('iid');

		$load_item = \lib\app\form\item\get::get($iid);
		if(!$load_item)
		{
			\dash\header::status(404);
		}


		\dash\data::itemDetail($load_item);

		if(isset($load_item['type_detail']['chart']) && $load_item['type_detail']['chart'])
		{
			// load chart
		}
		else
		{
			\dash\data::noChart(true);
		}

		$reportDetail = \lib\app\form\report::chart($load_item);

		\dash\data::reportDetail($reportDetail);

		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));

	}

}
?>
