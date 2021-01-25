<?php
namespace dash\app\ticket;

class dashboard
{

	public static function detail()
	{
		$result             = [];
		$result['awaiting'] = \dash\db\tickets\get::count_awaiting();
		$result['tickets']  = \dash\db\tickets\get::count_ticket();
		$result['message']  = \dash\db\tickets\get::count_message();
		$result['close']    = \dash\db\tickets\get::count_close();
		$result['solved']   = \dash\db\tickets\get::count_solved();
		$result['unsolved'] = \dash\db\tickets\get::count_unsolved();


		return $result;
	}
}
?>