<?php
namespace content_site\section;


class controller
{
	public static function routing()
	{
		// load post detail
		// all url route in this module need page id
		\content_site\controller::load_current_page_detail();


		// load current section detail
		// need in some option on save
		// in adding mode need end section detail as current section
		self::current_section_detail();


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
		$section_id = \dash\request::get('sid');
		$section_id = \dash\validate::id($section_id);
		if(!$section_id)
		{
			\dash\header::status(403, T_("Invalid section id"));
			return;
		}

		$options = \content_site\call_function::option($child);

		\dash\data::currentOptionList($options);

		// allow to get and post on this page
		\dash\open::get();
		\dash\open::post();

		if(!is_array($options))
		{
			$options = [];
		}
		// enable upload file in gallery section
		foreach ($options as $key => $value)
		{
			if(is_array($value) && in_array('file', $value))
			{
				\dash\allow::file();
			}

			if($value === 'file')
			{
				\dash\allow::file();
			}
		}
	}


	/**
	 * Get list of all section
	 *
	 * @return     <type>  ( description_of_the_return_value )
	 */
	private static function all_section_name()
	{
		$all =
		[
			/* headers */
			'h1',
			'h2',


			/* body */
			'blog',
			// 'gallery',
			// 'imagetext',
			// 'text',


			/* footer */
		];

		return $all;
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
			$detail = \content_site\call_function::detail($section);

			if($detail && is_array($detail))
			{
				$section_list[] = $detail;
			}
		}

		return $section_list;
	}



	/**
	 * Load current section detail
	 *
	 * If in a section and have section_id in url => load section detail
	 *
	 * If in adding mode and have not section_id in url => get last section added (addin mode)
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	public static function current_section_detail()
	{
		$page_id    = \dash\coding::decode(\dash\request::get('id'));
		$section_id = \dash\validate::id(\dash\request::get('sid'));

		$section_detail = [];

		if(!$section_id && $page_id && !\dash\url::child())
		{
			$section_list = \content_site\controller::load_current_section_list('with_adding');

			$section_detail = end($section_list);
			// needless to ready_section_list
		}
		else
		{
			if(!$page_id || !$section_id)
			{
				return false;
			}

			$section_detail = \lib\db\pagebuilder\get::by_id_related_id($section_id, $page_id);

			if(!is_array($section_detail) || !$section_detail)
			{
				return false;
			}

			$section_detail = view::ready_section_list($section_detail);

			if(isset($section_detail['preview']['key']) && $section_detail['preview']['key'] === \dash\url::child())
			{
				// ok
			}
			else
			{
				return false;
			}
		}


		\dash\data::currentSectionDetail($section_detail);

		return $section_detail;

	}


}
?>