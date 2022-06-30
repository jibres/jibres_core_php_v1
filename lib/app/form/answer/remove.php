<?php
namespace lib\app\form\answer;


class remove
{
	public static function remove($_answer_id)
	{
		\dash\permission::access('FormRemoveAnswer');

		$answer_id = \dash\validate::id($_answer_id);
		if(!$answer_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		\lib\db\form_answerdetail\delete::by_answer_id($answer_id);
		\lib\db\form_answer\delete::by_id($answer_id);
		return true;
	}


	public static function answer_detail_by_type($_type, $_form_answer_detail_id)
	{
		\dash\permission::access('FormRemoveAnswer');

		$form_answer_detail_id = \dash\validate::id($_form_answer_detail_id);

		if(!$form_answer_detail_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_answer_detail = \lib\db\form_answerdetail\get::by_id($form_answer_detail_id);
		if(!$load_answer_detail || !a($load_answer_detail, 'item_id'))
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_item = \lib\db\form_item\get::by_id($load_answer_detail['item_id']);

		if(a($load_item, 'type') !== $_type)
		{
			\dash\notif::error(T_("Invalid form type"));
			return false;
		}

		\lib\db\form_answerdetail\delete::by_id($form_answer_detail_id);

		\dash\notif::ok(T_("Answer removed"));
		return true;
	}
}
?>