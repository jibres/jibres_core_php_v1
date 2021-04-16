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
						'allow_upload_file' => true,
						'hidden'            => true,
						'page_title'        => T_("Add new image"),
					],
				],
				'advance' =>
				[
					'detail'  =>
					[
						'page_title' => T_("Edit image block setting"),
						'btn_save'   => false,
					],
					'contain' =>
					[
						'title'        => true,
						'avand'        => true,
						'radius'       => true,
						'effect'       => true,
						'padding'      => true,
						'infoposition' => true,
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
		$_args['sort']   = 'smallint';
		$_args['image']  = 'bit';
		$_args['target'] = 'bit';

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
		$image = [];

		$image_path = null;


		$image_path = \dash\upload\website::upload_image('image');

		if(!\dash\engine\process::status())
		{
			return false;
		}


		if(!$image_path)
		{
			\dash\notif::error(T_("Please upload an image file"), 'image');
			return false;
		}

		if(isset($_saved_detail['detail']['list']) && is_array($_saved_detail['detail']['list']))
		{
			$image['list'] = $_saved_detail['detail']['list'];
		}


		$image['list'][] =
		[
			'image'  => $image_path,
			'url'    => $_data['url'],
			'alt'    => $_data['alt'],
			'sort'   => $_data['sort'],
			'target' => $_data['target'],
		];


		if(!empty($image))
		{
			$_data['detail'] = json_encode($image, JSON_UNESCAPED_UNICODE);
		}
		else
		{
			$_data['detail'] = null;
		}

		\lib\app\pagebuilder\line\tools::input_exception('detail');


		unset($_data['image']);
		unset($_data['url']);
		unset($_data['alt']);
		unset($_data['sort']);
		unset($_data['target']);

		return $_data;

	}
}
?>
