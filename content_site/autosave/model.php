<?php
namespace content_site\autosave;

class model
{
	public static function post()
	{
		$post = [];

		if(\dash\request::post('autosave') === 'enable')
		{
			$post['force_stop_sitebuilder_auto_save'] = null;
		}
		elseif(\dash\request::post('autosave') === 'disable')
		{
			$post['force_stop_sitebuilder_auto_save'] = 1;
		}
		else
		{
			return;
		}

		\lib\app\store\edit::selfedit($post);
		\dash\redirect::pwd();
		return;
	}
}
?>