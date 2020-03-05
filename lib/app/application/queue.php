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


	public static function set_android()
	{
		if(!\lib\store::id())
		{
			\dash\notif::error(T_("Store not found"));
			return false;
		}


		$current_queue = self::detail();

		if(!$current_queue)
		{
			$insert_queue =
			[
				'store_id'     => \lib\store::id(), //` int(10) UNSIGNED NOT NULL,
				'user_id'      => \dash\user::is_init_jibres_user(), //` int(10) UNSIGNED NOT NULL,
				'version'      => 1, //` smallint(5) UNSIGNED NULL DEFAULT NULL,
				'status'       => 'queue', //` enum('','inprogress','done','failed', 'disable', 'expire', 'cancel', 'delete', 'enable') DEFAULT NULL,
				'daterequest'  => date("Y-m-d H:i:s"), //` timestamp NULL DEFAULT NULL,
				'datequeue'    => null, //` timestamp NULL DEFAULT NULL,
				'datedone'     => null, //` timestamp NULL DEFAULT NULL,
				'datedownload' => null, //` timestamp NULL DEFAULT NULL,
				'datemodified' => null, //` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
			];

			\lib\db\store_app\insert::new_record($insert_queue);
		}

	}


	public static function get_build_queue()
	{
		$build_queue = \lib\db\store_app\get::build_queue();
		if(isset($build_queue['store_id']))
		{
			$build_queue['store'] = \dash\coding::encode($build_queue['store_id']);
		}

		return $build_queue;

	}
}
?>