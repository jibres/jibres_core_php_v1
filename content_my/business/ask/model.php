<?php
namespace content_my\business\ask;


class model
{
	public static function post()
	{
		$data = [];
		$data['st2'] = time();

		$my_skip = false;
		if(\dash\request::post('skip') === 'skip')
		{
			$my_skip = true;
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

								$data[$question['id']] = $answer;
							}
						}
					}
				}
			}
		}


		$business_token = \content_my\business\creating::cross_step('ask', $data);

		\dash\log::set('business_creatingNew', ['my_step' => 'ask', 'my_skip' => $my_skip, 'my_answer' => $data]);

		\dash\redirect::to(\dash\url::this(). '/subdomain');

		return;

	}
}
?>
