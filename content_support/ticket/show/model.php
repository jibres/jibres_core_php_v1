<?php
namespace content_support\ticket\show;

class model
{

	public static function post()
	{

		$id = \dash\validate::id(\dash\request::get('id'));
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(\dash\request::post('TicketFormType') === 'tag')
		{
			if(self::save_tag($id, \dash\request::post('tag')))
			{
				\dash\redirect::pwd();
			}
			return false;
		}

		if(\dash\request::post('TicketFormType') === 'changeStatus')
		{
			if(self::change_status($id, \dash\request::post('status')))
			{
				\dash\redirect::pwd();
			}
			return false;
		}

		if(\dash\request::post('TicketFormSolved') === 'solvedForm')
		{
			if(self::save_solved($id, \dash\request::post('solved')))
			{
				\dash\redirect::pwd();
			}
			return false;
		}

		if(\dash\request::post('TicketFormType') === 'setTitle')
		{
			if(self::save_title($id, \dash\request::post('title')))
			{
				\dash\redirect::pwd();
			}
			return false;
		}

		if(self::answer_save($id, \dash\request::post_raw('content'), \dash\request::post('addnote'), \dash\request::post('sendmessage')))
		{
			\dash\redirect::pwd();
		}
	}


	private static function loadTicketDetail($_id)
	{
		$main = \dash\data::loadTicketDetail();
		if(!$main && $_id && is_numeric($_id))
		{
			$main = \dash\app\ticket::get($_id);
			\dash\data::loadTicketDetail($main);
		}
		return $main;
	}


	public static function save_title($_id, $_title)
	{
		\dash\permission::access('supportTicketAnswer');

		$main = self::loadTicketDetail($_id);


		$update_main = [];

		$update_main['title'] = $_title;

		$result = false;

		if(!empty($update_main))
		{
			$result = \dash\app\ticket::edit($update_main, $_id);
		}

		if($result)
		{
			\dash\notif::ok(T_("Title of ticket saved"), 'title');
		}
		return $result;
	}


	public static function save_tag($_id, $_tag)
	{
		\dash\permission::access('supportTicketAssignTag');

		$main = self::loadTicketDetail($_id);

		if(!\dash\permission::check('cpTagSupportAdd'))
		{
			$getTagArgs = ['type' => 'support_tag'];


			$current_tag = \dash\db\terms::get($getTagArgs);

			if(is_array($current_tag))
			{
				$tag_titles = array_column($current_tag, 'title');
				$new_tag    = $_tag;
				$new_tag    = explode(',', $new_tag);
				foreach ($new_tag as $key => $value)
				{
					if(!in_array($value, $tag_titles))
					{
						\dash\notif::error(T_("Please select tag from list"), 'tag');
						return false;
					}
				}
			}
		}

		\dash\app\posts::set_post_term($_id, 'support_tag', 'tickets', $_tag);
		\dash\log::temp_set('ticket_ticketAddTag', ['code' => $_id, 'tag' => $_tag, 'masterid' => $_id,]);

		if(\dash\engine\process::status())
		{
			\dash\log::save_temp();
			\dash\notif::ok(T_("Tag was saved"));
		}
		return true;
	}


