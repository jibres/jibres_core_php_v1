<?php
namespace content_love\changelog\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title'  => \dash\request::post('html'),
			'date'   => \dash\request::post('date'),
			'link'   => \dash\request::post('link'),
			'tag'    => \dash\request::post('tag'),
			'sendtg' => \dash\request::post('sendtg'),
		];

		if(\dash\data::editMode())
		{
			if(\dash\request::post('remove') === 'remove')
			{
				\dash\app\changelog::remove(\dash\request::get('id'));
				\dash\redirect::to(\dash\url::this());
			}
			else
			{
				$id = \dash\app\changelog::edit($post, \dash\request::get('id'));

				\dash\redirect::to(\dash\url::this());
			}
		}
		else
		{
			$id = \dash\app\changelog::add($post);

			if($id)
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. $id);
			}
		}



	}
}
?>
