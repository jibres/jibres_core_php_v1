<?php
namespace lib\app\product;


class site
{


	public static function last()
	{
		$args =
		[
			'limit'      => 5,
			'order'      => 'desc',
			'sort'       => 'id',
			'pagination' => false,
		];

		$result = \lib\app\product::list(null, $args);
		return $result;

	}


	public static function love()
	{
		$args =
		[
			'limit'      => 5,
			'order'      => 'desc',
			'sort'       => 'id',
			'pagination' => false,
		];

		$result = \lib\app\product::list(null, $args);
		return $result;

	}


	public static function by_cat($_cat)
	{
		$args =
		[
			'limit'      => 5,
			'order'      => 'desc',
			'sort'       => 'id',
			'cat'       => $_cat,
			'pagination' => false,
		];

		$result = \lib\app\product::list(null, $args);
		return $result;


	}


	public static function by_discount($_discount = null)
	{
		$args =
		[
			'limit'      => 5,
			'order'      => 'desc',
			'sort'       => 'id',
			'pagination' => false,
		];

		if($_discount)
		{
			$args['discount'] = $_discount;
		}
		else
		{
			$args['discount'] = ['IS NOT', 'NULL'];
		}


		$result = \lib\app\product::list(null, $args);
		return $result;

	}





}
?>