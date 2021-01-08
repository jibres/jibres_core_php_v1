<?php
namespace dash\app\posts;

class search
{

	private static $is_filtered    = false;


	public static function is_filtered()
	{
		return self::$is_filtered;
	}


	public static function list($_query_string, $_args, $_force = false)
	{
		if($_force)
		{
			// not check permission because request from website
		}
		else
		{
			\dash\permission::access('_group_cms');
		}


		$condition =
		[
			'order'        => 'order',
			'sort'         => ['enum' => ['title',]],
			'subtype'      => ['enum' => ['standard', 'gallery', 'video', 'audio']],
			'status'       => ['enum' => ['publish', 'draft', 'deleted']],
			'user_code'    => 'code',
			'type'         => ['enum' => ['post', 'page', 'help']],
			'parent'       => 'string_100',
			'language'     => 'language',
			'limit'        => 'int',
			'cat_id'       => 'code',
			'tag_id'       => 'code',
			'website_mode' => 'bit',
			'pagination'   => 'y_n',

			'multi_tag_search' => 'string_1000',
			'not_current_id'       => 'id',

			'pd'           => 'bit', // publish date in the future
			'g'            => 'y_n', // with gallery
			'fi'           => 'y_n', // feautred image. thumb
			'co'           => 'y_n', // cover
			'seo'          => ['enum' => ['full']],
			'sa'           => ['enum' => ['n', 'y', 'yt', 'yp']], // special address
			'com'          => 'y_n', // comment
			't'            => 'y_n', // tag
			'r'            => 'bit', // redirecturl

		];


		$require = [];
		$meta    =	[];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$and           = [];
		$meta          = [];
		$meta['join']  = [];
		$or            = [];
		$order_sort    = null;
		$meta['limit'] = 15;

		if($data['pagination'] === 'n')
		{
			$meta['pagination'] = false;
		}

		if($data['limit'])
		{
			$meta['limit'] = $data['limit'];
		}

		if($data['type'])
		{
			$and[] = " posts.type =  '$data[type]' ";
		}

		if($data['subtype'])
		{
			$and[] = " posts.subtype =  '$data[subtype]' ";
		}

		if($data['language'])
		{
			$and[] = " posts.language =  '$data[language]' ";
		}

		if($data['status'])
		{
			$and[] = " posts.status =  '$data[status]' ";
			self::$is_filtered = true;
		}
		else
		{
			$and[] = " posts.status !=  'deleted' ";
		}


		if($data['tag_id'])
		{
			$data['tag_id'] = \dash\coding::decode($data['tag_id']);

			if($data['tag_id'])
			{
				$and[]   = " termusages.term_id =  $data[tag_id] ";
				$meta['join']['join_on_termusages'] = " INNER JOIN termusages ON termusages.post_id = posts.id ";
			}
		}

		if($data['multi_tag_search'])
		{
			$and[]   = " termusages.term_id IN ($data[multi_tag_search]) ";
			$meta['join']['join_on_termusages'] = " INNER JOIN termusages ON termusages.post_id = posts.id ";
		}

		if($data['not_current_id'])
		{
			$and[] = " posts.id != $data[not_current_id] ";
		}


		if($data['website_mode'])
		{
			$now = date("Y-m-d H:i:s");
			$and[] = " posts.publishdate <= '$now' ";
			$order_sort = " ORDER BY posts.publishdate DESC";
		}


		if($data['t'] === 'y')
		{
			$and[]   = " termusages.term_id IS NOT NULL ";
			$meta['join']['join_on_termusages'] = " INNER JOIN termusages ON termusages.post_id = posts.id ";
			self::$is_filtered = true;
		}
		elseif($data['t'] === 'n')
		{
			$and[]   = " termusages.term_id IS NULL ";
			$meta['join']['join_on_termusages'] = " LEFT JOIN termusages ON termusages.post_id = posts.id ";
			self::$is_filtered = true;
		}


		if($data['pd'])
		{
			$now = date("Y-m-d H:i:s");
			$and[] = " posts.publishdate >= '$now' ";
			$and[] = " posts.status = 'publish' ";
			self::$is_filtered = true;
		}

		if($data['g'] === 'y')
		{
			$and[] = " posts.gallery IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['g'] === 'n')
		{
			$and[] = " posts.gallery IS NULL ";
			self::$is_filtered = true;
		}


		if($data['fi'] === 'y')
		{
			$and[] = " posts.thumb IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['fi'] === 'n')
		{
			$and[] = " posts.thumb IS NULL ";
			self::$is_filtered = true;
		}


		if($data['com'] === 'y')
		{
			$and[] = " posts.comment = 'open' ";
			self::$is_filtered = true;
		}
		elseif($data['com'] === 'n')
		{
			$and[] = " ( posts.comment = 'close' OR posts.comment IS NULL)  ";
			self::$is_filtered = true;
		}


		if($data['co'] === 'y')
		{
			$and[] = " posts.cover IS NOT NULL ";
			self::$is_filtered = true;
		}
		elseif($data['co'] === 'n')
		{
			$and[] = " posts.cover IS NULL ";
			self::$is_filtered = true;
		}

		if($data['seo'] === 'full')
		{
			$and[] = " posts.excerpt IS NOT NULL ";
			$and[] = " posts.specialaddress != 'independence' ";
			self::$is_filtered = true;
		}


		if($data['r'])
		{
			$and[] = " posts.redirecturl IS NOT NULL ";
			self::$is_filtered = true;
		}


		if($data['sa'] === 'n')
		{
			$and[] = " posts.specialaddress = 'independence' ";
			self::$is_filtered = true;
		}
		elseif($data['sa'] === 'y')
		{
			$and[] = " posts.specialaddress = 'special' ";
			self::$is_filtered = true;
		}
		elseif($data['sa'] === 'yt')
		{
			$and[] = " posts.specialaddress = 'under_tag' ";
			self::$is_filtered = true;
		}
		elseif($data['sa'] === 'yp')
		{
			$and[] = " posts.specialaddress = 'under_page' ";
			self::$is_filtered = true;
		}


		$query_string = \dash\validate::search($_query_string, false);

		if($query_string)
		{
			$or[] = " posts.title LIKE '%$query_string%' ";

			self::$is_filtered = true;
		}


		if($data['sort'] && !$order_sort)
		{
			$order_sort = " ORDER BY $data[sort] $data[order]";
		}

		if(!$order_sort)
		{
			$order_sort = " ORDER BY posts.id DESC ";
		}

		$list = \dash\db\posts\search::list($and, $or, $order_sort, $meta);

		if(is_array($list))
		{
			$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);
		}
		else
		{
			$list = [];
		}

		return $list;
	}


	public static function random_help_center()
	{
		$language = \dash\language::current();
		$list = \dash\db\posts\search::random_help_center($language);
		if(!is_array($list))
		{
			$list = [];
		}
		$list = array_map(['\\dash\\app\\posts\\ready', 'row'], $list);

		return $list;

	}

	public static function blog_page($_subtype)
	{
		$args =
		[
			'subtype'      => $_subtype,
			'website_mode' => true

		];
		$list = self::list(null, $args, true);
		return $list;
	}




	public static function api_lates_post($_args = [])
	{

		$_args['website_mode'] = true;
		$_args['status']       = 'publish';

		$list = self::list(null, $_args, true);

		return $list;
	}



	public static function lates_post($_args = [])
	{
		if(!isset($_args['limit']))
		{
			$_args['limit'] = 5;
		}

		$_args['pagination'] = 'n';
		$_args['status'] = 'publish';

		$list = self::list(null, $_args, true);

		return $list;
	}


	public static function similar_post($_post_id)
	{
		$post_id = \dash\coding::decode($_post_id);
		if(!$post_id)
		{
			return null;
		}


		$load_post_term =
		"
			SELECT
				terms.id AS `id`
			FROM
				posts
			INNER JOIN termusages ON termusages.post_id = posts.id
			INNER JOIN terms ON terms.id = termusages.term_id
			WHERE
				posts.id = $post_id
			LIMIT 20
		";

		$post_term = \dash\db::get($load_post_term, 'id');
		if(empty($post_term))
		{
			return null;
		}

		$multi_tag_search = implode(',', $post_term);

		$args                     = [];
		$args['pagination']       = 'n';
		$args['status']           = 'publish';
		$args['website_mode']     = 1;
		$args['multi_tag_search'] = $multi_tag_search;
		$args['not_current_id']   = $post_id;

		return self::list(null, $args, true);

	}

}
?>
