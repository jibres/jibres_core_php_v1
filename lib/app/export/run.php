<?php
namespace lib\app\export;

class run
{

	public static function crontab()
	{

		// check have running
		// if have any record as runing skip other export
		$any_running = \lib\db\export\get::any_running();
		if($any_running)
		{
			return;
		}


		// check have request
		// if have not any request return
		$any_request = \lib\db\export\get::any_request();
		if(!$any_request)
		{
			return;
		}

		$id   = isset($any_request['id']) ? $any_request['id'] : null;
		$type = isset($any_request['type']) ? $any_request['type'] : null;

		if(!$id)
		{
			return;
		}

		// enable before push
		\lib\db\export\update::set_running($id);
		$link = null;

		switch ($type)
		{
			case 'products':
				$link = \lib\app\export\product::run($any_request);
				break;

			default:
				// nothing
				break;
		}

		if(!$link)
		{
			\lib\db\export\update::set_failed($id);
		}
		else
		{
			\lib\db\export\update::set_done($id, $link);
		}
	}
}
?>