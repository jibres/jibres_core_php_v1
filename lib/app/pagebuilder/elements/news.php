<?php
namespace lib\app\pagebuilder\elements;


class news
{
	public static function detail()
	{
		return
		[
			'key'         => 'news',
			'mode'        => 'body',
			'title'       => T_("Latest news"),
			'page_title'  => T_("Latest news"),
			'description' => T_("View some of the latest news"),
			'btn_title'   => T_("Add latest news"),
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
			'title'  =>
			[
				'detail' =>
				[
					'page_title' => T_("Edit title"),
					'btn_save' => true,
				],
			],

			'filter'  =>
			[
				'detail' =>
				[
					'page_title' => T_("Set Filter"),
					'btn_save' => true,
				],

				'contain' =>
				[
					'news_filter' => true,
				],

			],
			'design' =>
			[
				'detail' =>
				[
					'page_title' => T_("Set design config"),
					'btn_save'   => false,
				],

				'contain' =>
				[
					'avand'  => true,
					'radius' => true,
					'effect' => true,
					'padding' => true,
					'infoposition' => true,
				],
			],
			'puzzle' => true,
			'remove' => true,
		];

		return $map;
	}



	public static function input_condition($_args = [])
	{
		$_args['set_title']         = 'bit';
		$_args['show_title']        = 'string_100';
		$_args['more_link']         = 'string_100';
		$_args['more_link_caption'] = 'string_100';
		$_args['tag_id']            = 'code';
		$_args['subtype']           = ['enum' => ['any', 'standard', 'gallery', 'video', 'audio']];
		$_args['play_item']         = ['enum' => ['none', 'first', 'all']];

		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
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

		\lib\app\pagebuilder\line\tools::input_exception('detail');

		unset($_data['tag_id']);
		unset($_data['subtype']);
		unset($_data['play_item']);

		return $_data;

	}
}
?>
