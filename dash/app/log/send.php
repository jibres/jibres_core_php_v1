<?php
namespace dash\app\log;


class send
{


	public static function notification()
	{
		if(\dash\url::isLocal())
		{
			return false;
		}

		$not_send = \dash\db\logs::notif_not_send();
		if(!$not_send || !is_array($not_send))
		{
			// nothing to send
			return true;
		}

		$start = time();

		foreach ($not_send as $key => $value)
		{
			if(!\dash\app\log\protector::cronjob($start))
			{
				break;
			}

			if(isset($value['telegram']))
			{
				$telegram = json_decode($value['telegram'], true);

				if($telegram)
				{
					if(!\dash\app\log\protector::tg($telegram))
					{
						break;
					}
					self::send_telegram($telegram);
				}
			}

			if(isset($value['email']))
			{
				$email = json_decode($value['email'], true);

				if(isset($email['email']))
				{
					self::send_email($email['email'], $email);
				}
			}

			\dash\db\logs::update(['send' => 1], $value['id']);
		}
	}


	private static function send_telegram($_data)
	{
		if(!\dash\social\telegram\tg::setting('status'))
		{
			return false;
		}

		foreach ($_data as $key => $value)
		{
			if(isset($value['method']))
			{
				$method   = $value['method'];
				unset($value['method']);
				$myResult = \dash\social\telegram\tg::$method($value);
			}
			else
			{
				$myResult = \dash\social\telegram\tg::sendMessage($value);
			}
		}

	}


	private static function send_email($_email, $_meta = [])
	{
		if(\dash\url::isLocal())
		{
			return false;
		}

		$email =
		[
			'to'       => $_email,
			'body'     => a($_meta, 'body'),
			'template' => 'html',
			'subject'  => a($_meta, 'subject'),
		];

		$send = \lib\email\send::send($email);


	}
}
?>
