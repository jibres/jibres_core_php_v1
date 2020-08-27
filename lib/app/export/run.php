<?php
namespace lib\app\export;

class run
{

	public static function crontab()
	{
		// expire old export
		self::expire();

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

			case 'form_answer':
				$link = \lib\app\export\form_answer::run($any_request);
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


	private static function expire()
	{
		$date           = date("Y-m-d", strtotime("-1 days"));
		$need_to_expire = \lib\db\export\get::last_day_complete($date);

		if($need_to_expire)
		{
			foreach ($need_to_expire as $key => $value)
			{
				if(isset($value['file']))
				{
					\dash\file::delete($value['file']);
				}
			}
			$need_to_expire_id = array_column($need_to_expire, 'id');
			$need_to_expire_id = array_filter($need_to_expire_id);
			$need_to_expire_id = array_unique($need_to_expire_id);
			if($need_to_expire_id)
			{
				$ids = implode(',', $need_to_expire_id);
				\lib\db\export\update::whole_status_expire($ids);
			}
		}
	}
}
?>