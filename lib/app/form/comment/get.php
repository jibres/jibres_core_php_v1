<?php
namespace lib\app\form\comment;


class get
{
	public static function check_trust_comment($_form_id, $_answer_id, $_note_id)
	{
		$form_id   = \dash\validate::id($_form_id);
		$answer_id = \dash\validate::id($_answer_id);
		$note_id   = \dash\validate::id($_note_id);

		if(!$form_id || !$answer_id || !$note_id)
		{
			return false;
		}

		$load_comment = \lib\db\form_comment\get::check_trust_comment($form_id, $answer_id, $note_id);

		if(!$load_comment)
		{
			return false;
		}

		$load_comment = ready::row($load_comment);

		return $load_comment;

	}

	public static function get($_answer_id)
	{
		\dash\permission::access('_group_form');

		$_answer_id = \dash\validate::id($_answer_id);
		if(!$_answer_id)
		{
			return false;
		}

		$load_answer = \lib\app\form\answer\get::by_id($_answer_id);
		if(!$load_answer)
		{
			return false;
		}

		$list = \lib\db\form_comment\get::get_by_answer_id($_answer_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$new_list[] = ready::row($value);
		}

		return $new_list;

	}


	/**
	 * Get comment to show to users
	 * needless to check permission
	 *
	 * @param      <type>   $_answer_id  The answer identifier
	 *
	 * @return     boolean  ( description_of_the_return_value )
	 */
	public static function public_comment($_answer_id)
	{

		$load_answer = \lib\app\form\answer\get::public_by_id($_answer_id);
		if(!$load_answer)
		{
			return false;
		}

		$list = \lib\db\form_comment\get::get_by_answer_id_public($_answer_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$new_list[] = ready::row($value);
		}

		return $new_list;

	}




	public static function one($_id)
	{
		\dash\permission::access('_group_form');

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Id not set"));
			return false;
		}

		$load = \lib\db\form_comment\get::get($id);
		if(!$load)
		{
			\dash\notif::error(T_("Comment not found"));
			return false;
		}

		return $load;

	}
}
?>