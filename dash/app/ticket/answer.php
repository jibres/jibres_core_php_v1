<?php
namespace dash\app\ticket;

class answer
{

	public static function add($_args, $_id)
	{
		\dash\permission::access('crmTicketManager');

		$master = \dash\app\ticket\get::inline_get($_id);
		if(!$master)
		{
			return false;
		}

		if(isset($master['parent']) && $master['parent'])
		{
			\dash\noitf::error(T_("Can not answer to this message!"));
			return false;
		}


		$args = \dash\app\ticket\check::variable($_args);
		if(!$args)
		{
			return false;
		}

		$file = null;
		if(\dash\request::files('file'))
		{
			$file = \dash\upload\support::ticket();
			if(!isset($file['path']))
			{
				return false;
			}

			$args['file'] = $file['path'];
		}

		$args['parent']      = $master['id'];

		$sendmessage = false;

		if($args['sendmessage'])
		{
			$sendmessage = true;
		}

		unset($args['sendmessage']);

		$message_id = \dash\db\tickets\insert::new_record($args);

		if(!$message_id)
		{
			\dash\notif::error(T_("Can not add your message"));
			return false;
		}

		$update_master           = [];
		$update_master['status'] = 'answered';

		$plus = \dash\db\tickets\get::conversation_count($master['id']);
		if(is_numeric($plus))
		{
			$update_master['plus'] = $plus;
		}
		else
		{
			$plus = 1; // error. Bug. But need this variable :/
		}

		\dash\db\tickets\update::update($update_master, $master['id']);

		$log =
		[
			'masterid' => $master['id'],
			'code'     => $master['id'],
			'plus'     => $plus,
			'from'     => \dash\user::id(),
		];

		$isDubleAnswer = false;

		if(isset($master['status']) && $master['status'] === 'answered')
		{
			$isDubleAnswer = true;
			\dash\log::set('ticket_DubleAnswerTicket', $log);
		}
		else
		{
			\dash\log::set('ticket_AnswerTicket', $log);
		}

		if(!$isDubleAnswer)
		{
			if(isset($master['user_id']))
			{
				$log['to'] = $master['user_id'];
			}

			if($sendmessage)
			{
				\dash\log::set('ticket_answerTicketAlertSend', $log);
			}
			else
			{
				\dash\log::set('ticket_answerTicketAlert', $log);
			}
		}


		if(isset($file['id']))
		{
			\dash\upload\support::ticket_usage($file, $message_id);
		}

		\dash\notif::ok(T_('Your message saved'));

		return true;


	}


}
?>