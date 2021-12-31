<?php
namespace lib\app\order;


class next_prev
{


	private static function module_map() : array
	{
		$map =
		[
			'sale' => [],

			'buy'  =>
			[
				'opr' => [],
			],

			'order' =>
			[
				'detail'   => [],
				'products' => [],
				'comment'  => [],
				'address'  => [],
				'status'   => [],
				'discount' => [],
			],

			'chap' =>
			[
				'a4'      => [],
				'a4'      => [],
				'receipt' => [],

			],


		];

		return $map;
	}


	public static function detect_next_prev()
	{
		if(\dash\url::dir(3))
		{
			return;
		}

		$subchild = \dash\url::subchild();
		$subchild = \dash\validate::factor_id($subchild, false);

		if(!$subchild)
		{
			return null;
		}

		$args =
		[
			'module' => \dash\url::module(),
			'child'  => \dash\request::get('c'),
		];

		$new_url = \dash\url::this();

		if(\dash\url::child() === 'next')
		{
			$new_url = \lib\app\order\next_prev::next($subchild, $args);
		}
		elseif(\dash\url::child() === 'prev')
		{
			$new_url = \lib\app\order\next_prev::prev($subchild, $args);
		}

		if($new_url)
		{
			\dash\redirect::to($new_url);
		}

	}


	private static function detect_addr($_args) : string
	{
		$addr   = [];
		$addr[] = \dash\url::here();

		$map = self::module_map();

		if(a($_args, 'module'))
		{
			if(isset($map, $_args['module']))
			{
				$addr[] = $_args['module'];

				if(a($_args, 'child'))
				{
					if(is_array(a($map, $_args['module'], $_args['child'])))
					{
						$addr[] = $_args['child'];
					}
				}
			}
		}


		return implode('/', $addr);

	}

	private static function next_prev(string $_opr, $_id, array $_args)
	{
		$addr = self::detect_addr($_args);

		$result = self::ping_row($_id);

		if(!$result)
		{
			return false;
		}

		if($_opr === 'next')
		{
			$new_id = \lib\db\orders\get::next($result['id'], $result['type']);

			if(!$new_id)
			{
				$new_id = \lib\db\orders\get::first_factor_id($result['type']);
			}
		}
		else
		{
			$new_id = \lib\db\orders\get::prev($result['id'], $result['type']);

			if(!$new_id)
			{
				$new_id = \lib\db\orders\get::end_factor_id($result['type']);
			}
		}

		$http_query = [];
		$http_query['id'] = $new_id;

		$addr .= '?'. \dash\request::build_query($http_query);

		return $addr;

	}



	public static function next($_id, array $_args = [])
	{
		return self::next_prev('next', $_id, $_args);
	}



	public static function prev($_id, array $_args = [])
	{
		return self::next_prev('prev', $_id, $_args);
	}


	/**
	 * Ping factor exist
	 *
	 * @param      <type>  $_id    The identifier
	 *
	 * @return     bool    ( description_of_the_return_value )
	 */
	public static function ping_row($_id)
	{
		$id = \dash\validate::factor_id($_id);
		if(!$id)
		{
			return false;
		}

		return \lib\db\orders\get::ping_row($id);
	}
}
?>