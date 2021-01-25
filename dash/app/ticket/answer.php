<?php
namespace dash\app\ticket;

class answer
{

	public static function add($_args, $_id)
	{
		// \dash\permission::access('crmTicketManager');

		$is_note = false;
		if(isset($_args['note']) && $_args['note'])
		{
			$is_note = true;
		}

		unset($_args['note']);

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

		$args['parent']      = $master['id'];

		$sendmessage = false;

		if($args['sendmessage'])
		{
			$sendmessage = true;
		}

		unset($args['sendmessage']);

		if($is_note)
		{
			$args['type'] = 'note';
		}
		else
		{
			$args['type'] = 'answer';
		}

		$message_id = \dash\app\ticket\add::add_new_ticket($args);

		if(!$message_id)
		{
			\dash\notif::error(T_("Can not add your message"));
			return false;
		}

		$update_master           = [];

		if(!$is_note)
		{
			$update_master['status'] = 'answered';
		}

		if(!a($master, 'answertime') && a($master, 'datecreated'))
		{
			$update_master['answertime'] = time() - strtotime($master['datecreated']);
		}

		$plus = \dash\db\tickets\get::conversation_count($master['id']);
		if(is_numeric($plus))
		{
			$update_master['plus'] = $plus;
		}
		else
		{
			$plus = 1; // error. Bug. But need this variable :/
		}

		if(!empty($update_master))
		{
			\dash\db\tickets\update::update($update_master, $master['id']);
		}

		$log =
		[
			'masterid' => $master['id'],
			'code'     => $message_id,
			'plus'     => $plus,
			'from'     => \dash\user::id(),
		];

		if($is_note)
		{
			\dash\log::set('ticket_AddNoteTicket', $log);
		}
		else
		{
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
		}


		\dash\notif::ok(T_('Your message saved'));

		return true;
	}
}
?>