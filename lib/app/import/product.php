<?php
namespace lib\app\import;

class product
{
	private static $result = [];
	private static $error = [];

	public static function cancel_last_file()
	{
		$get_last_awaiting = \lib\db\import\get::get_last_awaiting('product');
		if(isset($get_last_awaiting['id']))
		{
			\lib\db\import\update::set_cancel($get_last_awaiting['id']);
		}

		\dash\notif::ok(T_("Ok"));
		return false;
	}


	public static function import_last_file()
	{
		$get_last_awaiting = \lib\db\import\get::get_last_awaiting('product');
		if(!isset($get_last_awaiting['id']))
		{
			\dash\notif::error(T_("No avalible file founded to import"));
			return false;
		}

		$result = self::pre_check($get_last_awaiting, true);

		if(isset($result['allErrorCount']) && $result['allErrorCount'] && intval($result['allErrorCount']) > 0)
		{
			\dash\notif::error(T_("This file have error and can not be import!"));
			return false;
		}

		$overwrite = [];
		if(isset($result['overwrite']))
		{
			$overwrite = $result['overwrite'];
			if(!is_array($overwrite))
			{
				$overwrite = [];
			}
		}

		$overwrite = array_map('intval', $overwrite);

		// import all products
		\lib\app\product\add::for_import($result['data'], $overwrite);

		\lib\db\import\update::set_done($get_last_awaiting['id']);

		\dash\notif::ok(T_("Import successfully"));
		return true;


	}

	public static function awaiting_import()
	{
		$awaiting_import = \lib\db\import\get::awaiting_import('product');
		if(!isset($awaiting_import['id']))
		{
			return;
		}

		if(isset($awaiting_import['meta']))
		{
			$awaiting_import['meta'] = json_decode($awaiting_import['meta'], true);
		}

		return $awaiting_import;
	}




	public static function pre_check($_detail, $_inline = false)
	{
		$file     = isset($_detail['file']) ? $_detail['file'] : null;
		$id       = isset($_detail['id']) ? $_detail['id'] : null;
		$old_meta = isset($_detail['meta']) ? $_detail['meta'] : null;

		if(!$file)
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		if(!is_file($file))
		{
			\dash\notif::error(T_("File not found"));
			return false;
		}

		if(filesize($file) > (6*1024*1024))
		{
			\dash\notif::error(T_("File size error"));
			return false;
		}

		$load = \dash\utility\import::csv($file, 1001);
		if(!$load || !is_array($load))
		{
			\dash\notif::error(T_("Can not read file"));
			return false;
		}

		if(count($load) > 1000)
		{
			\dash\notif::error(T_("Only 1,000 products are accepted in each file"));
			return false;
		}

		if(is_string($old_meta))
		{
			$old_meta = json_decode($old_meta, true);
		}

		if(!is_array($old_meta))
		{
			$old_meta = [];
		}

		$avalible = [];

		self::$result['allErrorCount'] = 0;

		foreach ($load as $key => $value)
		{
			$index = $key + 1;

			\dash\temp::set('clesnse_not_check_needless_args', true);
			\dash\temp::set('clesnse_not_end_with_error', true);

			$check = \lib\app\product\check::variable($value);

			if(!$check || !\dash\engine\process::status())
			{
				self::save_notif_error($index);
				\dash\notif::clean();
				\dash\engine\process::continue();
				continue;
			}

			// raw id
			if(isset($value['id']) && \dash\number::is($value['id']))
			{
				$value['id'] = $value['id'];
			}

			// id with hidden chracter
			if(isset($value['﻿id']) && \dash\number::is($value['﻿id']))
			{
				$value['id'] = $value['﻿id'];
			}

			$avalible[] = $value;
		}

		\dash\notif::clean();

		self::$result['avalible_count'] = count($avalible);
		self::$result['error']          = array_values(self::$error);


		if(self::$result['allErrorCount'] === 0)
		{
			$ids = array_column($avalible, 'id');
			$ids = array_filter($ids);
			$ids = array_unique($ids);
			if($ids)
			{
				$check_exsist_id = \lib\db\products\get::check_import_id(implode(',', $ids));
				if($check_exsist_id)
				{
					self::$result['overwrite_count'] = count($check_exsist_id);
					self::$result['overwrite'] = $check_exsist_id;
				}
			}
		}

		if($_inline)
		{
			self::$result['data'] = $avalible;
			return self::$result;
		}

		$meta = array_merge($old_meta, self::$result);
		$meta = json_encode($meta, JSON_UNESCAPED_UNICODE);

		\lib\db\import\update::meta_field($meta, $id);

		\dash\notif::ok(T_("Your file saved."));
		return true;

	}


	private static function save_notif_error($_index)
	{
		$notif = \dash\notif::get();

		if(is_array($notif) && array_key_exists('ok', $notif) && $notif['ok'] == false)
		{
			if(isset($notif['msg']) && is_array($notif['msg']))
			{
				foreach ($notif['msg'] as $key => $value)
				{
					if(isset($value['text']) && isset($value['type']) && $value['type'] == 'error')
					{
						$myKey = md5($value['text']);
						self::error($myKey, $value['text'], $_index);
					}
				}
			}
		}
	}


	private static function error($_key, $_msg, $_index)
	{

		self::$result['allErrorCount']++;

		if(isset(self::$error[$_key]))
		{
			self::$error[$_key]['count']++;
			self::$error[$_key]['index'][] = $_index;
		}
		else
		{
			self::$error[$_key] = ['count' => 1, 'msg' => $_msg, 'index' => [$_index]];
		}
	}
}
?>