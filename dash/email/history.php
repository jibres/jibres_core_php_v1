<?php
namespace dash\email;

class history
{
	// use in search list
	private static $is_filtered    = false;


	/**
	 * Save email history before send
	 *
	 * @param      <type>  $_args  The arguments
	 */
	public static function set($_args)
	{
		// 'from' => string 'verify@jibres.store' (length=19)
		// 'to' => string 'Mr.Javad.Adib@gmail.com' (length=23)
		//
		// 'fromTitle' => string 'جیبرس' (length=10)
		// 'toTitle' => string 'Javad Adib' (length=10)
		//
		// 'subject' => string '[ جیبرس ] لطفا ایمیل خودتون رو تایید کنید' (length=72)
		// 'body' => string ''

		$insert                 = [];
		$insert['provider']     = null;
		$insert['from']         = a($_args, 'from');
		$insert['to']           = a($_args, 'to');
		$insert['subject']      = a($_args, 'subject');
		$insert['design']       = null;
		$insert['body']         = a($_args, 'body');
		$insert['template']     = null;
		$insert['status']       = 'send';
		$insert['user_id']      = \dash\user::id();
		$insert['ip_id']        = \dash\utility\ip::id();
		$insert['agent_id']     = \dash\agent::get(true);
		$insert['response']     = null;
		$insert['datesend']     = date("Y-m-d H:i:s");
		$insert['dateresponse'] = null;
		$insert['datecreated']  = date("Y-m-d H:i:s");
		$insert['datemodified'] = null;

		$log_id = \dash\db\crm_email\insert::new_record($insert);

	}

	public static function get($_id)
	{
		$id = \dash\validate::id($_id);
		if(!$id)
		{
			return false;
		}

		$load = \dash\db\crm_email\get::by_id($id);

		return $load;
	}

	/**
	 * Determines if filtered.
	 *
	 * @return     bool  True if filtered, False otherwise.
	 */
	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args)
	{

		$condition =
		[
			'order'  => 'order',
			'sort'   => 'string_50',
			'user'   => 'code',
			'status' => ['enum' => ['pending', 'sending', 'send', 'sended', 'delivered','queue','failed','undelivered','cancel','block','other']],
		];


		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$meta['join']  = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 10;



		if($data['user'])
		{
			$user_id = \dash\coding::decode($data['user']);
			if($user_id)
			{
				$and[] = " crm_email.user_id =  $user_id ";
				self::$is_filtered = true;
			}

		}

		if($data['status'])
		{
			$and[] = " crm_email.status =  '$data[status]' ";
			self::$is_filtered = true;
		}

		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " crm_email.subject LIKE '%$query_string%' ";
			$or[] = " crm_email.from LIKE '%$query_string%' ";
			$or[] = " crm_email.to LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\dash\app\posts\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order]";
			}
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY crm_email.id DESC ";
		}


		$list = \dash\db\crm_email\search::list($and, $or, $order_sort, $meta);


		return $list;
	}


}
?>
