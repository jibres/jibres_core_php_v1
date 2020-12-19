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
		$cat_id     = a($_detail, 'value', 'news', 'cat_id');
		$tag_id     = a($_detail, 'value', 'news', 'tag_id');
		$subtype    = a($_detail, 'value', 'news', 'subtype');
		$limit      = a($_detail, 'value', 'limit');

		if(!$limit)
		{
			$limit = 5;
		}

		if(!$subtype)
		{
			$subtype = 'standard';
		}



		$args =
		[
			'pagination'   => 'n',
			'website_mode' => true,
			'type'         => 'post',
			'subtype'      => $subtype,
			'limit'        => $limit,
			'cat_id'       => $cat_id,
			'tag_id'       => $tag_id,
		];

		$list = \dash\app\posts\search::list(null, $args);

		$result              = [];
		$result['title']     = $line_title;
		$result['line_link'] = \dash\url::kindgom(). '/blog';
		$result['list']      = $list;

		return $result;
	}
}
?>