<?php
namespace content_a\form\item;

class model
{
	public static function post()
	{
		$form_id = \dash\request::get('id');

		if(\dash\request::post('removeitem') === 'removeitem')
		{
			\lib\app\form\item\remove::remove(\dash\request::get('item'));

			if(\dash\engine\process::status())
			{
				\dash\redirect::to(\dash\url::this().'/edit?id='. \dash\request::get('id'));
			}
			return;
		}


		$all_post = \dash\request::post();

		$whole_edit = [];


		foreach ($all_post as $key => $value)
		{
			if(preg_match("/^item_(title|desc|filetype|color|type|require|checkrequire|maxlen|placeholder|choice|choiceinline|random|check_unique|min|max|choice|send_sms|sms_text|signup|defaultvalue|link|targetblank)_(\d+)$/", $key, $split))
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
				$value['type'] = \dash\data::itemDetail_type();
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