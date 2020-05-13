<?php
namespace content_a\website\body\image;

class model
{
	public static function post()
	{
		if(\dash\request::post('edit_line') === 'setting')
		{
			\content_a\website\body\edit\model::post();

			if(\dash\engine\process::status())
			{
				if(\dash\request::post('remove') === 'line')
				{
					\dash\redirect::to(\dash\url::that());
				}
			}

			return;
		}



		$post =
		[
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
			'alt'    => \dash\request::post('alt'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		if(!\dash\data::imageID())
		{
			$image = \lib\app\website\body\line\image::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($image['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/image?id='. $image['id']);
				}
				else
				{
					// @BUG!
					\dash\redirect::to(\dash\url::that());
				}
			}

			return;
		}
		else
		{
			$image = \lib\app\website\body\line\image::edit($post, \dash\data::imageID());

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/image?id='. \dash\data::imageID());
			}
		}
	}
}
?>
