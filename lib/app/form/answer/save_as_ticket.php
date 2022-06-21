<?php
namespace lib\app\form\answer;


class save_as_ticket
{
	public static function save($_form_id, $_answer_id)
	{

		$args              = [];

		$args['answer_id'] = $_answer_id;
		$args['form_id']   = $_form_id;
		$args['export']   = true;



		$dataTable = \lib\app\form\answerdetail\search::list(null, $args, [], true);

		if(empty($dataTable))
		{
			return false;
		}

		$files       = [];
		$answer_list = [];
		$total_price = 0;

		foreach ($dataTable as $key => $value)
		{
			$answer = $value['answer'];

			switch ($value['item_type'])
			{

				case 'message':
					// do nothing
					break;

				case 'nationalcode':
					$answer = \dash\fit::text($answer);
					break;


				// neet T_()
				case 'yes_no':
				case 'gender':
					$answer = T_(strval($answer));
					// code...
					break;

				case 'ircard':
				case 'irshaba':
					$answer = \dash\fit::text($answer);
					break;

				// need fit number
				case 'tel':
				case 'numeric':
				case 'time':
				case 'postalcode':
					$answer = \dash\fit::text($answer);
					break;

				case 'mobile':
					$answer = \dash\fit::mobile($answer);
					break;

				// need fit date
				case 'date':
				case 'birthdate':
					$answer = \dash\fit::date($answer);
					break;

				// need check by other
				case 'multiple_choice':
					// nothing
					break;

				case 'country':
					$answer = a($value, 'country_name');
					break;

				case 'province':
					$answer = a($value, 'province_name');
					break;

				case 'province_city':
					$answer = trim(a($value, 'province_name'). ' - '. a($value, 'city_name'));
					break;

				case 'agree':
					if($answer)
					{
						$answer = T_("Yes");
					}
					else
					{
						$answer = T_("No");
					}
					break;

				case 'file':
					// save file to another ticket message
					$files[] =
					[
						'title' => $value['item_title'],
						'file' => $value['answer'],
					];
					$answer = null;
					break;

				case 'manual_amount':
				case 'list_amount':
				case 'hidden_amount':
					$total_price += floatval($answer);
					$answer      = null;
					break;

				case 'descriptive_answer':
					$answer = a($value, 'textarea');

					break;

				case 'short_answer':
				case 'single_choice':
				case 'dropdown':
				case 'email':
				case 'displayname':
				case 'website':
				case 'password':
				case 'hidden':
				case 'random':
				default:
					// okay. $answer = $answer :)
					break;

			}

			if($answer)
			{
				if(isset($answer_list[$value['item_id']]))
				{
					$answer_list[$value['item_id']]['answer'] .= ', '. $answer;
				}
				else
				{
					$answer_list[$value['item_id']] =
					[
						'title'  => $value['item_title'],
						'answer' => $answer,
					];
				}
			}
		}

		$answer_list = array_values($answer_list);

		$ticket_content = [];
		foreach ($answer_list as $key => $value)
		{
			$temp = '';
			$temp .= \dash\fit::number($key + 1);
			$temp .= '. ';
			$temp .= '***'. $value['title']. '***'. "\n";
			$temp .= $value['answer'];

			$ticket_content[] = $temp;
		}

		$ticket_content = implode("\n", $ticket_content);

		$user_id = null;

		$load_answer = \lib\db\form_answer\get::by_id($_answer_id);

		if(isset($load_answer['user_id']) && $load_answer['user_id'])
		{
			$user_id = $load_answer['user_id'];
		}

		$add_new_ticket =
		[
			'content' => $ticket_content,
			'user_id' => $user_id,
			'title'   => T_("Answer to form #:val Answer id #:id", ['val' => \dash\fit::number($_form_id), 'id' => \dash\fit::number($_answer_id)]),
			'via'     => null,
			'file'    => null,
			'parent'  => null,
		];




		$ticket_id = \dash\app\ticket\add::add_from_form_answer($add_new_ticket, $_answer_id);

		if(!$ticket_id)
		{
			\dash\log::oops('CannotAddData');
			return false;
		}


		if($files)
		{
			foreach ($files as $key => $value)
			{

				$add_new_ticket =
				[
					'content' => $value['title'],
					'parent'  => $ticket_id,
					'file'    => $value['file'],
					'user_id' => $user_id,
				];

				\dash\app\ticket\add::add_from_form_answer($add_new_ticket, $_answer_id);

			}
		}

		$load_answer = \lib\app\form\answer\get::public_by_id($_answer_id);

		if(isset($load_answer['transaction_id']) && $load_answer['transaction_id'])
		{
			$answerTransactionDetail = \dash\app\transaction\get::get(($load_answer['transaction_id']));

			if(a($answerTransactionDetail, 'verify'))
			{

				$transaction_content = ' '. \dash\fit::number(a($answerTransactionDetail, 'plus')). ' '. \lib\store::currency();
				$transaction_content .= T_("Payed."). "\n";

				$transaction_content .= T_("Tracking link"). "\n";

				$transaction_content .=  \lib\store::admin_url(). '/crm/transactions/detail?id='. a($load_answer, 'transaction_id');

				$add_new_ticket =
				[
					'content' => $transaction_content,
					'parent'  => $ticket_id,
					'user_id' => $user_id,
				];

				\dash\app\ticket\add::add_from_form_answer($add_new_ticket, $_answer_id);
			}
		}

		if($transaction_id = \dash\temp::get('minusTransactionAfterPayForm'))
		{
				$transaction_content = ' '. \dash\fit::number(\dash\temp::get('minusTransactionAfterPayFormPrice')). ' '. \lib\store::currency();
				$transaction_content .= T_("Was deducted."). "\n";

				$transaction_content .= T_("Tracking link"). "\n";

				$transaction_content .=  \lib\store::admin_url(). '/crm/transactions/detail?id='. $transaction_id;

				$add_new_ticket =
				[
					'content' => $transaction_content,
					'parent'  => $ticket_id,
					'user_id' => $user_id,
				];

				\dash\app\ticket\add::add_from_form_answer($add_new_ticket, $_answer_id);
		}

		return $ticket_id;

	}
}
?>