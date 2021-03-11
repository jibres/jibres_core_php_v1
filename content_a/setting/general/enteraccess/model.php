<?php
namespace content_a\setting\general\enteraccess;


class model
{
	public static function post()
	{
		$post               = [];

		$post = [];

		if(\dash\request::post('set_enterdisallow'))
		{
			$post['enterdisallow'] = \dash\request::post('enterdisallow') ? null : 1;
			if($post['enterdisallow'])
			{
				$post['entersignupdisallow'] = 1;
			}
		}

		if(\dash\request::post('set_entersignupdisallow'))
		{
			$post['entersignupdisallow'] = \dash\request::post('entersignupdisallow') ? null : 1;
		}

		if(empty($post))
		{
			\dash\notif::error(T_("Invalid request"));
			return false;
		}

		\lib\app\store\edit::selfedit($post);

		\dash\redirect::pwd();
	}


}
?>