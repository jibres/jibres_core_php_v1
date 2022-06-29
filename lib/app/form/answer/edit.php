<?php
namespace lib\app\form\answer;


class edit
{

	public static function makr_all_as_review($_form_id)
	{
		$id = \dash\validate::id($_form_id);

		if(!$id)
		{
			return false;
		}

		\lib\db\form_answer\edit::makr_all_as_review($id);

		\dash\notif::ok(T_("All answer of this form mark as reviewd"));

		return true;
	}



	public static function makr_as_review($_form_id, $_answer_id)
	{
		$id = \dash\validate::id($_form_id);

		if(!$id)
		{
			return false;
		}

		$answer_id = \dash\validate::id($_answer_id);

		if(!$answer_id)
		{
			return false;
		}


		\lib\db\form_answer\edit::makr_as_review($id, $answer_id);

		\dash\notif::ok(T_("Answer mark as reviewd"));

		return true;

	}

	public static function edit_status($_status, $_id)
	{
		$allow_status =
		[
			'start',
			'complete',
			'skip',
			'spam',
			'filter',
			'block',
			'draft',
			'enable',
			'disable',
			'deleted',
			'archive',
			'done',
			'review',
			'pending',
			'other',
			'payed',
			'expire',
			'cancel',
			'reject',
			'trash',
			'approved',
			'awaiting',
			'unapproved',
			'close',
			'active',
			'deactive',
			'unreachable',
			'unknown',
		];

		if(!in_array($_status, $allow_status))
		{
			\dash\notif::error(T_("Invalid status"));
			return false;
		}

		$id = \dash\validate::id($_id);

		\lib\db\form_answer\edit::update(['status' => $_status], $id);

		\dash\notif::ok(T_("Saved"));

		return true;
	}


	/**
	 * Edit form answer
	 *
	 * @param      <type>  $_new_answer  The new answer
	 * @param      <type>  $_old_answer  The old answer
	 */
	public static function answer($_new_answer, $_old_answer, $_answer_id)
	{
		$must_remove_old_answer = [];

		$must_inert_new_answer  = [];

		$must_remove_from_new_answer = [];

		foreach ($_old_answer as $old_answer)
		{
			if(isset($old_answer['user_answer']) && is_array($old_answer['user_answer']))
			{
				foreach ($old_answer['user_answer'] as $the_old_answer)
				{
					$finded = false;


					foreach ($_new_answer as $new_answer_key => $new_answer)
					{
						if(floatval($the_old_answer['item_id']) === floatval($new_answer['item_id']))
						{
							if(\dash\validate::is_equal($the_old_answer['answer'] , $new_answer['answer']) || \dash\validate::is_equal($the_old_answer['answer'] , $new_answer['textarea']))
							{
								$finded = true;
								unset($_new_answer[$new_answer_key]);
								break;
							}

							if(a($the_old_answer, 'choice_id') && \dash\validate::is_equal($the_old_answer['choice_id'] , $new_answer['choice_id']))
							{
								$finded = true;
								unset($_new_answer[$new_answer_key]);
								break;
							}
						}
					}

					if(!$finded)
					{
						if(a($old_answer, 'type') === 'file')
						{
							// not remove file
						}
						else
						{
							$must_remove_old_answer[] = $the_old_answer['answer_detail_id'];
						}
					}
				}
			}
		}

		if(!empty($must_remove_old_answer))
		{
			foreach ($must_remove_old_answer as $key => $value)
			{
				\lib\db\form_answerdetail\delete::by_id($value);
			}
		}

		if(!empty($_new_answer))
		{

			foreach ($_new_answer as $key => $value)
			{
				$_new_answer[$key]['answer_id'] = $_answer_id;
			}

			\lib\db\form_answerdetail\insert::multi_insert($_new_answer);

		}

		return true;


	}
}
?>