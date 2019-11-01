<?php
namespace content_store\creating;


class model
{
	public static function post()
	{
		if(\dash\request::post('create') === 'store')
		{
			\lib\app\store\timeline::set('startcreate');

			$title           = \dash\session::get('createNewStore_title', 'CreateNewStore');
			$subdomain       = \dash\session::get('createNewStore_subdomain', 'CreateNewStore');
			$question_answer = \dash\session::get('createNewStore_question_answer', 'CreateNewStore');

			$post =
			[
				'title'     => $title,
				'subdomain' => $subdomain,
				'answer'    => $question_answer,
			];

			$result = \lib\app\store\add::trial($post);

			if(\dash\engine\process::status())
			{
				\dash\session::clean_cat('CreateNewStore');

				\dash\session::set('myNewStoreSubdomain', $subdomain);

				\lib\app\store\timeline::set('endcreate');

				if(isset($result['store_id']))
				{
					\dash\session::set('myNewStoreID', $result['store_id']);
					\lib\app\store\timeline::set_store_id($result['store_id']);
				}


				\dash\notif::direct();
				\dash\redirect::to(\dash\url::here().'/opening');
			}
			else
			{
				return false;
			}
		}
	}
}
?>
