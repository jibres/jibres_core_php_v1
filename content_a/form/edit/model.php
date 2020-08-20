<?php
namespace content_a\form\edit;

class model
{
	public static function post()
	{
		$post =
		[
			'title' => \dash\request::post('title'),
			'slug' => \dash\request::post('slug'),
		];

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		$form_id = \dash\request::get('id');

		$new_item =
		[
			'title'    => \dash\request::post('new_title'),
			'type'     => \dash\request::post('new_type'),
			'require' => \dash\request::post('new_required'),
		];


		if($new_item['title'])
		{
			\lib\app\form\item\add::add($new_item, $form_id);
		}

		$all_post = \dash\request::post();

		$whole_edit = [];
		foreach ($all_post as $key => $value)
		{
			if(preg_match("/^item_(title|type|require)_(\d+)$/", $key, $split))
			{
				if(!isset($whole_edit[$split[2]]))
				{
					$whole_edit[$split[2]] = [];
				}

				$whole_edit[$split[2]][$split[1]] = $value;
			}
		}

		if(!empty($whole_edit))
		{
			foreach ($whole_edit as $key => $value)
			{
				\lib\app\form\item\edit::edit($value, $key, $form_id);
			}
		}

		\dash\redirect::pwd();
	}
}
?>