<?php
namespace content_site\section;


class controller
{
	public static function routing()
	{
		\dash\data::pagebuilderMode('body');

		// load post detail
		\content_site\controller::load_current_page_detail();


	}


	/**
	 * Get section list
	 */
	public static function section_list()
	{
		$list = [];

		self::blog($list);

		self::collection($list);

		self::image($list);

		self::product($list);

		self::store_information($list);

		self::text($list);

		self::video($list);

		return $list;

	}



	private static function blog(&$list)
	{
		$list[] =
		[
			'group'   => T_("Blog"),
			'title'   => T_("Blog posts"),
			'key'     => 'blog',
			'icon'    => \dash\utility\icon::url('Blog'),
			'default' =>
			[
				'heading' => T_("Blog post"),
				'limit'   => 2,
			]
		];
	}


	private static function collection(&$list)
	{
		$list[] =
		[
			'group' => T_("Collection"),
			'title' => T_("Collection list"),
			'key'   => 'collectionlist',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Collection"),
			'title' => T_("Featured collection"),
			'key'   => 'featuredcollection',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}


	private static function image(&$list)
	{
		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Gallery"),
			'key'   => 'gallery',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Image with text"),
			'key'   => 'imagewithtext',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Image with text overlay"),
			'key'   => 'imagewithtextoverlay',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Logo list"),
			'key'   => 'logolist',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Image"),
			'title' => T_("Slideshow"),
			'key'   => 'slideshow',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}


	private static function product(&$list)
	{
		$list[] =
		[
			'group' => T_("Product"),
			'title' => T_("Featured product"),
			'key'   => 'featuredproduct',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}


	private static function store_information(&$list)
	{
		$list[] =
		[
			'group' => T_("Business Information"),
			'title' => T_("Map"),
			'key'   => 'businessmap',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}


	private static function text(&$list)
	{
		$list[] =
		[
			'group' => T_("Text"),
			'title' => T_("Rich text"),
			'key'   => 'richtext',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Text"),
			'title' => T_("Testimonials"),
			'key'   => 'testimonials',
			'icon'  => \dash\utility\icon::url('images'),
		];

		$list[] =
		[
			'group' => T_("Text"),
			'title' => T_("Text columns with images"),
			'key'   => 'textcolumnswithimages',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}


	private static function video(&$list)
	{
		$list[] =
		[
			'group' => T_("Video"),
			'title' => T_("Video"),
			'key'   => 'video',
			'icon'  => \dash\utility\icon::url('images'),
		];
	}

}
?>