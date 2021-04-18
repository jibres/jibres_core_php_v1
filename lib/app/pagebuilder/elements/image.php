<?php
namespace lib\app\pagebuilder\elements;


class image
{
	// the index on image for edit or remove it
	private static $image_index = null;


	public static function detail()
	{
		return
		[
			'key'         => 'image',
			'mode'        => 'body',
			'title'       => T_("Image Block"),

			'description' => T_("Add an image block with a link to somewhere. You can use a beautiful image to engage your customers. for example a special offer."),
			'btn_title'   => T_("Add Images Block"),
		];
	}


	public static function default_value()
	{
		$default =
		[
			'puzzle' =>
			[
				'puzzle_type' => 'slider',
				'slider_type' => 'special',
			]
		];

		return $default;
	}


	public static function router($_args)
	{
		$index = \dash\request::get('index');
		$index = \dash\validate::int($index, false);

		if(!is_numeric($index))
		{
			return false;
		}

		if(!isset($_args['detail']['list'][$index]))
		{
			return false;
		}

		self::$image_index = $index;

		\dash\data::dataRow($_args['detail']['list'][$index]);

		return $_args;
	}


	/**
	 * Images element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The image contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title' => T_("Image Block"),
				'btn_add'    =>
				[
					'text' => T_('Add new image'),
					'link' => \dash\url::that(). '/addimage'. \dash\request::full_get()
				],
				'btn_advance'    => \dash\url::that(). '/advance'. \dash\request::full_get(),
			],

			'contain' =>
			[
				'addimage' =>
				[
					'detail' =>
					[
						'page_title'        => T_("Add new image"),
						'allow_upload_file' => true,
						'hidden'            => true,
					],
				],
				'editimage' =>
				[
					'detail' =>
					[
						'page_title'        => T_("Edit image"),
						'router'            => true,
						'allow_upload_file' => true,
						'hidden'            => true,
						'back_args'         => ['index' => null,],
					],
				],
				'advance' =>
				[
					'detail'  =>
					[
						'page_title' => T_("Image block setting"),
						'btn_save'   => false,
					],
					'contain' =>
					[
						'title'        => true,
						'puzzle'       => true,
						'avand'        => true,
						'radius'       => true,
						'effect'       => true,
						'padding'      => true,
						'infoposition' => true,
						'ratio'        => true,
						'remove'       => true,
					]
				],
			],

		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['alt']    = 'string_200';
		$_args['url']    = 'string_200';
		$_args['sort']   = 'sort';
		$_args['image']  = 'bit';
		$_args['target'] = 'bit';
		$_args['remove'] = 'string_50';

		return $_args;
	}


	public static function ready($_data)
	{
		if(isset($_data['detail']['list']) && is_array($_data['detail']['list']))
		{
			foreach ($_data['detail']['list'] as $key => $value)
			{
				if(isset($value['image']))
				{
					$_data['detail']['list'][$key]['imageurl'] = \lib\filepath::fix($value['image']);
				}
			}
		}

		return $_data;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$current_page = \lib\app\pagebuilder\line\tools::current_page();

		if(isset($current_page['current_page']))
		{
			$current_page = $current_page['current_page'];
		}
		else
		{
			$current_page = 'addimage';
		}

		if($_data['sort'])
		{
			$_data = self::image_process($_data, $_saved_detail, '_set_sort');
		}
		else
		{
			if($current_page === 'addimage' || $current_page === 'editimage')
			{
				$_data = self::image_process($_data, $_saved_detail, $current_page);
			}
		}

		return $_data;

	}


	private static function image_process($_data, $_saved_detail, $current_page)
	{

		$image = [];

		$image_path = null;

		if(\dash\request::files('image'))
		{
			$image_path = \dash\upload\website::upload_image('image');

			if(!\dash\engine\process::status())
			{
				return false;
			}
		}
		else
		{
			// file not uploaded. get from saved detail
			if(self::$image_index)
			{
				if(isset($_saved_detail['detail']['list'][self::$image_index]['image']))
				{
					$image_path = $_saved_detail['detail']['list'][self::$image_index]['image'];
				}
			}
		}


		if(!$image_path && $current_page !== '_set_sort')
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		if(isset($_saved_detail['detail']['list']) && is_array($_saved_detail['detail']['list']))
		{
			$image['list'] = $_saved_detail['detail']['list'];

			// unset ready variable
			foreach ($image['list'] as $key => $value)
			{
				unset($image['list'][$key]['imageurl']);
			}
		}

		if($current_page === '_set_sort')
		{
			if(!$image || !is_array(a($image, 'list')))
			{
				\dash\notif::error(T_("No item to sort"));
				return false;
			}

			$sort = $_data['sort'];
			$sort = array_map('intval', $sort);

			foreach ($sort as $new_index => $old_index)
			{
				if(!array_key_exists($old_index, $image['list']))
				{
					\lib\app\pagebuilder\line\tools::need_redirect(\dash\url::pwd());
					return;
				}

				$image['list'][$old_index]['sort'] = $new_index;
			}


			$sort_column = array_column($image['list'], 'sort');

			if(count($sort_column) !== count($image['list']))
			{
				\lib\app\pagebuilder\line\tools::need_redirect(\dash\url::pwd());
				return;
			}

			$my_sorted_list = $image['list'];

			array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			$my_sorted_list = array_values($my_sorted_list);

			$image['list'] = $my_sorted_list;
		}
		elseif($current_page === 'editimage')
		{
			if(!isset($image['list'][self::$image_index]))
			{
				\dash\notif::error(T_("Can not find this image index in your list"));
				return false;
			}

			if($_data['remove'] === 'thisimage')
			{
				unset($image['list'][self::$image_index]);
			}
			else
			{

				$image['list'][self::$image_index] =
				[
					'image'  => $image_path,
					'url'    => $_data['url'],
					'alt'    => $_data['alt'],
					'sort'   => $_data['sort'],
					'target' => $_data['target'],
				];

			}
		}
		else
		{
			$image['list'][] =
			[
				'image'  => $image_path,
				'url'    => $_data['url'],
				'alt'    => $_data['alt'],
				'sort'   => $_data['sort'],
				'target' => $_data['target'],
			];
		}

		if(!empty($image))
		{
			$_data['detail'] = json_encode($image, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		\lib\app\pagebuilder\line\tools::input_exception('detail');

		\lib\app\pagebuilder\line\tools::need_redirect(\dash\url::that(). \dash\request::full_get(['index' => null]));

		unset($_data['image']);
		unset($_data['url']);
		unset($_data['alt']);
		unset($_data['sort']);
		unset($_data['target']);
		unset($_data['remove']);
		unset($_data['sort']);

		return $_data;
	}
}
?>
