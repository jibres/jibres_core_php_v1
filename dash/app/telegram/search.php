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
			'order'      => 'order',
			'sort'       => 'string_100',
			'pagination' => 'bit',
			'type'       => ['enum' => ['other']],
			'ext'       => 'string_100',
		];

		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);


		$and         = [];
		$meta        = [];
		$or          = [];


		if($data['type'])
		{
			if($data['type'] === 'other')
			{
				$and[] = " telegrams.type IN ('word','excel','powerpoint','code','text','file') ";
			}
			else
			{
				$and[] = " telegrams.type = '$data[type]' ";
			}

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


		$list = \dash\db\telegrams\search::list($and, $or, $order_sort, $meta);


		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\telegram\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}
}
?>