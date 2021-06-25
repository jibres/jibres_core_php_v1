<?php
namespace content_site\section;


class controller
{
	public static function routing()
	{
		// load post detail
		// all page route in this module need page id
		\content_site\controller::load_current_page_detail();

		$child = \dash\url::child();

		// route section list
		if(!$child)
		{
			return;
		}


		/**
		 * Route one section
		 */
		if(!in_array($child, self::all_section_name()))
		{
			\dash\header::status(404, T_("Invalid section name"));
			return;
		}

		// not route image/add/[anything]
		if(\dash\url::dir(3))
		{
			\dash\header::status(404, T_("Invalid url"));
			return;
		}

		// all section need to sid [section id] to load

		// load current section detail
		// need in some option on save
		view::current_section_detail();

		$options = \content_site\call_function::option();

		\dash\data::currentOptionList($options);

		// allow to get and post on this page
		\dash\open::get();
		\dash\open::post();


		// enable upload file in gallery section
		if(in_array(\dash\url::child(), ['gallery']))
		{
			\dash\allow::file();
		}


	}


	/**
	 * Get list of all section
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function all_section_name()
	{
		$list =
		[
			'blog',
			'gallery',
			'text',
		];

		return $list;
	}


	/**
	 * Get section list
	 */
	public static function section_list()
	{
		$list = self::all_section_name();

		$section_list = [];

		foreach ($list as $section)
		{
			$section_list[] = \content_site\call_function::detail($section);
		}

		return $section_list;
	}








































	// private static function collection(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Collection"),
	// 		'title' => T_("Collection list"),
	// 		'key'   => 'collectionlist',
	// 		'icon'  => \dash\utility\icon::url('collections'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Collection"),
	// 		'title' => T_("Featured collection"),
	// 		'key'   => 'featuredcollection',
	// 		'icon'  => \dash\utility\icon::url('collections'),
	// 	];
	// }


	// private static function image(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Image"),
	// 		'title' => T_("Gallery"),
	// 		'key'   => 'gallery',
	// 		'icon'  => \dash\utility\icon::url('images'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Image"),
	// 		'title' => T_("Image with text"),
	// 		'key'   => 'imagewithtext',
	// 		'icon'  => \dash\utility\icon::url('ImageWithText'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Image"),
	// 		'title' => T_("Image with text overlay"),
	// 		'key'   => 'imagewithtextoverlay',
	// 		'icon'  => \dash\utility\icon::url('ImageWithTextOverlay'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Image"),
	// 		'title' => T_("Logo list"),
	// 		'key'   => 'logolist',
	// 		'icon'  => \dash\utility\icon::url('LogoBlock'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Image"),
	// 		'title' => T_("Slideshow"),
	// 		'key'   => 'slideshow',
	// 		'icon'  => \dash\utility\icon::url('Slideshow'),
	// 	];
	// }


	// private static function product(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Product"),
	// 		'title' => T_("Featured product"),
	// 		'key'   => 'featuredproduct',
	// 		'icon'  => \dash\utility\icon::url('Products'),
	// 	];
	// }


	// private static function promotional(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Promotional"),
	// 		'title' => T_("Newsletter"),
	// 		'key'   => 'newsletter',
	// 		'icon'  => \dash\utility\icon::url('email'),
	// 	];
	// }


	// private static function store_information(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Business Information"),
	// 		'title' => T_("Map"),
	// 		'key'   => 'businessmap',
	// 		'icon'  => \dash\utility\icon::url('Location'),
	// 	];
	// }


	// private static function text(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Text"),
	// 		'title' => T_("Rich text"),
	// 		'key'   => 'richtext',
	// 		'icon'  => \dash\utility\icon::url('TextBlock'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Text"),
	// 		'title' => T_("Testimonials"),
	// 		'key'   => 'testimonials',
	// 		'icon'  => \dash\utility\icon::url('Blockquote'),
	// 	];

	// 	$list[] =
	// 	[
	// 		'group' => T_("Text"),
	// 		'title' => T_("Text columns with images"),
	// 		'key'   => 'textcolumnswithimages',
	// 		'icon'  => \dash\utility\icon::url('ColumnWithText'),
	// 	];
	// }


	// private static function video(&$list)
	// {
	// 	$list[] =
	// 	[
	// 		'group' => T_("Video"),
	// 		'title' => T_("Video"),
	// 		'key'   => 'video',
	// 		'icon'  => \dash\utility\icon::url('PlayCircle'),
	// 	];
	// }

}
?>