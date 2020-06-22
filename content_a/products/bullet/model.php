<?php
namespace content_a\products\bullet;


class model
{

	public static function post()
	{
		$id             = \dash\request::get('id');

		if(\dash\request::post('type') === 'remove')
		{
			$result = \lib\app\product\bullet::set([], $id, 'remove', \dash\request::post('index'));
			if($result && \dash\engine\process::status())
			{
				\dash\redirect::pwd();
			}
			return;
		}


		$post           = [];

		$post['bullet'] = \dash\request::post('bullet');

		if(\dash\data::editMode())
		{
			$result = \lib\app\product\bullet::set($post, $id, 'edit', \dash\data::bulletIndex());
			if($result && \dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this(). '/bullet?id='. $id);
			}
		}
		else
		{
			$result = \lib\app\product\bullet::set($post, $id, 'add');
		}

		if($result && \dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}

}
?>