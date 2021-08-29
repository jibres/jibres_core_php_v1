<?php
namespace content_site;


class homepage
{

	public static function id()
	{
		$post_id = \lib\store::detail('homepage_builder_post_id');
		if(!$post_id)
		{
			return false;
		}

		return $post_id;
	}


	public static function get_header_and_footer()
	{
		$post_id = self::id();
		if(!$post_id || !is_numeric($post_id))
		{
			return null;
		}

		$load = \lib\db\pagebuilder\get::homepage_header_footer($post_id);

		return $load;
	}

	public static function get_link()
	{
		$post_id = self::id();
		if(!$post_id)
		{
			return null;
		}

		$post_id = \dash\coding::encode($post_id);
		$url = \lib\store::admin_url(). '/a/pagebuilder/build?id='. $post_id;
		return $url;
	}


	public static function set_as_homepage($_post_id)
	{
		$post_id = \dash\validate::code($_post_id);
		$post_id = \dash\coding::decode($post_id);

		if(!$post_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_post_detail = self::load($post_id);

		if(!$load_post_detail)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		if(isset($load_post_detail['status']) && $load_post_detail['status'] === 'publish')
		{
			// nothing
		}
		else
		{
			\dash\notif::error(T_("Please publish the page and then set as homepage"));
			return false;
		}

		\lib\app\store\edit::selfedit(['homepage_builder_post_id' => $post_id]);

		\dash\notif::clean();

		\dash\notif::ok(T_("Homepage was changed"));

		return true;

	}



	public static function load($_id)
	{
		if($_id && is_numeric($_id))
		{
			// ok
		}
		else
		{
			return false;
		}
		// load post detail
		$post_detail = \dash\db\posts\get::by_id_type($_id, 'pagebuilder');

		if(isset($post_detail['id']) && floatval($post_detail['id']) === floatval(self::id()))
		{
			$post_detail['ishomepage'] = true;
		}

		\dash\temp::get('not_load_cms_setting', true);

		$ready = \dash\app\posts\ready::row($post_detail);

		return $ready;
	}
}
?>