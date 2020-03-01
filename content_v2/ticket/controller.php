<?php
namespace content_v2\ticket;


class controller
{
	public static function routing()
	{
		\content_v2\tools::invalid_url();
	}


	public static function api_routing()
	{
		$detail    = [];

		\content_v2\tools::apikey_required();

		$dir_3     = \dash\url::dir(3);
		$ticket_id = $dir_3;


		if($dir_3 === 'list')
		{
			if(\dash\url::dir(4))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('get'))
			{
				\content_v2\tools::invalid_method();
			}

			self::ticket_list();
		}
		elseif($dir_3 === 'add')
		{
			if(\dash\url::dir(4))
			{
				\content_v2\tools::invalid_url();
			}

			if(!\dash\request::is('post'))
			{
				\content_v2\tools::invalid_method();
			}

			self::ticket_add();
		}
		elseif($ticket_id && is_numeric($ticket_id) && intval($ticket_id) > 0 && !\dash\number::is_larger($ticket_id, 9999999999))
		{
			if(!\dash\url::dir(4))
			{
				if(!\dash\request::is('get'))
				{
					\content_v2\tools::invalid_method();
				}

				self::get_ticket($ticket_id);
			}
			elseif(in_array(\dash\url::dir(4), ['attachment','replay','status','solved']))
			{
				$dir_4 = \dash\url::dir(4);

				if(\dash\url::dir(5))
				{
					\content_v2\tools::invalid_url();
				}

				if($dir_4 === 'replay')
				{
					if(!\dash\request::is('post'))
					{
						\content_v2\tools::invalid_method();
					}
					self::ticket_replay($ticket_id);
				}
				elseif($dir_4 === 'status')
				{
					if(!\dash\request::is('put'))
					{
						\content_v2\tools::invalid_method();
					}
					self::ticket_status($ticket_id);
				}
				elseif($dir_4 === 'solved')
				{
					if(!\dash\request::is('put'))
					{
						\content_v2\tools::invalid_method();
					}
					self::ticket_solved($ticket_id);
				}
				else
				{
					\content_v2\tools::invalid_url();
				}
			}
			else
			{
				\content_v2\tools::invalid_url();
			}
		}
		else
		{
			\content_v2\tools::invalid_url();
		}
	}


	private static function ticket_status($_tiket_id)
	{
		$status = \content_v2\tools::input_body('status');
		$result = \content_support\ticket\show\model::change_status($_tiket_id, $status);
		\content_v2\tools::say($result);
	}


	private static function ticket_solved($_tiket_id)
	{
		$solved = \content_v2\tools::input_body('solved');
		$result = \content_support\ticket\show\model::save_solved($_tiket_id, $solved);
		\content_v2\tools::say($result);
	}


	private static function get_ticket($_tiket_id)
	{
		\content_support\ticket\show\view::load_tichet($_tiket_id);
		$ticket_list                    = \dash\data::dataTable();
		\content_v2\tools::say($ticket_list);
	}


	private static function ticket_list()
	{
		\content_support\ticket\home\view::load_ticket_list();
		$ticket_list = \dash\data::dataTable();
		\content_v2\tools::say($ticket_list);
	}

	private static function ticket_replay($_tiket_id)
	{
		// $via     = 'api';
		$via     = null;
		$content = \content_v2\tools::input_body('content');
		$result = \content_support\ticket\show\model::answer_save($_tiket_id, $content, $_type = 'ticket', $_send_message = false);
		\content_v2\tools::say($result);
	}


	private static function ticket_add()
	{
		// $via     = 'api';
		$via     = null;
		$content = \content_v2\tools::input_body('content');
		$title   = \content_v2\tools::input_body('title');
		$file    = null;
		$result  = \content_support\ticket\add\model::add_new($via, $content, $file, $title);

		\content_v2\tools::say($result);
	}

}
?>