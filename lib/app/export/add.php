<?php
namespace lib\app\export;

class add
{

	public static function request($_type, $_meta = null)
	{
		$insert =
		[
			'type'        => $_type,
			'mode'        => 'export',
			'creator'     => \dash\user::id(),
			'status'      => 'request',
			'datecreated' => date("Y-m-d H:i:s"),
		];

		$where =
		[
			'type' => $_type,
		];

		if(isset($_meta['related_id']))
		{
			$insert['related_id'] = $_meta['related_id'];
			$where['related_id'] = $_meta['related_id'];

			unset($_meta['related_id']);
		}

		if(isset($_meta['related']))
		{
			$insert['related'] = $_meta['related'];
			$where['related'] = $_meta['related'];
			unset($_meta['related']);
		}

		$check_duplicate = \lib\db\export\get::check_duplicate_where($where);
		if($check_duplicate)
		{
			if(isset($check_duplicate['datecreated']) && $check_duplicate['datecreated'] && (time() - strtotime($check_duplicate['datecreated'])) > (60*60*24))
			{
				// no problem to add new exprot request if old request for yesterday
			}
			else
			{
				\dash\notif::error(T_("Your request was saved before. please wait to export process is complete"));
				return false;
			}
		}

		$check_day_limit = \lib\db\export\get::check_day_limit($_type, date("Y-m-d"));

		if(intval($check_day_limit) >= 5)
		{
			\dash\notif::error(T_("Your can make 5 export in every day"));
			return false;
		}



		if(is_array($_meta) && $_meta)
		{
			$_meta          = json_encode($_meta, JSON_UNESCAPED_UNICODE);
			$insert['meta'] = $_meta;
		}

		$export_id = \lib\db\export\insert::new_record($insert);
		if($export_id)
		{
			\dash\notif::ok(T_("Your request was saved"));
			return true;
		}
		else
		{
			\dash\notif::ok(T_("Can not save your export request"));
			return false;
		}
	}
}
?>