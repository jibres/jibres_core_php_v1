<?php
namespace lib\pagebuilder\body\products;


class products
{

	public static function allow()
	{
		return true;
	}


	public static function detail()
	{
		return
		[
			'key'         => 'products',
			'mode'        => 'body',
			'title'       => T_("Product Block"),
			'description' => T_("A block to show products like random products, products of special category, popular products, etc."),
			'btn_title'   => T_("Add Products Block"),
		];
	}


	public static function default_value()
	{
		return
		[
			'titlesetting' =>
			[
				'show_title' => 'yes',
				'more_link' => 'show',
				'show_mode' => 'special',
			],
		];

	}

	/**
	 * Products element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The products contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title' => T_("Product Block"),
			],

			'contain' =>
			[
				'title' =>
				[
					'detail' =>
					[
						'page_title' => T_("Edit title"),
					],
				],

				'device' => true,

				'filter' =>
				[
					'detail' =>
					[
						'page_title' => T_("Set Filter"),
						'btn_save'   => true,
					],
				],
				'view' =>
				[
					'detail' =>
					[
						'page_title' => T_("Set design config"),
						'btn_save'   => false,
					],

					'contain' =>
					[
						'avand'        => true,
						'radius'       => true,
						'effect'       => true,
						'padding'      => true,
						'infoposition' => true,
					],
				],
				'puzzle' => true,
				'remove' => true,
			],
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['cat_id'] = 'id';
		$_args['type']   = ['enum' => ['latestproduct', 'randomproduct', 'bestselling']];
		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$products = [];

		if(array_key_exists('cat_id', $_data))
		{
			$products['cat_id'] = $_data['cat_id'];
		}
		elseif(a($_saved_detail, 'detail', 'cat_id'))
		{
			$products['cat_id'] = a($_saved_detail, 'detail', 'cat_id');
		}


		if(array_key_exists('type', $_data))
		{
			$products['type'] = $_data['type'];
		}
		elseif(a($_saved_detail, 'detail', 'type'))
		{
			$products['type'] = a($_saved_detail, 'detail', 'type');
		}


		if(array_key_exists('play_item', $_data))
		{
			$products['play_item'] = $_data['play_item'];
		}
		elseif(a($_saved_detail, 'detail', 'play_item'))
		{
			$products['play_item'] = a($_saved_detail, 'detail', 'play_item');
		}

		if(!empty($products))
		{
			$_data['detail'] = json_encode($products, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		\lib\pagebuilder\tools\tools::input_exception('detail');

		unset($_data['cat_id']);
		unset($_data['type']);


		return $_data;

	}

	public static function draw($_args)
	{
		$link = null;


		$line_detail =
		[
			'value' =>
			[

				'productline' =>
				[
					'type'   => a($_args, 'detail', 'type'),
					'cat_id' => a($_args, 'detail', 'cat_id'),
				],
			],
		];

		$data = \lib\app\product\search::website_product_list($line_detail);

		if(!is_array($data))
		{
			$data = [];
		}


		foreach ($data as $key => $value)
		{
			if(isset($value['thumb']))
			{
				$data[$key]['imageurl'] = $value['thumb'];
			}

			if(isset($value['url']))
			{
				$data[$key]['link'] = $value['url'];
			}
		}


		$html = '';

		// first draw title
		$html .= \lib\pagebuilder\body\title\title::draw($_args, $link);

		$html .= \lib\pagebuilder\draw\datablock::draw($_args, $data);

		return $html;

	}
}
?>
