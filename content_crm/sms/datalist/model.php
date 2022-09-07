<?php
namespace content_crm\sms\datalist;


class model
{
	public static function post()
    {
        if(\dash\request::post('status') === 'resend')
        {
            // resend sms
            \lib\app\sms\resend::all();
        }

        if(\dash\request::post('status') === 'archive')
        {
            // set status of sms as archive
            \lib\app\sms\resend::archive_all();
        }

        if(\dash\engine\process::status())
        {
            \dash\redirect::pwd();
        }

    }
}