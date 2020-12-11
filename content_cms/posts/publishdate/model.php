<?php
namespace content_cms\posts\publishdate;

class model
{
	public static function post()
	{

		$post =
		[
			'publishdate'     => \dash\request::post('publishdate'),
			'publishtime'     => \dash\request::post('publishtime'),
			'set_publishdate' => 1,
		];

		if(\dash\request::post('PDT') === 'publishdatetypeonpublish')
		{
			$post =
			[
				'publishdate'     => null,
				'publishtime'     => null,
				'set_publishdate' => 1,
			];
		}


		if(!$post || !\dash\engine\process::status())
		{
			return false;
		}

		$post_detail = \dash\app\posts\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>
