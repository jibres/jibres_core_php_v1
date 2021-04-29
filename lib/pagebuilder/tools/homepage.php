<?php
namespace lib\pagebuilder\tools;


class homepage
{

	public static function set_as_homepage($_post_id)
	{
		$post_id = \dash\validate::code($_post_id);
		$post_id = \dash\coding::decode($post_id);

		if(!$post_id)
		{
			\dash\notif::error(T_("Invalid id"));
			return false;
		}

		$load_post_detail = \lib\pagebuilder\tools\get::load_post_detail($post_id);

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
}
?>