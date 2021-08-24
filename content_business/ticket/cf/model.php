<?php
namespace content_business\ticket\cf;


class model
{
	public static function post()
	{
		$args            = [];
		$args['subtype'] = 'contact';
		$args['name']    = \dash\request::post('xun');
		$args['mobile']  = \dash\request::post('xum');
		$args['email']   = \dash\request::post('xue');
		$args['content'] = \dash\request::post('xuc');

		\dash\temp::set('tempTicketTitle', \dash\request::post('xut'));

		\dash\temp::set('skipp_ticket_load_page_time', true);

		\dash\app\ticket\contact::post($args);
	}
}
?>
