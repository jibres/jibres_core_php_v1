<?php
namespace content_api\v1\ticket;


class controller
{
	public static function routing()
	{
		\content_api\v1::invalid_url();
	}



	/**
	 *
		********************************************************************* Ticket
		>> ticket/list ------------------------------------------------------ ??
		>> ticket/add ------------------------ Ready
		>> ticket/add/bug
		>> ticket/add/feedback
		>> ticket/add/contact
		>> ticket/{TICKET} ------------------- Ready
		>> ticket/{TICKET}/attachment -------- Ready
		>> ticket/{TICKET}/reply ------------- Ready
		>> ticket/{TICKET}/close ------------- Ready
		>> ticket/{TICKET}/status ------------ Ready
		>> ticket/{TICKET}/solved ------------ Ready
	 */
	public static function api_routing()
	{
		$detail    = [];

		\content_api\v1::apikey_required();

		$dir_3     = \dash\url::dir(3);

		$ticket_id = \dash\coding::decode($dir_3);

		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_api\v1::invalid_method();
			}

			self::ticket_list();
		}
		elseif($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_api\v1::invalid_url();
			}

			if(!\dash\request::is('post'))
			{
				\content_api\v1::invalid_method();
			}

			self::ticket_add();
		}
		elseif($ticket_id && is_numeric($ticket_id) && intval($ticket_id) > 0 && !\dash\number::is_larger($ticket_id, 9999999999))
		{

		}
		else
		{
			\content_api\v1::invalid_url();
		}
	}


	private static function ticket_list()
	{
		\content_support\ticket\home\view::load_ticket_list();
		$ticket_list = \dash\data::dataTable();
		\content_api\v1::say($ticket_list);
	}


	private static function ticket_add()
	{
		// $via     = 'api';
		$via     = null;
		$content = \content_api\v1::input_body('content');
		$title   = \content_api\v1::input_body('title');
		$file    = null;
		$result  = \content_support\ticket\add\model::add_new($via, $content, $file, $title);

		\content_api\v1::say($result);
	}

}
?>