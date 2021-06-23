<?php
namespace lib\app\form\form;


class add
{
	public static function satisfaction_survey()
	{
		$args =
		[
			'title'   => T_("Satisfaction Survey"),
			'privacy' => 'private',
		];

		$form_id = self::add($args, true);

		if(isset($form_id['id']))
		{
			\lib\app\store\edit::selfedit(['satisfaction_survey' => $form_id['id']]);
		}

		return $form_id;
	}



	public static function add($_args, $_force = false)
	{
		if(!$_force)
		{
			\dash\permission::access('ManageForm');
		}

		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}


		$args['datecreated'] = date("Y-m-d H:i:s");
		$args['status']      = 'publish';
		$args['user_id']     = \dash\user::id();

		$id = \lib\db\form\insert::new_record($args);

		\dash\utility\sitemap::forms($id);

		\dash\notif::ok(T_("Contact form successfully added"));

		return ['id' => $id];
	}


	public static function duplicate($_args, $_id)
	{

		\dash\permission::access('ManageForm');

		$args = \lib\app\form\form\check::variable($_args);

		if(!$args)
		{
			return false;
		}

		$load = \lib\app\form\form\get::get($_id);
		if(!$load)
		{
			return false;
		}

		$id = \lib\db\form\insert::duplicate($_id, $args['title']);
		if($id)
		{
			\dash\notif::ok(T_("Contact form successfully added"));

			return ['id' => $id];
		}
		else
		{
			\dash\notif::error(T_("Can not duplicate this form"));
			return false;
		}

	}
}
?>