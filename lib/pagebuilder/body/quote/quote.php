<?php
namespace lib\pagebuilder\body\quote;


class quote
{
	// the index on quote for edit or remove it
	private static $quote_comment_id = null;


	public static function detail()
	{
		return
		[
			'key'         => 'quote',
			'mode'        => 'body',
			'title'       => T_("Quote Block"),
			'description' => T_("Show quote of some customers to engage your audience with beautiful design."),
			'btn_title'   => T_("Add Quotes Block"),
		];
	}


	public static function default_value()
	{
		$default =
		[
			'puzzle' =>
			[
				'puzzle_type' => 'slider',
				'slider_type' => 'simple',
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

		self::$quote_comment_id = $index;

		\dash\data::dataRow($_args['detail']['list'][$index]);

		return $_args;
	}



	public static function remove($_args)
	{
		$id = $_args['id'];
		if(is_numeric($id))
		{
			\dash\db\comments\delete::quote($id);
			return true;
		}
	}


	/**
	 * Quotes element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The quote contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title' => T_("Quote Block"),
				'btn_add'    =>
				[
					'text' => T_('Add new quote'),
					'link' => \dash\url::current(). '/add'. \dash\request::full_get()
				],
				'btn_advance'    => \dash\url::current(). '/advance'. \dash\request::full_get(),
			],

			'contain' =>
			[
				'add' =>
				[
					'detail' =>
					[
						'allow_upload_file' => true,
						'hidden'            => true,
						'page_title'        => T_("Add new quote"),
					],
				],
				'edit' =>
				[
					'detail' =>
					[
						'router'            => true,
						'allow_upload_file' => true,
						'hidden'            => true,
						'page_title'        => T_("Edit quote"),
						'back_args'         => ['index' => null,],
					],
				],
				'advance' =>
				[
					'detail'  =>
					[
						'page_title' => T_("Edit setting"),
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
		$_args['displayname'] = 'displayname';
		$_args['job']         = 'string_200';
		$_args['text']        = 'desc';
		$_args['star']        = 'star';
		$_args['sort']        = 'sort';
		$_args['remove']      = 'string_50';

		return $_args;
	}


	public static function input_required()
	{
		return ['text'];
	}


	public static function input_meta()
	{
		return [];
	}


	public static function ready($_data)
	{
		if(isset($_data['detail']['list']) && is_array($_data['detail']['list']))
		{
			$id = $_data['id'];

			$load_all_comment = \dash\db\comments\get::quote_list($id);

			if(!is_array($load_all_comment))
			{
				$load_all_comment = [];
			}

			$load_all_comment = array_combine(array_column($load_all_comment, 'id'), $load_all_comment);

			foreach ($_data['detail']['list'] as $key => $value)
			{
				if(isset($value['image']))
				{
					$_data['detail']['list'][$key]['imageurl'] = \lib\filepath::fix($value['image']);
				}

				$_data['detail']['list'][$key]['displayname'] = a($load_all_comment, $key, 'displayname');
				$_data['detail']['list'][$key]['star'] = a($load_all_comment, $key, 'star');
				$_data['detail']['list'][$key]['text'] = a($load_all_comment, $key, 'content');
			}


		}

		return $_data;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$current_page = \lib\pagebuilder\tools\tools::current_page();

		if(isset($current_page['current_page']))
		{
			$current_page = $current_page['current_page'];
		}
		else
		{
			$current_page = 'add';
		}

		if($_data['sort'])
		{
			$_data = self::quote_process($_data, $_saved_detail, '_set_sort');
		}
		else
		{
			if($current_page === 'add' || $current_page === 'edit')
			{
				$_data = self::quote_process($_data, $_saved_detail, $current_page);
			}
		}

		return $_data;

	}


	private static function quote_process($_data, $_saved_detail, $current_page)
	{
		$quote = [];

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
			if(self::$quote_comment_id)
			{
				if(isset($_saved_detail['detail']['list'][self::$quote_comment_id]['image']))
				{
					$image_path = $_saved_detail['detail']['list'][self::$quote_comment_id]['image'];
				}
			}
		}

		// fix star
		if($_data['star'])
		{
			$_data['star'] = (5 - intval($_data['star'])) + 1;
		}


		if(isset($_saved_detail['detail']['list']) && is_array($_saved_detail['detail']['list']))
		{
			$quote['list'] = $_saved_detail['detail']['list'];

			// unset ready variable
			foreach ($quote['list'] as $key => $value)
			{
				unset($quote['list'][$key]['imageurl']);
				unset($quote['list'][$key]['text']);
				unset($quote['list'][$key]['star']);
				unset($quote['list'][$key]['displayname']);
			}
		}

		if($current_page === '_set_sort')
		{
			// if(!$quote || !is_array(a($quote, 'list')))
			// {
			// 	\dash\notif::error(T_("No item to sort"));
			// 	return false;
			// }

			// $sort = $_data['sort'];
			// $sort = array_map('intval', $sort);

			// foreach ($sort as $new_index => $old_index)
			// {
			// 	if(!array_key_exists($old_index, $quote['list']))
			// 	{
			// 		\lib\pagebuilder\tools\tools::need_redirect(\dash\url::pwd());
			// 		return;
			// 	}

			// 	$quote['list'][$old_index]['sort'] = $new_index;
			// }


			// $sort_column = array_column($quote['list'], 'sort');

			// if(count($sort_column) !== count($quote['list']))
			// {
			// 	\lib\pagebuilder\tools\tools::need_redirect(\dash\url::pwd());
			// 	return;
			// }

			// $my_sorted_list = $quote['list'];

			// array_multisort($my_sorted_list, SORT_ASC, SORT_NUMERIC, $sort_column);

			// $my_sorted_list = array_values($my_sorted_list);

			// $quote['list'] = $my_sorted_list;
		}
		elseif($current_page === 'edit')
		{
			if(!isset($quote['list'][self::$quote_comment_id]))
			{
				\dash\notif::error(T_("Can not find this quote index in your list"));
				return false;
			}

			if($_data['remove'] === 'quote')
			{
				\dash\app\comment\remove::quote(self::$quote_comment_id);
				// remove comment record
				unset($quote['list'][self::$quote_comment_id]);
			}
			else
			{
				// edit comment record
				$edit_comment =
				[
					'displayname'    => $_data['displayname'],
					'content'        => $_data['text'],
					'star'           => $_data['star'],
				];

				\dash\app\comment\edit::quote($edit_comment, self::$quote_comment_id);

				$quote['list'][self::$quote_comment_id] =
				[
					'comment_id' => self::$quote_comment_id,
					'image'      => $image_path,
					'job'        => $_data['job'],
					'sort'       => $_data['sort'],
				];

			}
		}
		else
		{
			if(isset($quote['list']) && is_array($quote['list']))
			{
				$max_capacity = 50;

				if((count($quote['list']) + 1) > $max_capacity)
				{
					\dash\notif::error(T_("Maximum capacity of quote block is :val quote!", ['val' => \dash\fit::number($max_capacity)]));
					return false;
				}
			}

			$comment_args =
			[
				'pagebuilder_id' => $_saved_detail['id'],
				'for'            => 'quote',
				'displayname'    => $_data['displayname'],
				'content'        => $_data['text'],
				'star'           => $_data['star'],
			];

			// add comment
			// get comment id
			$comment_id = \dash\app\comment\add::quote($comment_args);

			if(!$comment_id)
			{
				return false;
			}

			$quote['list'][$comment_id] =
			[
				'comment_id' => $comment_id,
				'image'      => $image_path,
				'job'        => $_data['job'],
				'sort'       => $_data['sort'],
			];
		}

		if(!empty($quote))
		{
			$_data['detail'] = json_encode($quote, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		\lib\pagebuilder\tools\tools::input_exception('detail');

		\lib\pagebuilder\tools\tools::need_redirect(\dash\url::that(). '/quote'. \dash\request::full_get(['index' => null]));

		unset($_data['displayname']);
		unset($_data['job']);
		unset($_data['text']);
		unset($_data['sort']);
		unset($_data['star']);
		unset($_data['remove']);

		return $_data;
	}
}
?>
