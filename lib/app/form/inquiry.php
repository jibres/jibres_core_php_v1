<?php
namespace lib\app\form;


class inquiry
{
	public static function items($_form_detail, $_items)
	{
		if(!\dash\get::index($_form_detail, 'inquiry'))
		{
			return false;
		}

		$question = \dash\get::index($_form_detail, 'inquirysetting', 'question');
		if(!$question || !is_array($question))
		{
			return false;
		}

		echo '<form method="get" autocomplete="off" action="'.\dash\url::current().'">';
		echo '<input type="hidden" name="i" value="1">';
		echo '<label >'. T_("Search"). '</label>';
		echo '</label>';

		echo '<div class="input">';
		echo '<input type="tel" name="q" ';
		echo ' maxlength=15 ';
		echo '>';
		echo '<button class="addon btn primary2"><i class="sf-search"></i></button>';
		echo '</div>';
		echo '</form>';

		return;

		foreach ($_items as $key => $value)
		{
			if(in_array($value['id'], $question))
			{
				if($value['type'] === 'mobile' || $value['type'] === 'nationalcode' )
				{
					self::input_quiry($value, $value['type']);
				}
			}
		}
	}


	public static function check($_form_detail, $_items)
	{
		if(\dash\request::get('i') === '1')
		{
			/*nothing*/
		}
		else
		{
			return;
		}

		$f = \dash\request::get('f');
		$q = \dash\request::get('q');

		// $f = \dash\validate::id($f, false);
		$q = \dash\validate::search($q, false);

		// if(!$f || !$q)
		if(!$q)
		{
			return false;
		}


		if(!\dash\get::index($_form_detail, 'inquiry'))
		{
			return false;
		}

		$question = \dash\get::index($_form_detail, 'inquirysetting', 'question');

		if(!$question || !is_array($question))
		{
			return false;
		}

		$trust_field = [];
		$current_search = [];
		foreach ($_items as $key => $value)
		{
			if(in_array($value['id'], $question))
			{
				if($value['type'] === 'mobile' || $value['type'] === 'nationalcode' )
				{
					$trust_field[] = $value['id'];
					if(floatval($value['id']) === floatval($f))
					{
						$current_search = $value;
					}
				}
			}
		}

		if(!$trust_field)
		{
			return false;
		}

		// if(!isset($current_search['type']))
		// {
		// 	return false;
		// }

		// $search = null;

		// if($current_search['type'] === 'mobile')
		// {
		// 	$search = \dash\validate::mobile($q, false);
		// 	if(!$search)
		// 	{
		// 		\dash\notif::error(T_("Invalid mobile"));
		// 		return false;
		// 	}
		// }
		// elseif($current_search['type'] === 'nationalcode')
		// {
		// 	$search = \dash\validate::nationalcode($q, false);
		// 	if(!$search)
		// 	{
		// 		\dash\notif::error(T_("Invalid nationalcode"));
		// 		return false;
		// 	}
		// }
		// else
		// {
		// 	return false;
		// }

		// if(!$search)
		// {
		// 	return false;
		// }

		\dash\data::inquiryExec(true);


		$mobile = \dash\validate::mobile($q, false);
		if($mobile)
		{
			$q = $q. "','". $mobile;
		}

		$result = \lib\db\form_answerdetail\get::by_items_id_answer(implode(',', $trust_field), $q);

		if(!$result || !isset($result['answer_id']) || !isset($result['form_id']))
		{
			if(isset($_form_detail['inquirysetting']['inquiry_msg_not_founded']) && $_form_detail['inquirysetting']['inquiry_msg_not_founded'])
			{
				\dash\notif::error($_form_detail['inquirysetting']['inquiry_msg_not_founded']);
			}
			else
			{
				\dash\notif::error(T_("You have not complete this form"));
			}
			return false;
		}

		$answer_id = $result['answer_id'];

		// add tag to this answer
		$x = \lib\app\form\tag\add::public_answer_tag_plus(T_("Viewd"), $answer_id, $result['form_id'], true);


		\dash\data::answerID($answer_id);

		$tag_list = \lib\app\form\tag\get::public_answer_tag($answer_id);
		if(!is_array($tag_list))
		{
			$tag_list = [];
		}

		\dash\data::tagList($tag_list);

		$comment_list = \lib\app\form\comment\get::public_comment($answer_id);

		\dash\data::commentList($comment_list);

		\dash\data::inquiryExecHaveResult($comment_list || $tag_list);

		if(isset($_form_detail['inquirysetting']['inquiry_msg_founded']) && $_form_detail['inquirysetting']['inquiry_msg_founded'])
		{
			\dash\notif::info($_form_detail['inquirysetting']['inquiry_msg_founded']);
		}
		else
		{
			\dash\notif::info(T_("You have already complete this form"));
		}

		return true;

	}



	private static function input_quiry($value, $_type)
	{
		echo '<form method="get" autocomplete="off" action="'.\dash\url::current().'">';
		echo '<input type="hidden" name="i" value="1">';
		echo '<input type="hidden" name="f" value="'. $value['id']. '">';
		echo '<label for="'. $value['id']. '" >';
		echo $value['title'];
		echo '</label>';

		echo '<div class="input">';
		echo '<input type="tel" name="q" ';

		if($_type === 'mobile')
		{
			echo ' data-format="mobile-enter" maxlength=15 ';
		}
		else
		{
			echo ' data-format="nationalCode" maxlength=12 ';
		}
		echo '>';
		echo '<button class="addon btn primary2"><i class="sf-search"></i></button>';
		echo '</div>';
		echo '</form>';
	}
}
?>