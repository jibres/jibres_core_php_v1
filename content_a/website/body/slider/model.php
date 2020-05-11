<?php
namespace content_a\website\body\slider;

class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'slider')
		{
			$slider = \lib\app\website\body\line\slider::remove(\dash\data::sliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/slider?id='. \dash\data::sliderID());
			}

			return;
		}


		$post =
		[
			'url'    => \dash\request::post('url'),
			'target' => \dash\request::post('target'),
			'alt'    => \dash\request::post('alt'),
			'sort'   => \dash\request::post('sort'),
		];

		if(\dash\request::files('image'))
		{
			$post['image'] = 'image';
		}

		if(!\dash\data::sliderID())
		{
			$slider = \lib\app\website\body\line\slider::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($slider['id']))
				{
					\dash\redirect::to(\dash\url::that(). '/slider?id='. $slider['id']);
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
			$slider = \lib\app\website\body\line\slider::edit($post, \dash\data::sliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::that(). '/slider?id='. \dash\data::sliderID());
			}
		}
	}
}
?>
