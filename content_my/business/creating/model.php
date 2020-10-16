<?php
namespace content_my\business\creating;


class model
{
	public static function post()
	{
		if(\dash\request::post('create') === 'store')
		{
			\lib\app\store\timeline::set('startcreate');

			$title           = \dash\request::get('title');
			$subdomain       = \dash\request::get('subdomain');

			$question_answer = [];
			if(\dash\request::get('Q1'))
			{
				$question_answer['Q1'] = \dash\request::get('Q1');
			}

			if(\dash\request::get('Q2'))
			{
				$question_answer['Q2'] = \dash\request::get('Q2');
			}

			if(\dash\request::get('Q3'))
			{
				$question_answer['Q3'] = \dash\request::get('Q3');
			}

			if(\dash\request::get('st1'))
			{
				$question_answer['st1'] = \dash\request::get('st1');
			}

			if(\dash\request::get('st2'))
			{
				$question_answer['st2'] = \dash\request::get('st2');
			}

			if(\dash\request::get('st3'))
			{
				$question_answer['st3'] = \dash\request::get('st3');
			}

			$question_answer['st4'] = time();

			$post =
			[
				'title'     => $title,
				'subdomain' => $subdomain,
				'answer'    => $question_answer,
			];

			\dash\temp::set('clesnse_not_end_with_error', true);

			$result = \lib\app\store\add::free($post);

			if(\dash\engine\process::status() && isset($result['store_id']))
			{
				\dash\notif::direct();
				$url = \dash\url::kingdom(). '/'. \dash\store_coding::encode($result['store_id']). '/a?'. \dash\request::fix_get(['bigopening' => 1]);
				\dash\redirect::to($url);
			}
			else
			{
				\dash\log::set('business_creatingNew', ['my_step' => 'creating', 'my_error' => true, 'my_data' => $post]);
				\dash\log::oops('CreateNewStoreError');
				\dash\redirect::to(\dash\url::this());
				return false;
			}
		}
	}
}
?>
