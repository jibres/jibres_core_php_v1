<?php
namespace lib\app\import;

class run
{

	public static function crontab()
	{
		// expire old import
		self::expire();
	}


	private static function expire()
	{
		$date           = date("Y-m-d", strtotime("-1 days"));
		$need_to_expire = \lib\db\import\get::last_day_complete($date);

		if($need_to_expire)
		{
			foreach ($need_to_expire as $key => $value)
			{
				if(isset($value['file']))
				{
					\dash\file::delete($value['file']);
				}

				if(isset($value['meta']))
				{
					$meta = json_decode($value['meta'], true);
					if(isset($meta['file_id']) && is_numeric($meta['file_id']))
					{
						\dash\db\files::set_removed($meta['file_id']);
					}
				}
			}
			$need_to_expire_id = array_column($need_to_expire, 'id');
			$need_to_expire_id = array_filter($need_to_expire_id);
			$need_to_expire_id = array_unique($need_to_expire_id);
			if($need_to_expire_id)
			{
				$ids = implode(',', $need_to_expire_id);
				\lib\db\import\update::whole_status_expire($ids);
			}
		}
	}
}
?>