	/**
	 * this function call from api
	 *
	 * @param      <type>   $_id      The identifier
	 * @param      <type>   $_status  The status
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function change_status($_id, $_status)
	{
		$main = self::loadTicketDetail($_id);

		if(isset($main['status']) && $main['status'] === 'spam')
		{
			\dash\permission::access('supportTicketReOpen', T_("This ticket is spam!"));
		}

		// check is my ticket and some permission to load guest , ...
		$is_my_ticket = \content_support\ticket\show\view::is_my_ticket($main);

		$status = \dash\validate::string($_status);

		if(!in_array($status, ['close','deleted','awaiting', 'spam']))
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		if(!$is_my_ticket)
		{
			switch ($status)
			{
				case 'close':
					\dash\permission::access('supportTicketClose');
					\dash\log::temp_set('ticket_setCloseTicket', ['code' => $_id, 'masterid' => $_id,]);

					break;

				case 'awaiting':
					\dash\permission::access('supportTicketReOpen');
					\dash\log::temp_set('ticket_setAwaitingTicket', ['code' => $_id, 'masterid' => $_id,]);
					break;


				case 'spam':
					\dash\permission::access('supportTicketAnswer');
					\dash\log::temp_set('setSpamTicket', ['code' => $_id, 'masterid' => $_id,]);
					break;

				case 'deleted':
					\dash\permission::access('supportTicketDelete');
					\dash\log::temp_set('ticket_setDeleteTicket', ['code' => $_id, 'masterid' => $_id,]);
					break;

			}
		}

		\dash\db\tickets::update(['status' => $status], $_id);

		switch ($status)
		{
			case 'close':
				\dash\notif::warn(T_("Ticket closed"));
				break;

			case 'awaiting':
				\dash\notif::ok(T_("Ticket was open again"));
				break;

			case 'deleted':
				\dash\notif::warn(T_("Ticket was deleted"));
				break;

			case 'spam':
				\dash\notif::warn(T_("Ticket set on spam"));
				break;
		}

		if(\dash\engine\process::status())
		{
			\dash\log::save_temp();
		}
		return true;
	}


	public static function save_solved($_id, $_solved)
	{

		\dash\permission::access('supportTicketAnswer');

		$main = self::loadTicketDetail($_id);

		$solved = $_solved ? 1 : null;

		\dash\db\tickets::update(['solved' => $solved], $_id);
		if($solved)
		{
			\dash\log::temp_set('ticket_setSolvedTicket', ['code' => $_id, 'masterid' => $_id,]);
			\dash\notif::ok(T_("Ticket set as solved"));
		}
		else
		{
			\dash\log::temp_set('ticket_setUnSolvedTicket', ['code' => $_id, 'masterid' => $_id,]);
			\dash\notif::warn(T_("Ticket set as unsolved"));
		}

		if(\dash\engine\process::status())
		{
			\dash\log::save_temp();
		}
		return true;

	}


	/**
	 * replay message
	 * this function call in api
	 *
	 * @param      <type>   $_id            The identifier
	 * @param      <type>   $_answer        The answer
	 * @param      string   $_type          The type
	 * @param      boolean  $_send_message  The send message
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function answer_save($_id, $_answer, $_type = 'ticket', $_send_message = true)
	{
		$file     = \dash\upload\support::ticket();

		// we have an error in upload file1
		if($file && !isset($file['path']))
		{
			return false;
		}

		$main = self::loadTicketDetail($_id);

		if(isset($main['status']) && $main['status'] === 'spam')
		{
			\dash\notif::error(T_("This ticket is spam!"));
			return false;
		}


		// check is my ticket and some permission to load guest , ...
		$is_my_ticket = \content_support\ticket\show\view::is_my_ticket($main);

		$msg      = T_("Your ticket was sended");
		$notif_fn = 'ok';


		$content = $_answer;

		if(\dash\permission::check('supportTicketSignature'))
		{

			if((mb_strlen($content) - 1) === (mb_strlen(\dash\user::detail('signature'))))
			{
				$content = null;
			}
		}
		else
		{
			$content = \dash\safe::safe($content);
		}

		$plus = \dash\db\tickets::get_count(['type' => 'ticket', 'parent' => $_id]);

		$ticket_type = 'ticket';

		if(\dash\permission::check('supportTicketAddNote'))
		{
			if($_type === 'note')
			{
				$log =
				[
					'masterid' => $_id,
					'code'     => $_id,
					// 'tcontent' => \dash\safe::forJson($content),
					'plus'     => $plus,
				];

				\dash\log::temp_set('ticket_AddNoteTicket', $log);

				$msg         = T_("Your note saved");
				$notif_fn    = 'warn';
				$ticket_type = 'ticket_note';
			}
		}


		// ready to insert tickets
		$args =
		[
			'type'    => $ticket_type,
			'content' => $content,
			'user_id' => \dash\user::id(),
			'parent'  => $_id,
			'file'    => isset($file['path']) ? $file['path'] : null,
		];


		$update_main = [];


		if($ticket_type !== 'ticket_note')
		{

			$update_main['plus'] = intval($plus) + 1 + 1 ; // master ticket + this tichet

			if(!\dash\temp::get('ticketGuest'))
			{

				if($is_my_ticket)
				{

					$update_main['status'] = 'awaiting';
					$update_main['solved'] = null;
					$msg = T_("Your message has been added");
					$notif_fn = 'ok';

					$log =
					[
						'masterid' => $_id,
						'code'     => $_id,
						// 'tcontent' => \dash\safe::forJson($content),
						'plus'     => $update_main['plus'],
					];

					\dash\log::temp_set('ticket_AddToTicket', $log);
				}
				else
				{

					\dash\permission::access('supportTicketAnswer');

					$log =
					[
						'masterid' => $_id,
						'code'     => $_id,
						// 'tcontent' => \dash\safe::forJson($content),
						'plus'     => $update_main['plus'],
					];

					$isDubleAnswer = false;

					if(isset($main['status']) && $main['status'] === 'answered')
					{
						$isDubleAnswer = true;
						\dash\log::temp_set('ticket_DubleAnswerTicket', $log);
					}
					else
					{
						\dash\log::temp_set('ticket_AnswerTicket', $log);
					}

					if(!$isDubleAnswer)
					{
						if($_send_message)
						{
							$log =
							[
								'code'     => $_id,
								'masterid' => $_id,
								'to'       => \dash\coding::decode($main['user_id']),
								'from'     => \dash\user::id(),
							];

							\dash\log::temp_set('ticket_answerTicketAlertSend', $log);
						}
						else
						{
							$log =
							[
								'code' => $_id,
								'masterid' => $_id,
								'to'   => \dash\coding::decode($main['user_id']),
								'from' => \dash\user::id(),
							];

							\dash\log::temp_set('ticket_answerTicketAlert', $log);
						}
					}

					$update_main['status'] = 'answered';
					$msg = T_("Your answer was saved");

					if(isset($main['answertime']) && $main['answertime'])
					{
						// no change
					}
					else
					{
						if(isset($main['datecreated']))
						{
							$diff                      = time() - strtotime($main['datecreated']);
							$update_main['answertime'] = $diff;
						}
					}
				}
			}
		}

		$result = \dash\app\ticket::add($args);

		if($result)
		{
			if(!empty($update_main))
			{
				\dash\db\tickets::update($update_main, $_id);
			}

			\dash\notif::$notif_fn($msg);
			if(isset($result['id']))
			{
				\dash\upload\support::ticket_usage($file, $result['id']);
				\dash\log::save_temp(['replace' => ['code' => $result['id'], 'masterid' => $_id]]);
			}
			else
			{
				\dash\log::save_temp();
			}

			return true;
		}
		return false;
	}
}
?>