<?php
namespace content_a\form\report\compare;


class view
{
	public static function config()
	{
		// back
		\dash\data::back_text(T_('Back'));
		\dash\data::back_link(\dash\url::that(). '?id='. \dash\request::get('id'));

		$load_item1 = [];
		$load_item2 = [];
		$load_item3 = [];




		$id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($id);
		if(!$load)
		{
			\dash\header::status(404);
		}
		\dash\data::formDetail($load);

		\dash\face::title(T_('Report'). ' | '. \dash\data::formDetail_title());

		$items = \lib\app\form\item\get::items_comparable($id);
		\dash\data::formItems($items);


		$q1 = \dash\request::get('q1');

		$load_item1 = \lib\app\form\item\get::get($q1);

		if(!$load_item1)
		{
			\dash\header::status(404);
		}

		if(isset($load_item1['type_detail']['compare']) && $load_item1['type_detail']['compare'])
		{
			// load chart
		}
		else
		{
			\dash\notif::error(T_(":val is not comparable"));
			return false;
		}

		\dash\data::itemDetailQ1($load_item1);

		$q2 = \dash\request::get('q2');

		if($q2)
		{
			$load_item2 = \lib\app\form\item\get::get($q2);
			if(!$load_item2)
			{
				\dash\header::status(404);
			}

			\dash\data::itemDetailQ2($load_item2);
			if(isset($load_item2['type_detail']['compare']) && $load_item2['type_detail']['compare'])
			{
				// load chart
			}
			else
			{
				\dash\notif::error(T_(":val is not comparable"));
				return false;
			}
		}

		$q3 = \dash\request::get('q3');

		if($q3)
		{
			$load_item3 = \lib\app\form\item\get::get($q3);
			if(!$load_item3)
			{
				\dash\header::status(404);
			}

			\dash\data::itemDetailQ3($load_item3);

			if(isset($load_item3['type_detail']['compare']) && $load_item3['type_detail']['compare'])
			{
				// load chart
			}
			else
			{
				\dash\notif::error(T_(":val is not comparable"));
				return false;
			}
		}

		if($load_item1 && $load_item2)
		{
			$reportDetail = \lib\app\form\report::compare($load_item1, $load_item2, $load_item3);

			\dash\data::reportDetail($reportDetail);

		}


	}

}
?>
