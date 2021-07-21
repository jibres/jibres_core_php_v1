<?php
namespace lib\app\tax\doc;


class edit
{
	public static function reset_number($_args)
	{
		$condition =
		[
			'year_id'  => 'id',
		];

		$require = ['year_id'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load_year = \lib\app\tax\year\get::get($data['year_id']);
		if(!isset($load_year['id']))
		{
			\dash\notif::error(T_("Invalid year"));
			return false;
		}

		$doc_list = \lib\db\tax_document\get::list_reset_number($data['year_id']);

		if(!is_array($doc_list))
		{
			$doc_list = [];
		}

		if(!$doc_list)
		{
			\dash\notif::warn(T_("This accounting year is empty!"));
			return false;
		}

		$update = \lib\db\tax_document\update::reset_number($doc_list);
		\dash\notif::ok(T_("The number was reset"));
		return true;

	}

	public static function edit_status($_args, $_id)
	{
		$condition =
		[
			'status'  => ['enum' => ['draft', 'temp', 'lock']],
		];

		$require = ['status'];

		$meta = [];

		$data = \dash\cleanse::input($_args, $condition, $require, $meta);

		$load = \lib\app\tax\doc\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			\dash\notif::error(T_("Document not found"));
			return false;
		}

		if(!a($load, 'status'))
		{
			\lib\app\tax\doc\balance::set($load['id']);
			$load = \lib\app\tax\doc\get::get($_id);

			if(!a($load, 'status'))
			{
				\dash\notif::error(T_("Can not set document status"));
				return false;
			}
		}

		if($load['status'] === 'draft')
		{
			\dash\notif::error(T_("This accounting document is not balance!"));
			return false;
		}

		if($load['status'] === $data['status'])
		{
			\dash\notif::warn(T_("This status already set on this document"));
			return false;
		}


		$data['datemodified'] = date("Y-m-d H:i:s");
		\lib\db\tax_document\update::update($data, $load['id']);

		if($data['status'] === 'lock')
		{
			\dash\notif::ok_once(T_("Accounting document locked"));
		}
		else
		{
			\dash\notif::ok_once(T_("Accounting document Unlocked"));
		}

		return true;


	}

	public static function edit($_args, $_id, $_edit_status = false, $_option = [])
	{
		$load = \lib\app\tax\doc\get::get($_id);

		if(!$load || !isset($load['id']))
		{
			return false;
		}

		$load = array_merge($_option, $load);


		$args = \lib\app\tax\doc\check::variable($_args, $load, $load['id']);

		if(!$args)
		{
			return false;
		}


		unset($args['pay_from']);
		unset($args['put_on']);
		unset($args['tax']);
		unset($args['vat']);
		unset($args['thirdparty']);
		unset($args['bank']);
		unset($args['petty_cash']);
		unset($args['partner']);

		$data = \dash\cleanse::patch_mode($_args, $args);

		if(empty($data))
		{
			\dash\notif::info(T_("No change in your data"));
		}
		else
		{
			$data['datemodified'] = date("Y-m-d H:i:s");
			\lib\db\tax_document\update::update($data, $load['id']);
			\dash\notif::ok(T_("Accounting doc successfully updated"));
		}

		return true;
	}

}
?>