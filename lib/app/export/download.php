<?php
namespace lib\app\export;

class download
{
	public static function export_products($_id)
	{
		return self::by_id($_id, 'products');
	}

	public static function by_id($_id, $_type)
	{
		$_id = \dash\validate::id($_id);
		if(!$_id)
		{
			return null;
		}

		$load = \lib\db\export\get::by_id($_id);

		if(!isset($load['id']) || !isset($load['type']) || !isset($load['file']) || !isset($load['mode']))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if($load['type'] !== $_type)
		{
			\dash\notif::error(T_("Invalid type"));
			return false;
		}

		if($load['status'] !== 'done')
		{
			\dash\notif::error(T_("File not available to download"));
			return false;
		}


		if($load['mode'] !== 'export')
		{
			\dash\notif::error(T_("File not available to download"));
			return false;
		}

		$file = $load['file'];
		if(!is_file($file))
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		\dash\file::download($file);

	}
}
?>