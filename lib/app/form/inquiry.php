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

		$f = \dash\validate::id($f, false);
		$q = \dash\validate::search($q, false);

		if(!$f || !$q)
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

		if(!in_array($f, $trust_field))
		{
			return false;
		}

		if(!isset($current_search['type']))
		{
			return false;
		}

		$search = null;

		if($current_search['type'] === 'mobile')
		{
			$search = \dash\validate::mobile($q, false);
			if(!$search)
			{
				\dash\notif::error(T_("Invalid mobile"));
			}
		}
		elseif($current_search['type'] === 'nationalcode')
		{
			$search = \dash\validate::nationalcode($q, false);
			if(!$search)
			{
				\dash\notif::error(T_("Invalid nationalcode"));
			}
		}
		else
		{
			return false;
		}

		if(!$search)
		{
			return false;
		}

		$result = \lib\db\form_answerdetail\get::by_item_id_answer($f, $search);

		if(!$result || !isset($result['answer_id']))
		{
			\dash\notif::error(T_("No data matched by this condition"));
			return false;
		}

		$answer_id = $result['answer_id'];


		$tag_list = \lib\app\form\tag\get::public_answer_tag($answer_id);

		if(!is_array($tag_list))
		{
			$tag_list = [];
		}

		\dash\data::tagList($tag_list);

		$comment_list = \lib\app\form\comment\get::public_comment($answer_id);

		\dash\data::commentList($comment_list);

		\dash\notif::ok(T_("Search complete"));

		return true;

	}



	private static function input_quiry($value, $_type)
	{
		echo '<form method="get" autocomplete="off" action="'.\dash\url::that().'">';
		echo '<input type="hidden" name="i" value="1">';
		echo '<input type="hidden" name="f" value="'. $value['id']. '">';
		echo '<label for="'. $value['id']. '" >';
		echo $value['title'];
		echo '</label>';

		echo '<div class="input">';
		echo '<input type="text" name="q" ';

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