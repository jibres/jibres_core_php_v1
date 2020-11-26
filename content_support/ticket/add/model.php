<?php
namespace content_support\ticket\add;

class model
{
	public static function add_new($_via, $_content, $_file = null, $_title = null)
	{
		// ready to insert tickets
		$args =
		[
			'title'   => $_title,
			'type'    => 'ticket',
			'content' => $_content,
			'via'     => $_via,
			'file'    => $_file,
			'user_id' => \dash\user::id(),
		];

		// insert tickets
		$result = \dash\app\ticket::add($args);

		if(isset($result['id']))
		{
			$log =
			[
				'from'     => \dash\user::id(),
				'code'     => $result['id'],
				'masterid' => $result['id'],
				'via'      => $_via,
			];

			\dash\log::set('ticket_addNewTicket', $log);

			\dash\notif::ok(T_("Your ticket was sended"));
		}
		return $result;
	}

	public static function post()
	{
		$ticket_load_page_time = \dash\session::get('ticket_load_page_time');

		if($ticket_load_page_time)
		{
			if(time() - $ticket_load_page_time < 5)
			{
				\dash\session::set('ticket_load_page_time', time());
				\dash\header::status(422, T_("It was very fast!"));
			}
		}
		else
		{
			\dash\notif::warn(T_("Your cookies may have been blocked"). ' '. T_("You need to enable cookie for usign this service"));
			return false;
		}


		$file     = \dash\upload\support::ticket();

		// we have an error in upload file1
		if($file && !isset($file['path']))
		{
			return false;
		}
		else
		{
			$file['path'] = isset($file['path']) ? $file['path'] : null;
		}

		if(\dash\permission::check('supportTicketSignature'))
		{
			$content = \dash\request::post_raw('content');
		}
		else
		{
			if(strip_tags(\dash\request::post_raw('content')) != \dash\request::post_raw('content'))
			{
				\dash\session::set('ticket_load_page_time', time());
				\dash\header::status(422, T_("You try to send some html code!"));
			}

			$content = \dash\request::post('content');
		}

		$count_http  = substr_count($content, 'http://');
		$count_https = substr_count($content, 'https://');
		if($count_https + $count_http >= 2)
		{
			\dash\header::status(422, T_("Can not set 2 link in one message!"));
		}

		$title = \dash\validate::string_100(\dash\request::get('title'));

		if(!\dash\user::id())
		{
			$mobile = \dash\validate::mobile(\dash\request::post('mobile'), false);
			if(!$mobile)
			{
				\dash\notif::error(T_("Mobile is required"), 'mobile');
				return false;
			}

			$content = T_("Mobile") . ' '. $mobile. "\n". $content;
		}


		// insert tickets
		$result = self::add_new('site', $content, $file['path'], $title);

		if(isset($result['id']))
		{
			\dash\upload\support::ticket_usage($file, $result['id']);

			if(!\dash\user::login())
			{
				$guest_ticket = \dash\session::get('guest_ticket');

				if(!$guest_ticket || !is_array($guest_ticket))
				{
					$guest_ticket = [];
				}

				array_push($guest_ticket, $result);

				\dash\session::set('guest_ticket', $guest_ticket);

				if(isset($result['code']))
				{
					\dash\redirect::to(\dash\url::this().'/show?id='. $result['id']. '&guest='. $result['code']);
				}
			}
			else
			{
				\dash\redirect::to(\dash\url::this().'/show?id='. $result['id']);
			}
		}
	}
}
?>