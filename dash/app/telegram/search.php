<?php
namespace dash\app\telegram;


class search
{
	private static $is_filtered    = false;



	public static function is_filtered()
	{
		return self::$is_filtered;
	}




	public static function list($_query_string = null, $_args = [])
	{
		$condition =
		[
			'order'        => 'order',
			'sort'         => 'string_100',
			'pagination'   => 'bit',
			'chatid'       => 'string_100',
			'conversation' => 'bit',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];


		if($data['chatid'])
		{
			$and[] = " telegrams.chatid = '$data[chatid]' ";

			self::$is_filtered = true;
		}

		$meta['limit'] = 15;

		if(array_key_exists('pagination', $_args) && $_args['pagination'] === false)
		{
			$meta['pagination'] = false;
		}

		$order_sort  = null;


		$query_string = \dash\validate::search($_query_string, false);


		if($query_string)
		{
			$filename_search = true;
			if(substr($query_string, 0, 1) === '.' && strpos($query_string, ' ') === false && mb_strlen($query_string) > 3)
			{
				$ext = substr($query_string, 1);
				if(\dash\upload\extentions::is_ext($ext))
				{
					$and[] = " telegrams.ext = '$ext' ";
					$filename_search = false;
				}
			}

			if($filename_search)
			{
				$or[]        = " telegrams.filename LIKE '%$query_string%'";
			}

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			if(\dash\app\telegram\filter::check_allow($data['sort'], $data['order']))
			{
				$order_sort = " ORDER BY $data[sort] $data[order] ";
			}

		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY telegrams.id DESC";
		}

		if($data['conversation'])
		{
			$list = \dash\db\telegrams\search::conversation_list($and, $or, $order_sort, $meta);
		}
		else
		{
			$list = \dash\db\telegrams\search::list($and, $or, $order_sort, $meta);
		}


		if(is_array($list))
		{

			$all_chatid = array_column($list, 'chatid');
			$all_chatid = array_filter($all_chatid);
			$all_chatid = array_unique($all_chatid);
			if($all_chatid)
			{
				self::load_user_detail_chatid($list, $all_chatid);
			}

			$list = array_map(['\\dash\\app\\telegram\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}


		return $list;
	}


	private static function load_user_detail_chatid(&$list, $all_chatid)
	{
		$load_user_detail_chatid = \dash\db\user_telegram\get::load_user_detail_chatid($all_chatid);
		if(!is_array($load_user_detail_chatid))
		{
			$load_user_detail_chatid = [];
		}

		if(!$load_user_detail_chatid)
		{
			return;
		}

		$load_user_detail_chatid = array_map(['\\dash\\app', 'fix_avatar'], $load_user_detail_chatid);

		$load_user_detail_chatid = array_combine(array_column($load_user_detail_chatid, 'chatid'), $load_user_detail_chatid);

		foreach ($list as $key => $value)
		{
			if(isset($value['chatid']) && isset($load_user_detail_chatid[$value['chatid']]))
			{
				$list[$key]['user_detail'] = $load_user_detail_chatid[$value['chatid']];
			}
		}

	}
}
?>