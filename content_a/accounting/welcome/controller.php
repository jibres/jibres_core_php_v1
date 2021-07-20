<?php
namespace content_a\accounting\welcome;


class controller
{
	public static function routing()
	{
		\dash\permission::access('_group_accounting');

		$have_any_coding = \lib\app\tax\coding\get::have_any_coding();
		if(!$have_any_coding)
		{
			\dash\data::firstInit(true);
		}


		// check year
		// check default coding
		// check currency

		if($have_any_coding)
		{
			\dash\redirect::to(\dash\url::this());
		}

	}
}
?>
