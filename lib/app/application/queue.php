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

		$store_app_detail = self::check_detail_from_file();

		if(!$store_app_detail)
		{
			$store_app_detail = self::check_detail_from_setting();

			if(!$store_app_detail)
			{
				$store_app_detail = \lib\db\store_app\get::jibres_my_app_detail(\lib\store::id());

				if(!$store_app_detail)
				{
					// create empty array from store queue to not send query to jibres again
					// catch this detail in setting record and file
					$store_app_detail =
					[
						'store_id'      => null,
						'user_id'       => null,
						'version'       => null,
						'build'         => null,
						'status'        => null,
						'daterequest'   => null,
						'datequeue'     => null,
						'datedone'      => null,
						'datedownload'  => null,
						'datemodified'  => null,
						'versiontitle'  => null,
						'versionnumber' => null,
						'packagename'   => null,
						'keystore'      => null,
						'file'          => null,
						'meta'          => null,
					];
				}

				self::check_detail_from_setting($store_app_detail);
				self::check_detail_from_file($store_app_detail);
			}
			else
			{
				self::check_detail_from_file($store_app_detail);
			}
		}

		return $store_app_detail;
	}


	public static function rebuild($_force = false)
	{
		if(\lib\app\application\detail::need_to_rebuild() || $_force)
		{
			$current_queue = self::detail();
			if(isset($current_queue['id']))
			{
				\lib\db\store_app\update::set_field($current_queue['id'], 'status', 'disable');
				self::new_queue();
				\dash\notif::ok(T_("Your application build request saved in queue."));
			}
		}
		else
		{
			\dash\notif::error(T_("No change in your application detail and needless to rebuild it!"));
			return false;
		}


	}


	public static function load_by_id($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \lib\db\store_app\get::by_id($id);
		return $load;
	}

	public static function update_status_id($_status, $_id)
	{
		$detail = self::load_by_id($_id);
		if(!$detail)
		{
			\dash\notif::error(T_("Invalid record detail"));
			return false;
		}

		$_status = \dash\validate::enum($_status, true, ['enum' => ['queue','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable']]);
		if($_status)
		{
			\lib\db\store_app\update::record(['status' => $_status], $_id);
			\dash\notif::ok(T_("Record was updated"));
			return true;
		}
	}



	private static function check_detail_from_setting($_new_detail = null)
	{
		if($_new_detail === null)
		{
			$app_queue_detail = \lib\db\setting\get::platform_cat_key('android', 'application', 'queue_detail');

			if(isset($app_queue_detail['value']) && is_string($app_queue_detail['value']))
			{
				$app_queue_detail = json_decode($app_queue_detail['value'], true);

				if(!is_array($app_queue_detail))
				{
					return false;
				}

				return $app_queue_detail;
			}
			else
			{
				return false;
			}
		}
		else
		{
			// save detail to setting record
			$value = json_encode($_new_detail, JSON_UNESCAPED_UNICODE);
			\lib\db\setting\update::overwirte_platform_cat_key($value, 'android', 'application', 'queue_detail');
		}
	}


	private static function check_detail_from_file($_new_detail = null)
	{
		$app_queue_detail_folder = YARD . 'jibres_temp/app/';
		$app_queue_detail_addr = $app_queue_detail_folder . \lib\store::id();

		if($_new_detail === null)
		{
			if(is_file($app_queue_detail_addr))
			{
				$app_queue_detail = json_decode(\dash\file::read($app_queue_detail_addr), true);
				if(!is_array($app_queue_detail))
				{
					return false;
				}

				return $app_queue_detail;
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(!file_exists($app_queue_detail_folder))
			{
				\dash\file::makeDir($app_queue_detail_folder, null, true);
			}

			$value = json_encode($_new_detail, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
			\dash\file::write($app_queue_detail_addr, $value);
		}
	}


	private static function new_queue()
	{
		$build = \lib\db\store_app\get::count_record_store(\lib\store::id());
		$build = intval($build) + 1;

		$insert_queue =
		[
			'store_id'      => \lib\store::id(),
			'user_id'       => \dash\user::jibres_user('id') ? \dash\user::jibres_user('id') : \dash\user::id(),
			'version'       => \lib\app\application\version::get_last_version(),
			'status'        => 'queue',
			'build'         => $build,
			'daterequest'   => date("Y-m-d H:i:s"),
			'datequeue'     => null,
			'datedone'      => null,
			'datedownload'  => null,
			'datemodified'  => null,

			'versiontitle'  => '4.0.1',
			'versionnumber' => 40,
			'packagename'   => 'com.jibres.'. \dash\store_coding::encode_raw(),
			'keystore'      => 'jibres',
		];

		\lib\db\store_app\insert::new_record($insert_queue);

		\lib\db\setting\update::overwirte_platform_cat_key(null, 'android', 'application', 'queue_detail');

		$app_queue_detail_addr = YARD . 'jibres_temp/app/'. \lib\store::id();
		\dash\file::delete($app_queue_detail_addr);

		\lib\app\application\detail::need_to_rebuild(false);


	}



	/**
	 * Adds a new queue.
	 * All application queue in jibres database
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function add_new_queue()
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}

		// check required detail is ok or no
		// for example logo, title and intro theme must be set
		$check_ok = \lib\app\application\detail::is_ready_to_create();
		if(isset($check_ok['ok']) && $check_ok['ok'])
		{
			// no problem, all is well
		}
		else
		{
			\dash\notif::error(T_("Your application need some detail to ready to build"));
			return false;
		}

		// load current queue
		$current_queue = self::detail();

		// no curren queue. need to create one
		if(!$current_queue || !isset($current_queue['status']) || !isset($current_queue['id']))
		{
			self::new_queue();
		}
		else
		{
			// we have an old queue
			// check curren queue status
			switch ($current_queue['status'])
			{
				case 'queue':
				case 'inprogress':
					\dash\notif::info(T_("Your request to create store app is saved and on queue in our app factory."));
					return true;
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

		\dash\notif::ok(T_("Your build request has been queued"));
		return true;
	}



	/**
	 * Gets the build queue.
	 * @call this function from api
	 * Jibres call have any application queue?
	 *
	 * @param      boolean  $_detail  The detail
	 *
	 * @return     array    The build queue.
	 */
	public static function get_build_queue($_detail = false)
	{
		$build_queue = \lib\db\store_app\get::build_queue();

		$result          = [];
		$result['store'] = null;
		$result['build'] = null;

		if(isset($build_queue['build']))
		{
			$result['build'] = $build_queue['build'];
		}

		if(isset($build_queue['store_id']))
		{
			$build_queue['store'] = \dash\store_coding::encode($build_queue['store_id']);
			$result['store']      = $build_queue['store'];
		}

		$remove_store_catch_detail = false;

		if(isset($build_queue['id']) && $build_queue && is_array($build_queue) && array_key_exists('datequeue', $build_queue) && !$build_queue['datequeue'])
		{
			$remove_store_catch_detail = true;
			\lib\db\store_app\update::set_field($build_queue['id'], 'datequeue', date("Y-m-d H:i:s"));
		}

		if(isset($build_queue['status']) && $build_queue['status'] === 'queue')
		{
			$remove_store_catch_detail = true;
			\lib\db\store_app\update::set_field($build_queue['id'], 'status', 'inprogress');
		}

		if($remove_store_catch_detail)
		{
			self::remove_store_catch_detail(array_merge($build_queue, ['status' => 'inprogress']));
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



	private static function remove_store_catch_detail($_result)
	{
		if(isset($_result['store_id']) && is_numeric($_result['store_id']))
		{
			$load_store = \lib\db\store\get::by_id($_result['store_id']);
			if(isset($load_store['fuel']))
			{
				$my_store_fuel = $load_store['fuel'];
			}
			else
			{
				return false;
			}

			$my_store_db          = \dash\engine\store::make_database_name($_result['store_id']);

			\lib\db\setting\update::overwirte_platform_cat_key_fuel(json_encode($_result, JSON_UNESCAPED_UNICODE), 'android', 'application', 'queue_detail', $my_store_fuel, $my_store_db);

			$app_queue_detail_addr = YARD . 'jibres_temp/app/'. $_result['store_id'];
			\dash\file::delete($app_queue_detail_addr);
		}

	}

	/**
	 * Sets the status.
	 * Jibres Android server response call this function from api
	 * @param      <type>   $_store     The store
	 * @param      <type>   $_status    The status
	 * @param      <type>   $_filename  The filename
	 * @param      <type>   $_meta      The meta
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function set_status($_store, $_status, $_filename, $_path, $_meta)
	{
		// save log in file
		\dash\log::file(json_encode(func_get_args()), 'transfer_file_apk', 'application');

		if($_status && !is_string($_status))
		{
			\dash\notif::error(T_("Please set the status"));
			return false;
		}

		if($_path  && !is_string($_path))
		{
			\dash\notif::error(T_("Please set the path"));
			return false;
		}

		if($_filename && !is_string($_filename))
		{
			\dash\notif::error(T_("Please set the status"));
			return false;
		}

		if($_status && !in_array($_status, ['queue','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable']))
		{
			\dash\notif::error(T_("Please set the status"));
			return false;
		}


		if(!$_store || !is_string($_store))
		{
			\dash\notif::error(T_("Please set the store code"));
			return false;
		}

		$result = self::get_build_queue(true);

		if(isset($result['store']) && $result['store'] === $_store)
		{
			// do nothing
			// continue code
		}
		else
		{
			\dash\log::set('AndroidAPPQueue:errorLastBusinessId', ['args' => func_get_args()]);
			\dash\notif::error(T_("This id is not current application id"));
			return false;
		}

		$meta = null;

		if(is_array($_meta) || is_object($_meta))
		{
			$meta = json_encode($_meta, JSON_UNESCAPED_UNICODE);
		}
		elseif(is_string($_meta))
		{
			$meta = \dash\validate::string($_meta);
		}
		else
		{
			$meta = null;
		}

		$update =
		[
			'file'     => basename($_path),
			'path'     => $_path,
			'status'   => $_status,
			'datedone' => date("Y-m-d H:i:s"),
			'meta'     => $meta,
		];

		\lib\db\store_app\update::record($update, $result['id']);

		$save_in_store_detail = array_merge($result, $update);

		self::remove_store_catch_detail($save_in_store_detail);

		// download file in store app folder
		$transfer_file = self::transfer_file($_store, $_path);
		if($transfer_file)
		{
			$log =
			[
				'to'         => $result['user_id'],
				'data_build' => $result['build'],
			];

			\dash\log::set('application_readyToDownload', $log);
		}


		\dash\notif::ok(T_("Queue status updated"));
		return true;

	}


	/**
	 * Copy maked apk file from talambar server to store file location
	 *
	 * @param      <type>   $_filename  The filename
	 * @param      string   $_store     The store
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	private static function transfer_file($_store, $_path)
	{
		$source = 'http://app.talambar.ir/'. $_path;

		$store = str_replace('$', '', $_store);

		$store_addr = YARD . 'talambar_cloud/'. $store . '/app/';
		\dash\file::makeDir($store_addr, null, true);
		$dest = $store_addr . basename($_path);

		\dash\log::file(json_encode([$source, $dest]), 'transfer_file_apk', 'application');

		if(@copy($source, $dest))
		{
			// copy application successfully
			return true;
		}
		else
		{
			// copy not complete
			// file not exist
			// notif to admin to check this application
			\dash\notif::error(T_("Can not copy application file from talambar server!"));
			\dash\log::file(json_encode([$source, $dest, 'copy not complete']), 'transfer_file_apk', 'application');
			return false;
		}
	}
}
?>