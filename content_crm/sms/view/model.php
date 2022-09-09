<?php
namespace content_crm\sms\view;


class model
{
    public static function post()
    {
        if(\dash\request::post('status') === 'resend')
        {
            // resend sms
            \lib\app\sms\resend::one(\dash\request::get('id'));
        }

        if(\dash\request::post('status') === 'archive')
        {
            // set status of sms as archive
            \lib\app\sms\edit::edit(['status' => 'cancel'], \dash\request::get('id'));
        }

        if(\dash\engine\process::status())
        {
            \dash\redirect::pwd();
        }

    }
}
