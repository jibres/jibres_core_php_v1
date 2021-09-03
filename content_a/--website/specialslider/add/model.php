<?php
namespace content_a\website\specialslider\add;

class model
{

	public static function post()
	{

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

		if(!\dash\data::specialsliderID())
		{
			$specialslider = \lib\app\website\body\line\specialslider::add($post);

			if(\dash\engine\process::status())
			{
				if(isset($specialslider['id']))
				{
					\dash\redirect::to(\dash\url::this(). '/specialslider?id='. $specialslider['id']);
				}
				else
				{
					// @BUG!
					\dash\redirect::to(\dash\url::this());
				}
			}

			return;
		}
		else
		{
			$specialslider = \lib\app\website\body\line\specialslider::edit($post, \dash\data::specialsliderID(), \dash\request::get('index'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/specialslider?id='. \dash\data::specialsliderID());
			}
		}
	}

}
?>
