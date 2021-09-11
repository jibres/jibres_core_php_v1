<?php
namespace content_site\page\settings;


class model
{
	public static function post()
	{
		if(\dash\request::post('remove') === 'page')
		{
			return self::remove_page();
		}

		if(\dash\request::post('set_as_homepage') === 'set_as_homepage')
		{
			\content_site\page\model::save_page();
			\content_site\homepage::set_as_homepage(\dash\request::get('id'));
			\dash\redirect::pwd();
			return;
		}

		$need_redirect = false;

		$post = [];

		if(\dash\request::post('remove_cover') === 'remove_cover')
		{
			$need_redirect = true;
			$post['cover'] = null;
		}

		if(\dash\request::files('cover'))
		{
			$file_cover = \dash\upload\cms::set_post_cover(\dash\coding::decode(\dash\request::get('id')), true);
			if(!$file_cover)
			{
				\dash\notif::error(T_("Please upload a photo"));
				return false;
			}
			$need_redirect = true;
			$post['cover'] = $file_cover;
		}

		if(\dash\request::post('set_title'))
		{
			$post['title'] = \dash\request::post('title');
		}

		if(\dash\request::post('set_seo'))
		{

			$post =
			[
				'set_seo'        => true,
				'slug'           => \dash\request::post('slug'),
				'excerpt'        => \dash\request::post('excerpt'),
				'seotitle'       => \dash\request::post('seotitle'),
				'tagurl'         => \dash\request::post('tagurl'),
				'specialaddress' => \dash\request::post('specialaddress'),
				'parent'         => \dash\request::post('parent') ? \dash\request::post('parent') : null,
			];
		}






		\dash\app\posts\edit::edit($post, \dash\data::currentPageDetail_id());

		if(\dash\engine\process::status())
		{
			\dash\notif::clean();
			\dash\notif::complete();

			if($need_redirect)
			{
				\dash\redirect::pwd();
			}
		}
	}


	/**
	 * Removes a page.
	 *
	 * @return     bool  ( description_of_the_return_value )
	 */
	private static function remove_page()
	{
		$page_id = \dash\request::get('id');

		$page_id = \dash\validate::code($page_id);
		$page_id = \dash\coding::decode($page_id);
		if(!$page_id)
		{
			\dash\notif::error(T_("Invali page id"));
			return false;
		}

		if(floatval($page_id) === floatval(\content_site\homepage::id()))
		{
			\dash\notif::error(T_("Can not remove homepage"));
			return false;
		}

		$all_section = \lib\db\sitebuilder\get::all_section($page_id);

		if($all_section)
		{
			foreach ($all_section as $key => $value)
			{
				\content_site\call_function::before_section_remove(a($value, 'type'), a($value, 'id'));
			}
		}

		\lib\db\sitebuilder\delete::page($page_id);

		\dash\notif::ok(T_("Page removed"));

		\dash\redirect::to(\dash\url::here());

	}
}
?>