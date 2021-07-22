<?php
namespace content_love\changelog\add;


class model
{
	public static function post()
	{
		$post =
		[
			'title'  => \dash\request::post_html(),
			'date'   => \dash\request::post('date'),
			'link'   => \dash\request::post('link'),
			'tag'    => \dash\request::post('tag'),
			'sendtg' => \dash\request::post('sendtg'),
		];

		if(\dash\data::editMode())
		{
			$id = \dash\app\changelog::edit($post, \dash\request::get('id'));

			\dash\redirect::pwd();
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
