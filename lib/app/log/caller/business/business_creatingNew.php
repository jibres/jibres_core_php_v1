<?php
namespace lib\app\log\caller\business;



class business_creatingNew
{

	public static function site($_args = [])
	{

		$my_name         = isset($_args['data']['my_name']) ? $_args['data']['my_name'] : null;

		$result              = [];

		$result['title']     = T_("Creating New business Alert");

		$result['icon']      = 'shop';
		$result['cat']       = T_("Business");
		$result['iconClass'] = 'fc-green';
		$result['txt']       = self::get_msg($_args);
		return $result;

	}




	public static function get_msg($_args = [])
	{
		// $data =
		// [
		// 	'my_step'           => 'start',
		// 	'my_title'          => $title,
		// 	'my_message'        => T_("Can not add new business!"),
		// 	'my_business_limit' => true,
		// ]
		$msg          = '';

		$my_message      = isset($_args['data']['my_message']) ? $_args['data']['my_message'] : null;

		$my_step      = isset($_args['data']['my_step']) ? $_args['data']['my_step'] : null;

		switch ($my_step)
		{
			case 'start':
				$my_title      = isset($_args['data']['my_title']) ? $_args['data']['my_title'] : null;
				$msg.= T_("User start creating store by title :title", ['title' => $my_title]);

				$my_business_limit      = isset($_args['data']['my_business_limit']) ? $_args['data']['my_business_limit'] : null;
				if($my_business_limit)
				{
					$msg .= ' '. T_("But user can not add because have limit on create stor");

				}
				break;

			case 'ask':
				$my_skip      = isset($_args['data']['my_skip']) ? $_args['data']['my_skip'] : null;
				if($my_skip)
				{
					$msg.= T_("User skip ask step");
				}
				else
				{
					$msg.= ' '. T_("User answer to question in ask step");
				}

				$my_answer      = isset($_args['data']['my_answer']) ? $_args['data']['my_answer'] : null;
				if($my_answer && is_array($my_answer))
				{
					$polls = \lib\app\store\polls::all();

					if(isset($polls['questions']) && is_array($polls['questions']))
					{
						foreach ($my_answer as $key => $value)
						{
							foreach ($polls['questions'] as $k => $v)
							{
								if(isset($v['id']) && $v['id'] === $key)
								{
									if(isset($v['items'][$value]) && isset($v['title']))
									{
										$msg .= "\n";
										$msg .= ' '. $v['title'];
										$msg .= "\n";
										$msg .= ' '. $v['items'][$value];
										$msg .= "\n";

									}
								}
							}
						}

					}
				}

				break;

			case 'subdomain':
				$my_subdomain         = isset($_args['data']['my_subdomain']) ? $_args['data']['my_subdomain'] : null;

				$msg.= T_("User try choose subdomain :subdomain", ['subdomain' => $my_subdomain]);

				$my_invalid_subdomain = isset($_args['data']['my_invalid_subdomain']) ? $_args['data']['my_invalid_subdomain'] : null;

				if($my_invalid_subdomain)
				{
					$msg.= ' '. T_("But we can not support this subdomain!");
				}

				$my_notif = isset($_args['data']['my_notif']) ? $_args['data']['my_notif'] : null;

				if($my_notif && is_array($my_notif) && isset($my_notif['msg']) && is_array($my_notif['msg']))
				{

					foreach ($my_notif['msg'] as $key => $value)
					{
						if(isset($value['text']))
						{
							$msg .= "\n";
							$msg .= ' '. $value['text'];
							$msg .= "\n";
						}
					}
				}

				$my_duplicate = isset($_args['data']['my_duplicate']) ? $_args['data']['my_duplicate'] : null;

				if($my_duplicate)
				{
					$msg.= ' '.T_("But this sbudomain already exists");
				}

				$my_start_creating    = isset($_args['data']['my_start_creating']) ? $_args['data']['my_start_creating'] : null;

				if($my_start_creating)
				{
					$msg.= ' '. T_("And creating business was started ;)");
				}

				break;

			case 'creating':
				$my_error    = isset($_args['data']['my_error']) ? $_args['data']['my_error'] : null;
				if($my_error)
				{
					$msg.= ' '. T_("We can not complete creating store"). ' 😱 ';
				}

				$my_data    = isset($_args['data']['my_data']) ? $_args['data']['my_data'] : null;
				if($my_data)
				{
					$msg .= "\n";
					$msg .= ' '. json_encode($my_data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
					$msg .= "\n";
				}

				break;

			default:
				# code...
				break;
		}

		if($my_message)
		{
			$msg .= "\n";
			$msg .= $my_message;
			$msg .= "\n";
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
		$tg_msg .= "#Business #CreatingNew ";

		$tg_msg .= " 🚀 \n";

		$tg_msg .= T_("Creating New business in progress");

		$tg_msg .= "\n";

		$tg_msg .= self::get_msg($_args);
		$tg_msg .= "\n⏳ ". \dash\datetime::fit(date("Y-m-d H:i:s"), true);

		$tg                 = [];
		$tg['chat_id']      = $_chat_id;
		$tg['text']         = $tg_msg;

		return $tg;

	}
}
?>