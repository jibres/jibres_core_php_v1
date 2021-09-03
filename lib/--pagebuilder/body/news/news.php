<?php
namespace lib\pagebuilder\body\news;


class news
{

	public static function allow()
	{
		return true;
	}


	public static function detail()
	{
		return
		[
			'key'         => 'news',
			'mode'        => 'body',
			'title'       => T_("Latest news"),
			'description' => T_("View some of the latest news"),
			'btn_title'   => T_("Add latest news"),
		];
	}


	public static function default_value()
	{
		return
		[
			'titlesetting' =>
			[
				'show_title' => 'yes',
				'more_link'  => 'show'
			],
			'puzzle' =>
			[
				'limit' => 8
			]
		];

	}

	/**
	 * News element contain what
	 *
	 * @param      array  $_args  The public contains
	 *
	 * @return     array  The news contain
	 */
	public static function elements($_args = [])
	{
		$map =
		[
			'detail' =>
			[
				'page_title' => T_("Latest news"),

			],
			'contain' =>
			[
				'title'  =>
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
						// 'hidden'     => true,
					],

					// 'contain' =>
					// [
					// 	'news_filter' => true,
					// ],

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
		$_args['tag_id']    = 'code_0';
		$_args['subtype']   = ['enum' => ['any', 'standard', 'gallery', 'video', 'audio']];
		$_args['play_item'] = ['enum' => ['none', 'first', 'all']];

		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$current_module = \lib\pagebuilder\tools\tools::current_module();

		if(isset($current_module['current_module']))
		{
			$current_module = $current_module['current_module'];
		}
		else
		{
			$current_module = 'news';
		}

		$news = [];

		if(array_key_exists('tag_id', $_data))
		{
			$news['tag_id'] = $_data['tag_id'];
		}
		elseif(a($_saved_detail, 'detail', 'tag_id'))
		{
			$news['tag_id'] = a($_saved_detail, 'detail', 'tag_id');
		}

		if(array_key_exists('subtype', $_data))
		{
			$news['subtype'] = $_data['subtype'];
		}
		elseif(a($_saved_detail, 'detail', 'subtype'))
		{
			$news['subtype'] = a($_saved_detail, 'detail', 'subtype');
		}

		if(array_key_exists('play_item', $_data))
		{
			$news['play_item'] = $_data['play_item'];
		}
		elseif(a($_saved_detail, 'detail', 'play_item'))
		{
			$news['play_item'] = a($_saved_detail, 'detail', 'play_item');
		}

		if(!empty($news))
		{
			$_data['detail'] = json_encode($news, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		if($current_module === 'filter')
		{
			\lib\pagebuilder\tools\tools::input_exception('detail');
		}

		unset($_data['tag_id']);
		unset($_data['subtype']);
		unset($_data['play_item']);

		return $_data;

	}

	public static function draw($_args)
	{
		$link = null;

		$line_detail =
		[
			'value' =>
			[
				'title'     => a($_args, 'title'),
				'tag_id'    => a($_args, 'detail', 'tag_id'),
				'subtype'   => a($_args, 'detail', 'subtype'),
				'limit'     => a($_args, 'puzzle', 'limit'),
				'line_link' => a($_args, 'titlesetting', 'more_link_url'),
			],
		];

		$data = \dash\app\posts\load::template($line_detail);

		if(isset($data['list']))
		{
			$data = $data['list'];
		}

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

			if(isset($value['link']))
			{
				$data[$key]['url'] = $value['link'];
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
