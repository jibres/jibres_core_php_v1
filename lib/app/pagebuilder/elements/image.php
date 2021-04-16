<?php
namespace lib\app\pagebuilder\elements;


class image
{
	public static function detail()
	{
		return
		[
			'key'         => 'image',
			'mode'        => 'body',
			'title'       => T_("Image Block"),
			'page_title'  => T_("Image Block"),
			'description' => T_("Add an image block with a link to somewhere. You can use a beautiful image to engage your customers. for example a special offer."),
			'btn_title'   => T_("Add Images Block"),
		];
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
			'title'  =>
			[
				'detail' =>
				[
					'page_title'    => T_("Edit title"),
					'btn_save'      => true,
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
					'image_filter' => true,
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
		$_args['cat_id'] = 'id';
		$_args['type']   = ['enum' => ['latestproduct', 'randomproduct', 'bestselling']];
		return $_args;
	}


	public static function ready_for_db($_data, $_saved_detail = [])
	{
		$image = [];

		if(array_key_exists('cat_id', $_data))
		{
			$image['cat_id'] = $_data['cat_id'];
		}
		elseif(a($_saved_detail, 'detail', 'cat_id'))
		{
			$image['cat_id'] = a($_saved_detail, 'detail', 'cat_id');
		}


		if(array_key_exists('type', $_data))
		{
			$image['type'] = $_data['type'];
		}
		elseif(a($_saved_detail, 'detail', 'type'))
		{
			$image['type'] = a($_saved_detail, 'detail', 'type');
		}


		if(array_key_exists('play_item', $_data))
		{
			$image['play_item'] = $_data['play_item'];
		}
		elseif(a($_saved_detail, 'detail', 'play_item'))
		{
			$image['play_item'] = a($_saved_detail, 'detail', 'play_item');
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

		unset($_data['cat_id']);
		unset($_data['type']);


		return $_data;

	}
}
?>
