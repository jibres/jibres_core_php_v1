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
	public static function answer($_new_answer, $_old_answer)
	{
		var_dump($_new_answer, $_old_answer);exit;
	}
}
?>