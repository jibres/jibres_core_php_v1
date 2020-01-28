<?php
namespace lib\app\import;

class product
{
	private static $result = [];
	private static $error = [];

	public static function pre_check($_detail)
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

			\dash\app::variable($value);

			$check = \lib\app\product\check::variable($value);

			if(!$check || !\dash\engine\process::status())
			{
				self::save_notif_error($index);
				\dash\notif::clean();
				\dash\engine\process::continue();
				continue;
			}

			$avalible[] = $index;
		}

		\dash\notif::clean();

		self::$result['avalible']       = $avalible;
		self::$result['avalible_count'] = count($avalible);
		self::$result['error']          = array_values(self::$error);

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