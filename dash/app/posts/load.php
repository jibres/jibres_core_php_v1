<?php
namespace dash\app\posts;

class load
{
	/**
	 * Load post in website
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
}
?>