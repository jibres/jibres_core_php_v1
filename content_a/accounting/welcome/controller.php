<?php
namespace content_a\accounting\welcome;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');

		self::check_need_welcome_message(true);

	}


	public static function check_need_welcome_message($_in_welcome_module = false)
	{
		$check_need_welcome_message = false;

		$have_any_coding = \lib\app\tax\coding\get::have_any_coding();
		if(!$have_any_coding)
		{
			\dash\data::addFirstCoding(true);
			$check_need_welcome_message = true;
		}

		// check year
		$yearList = \lib\app\tax\year\search::list(null, ['pagination' => 'n', 'limit' => 1]);
		if(!$yearList)
		{
			\dash\data::addFirstYear(true);
			$check_need_welcome_message = true;
		}

		// check default coding
		// check currency

		if($_in_welcome_module)
		{
			if($have_any_coding && $yearList)
			{
				\dash\redirect::to(\dash\url::this());
			}
		}

		return $check_need_welcome_message;
	}
}
?>
