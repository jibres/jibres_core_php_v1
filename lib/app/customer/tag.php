<?php
namespace lib\app\customer;

class tag
{

	public static function add($_tag, $_id)
	{
		\dash\permission::access('customerAssignTag');

		$id = \dash\coding::decode($_id);

		if(!$id)
		{
			\dash\notif::error(T_("Invalid customer id"));
			return false;
		}

		if(!\dash\permission::check('cpThirdpartyTagAdd'))
		{
			$current_tag = \dash\db\terms::get(['type' => 'customer_tag']);
			if(is_array($current_tag))
			{
				$tag_titles = array_column($current_tag, 'title');
				$new_tag    = $_tag;
				$new_tag    = explode(',', $new_tag);
				foreach ($new_tag as $key => $value)
				{
					if(!in_array($value, $tag_titles))
					{
						\dash\notif::error(T_("Please select tag from list"), 'tag');
						return false;
					}
				}
			}
		}

		\dash\app::variable(['customer_tag' => $_tag]);

		\dash\app\posts::set_post_term($id, 'customer_tag', 'users', $_tag);

		\dash\log::set('customerAddTag', ['code' => $_id, 'tag' => $_tag]);
		\dash\notif::ok(T_("Tag was saved"));
		return true;

	}
}
?>