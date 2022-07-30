<?php
namespace content_crm\sms\datalist;


class model
{
	public static function post()
    {
        if(\dash\request::post('status') === 'recend')
        {
            // recend sms
            \lib\app\sms\recend::all();
        }

        if(\dash\request::post('status') === 'archive')
        {
            // set status of sms as archive
            \lib\app\sms\recend::archive_all();
        }

        if(\dash\engine\process::status())
        {
            \dash\redirect::pwd();
        }

    }
}