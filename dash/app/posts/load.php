<?php
namespace dash\app\posts;

class load
{
	/**
	 * Load post in website
	 *
	 * NEED REMOVE AFTER COMPLATE SITEBUILDER
	 *
	 * @param      <type>         $_detail  The detail
	 *
	 * @return     array|boolean  ( description_of_the_return_value )
	 */
	public static function template($_detail)
	{
		$line_title = a($_detail, 'value', 'title');
		$tag_id     = a($_detail, 'value', 'tag_id');
		$subtype    = a($_detail, 'value', 'subtype');
		$limit      = a($_detail, 'value', 'limit');
		$line_link  = a($_detail, 'value', 'line_link');

		if(!$limit)
		{
			$limit = 5;
		}

		if(!$subtype || $subtype === 'any')
		{
			$subtype = null;
		}

		if(!$line_link && $tag_id)
		{
			$load_tag = \dash\app\terms\get::get($tag_id, true);
			if(isset($load_tag['link']))
			{
				$line_link = $load_tag['link'];
			}
		}

		$args =
		[
			'pagination'   => 'n',
			'website_mode' => true,
			'subtype'      => $subtype,
			'limit'        => $limit,
			'tag_id'       => $tag_id,
		];

		$list = \dash\app\posts\search::list(null, $args, true);

		$result              = [];
		$result['title']     = $line_title;
		$result['line_link'] = $line_link;
		$result['list']      = $list;

		return $result;
	}



	/**
	 * Load post by some condition
	 *
	 * @param      <type>  $_detail  The detail
	 *
	 * @return     array   ( description_of_the_return_value )
	 */
	public static function sitebuilder_template($_detail)
	{

		$tag_id            = $_detail['tag_id'];
		$subtype           = $_detail['subtype'];
		$limit             = $_detail['limit'];

		$post_show_author  = $_detail['post_show_author'];
		$btn_viewall_check = $_detail['btn_viewall_check'];

		$link              = null;

		if(!$limit)
		{
			$limit = 5;
		}

		if(!$subtype || $subtype === 'any')
		{
			$subtype = null;
		}

		if($tag_id)
		{
			$load_tag = \dash\app\terms\get::get($tag_id, true);

			if(isset($load_tag['link']))
			{
				$link = $load_tag['link'];
			}
		}

		$args =
		[
			'pagination'   => 'n',
			'website_mode' => true,
			'subtype'      => $subtype,
			'limit'        => $limit,
			'tag_id'       => $tag_id,
		];

		$list = \dash\app\posts\search::list(null, $args, true);

		$result         = [];
		$result['link'] = $link;
		$result['list'] = $list;

		return $result;
	}
}
?>