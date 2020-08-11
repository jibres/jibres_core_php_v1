<?php
namespace content_a\setting\telegram\telegrambtn;


class model
{
	public static function post()
	{
		$post           = [];
		$post['instagram'] = \dash\request::post('instagram');
		$post['telegram']  = \dash\request::post('telegram');
		$post['youtube']   = \dash\request::post('youtube');
		$post['twitter']   = \dash\request::post('twitter');
		$post['linkedin']  = \dash\request::post('linkedin');
		$post['github']    = \dash\request::post('github');
		$post['facebook']  = \dash\request::post('facebook');
		$post['aparat']    = \dash\request::post('aparat');
		$post['eitaa']     = \dash\request::post('eitaa');

  		$args['telegrambtn'] = [$post];


		\lib\app\setting\set::telegram_setting($args);

		\dash\redirect::pwd();
	}
}
?>