<?php
namespace content\bug;


class model extends \content_support\ticket\contact_ticket\model
{
	public static function post()
	{
		$args            = [];
		$args['name']    = \dash\request::post('iu1');
		$args['mobile']  = \dash\request::post('xum');
		$args['email']   = \dash\request::post('wue');
		$args['content'] = \dash\request::post('title'). "\n". \dash\request::post('content');

		\dash\temp::set('tempTicketTitle', T_("Bug"));
		parent::post($args);
	}
}
?>
