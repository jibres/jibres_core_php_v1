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
		if(!$_id || !is_numeric($_id))
		{
			return null;
		}

		$load = \lib\db\export\get::by_id($_id);

		if(!isset($load['id']) || !isset($load['type']) || !isset($load['file']))
		{
			\dash\noitf::error(T_("Invalid id"));
			return false;
		}

		if($load['type'] !== $_type)
		{
			\dash\noitf::error(T_("Invalid type"));
			return false;
		}

		if($load['status'] !== 'done')
		{
			\dash\noitf::error(T_("File not available to download"));
			return false;
		}

		$file = $load['file'];
		if(!is_file($file))
		{
			\dash\noitf::error(T_("File not found"));
			return false;
		}

		\dash\file::download($file);

	}
}
?>