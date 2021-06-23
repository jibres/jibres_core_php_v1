<?php
namespace lib\app\form\item;


class get
{
	/**
	 * Get form items
	 * this function call in website form generator
	 * needless to check permission
	 *
	 * @param      <type>         $_form_id      The form identifier
	 * @param      boolean        $_load_choice  The load choice
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function items($_form_id, $_load_choice = true)
	{
		$_form_id = \dash\validate::id($_form_id);
		if(!$_form_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$list = \lib\db\form_item\get::by_form_id($_form_id);

		if(!is_array($list))
		{
			$list = [];
		}

		$all_choice = [];
		$choice = [];

		if($_load_choice)
		{

			$item_ids = array_column($list, 'id');


			$all_choice = \lib\db\form_choice\get::item_id_form_id(implode(',', $item_ids), $_form_id);

			if(!is_array($all_choice))
			{
				$all_choice = [];
			}


			$all_choice = array_map(['\\lib\\app\\form\\choice\\ready', 'row'], $all_choice);

			$all_choice = array_combine(array_column($all_choice, 'id'), $all_choice);

			foreach ($all_choice as $key => $value)
			{
				if(!isset($choice[$value['item_id']]))
				{
					$choice[$value['item_id']] = [];
				}

				$choice[$value['item_id']][$key] = $value;
			}
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			$new_list[] = \lib\app\form\item\ready::row($value, $choice);
		}

		return $new_list;
	}

	public static function items_inquiryable($_form_id)
	{
		\dash\permission::access('_group_form');

		$list = self::items($_form_id, false);
		if(!is_array($list))
		{
			return $list;
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['type']))
			{
				if($value['type'] === 'mobile' || $value['type'] === 'nationalcode')
				{
					$new_list[] = $value;
				}
			}

		}

		return $new_list;

	}


	public static function items_answerable($_form_id)
	{
		\dash\permission::access('_group_form');

		$list = self::items($_form_id, false);
		if(!is_array($list))
		{
			return $list;
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['type']))
			{
				if($value['type'] === 'message')
				{
					continue;
				}
			}

			$new_list[] = $value;
		}

		return $new_list;

	}


	public static function items_comparable($_form_id)
	{
		\dash\permission::access('_group_form');

		$list = self::items($_form_id, false);
		if(!is_array($list))
		{
			return $list;
		}

		$new_list = [];

		foreach ($list as $key => $value)
		{
			if(isset($value['type_detail']['compare']) && $value['type_detail']['compare'])
			{
				$new_list[] = $value;
			}

		}

		return $new_list;

	}


	public static function get($_id)
	{

		\dash\permission::access('_group_form');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$load = \lib\db\form_item\get::by_id($id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\item\ready::row($load);

		return $load;
	}



	public static function get_by_id_form_id($_id, $_form_id)
	{
		\dash\permission::access('_group_form');

		$id = \dash\validate::id($_id);

		if(!$id)
		{
			return false;
		}

		$form_id = \dash\validate::id($_form_id);

		if(!$form_id)
		{
			return false;
		}


		$load = \lib\db\form_item\get::get_by_id_form_id($id, $form_id);

		if(!$load)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load = \lib\app\form\item\ready::row($load);

		return $load;
	}



	public static function items_answer($_form_id, $_answer_id)
	{
		\dash\permission::access('_group_form');

		$items         = self::items($_form_id);

		$_answer_id = \dash\validate::id($_answer_id);
		if(!$_answer_id)
		{
			return false;
		}

		$load_answer   = \lib\db\form_answer\get::user_answer($_answer_id);

		$answer        = a($load_answer, 'answer');
		$answer_detail = a($load_answer, 'answer_detail');

		if(!is_array($answer_detail))
		{
			$answer_detail = [];
		}

		if(!$answer || !$answer_detail)
		{
			return $items;
		}

		foreach ($answer_detail as $one_answer)
		{
			foreach ($items as $key => $item)
			{
				if($one_answer['item_id'] === $item['id'])
				{
					switch ($item['type'])
					{
						case 'short_answer':
						case 'displayname':
						case 'numeric':
						case 'date':
						case 'birthdate':
						case 'country':
						case 'province':
						case 'province_city':
						case 'gender':
						case 'time':
						case 'tel':
						case 'nationalcode':
						case 'mobile':
						case 'email':
						case 'website':
						case 'password':
						case 'yes_no':
						case 'message':
						case 'agree':
						case 'hidden':
						case 'postalcode':
						case 'single_choice':
						case 'dropdown':
							$items[$key]['user_answer'] = $one_answer['answer'];
							break;

						case 'descriptive_answer':
							$items[$key]['user_answer'] = $one_answer['textarea'];
							break;

						case 'file':
						case 'multiple_choice':
							if(!isset($items[$key]['user_answer']))
							{
								$items[$key]['user_answer'] = [];
							}
							$items[$key]['user_answer'][] = ['title' => $one_answer['answer'], 'choice_id' => $one_answer['choice_id']];
							break;
					}
				}

			}
		}

		return $items;
	}
}
?>