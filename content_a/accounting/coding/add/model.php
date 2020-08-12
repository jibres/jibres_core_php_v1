<?php
namespace content_a\accounting\coding\add;

class model
{

	public static function getPost()
	{
		$post =
		[
			'parent'        => \dash\request::post('parent'),
			'title'         => \dash\request::post('title'),
			'code'          => \dash\request::post('code'),
			'type'          => \dash\data::myType(),
			'nature'        => \dash\request::post('nature'),
			'detailable'    => \dash\request::post('detailable'),
			'status'        => \dash\request::post('status'),

			'class'         => \dash\request::post('class'),
			'topic'         => \dash\request::post('topic'),
			'naturecontrol' => \dash\request::post('naturecontrol'),
			'exchangeable'  => \dash\request::post('exchangeable'),
			'followup'      => \dash\request::post('followup'),
			'currency'      => \dash\request::post('currency'),
		];

		return $post;

	}


	public static function post()
	{

		$post = self::getPost();
		$result = \lib\app\tax\coding\add::add($post);


		if(\dash\engine\process::status())
		{

			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::that(). '/edit?id='. $result['id']. '&parent='. \dash\request::post('parent'));
			}
			else
			{
				\dash\redirect::to(\dash\url::that());
			}
		}
	}
}
?>
