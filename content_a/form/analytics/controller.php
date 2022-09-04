<?php
namespace content_a\form\analytics;


class controller
{
	private static $from_detail = [];

	public static function routing()
	{
		self::form_id();
		self::check_count_answer_1000(true);
	}


	public static function check_count_answer_1000($_block = false)
	{
		$form_id = \dash\request::get('id');

		if(!$form_id)
		{
			return false;
		}

		$count_answer = \lib\db\form_answer\get::count_by_form_id($form_id);

		if(\dash\permission::supervisor())
		{
			return  true;
		}

		if(!$count_answer || floatval($count_answer) < 1000)
		{
			if($_block)
			{
				\dash\header::status(403, T_("This feature available when count of your answer count more than 1,000 answer"));
			}
			return false;
		}

		return true;

	}


	public static function form_id()
	{
		if(!self::$from_detail)
		{
			$form_id = \dash\request::get('id');

			$load = \lib\app\form\form\get::get($form_id);
			if(!$load)
			{
				\dash\header::status(404);
			}

			self::$from_detail = $load;
		}

		\dash\data::formDetail(self::$from_detail);
	}



	public static function form_filter_id()
	{

		$form_id = \dash\request::get('id');

		$load = \lib\app\form\form\get::get($form_id);
		if(!$load)
		{
			\dash\header::status(404);
		}

		\dash\data::formDetail($load);

		$filter_id = \dash\request::get('fid');

		if(!$filter_id)
		{
			\dash\redirect::to(\dash\url::that(). '/addfilter?id='. \dash\request::get('id'));
		}

		$load_filter = \lib\app\form\filter\get::get($filter_id);
		if(!$load_filter)
		{
			\dash\header::status(404);
		}

		\dash\data::filterDetail($load_filter);
	}

}
?>
