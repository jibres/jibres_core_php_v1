<?php
namespace content_cms\hashtag\edit;


class model
{
	public static function post()
	{



		$id = \dash\request::get('id');

		if(\dash\request::post('delete') === 'delete')
		{
			\dash\app\terms\remove::remove($id);

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this());
			}
			return;
		}


		$args          = [];
		$args['title'] = \dash\request::post('title');
		$args['url']   = \dash\request::post('url');

		$result = \dash\app\terms\edit::edit($args, $id);

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}

	}
}
?>