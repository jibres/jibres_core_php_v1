<?php
namespace content_crm\member\address;


class view
{
	public static function config()
	{
		\content_crm\member\master::view();

		$args               = [];
		$args['user_id']    = \dash\coding::decode(\dash\request::get('id'));
		$args['pagenation'] = false;
		$args['status']     = 'enable';

		$dataTable          = \dash\app\address::list(null, $args);
		\dash\data::dataTable($dataTable);

		\dash\data::myUrlAddress(\dash\url::this(). '/address');

		\dash\face::title(T_('Customer addresses'));

		if(\dash\request::get('add') === 'new' || \dash\request::get('addressid'))
		{
			if(\dash\request::get('add') === 'new')
			{
				\dash\face::title(T_('Add new address'));
			}
			else
			{
				\dash\face::title(T_('Edit address'));
			}

			\dash\data::addNewAddress(true);
			\dash\data::back_link(\dash\url::current() . \dash\request::full_get(['add' => null, 'addressid' => null]));
			\dash\data::back_text(T_("Back"));
		}
		else
		{
			\dash\data::action_link(\dash\url::current() . \dash\request::full_get(['add' => 'new']));
			\dash\data::action_text(T_("Add new address"));
			\dash\data::listEngine_start(true);

		}



	}

}
?>