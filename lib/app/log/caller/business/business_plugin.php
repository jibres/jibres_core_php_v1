<?php
namespace lib\app\log\caller\business;



class business_plugin
{

	public static function site($_args = [])
	{

		$my_name         = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;

		$result              = [];

		if(a($_args, 'data', 'my_plugin_add_by_admin'))
		{
			$result['title']     = T_("New plugin unlocked by admin");
		}
		elseif(a($_args, 'data', 'my_plugin_removed'))
		{
			$result['title']     = T_("Features locked");
		}
		else
		{
			$result['title']     = T_("New plugin unlocked");
		}


		$result['icon']      = 'money-banknote';
		$result['cat']       = T_("Features");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}




	public static function get_msg($_args = [], $_avatar = false)
	{
		$msg                    = '';

		// var_dump($_args);exit;

		$my_plugin_key          = a($_args, 'data', 'my_plugin');
		$my_business_id         = a($_args, 'data', 'my_business_id');
		$my_user_id             = a($_args, 'data', 'my_user_id');
		$my_page_url            = a($_args, 'data', 'my_page_url');
		$my_business_title      = a($_args, 'data', 'my_business_title');
		$my_price               = a($_args, 'data', 'my_price');
		$my_plugin_add_by_admin = a($_args, 'data', 'my_plugin_add_by_admin');
		$my_plugin_removed      = a($_args, 'data', 'my_plugin_removed');
		$my_package_count      = a($_args, 'data', 'my_package_count');



		if($my_plugin_add_by_admin)
		{
			$msg .= "\n#$my_plugin_key #AddedByAdmin\n";
			$msg .= T_("Feature") . ' '. \lib\app\plugin\get::title($my_plugin_key). "\n";
			$msg .= T_("Business") . ' '. $my_business_title. "\n";
			$msg .= " ". T_("Add by admin");
		}
		elseif($my_plugin_removed)
		{
			$msg .= "\n#$my_plugin_key #Removed\n";
			$msg .= T_("Feature") . ' '. \lib\app\plugin\get::title($my_plugin_key). "\n";
			$msg .= T_("Removed by admin from Business") . ' '. $my_business_title. "\n";
		}
		else
		{
			$msg .= "\n#$my_plugin_key\n";
			$msg .= T_("Feature") . ' '. \lib\app\plugin\get::title($my_plugin_key). "\n";
			$msg .= T_("Business") . ' '. $my_business_title. "\n";
			if($my_package_count)
			{
				$msg .= T_("Count") . ' '. \dash\fit::number($my_package_count). "\n";
			}
			$msg .= T_("Price") . ' '. \dash\fit::number($my_price). "\n";

			// $msg .= T_("Page Url") . "\n". $my_page_url. "\n";

		}


		return $msg;
	}


	public static function send_to()
	{
		return ['supervisor'];
	}


	public static function expire()
	{
		// 7 days
		return date("Y-m-d H:i:s", time() + (60*60*24*7));
	}


	public static function save_user_detail()
	{
		return true;
	}


	public static function is_notif()
	{
		return true;
	}


	public static function telegram()
	{
		return true;
	}


	public static function sms()
	{
		return false;
	}



	public static function telegram_text($_args, $_chat_id)
	{
		$tg_msg = '';
		$tg_msg .= "#Business #New ";

		$tg_msg .= " 🎉 \n";

		$tg_msg .= T_("New plugin unlocked");

		$tg_msg .= "\n";

		$tg_msg .= self::get_msg($_args, true);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>