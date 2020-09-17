<?php
namespace content_my\business\creating;


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

			$result = \lib\app\store\add::free($post);

			if(\dash\engine\process::status())
			{
				\dash\session::clean_cat('CreateNewStore');

				if(isset($result['subdomain']))
				{
					\dash\session::set('myNewStoreSubdomain', $result['subdomain']);
				}

				\lib\app\store\timeline::set('endcreate');

				if(isset($result['store_id']))
				{
					\dash\session::set('myNewStoreID', $result['store_id']);
					\lib\app\store\timeline::set_store_id($result['store_id']);
				}


				\dash\notif::direct();
				\dash\header::set(200);
				\dash\redirect::to(\dash\url::this().'/opening');
			}
			else
			{
				\dash\log::set('CreateNewStoreError', ['detail' => $post]);

				\dash\session::set('createNewStore_error', \dash\notif::get(), 'CreateNewStore');

				\dash\header::status(501, T_("Can not create your business!"));
				return false;
			}
		}
	}
}
?>
