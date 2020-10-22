<?php
namespace content_a\form\home;


class model
{
	public static function post()
	{

		if(\dash\request::post('findanswerid') === 'findanswerid')
		{
			$aid = \dash\validate::id(\dash\request::post('aid'), true, ['element' => 'aid', 'field_title' =>  T_("Answer id")]);
			if(!$aid)
			{
				\dash\notif::error(T_("Please enter the answer id to load detail"), 'aid');
				return false;
			}

			$load_answer_detail = \lib\app\form\answer\get::by_id($aid);
			if(!$load_answer_detail || !isset($load_answer_detail['form_id']) || !isset($load_answer_detail['id']))
			{
				return false;
			}

			$url = \dash\url::this(). '/answer/detail?id='. $load_answer_detail['form_id']. '&aid='. $aid;
			\dash\redirect::to($url);

		}
	}
}
?>