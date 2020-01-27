<?php
namespace lib\app\export;

class add
{

	public static function request($_type, $_meta = null)
	{
		if(is_array($_meta))
		{
			$_meta = json_encode($_meta, JSON_UNESCAPED_UNICODE);
		}

		$check_duplicate = \lib\db\export\get::check_duplicate($_type);
		if($check_duplicate)
		{
			\dash\notif::error(T_("Your request was saved before. please wait to export process is complete"));
			return false;
		}

		$insert =
		[
			'type'        => $_type,
			'meta'        => $_meta,
			'status'      => 'request',
			'datecreated' => date("Y-m-d H:i:s"),
		];

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