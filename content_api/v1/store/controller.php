<?php
namespace content_api\v1\store;


class controller
{
	public static function routing()
	{
		\content_api\v1\tools::invalid_url();
	}

	public static function api_routing()
	{

		$detail    = [];

		$directory = \dash\url::directory();

		\content_api\v1\tools::appkey_required();

		if($directory === 'v1/store/add')
		{

			\content_api\v1\tools::apikey_required();

			if(\dash\request::is('post'))
			{
				$detail = self::new_store();
			}
			else
			{
				\content_api\v1\tools::invalid_method();
			}
		}
		elseif($directory === 'v1/store/question')
		{
			$detail = \lib\app\store\polls::all();
		}
		else
		{
			\content_api\v1\tools::invalid_url();
		}

		\content_api\v1\tools::say($detail);
	}



	private static function new_store()
	{
		$post              = [];
		$post['title']     = \content_api\v1\tools::input_body('title');
		$post['subdomain'] = \content_api\v1\tools::input_body('subdomain');

		$polls = \lib\app\store\polls::all();

		$question_answer = [];

		if(isset($polls['questions']) && is_array($polls['questions']))
		{
			foreach ($polls['questions'] as $key => $question)
			{
				if(isset($question['id']))
				{
					$answer = \content_api\v1\tools::input_body($question['id']);
					if($answer && is_string($answer))
					{
						if(isset($question['items']) && is_array($question['items']))
						{
							$allow_key = array_keys($question['items']);
							if(!in_array($answer, $allow_key))
							{
								\dash\notif::error(T_("Please select one itme"), $question['id']);
								return false;
							}

							$question_answer[$question['id']] = $answer;
						}
					}
				}
			}
		}

		$post['answer']    = $question_answer;

		\lib\app\store\timeline::set('start');
		\lib\app\store\timeline::set('startcreate');

		$result = \lib\app\store\add::free($post);

		\lib\app\store\timeline::set('endcreate');

		if(isset($result['store_id']))
		{
			\lib\app\store\timeline::set_store_id($result['store_id']);
			unset($result['store_id']);
		}

		return $result;
	}
}
?>