<?php
namespace content_a\form\edit;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		if(\dash\request::post('removeitem') === 'removeitem')
		{
			\lib\app\form\item\remove::remove(\dash\request::post('id'));

			if(\dash\engine\process::status())
			{
				// \dash\redirect::pwd();
			}
			return;
		}



		$post =
		[
			'title'      => \dash\request::post('title'),
			'slug'       => \dash\request::post('slug'),
			'status'     => \dash\request::post('status'),
			'desc'       => \dash\request::post('desc') ? $_POST['desc'] : null,
			'endmessage' => \dash\request::post('endmessage'),
			'redirect'   => \dash\request::post('redirect'),

		];

		if(\dash\request::files('file'))
		{
			$post['file']   = \dash\upload\form::form($form_id);
		}

		$result = \lib\app\form\form\edit::edit($post, \dash\request::get('id'));

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
		}

		$form_id = \dash\request::get('id');

		$new_item =
		[
			'title'   => \dash\request::post('new_title'),
			'type'    => \dash\request::post('new_type'),
			'require' => \dash\request::post('new_require'),
		];


		if($new_item['title'])
		{
			\lib\app\form\item\add::add($new_item, $form_id);
			if(\dash\engine\process::status())
			{
				\dash\notif::clean();
			}
		}

		$sort = \dash\request::post('sort');
		if(!is_array($sort))
		{
			$sort = [];
		}


		$all_post = \dash\request::post();

		$whole_edit = [];

		foreach ($all_post as $key => $value)
		{
			if(preg_match("/^item_(title|desc|filetype|color|type|require|maxlen|placeholder|choice|choiceinline|random|check_unique|min|max|choice|send_sms|sms_text|signup)_(\d+)$/", $key, $split))
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
				$value['sort'] = array_search($key, $sort);
				\lib\app\form\item\edit::edit($value, $key, $form_id);
			}
		}

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Form items successfully edited"));
		}

		\dash\redirect::pwd();
	}
}
?>