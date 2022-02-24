<?php
namespace content_enter\verify\sendsms;


class view
{
	public static function config()
	{
		\content_enter\verify\view::verifyPageTitle();
		if(!\dash\utility\enter::get_session('sendsms_code_run'))
		{
			\content_enter\verify\sendsms\model::send_sendsms_code();
			\dash\utility\enter::set_session('sendsms_code_run', true);
		}

		if(\dash\utility\enter::get_session('sendsms_code'))
		{
			\dash\data::codeSend(\dash\utility\enter::get_session('sendsms_code'));
			\dash\data::codeSendView(\dash\data::codeSend());
			if(\dash\engine\store::inStore())
			{
				\dash\data::codeSendView(\lib\store::code_raw(). '-'. \dash\data::codeSend());
			}
			\dash\data::codeSendNum('+98 1000 2000 9');
			\dash\data::codeSendNumSMS('+98100020009');

			\dash\data::codeSendNumLtr(\dash\data::codeSendNum());

			if(\dash\language::current() === 'fa')
			{
				\dash\data::codeSendNumLtr('9 2000 1000 98+');
			}
			\dash\data::codeSendMsg(T_('Send ":code" to :num',
				[
					'code' => \dash\data::codeSend(),
					'num'  => '<b><code>'. \dash\data::codeSendNumLtr(). '</code></b>'
				]
				));

		}
	}
}
?>