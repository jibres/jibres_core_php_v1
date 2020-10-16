<?php
namespace content_my\business\ask;


class model
{
	public static function post()
	{
		$new_get = [];
		$new_get['st2'] = time();

		if(\dash\request::post('skip') === 'skip')
		{
			\dash\log::set('business_creatingNew', ['my_step' => 'ask', 'my_skip' => true]);
			// needless to check question
		}
		else
		{
			$polls = \lib\app\store\polls::all();

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

								$new_get[$question['id']] = $answer;
							}
						}
					}
				}
			}
		}

		\dash\log::set('business_creatingNew', ['my_step' => 'ask', 'my_skip' => false, 'my_answer' => $new_get]);

		\dash\redirect::to(\dash\url::this(). '/subdomain?'. \dash\request::fix_get($new_get));
		return;

	}
}
?>
