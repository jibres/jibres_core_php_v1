<?php
namespace content_my\business\ask;


class model
{
	public static function post()
	{
		if(\dash\request::post('skip') === 'skip')
		{
			// needless to check question
		}
		else
		{
			$polls = \lib\app\store\polls::all();

			$question_answer = [];

			if(isset($polls['questions']) && is_array($polls['questions']))
			{
				foreach ($polls['questions'] as $key => $question)
				{
					if(isset($question['id']))
					{
						$answer = \dash\validate::string_50(\dash\request::post($question['id']));
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

			\dash\session::set('createNewStore_question_answer', $question_answer, 'CreateNewStore');
		}
		\lib\app\store\timeline::set('ask');
		\dash\redirect::to(\dash\url::this(). '/subdomain');
		return;

	}
}
?>
