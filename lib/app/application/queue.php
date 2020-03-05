<?php
namespace lib\app\application;


class queue
{

	public static function detail()
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}


		$store_app_detail = \lib\db\store_app\get::jibres_my_app_detail(\lib\store::id());

		return $store_app_detail;

	}

	public static function rebuild()
	{
		$current_queue = self::detail();
		if(isset($current_queue['id']))
		{
			\lib\db\store_app\update::set_field($current_queue['id'], 'status', 'queue');
		}


	}

	public static function set_android()
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}


		$current_queue = self::detail();

		if(!$current_queue || !isset($current_queue['status']) || !isset($current_queue['id']))
		{
			self::new_queue();
		}
		else
		{
			switch ($current_queue['status'])
			{
				case 'queue':
				case 'inprogress':
					// do nothing
					break;

				case 'done':
				case 'enable':
					if(isset($current_queue['version']) && $current_queue['version'])
					{
						if(intval(\lib\app\application\version::get_last_version()) > intval($current_queue['version']))
						{
							\lib\db\store_app\update::set_field($current_queue['id'], 'status', 'expire');
							self::new_queue();
						}
						else
						{
							// do nothing
						}
					}
					else
					{
						\lib\db\store_app\update::set_field($current_queue['id'], 'status', 'expire');
						self::new_queue();
					}
					break;

				case 'failed':
				case 'disable':
				case 'expire':
				case 'cancel':
				case 'delete':
					self::new_queue();
					break;

				default:
					// do nothing
					break;
			}
		}
	}


	private static function new_queue()
	{
		$insert_queue =
		[
			'store_id'     => \lib\store::id(),
			'user_id'      => \dash\user::id(),
			'version'      => \lib\app\application\version::get_last_version(),
			'status'       => 'queue',
			'daterequest'  => date("Y-m-d H:i:s"),
			'datequeue'    => null,
			'datedone'     => null,
			'datedownload' => null,
			'datemodified' => null,
		];

		\lib\db\store_app\insert::new_record($insert_queue);
	}


	public static function get_build_queue($_detail = false)
	{
		$build_queue = \lib\db\store_app\get::build_queue();

		$result          = [];
		$result['store'] = null;

		if(isset($build_queue['id']))
		{
			$result['build'] = $build_queue['id'];
		}
		else
		{
			$result['build'] = rand(1, 9999);
		}

		if(isset($build_queue['store_id']))
		{
			$build_queue['store'] = \dash\coding::encode($build_queue['store_id']);
			$result['store']      = $build_queue['store'];
		}

		if(isset($build_queue['id']) && $build_queue && is_array($build_queue) && array_key_exists('datequeue', $build_queue) && !$build_queue['datequeue'])
		{
			\lib\db\store_app\update::set_field($build_queue['id'], 'datequeue', date("Y-m-d H:i:s"));
		}

		if($_detail)
		{
			return $build_queue;
		}
		else
		{
			return $result;
		}
	}


	public static function set_status($_store, $_status, $_filename)
	{
		\dash\log::file(json_encode(func_get_args()), 'transfer_file_apk', 'application');

		if(!in_array($_status, ['queue','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable']))
		{
			\dash\notif::error(T_("Please set the status"));
			return false;
		}


		if(!$_store)
		{
			\dash\notif::error(T_("Please set the store code"));
			return false;
		}

		$result = self::get_build_queue(true);

		if(isset($result['store']) && $result['store'] === $_store)
		{
			$update =
			[
				'file'     => $_filename,
				'status'   => $_status,
				'datedone' => date("Y-m-d H:i:s"),
			];
			\lib\db\store_app\update::record($update, $result['id']);


			if($_filename)
			{
				// download file in store app folder
				self::transfer_file($_filename, $_store);
			}

			\dash\notif::ok(T_("Queue status updated"));
			return true;
		}
		else
		{
			\dash\notif::error(T_("This id is not current application id"));
			return false;
		}
	}


	private static function transfer_file($_filename, $_store)
	{
		$host = 'http://app.jibres.com/';
		$source = $host. $_filename;
		$source = trim($source, '/');


		$store_addr = YARD . 'talambar_cloud/'. $_store . '/app/';
		\dash\file::makeDir($store_addr, null, true);
		$dest = $store_addr . basename($_filename);

		\dash\log::file(json_encode([$source, $dest]), 'transfer_file_apk', 'application');

		copy($source, $dest);
	}
}
?>