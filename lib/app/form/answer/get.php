<?php
namespace lib\app\form\answer;


class get
{
	public static function is_answered_form_user_factor_id($_form_id, $_user_id, $_factor_id)
	{
		$form_id = \dash\validate::id($_form_id);
		$factor_id = \dash\validate::id($_factor_id);

		if(!$form_id || !$factor_id || !$_user_id)
		{
			return false;
		}

		$get = \lib\db\form_answer\get::is_answered_form_user_factor_id($form_id, $_user_id, $factor_id);

		return $get;
	}


	public static function by_id($_id)
	{
		\dash\permission::access('_group_form');

		return self::public_by_id($_id);
	}


	public static function need_review_form()
	{
		$need_review_form = \lib\db\form_answer\get::need_review_form();
		if(!is_array($need_review_form) || !$need_review_form)
		{
			return null;
		}

		$form_id = array_column($need_review_form, 'form_id');

		$form_id = array_filter($form_id);
		$form_id = array_unique($form_id);
		$form_id = array_map('floatval', $form_id);

		if(!$form_id)
		{
			return null;
		}

		$load_multi_form = \lib\db\form\get::by_multi_id(implode(',', $form_id));

		$load_multi_form = array_map(['\\lib\\app\\form\\form\\ready', 'row'], $load_multi_form);

		$load_multi_form = array_combine(array_column($load_multi_form, 'id'), $load_multi_form);

		foreach ($need_review_form as $key => $value)
		{
			if(isset($value['form_id']) && isset($load_multi_form[$value['form_id']]) && isset($value['count']))
			{
				$load_multi_form[$value['form_id']]['count_need_review'] = $value['count'];
			}
		}

		return $load_multi_form;

	}


	public static function count_not_reviewd($_form_id)
	{
		$id = \dash\validate::id($_form_id);

		if(!$id)
		{
			return false;
		}

		$need_review_form = \lib\db\form_answer\get::need_review_form_id($id);

		return floatval($need_review_form);

	}



	public static function public_by_id($_id)
	{

		$id = \dash\validate::id($_id);
		if(!$id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_detail = \lib\db\form_answer\get::by_id($id);
		if(!$load_detail)
		{
			\dash\notif::error(T_("Answer not found"));
			return false;
		}

		return $load_detail;
	}


	public static function HTMLshowDetaiRecrod($value)
	{
		$result = '';
		if(a($value, 'province_name') || a($value, 'city_name'))
		{
			$result.= a($value, 'province_name');
			$result.= a($value, 'city_name');
		}
		elseif(isset($value['item_type']) && $value['item_type'] === 'file')
		{
			$result .= '<a target="_blank" href="'. \lib\filepath::fix($value['answer']). '" class="btn link" >'. T_("Show file"). '</a>';
		}
		else
		{
			$result .= a($value, 'answer');
			$result .= ' ';
			$result .= a($value, 'textarea');
		}

		return $result;
	}
}
?>