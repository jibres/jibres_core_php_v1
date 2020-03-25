<?php
namespace content\brand;


class view
{
	public static function config()
	{
		\dash\face::title(T_('Jibres Brand'));
		\dash\data::page_desc(T_('These guidelines are here to help ensure that your use of the Jibres logo is consistent with the way we present ourselves.'));
		// btn
		\dash\data::back_text(T_('Home'));
		\dash\data::back_link(\dash\url::kingdom());
		\dash\data::action_text(T_('Jibres Logo'));
		\dash\data::action_link(\dash\url::kingdom(). '/logo');
	}
}
?>