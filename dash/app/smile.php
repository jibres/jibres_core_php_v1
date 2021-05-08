<?php
namespace dash\app;


class smile
{

	public static function get()
	{
		\dash\temp::set('force_stop_visitor', true);
		\dash\temp::set('force_stop_query_log', true);

		$post               = [];
		$post['notifOn']    = \dash\request::post('notifOn'); // false
		// $post['smileLive']  = \dash\request::post('smileLive'); // get smile data inside of page if exist
		$post['store_code'] = \dash\request::post('url-env'); // jb2jr
		$post['url-in']     = \dash\request::post('url-in'); // a
		$post['url-page']   = \dash\request::post('url-page'); // home


		$myResult = [];

		if(\dash\user::id())
		{
			$notifCount = \dash\app\log::my_notif_count();
			$orderCount = 0;

			if($post['store_code'])
			{
				$orderCount = self::detect_order($post['store_code']);
			}

			if(\dash\request::post('smileLive'))
			{
				$smileLive = \dash\request::post('smileLive');
				if(is_string($smileLive))
				{
					$smileLive = urldecode($smileLive);
					$smileLive = json_decode($smileLive, true);
				}
				else
				{
					$smileLive = [];
				}

				if(!is_array($smileLive))
				{
					$smileLive = [];
				}

				if(isset($smileLive['module']))
				{
					switch ($smileLive['module'])
					{
						case 'ticket':
							self::live_ticket($smileLive, $post);
							break;

						default:
							# code...
							break;
					}
				}
			}

			$myResult =
			[
				'notifNew'   => $notifCount ? true : false,
				'notifCount' => $notifCount,
				'orderCount' => $orderCount,
			];

			if($myResult['notifCount'])
			{
				// self::play_sound('notif_sound_new_notification', $notifCount, 'new-notification-2.mp3');
			}

		}
		else
		{
			// user not login
		}

		return $myResult;
	}


	private static function detect_order($_store_code)
	{
		$detail = \dash\engine\store::detect_store_by_code($_store_code);
		if(!a($detail, 'db_name') || !a($detail, 'fuel'))
		{
			return false;
		}

		$count_order = \lib\db\factors\get::count_new_order_fuel(a($detail, 'fuel'), a($detail, 'db_name'));

		if(!is_numeric($count_order))
		{
			$count_order = 0;
		}

		if($count_order)
		{
			$alertyOpt =
			[
				'alerty'            => true,
				'timeout'           => 2000,
				'showConfirmButton' => false,
				'priority'          => false,
			];

				// show alert as toast
			$alertyOpt['toast']    = true;
			$alertyOpt['position'] = 'top-end';


			self::play_sound('notif_sound_new_order', $count_order, 'new-notification-2.mp3');

			\dash\notif::ok(T_("You have :val new order!", ['val' => \dash\fit::number($count_order)]), $alertyOpt);
		}

		return floatval($count_order);
	}


	private static function play_sound($_key, $_count, $_sound)
	{

		$play_sound = true;

		$session_sound = \dash\session::get($_key);

		if(isset($session_sound['count']) && isset($session_sound['time']))
		{
			if(floatval($session_sound['count']) === floatval($_count) && time() - floatval($session_sound['time']) < (60*1))
			{
				$play_sound = false;
			}
		}


		if(!$_count)
		{
			$play_sound = false;
		}

		if($play_sound)
		{

			$session_sound = ['count' => $_count, 'time' => time()];

			\dash\session::set($_key, $session_sound);

			// not play sound in local
			if(\dash\url::isLocal())
			{
				return;
			}

			\dash\notif::sound($_sound);
		}
	}


	private static function live_ticket($_smile, $_args)
	{
		if(!isset($_smile['id']))
		{
			return;
		}

		if(!isset($_smile['lastid']))
		{
			return;
		}

		if(!isset($_smile['urlcurrent']))
		{
			return;
		}

		$ticket_id = $_smile['id'];
		$ticket_id = \dash\validate::id($ticket_id, false);
		if(!$ticket_id)
		{
			return;
		}

		$lastid = $_smile['lastid'];
		$lastid = \dash\validate::id($lastid, false);
		if(!$lastid)
		{
			return;
		}

		$db_name = null;
		$fuel    = null;

		if(isset($_args['store_code']) && $_args['store_code'] && $_args['store_code'] !== 'Jibres')
		{
			$detail = \dash\engine\store::detect_store_by_code($_args['store_code']);
			if(!a($detail, 'db_name') || !a($detail, 'fuel'))
			{
				return false;
			}
			else
			{
				$db_name    = $detail['db_name'];
				$fuel       = $detail['fuel'];
			}
		}

		if(!\dash\permission::check('crmTicketManager'))
		{
			if(!\dash\user::id())
			{
				return false;
			}
			$is_my_ticket = \dash\db\tickets\get::is_my_ticket($ticket_id, \dash\user::id(), $fuel, $db_name);

			if(!$is_my_ticket)
			{
				return false;
			}
		}


		$get_last_ticket_message_id = \dash\db\tickets\get::last_ticket_message_id($ticket_id, $fuel, $db_name);

		if(isset($get_last_ticket_message_id['id']))
		{
			if(floatval($get_last_ticket_message_id['id']) === floatval($lastid))
			{
				// nothing
			}
			else
			{
				$get =
				[
					'id'      => $ticket_id,
					'lastid'  => $lastid,
					'gethtml' => 1,
				];
				$new_url = $_smile['urlcurrent'].'?'. \dash\request::build_query($get);

				// set live mode
				\dash\notif::live(1);
				\dash\notif::sound('new-ticket.mp3');

				\dash\notif::liveResult($new_url);
				\dash\notif::liveTarget('.chat');
				\dash\notif::livePosition('top');
			}
		}
		else
		{
			// ticket not found
			return;
		}




	}
}
?>