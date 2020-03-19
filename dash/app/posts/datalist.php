<?php
namespace dash\app\posts;

trait datalist
{
	public static $sort_field =
	[
		'id',
		'title',
		'slug',
		'publishdate',
		'status',
		'commentcount',
	];

	public static function random_post($_args = [])
	{
		$_args['order_raw'] = "RAND()";
		return self::list(null, $_args);
	}

	/**
	 * Gets the course.
	 *
	 * @param      <type>  $_args  The arguments
	 *
	 * @return     <type>  The course.
	 */
	public static function list($_string = null, $_args = [])
	{

		$condition =
		[
			'order'     => 'order',
			'sort'      => ['enum' => ['id', 'title', 'slug', 'publishdate', 'status', 'commentcount',]],
			'type'      => ['enum' => ['post', 'page', 'help']],
			'language'  => 'language',
			'limit'     => 'int',
			'status'    => ['enum' => ['publish','draft','schedule','deleted','expire']],
			'order_raw' => ['enum' => ['RAND()', '']],
		];

		$require = [];
		$meta    =	[];


		$data = \dash\cleanse::input($_args, $condition, $require, $meta);
		$_string = \dash\validate::search($_string);
		$result            = \dash\db\posts::search($_string, $data);
		$temp              = [];

		foreach ($result as $key => $value)
		{
			$check = self::ready($value);
			if($check)
			{
				$temp[] = $check;
			}
		}

		return $temp;
	}
}
?>