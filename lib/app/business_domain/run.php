<?php
namespace lib\app\business_domain;


class run
{
	public static function run()
	{
		/**
		 * Manual operation spte by step
		 *
		 * 1. check resolve DNS
		 * 		- if ok : go to step 2
		 * 		- else : check again in 1 hour later
		 *
		 * 2. check DNS is set on our DNS record
		 * 		- if ok: go to step 3
		 * 		- else: check again in 1 hour later
		 *
		 * 3. Add to cdn panel
		 * 		- if ok : go to 4
		 * 		- else alert to supervisor why this domain can not add to cnd panel
		 *
		 * 4. Add dns record of jibres
		 * 		- if ok : go to 5
		 * 		- else alert to supervisor why this domain can add dns record
		 *
		 * 5. Add request of https
		 * 6. chekc is https enable at 10 min
		 * 7. DONE
		 *
		 */

		self::pending_dns_sync();

		self::pending_domain_delete();


		self::check_free_domains();


		// check dns resolved
		// check dns is set on our dns record

		self::check_dns();

		self::add_to_cdn_panel();

		self::add_dns_record();

		self::https_request();

		self::https_request_check();

	}


	private static function have_pending_domain()
	{
		$result = \lib\db\business_domain\get::have_pending_domain();

		if(!$result)
		{
			return false;
		}

		return true;
	}


	private static function pending_dns_sync()
	{
		$pending_dns_add =  \lib\db\business_domain\get::pending_dns_add();

		$pending_dns_remove =  \lib\db\business_domain\get::pending_dns_remove();

		if(!$pending_dns_add && !$pending_dns_remove)
		{
			return;
		}

		foreach ($pending_dns_remove as $key => $value)
		{
			\lib\app\business_domain\dns::remove($value['business_domain_id'], $value['id']);
		}

		foreach ($pending_dns_add as $key => $value)
		{
			\lib\app\business_domain\dns::add_dns_to_cdn_panel($value['business_domain_id'], $value['id']);
		}


	}


	private static function pending_domain_delete()
	{
		$pending_domain_delete =  \lib\db\business_domain\get::pending_domain_delete();
		if(!$pending_domain_delete)
		{
			return;
		}

		foreach ($pending_domain_delete as $key => $value)
		{
			\lib\app\business_domain\remove::remove($value['id']);
		}
	}


	private static function check_dns()
	{
		$last_domain_not_resolved =  \lib\db\business_domain\get::last_domain_not_resolved();

		if(!$last_domain_not_resolved)
		{
			return;
		}

		foreach ($last_domain_not_resolved as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');

			if(isset($value['last_action_time']))
			{
				if(time() - strtotime($value['last_action_time']) < (60*5))
				{
					continue;
				}
			}

			\lib\app\business_domain\dns::check($value['id']);
		}
	}


	private static function add_to_cdn_panel()
	{
		$last_not_added_to_cdn_panel =  \lib\db\business_domain\get::last_not_added_to_cdn_panel();

		if(!$last_not_added_to_cdn_panel)
		{
			return;
		}

		foreach ($last_not_added_to_cdn_panel as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');
			\lib\app\business_domain\cdnpanel::add($value['id']);
			\lib\app\business_domain\dns::check_if_not_exist_add($value['id']);
		}
	}



	private static function add_dns_record()
	{
		$last_not_add_dns_record =  \lib\db\business_domain\get::last_not_add_dns_record();

		if(!$last_not_add_dns_record)
		{
			return;
		}

		foreach ($last_not_add_dns_record as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');
			\lib\app\business_domain\dns::check_if_not_exist_add($value['id']);
		}
	}


	private static function https_request()
	{
		$last_not_send_https_request =  \lib\db\business_domain\get::last_not_send_https_request();


		if(!$last_not_send_https_request)
		{
			return;
		}

		foreach ($last_not_send_https_request as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');
			\lib\app\business_domain\https::request($value['id']);
		}
	}


	private static function https_request_check()
	{
		$date = date("Y-m-d H:i:s", time() - (60*10));

		$last_waiting_https_request =  \lib\db\business_domain\get::last_waiting_https_request($date);


		if(!$last_waiting_https_request)
		{
			return;
		}

		foreach ($last_waiting_https_request as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');
			\lib\app\business_domain\https::request($value['id']);
		}
	}



	/**
	 * For example mradib.com
	 * this domain is enterprise domain
	 * need check headers
	 */
	private static function check_free_domains()
	{

		$last_free_domains =  \lib\db\business_domain\get::last_free_domains();

		if(!$last_free_domains)
		{
			return;
		}

		foreach ($last_free_domains as $key => $value)
		{
			\lib\app\business_domain\edit::set_date($value['id'], 'datemodified');
			\lib\app\business_domain\free_domain::check($value['id']);
		}
	}



	public static function re_pending_dns_not_active()
	{
		\lib\db\business_domain\update::re_pending_dns_not_active();
	}
}
?>