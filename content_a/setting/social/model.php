<?php
namespace content_a\setting\social;



class model
{
	public static function post()
	{
		$social                = [];
		$social['email']       = \dash\request::post('email');
		$social['sms']         = \dash\request::post('sms');
		$social['telegram']    = \dash\request::post('telegram');
		$social['facebook']    = \dash\request::post('facebook');
		$social['twitter']     = \dash\request::post('twitter');
		$social['instagram']   = \dash\request::post('instagram');
		$social['linkedin']    = \dash\request::post('linkedin');
		$social['sapp']        = \dash\request::post('sapp');
		$social['eitaa']       = \dash\request::post('eitaa');
		$social['aparat']      = \dash\request::post('aparat');


		$post                  = [];
		$post['socialnetwork'] = json_encode($social, JSON_UNESCAPED_UNICODE);

		\lib\db\stores::update($post, \lib\store::id());

		\dash\log::set('settingSocialUpdate');

		\lib\store::refresh();

		if(\dash\engine\process::status())
		{
			\dash\notif::ok(T_("Store social network detail updated"));
			\dash\redirect::pwd();
		}
	}
}
?>
