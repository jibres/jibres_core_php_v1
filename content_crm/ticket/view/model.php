<?php
namespace content_crm\ticket\view;


class model
{
	public static function post()
	{
		$_id = \dash\request::get('id');

			// ready to insert tickets
		$args =
		[
			'type'    => 'ticket',
			'content' => \dash\request::post('answer'),
			'user_id' => \dash\user::id(),
			'parent'  => \dash\request::get('id'),
			'file'    => null,
		];


		$update_main = [];

		$plus = \dash\data::dataRow_plus();

		$main = \dash\data::dataRow();



		$update_main['plus'] = intval($plus) + 1 + 1 ; // master ticket + this tichet


		$log =
		[
			'masterid' => $_id,
			'code'     => $_id,
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
			$log =
			[
				'code'     => $_id,
				'masterid' => $_id,
				'to'       => \dash\coding::decode($main['user_id']),
				'from'     => \dash\user::id(),
			];

			\dash\log::temp_set('ticket_answerTicketAlertSend', $log);
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


		$result = \dash\app\ticket::add($args);

		if($result)
		{
			if(!empty($update_main))
			{
				\dash\db\tickets::update($update_main, $_id);
			}

			\dash\notif::ok($msg);

			if(isset($result['id']))
			{
				\dash\log::save_temp(['replace' => ['code' => $result['id'], 'masterid' => $_id]]);
			}
			else
			{
				\dash\log::save_temp();
			}

			\dash\redirect::pwd();
			return true;
		}


	}
}
?>
