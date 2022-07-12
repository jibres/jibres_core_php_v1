<?php
namespace content_love\portfolio\add;


class model
{
	public static function post()
	{
		if(\dash\request::post('deletefile') === 'image')
		{
			\dash\app\portfolio::edit(['image' => null], \dash\request::get('id'));

			\dash\redirect::pwd();

			return;
		}

		if(\dash\request::post('deletefile') === 'thumb')
		{
			\dash\app\portfolio::edit(['thumb' => null], \dash\request::get('id'));

			\dash\redirect::pwd();

			return;
		}

		$post =
		[
			'title'    => \dash\request::post('title'),
			'industry' => \dash\request::post('industry'),
			'url'      => \dash\request::post('url'),
			'sort'     => \dash\request::post('sort'),
			'language' => \dash\request::post('language'),
			'store_id' => \dash\request::post('store_id'),
			'desc'     => \dash\request::post('desc'),
			'tag'      => \dash\request::post('tag'),
			'status'   => \dash\request::post('status'),
		];

		if($thumb = \dash\upload\quick::upload('thumb'))
		{
			$post['thumb'] = $thumb;
		}

		if($image = \dash\upload\quick::upload('image'))
		{
			$post['image'] = $image;
		}

		if(\dash\data::editMode())
		{
			if(\dash\request::post('remove') === 'remove')
			{
				\dash\app\portfolio::remove(\dash\request::get('id'));
				\dash\redirect::to(\dash\url::this());
			}
			else
			{
				$id = \dash\app\portfolio::edit($post, \dash\request::get('id'));

				\dash\redirect::pwd();
			}
		}
		else
		{
			$id = \dash\app\portfolio::add($post);

			if($id)
			{
				\dash\redirect::to(\dash\url::this(). '/edit?id='. $id);
			}
		}



	}
}
?>
