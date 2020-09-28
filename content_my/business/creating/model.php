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
				// \dash\session::clean_cat('CreateNewStore');

				// if(isset($result['subdomain']))
				// {
				// 	\dash\session::set('myNewStoreSubdomain', $result['subdomain']);
				// }

				// \lib\app\store\timeline::set('endcreate');

				// if(isset($result['store_id']))
				// {
				// 	\dash\session::set('myNewStoreID', $result['store_id']);
				// 	\lib\app\store\timeline::set_store_id($result['store_id']);
				// }

				\dash\notif::direct();
				// \dash\header::set(200);
				$url = \dash\url::kingdom(). '/'. \dash\store_coding::encode($result['store_id']). '/a?'. \dash\request::fix_get(['bigopening' => 1]);
				\dash\redirect::to($url);
			}
			else
			{
				\dash\log::set('CreateNewStoreError', ['detail' => $post]);

				// \dash\session::set('createNewStore_error', \dash\notif::get(), 'CreateNewStore');
				\dash\notif::error(T_("Can not create your business!"));
				\dash\redirect::to(\dash\url::this());


				return false;
			}
		}
	}
}
?>
