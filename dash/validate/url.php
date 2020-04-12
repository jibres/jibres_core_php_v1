<?php
namespace dash\validate;
/**
 * Class for validate args
 */
class url
{

	public static function url($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_URL))
		{
			if($_notif)
			{
				\dash\notif::error(T_("Url is invalid"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		return $data;
	}


	public static function domain($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);
		if($data === false || $data === null)
		{
			return $data;
		}


		if(strpos($data, '.') === false)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Domain must be contain one dot character."), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		if(substr_count($data, '.') > 3)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Doamin can contain maximum 3 dot character"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		$data = urldecode($data);
		$data = mb_strtolower($data);

		$data = str_replace('http://', '', $data);
		$data = str_replace('https://', '', $data);
		$data = str_replace(':', '', $data);

		if(strpos($data, '/') !== false)
		{
			$data = str_replace(substr($data, strpos($data, '/')), '', $data);
		}

		$data = str_replace('/', '', $data);

		return $data;
	}

	public static function domain_root($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);
		if($data === false || $data === null)
		{
			return $data;
		}

		if(substr_count($data, '.') > 2)
		{
			if($_notif)
			{
				\dash\notif::error(T_("Doamin can contain maximum 3 dot character"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		// $data = mb_ereg_replace('([^ءئؤيكإأةآا-ی۰-۹a-z0-9A-Z\.])+', '', $data);
		$data = urldecode($data);
		$data = mb_strtolower($data);

		$data = str_replace('http://', '', $data);
		$data = str_replace('https://', '', $data);
		$data = str_replace(':', '', $data);

		if(strpos($data, '/') !== false)
		{
			$data = str_replace(substr($data, strpos($data, '/')), '', $data);
		}

		$data = str_replace('/', '', $data);

		return $data;
	}


	public static function ir_domain($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/\.(ir|ایران|ايران|id\.ir|gov\.ir|co\.ir|net\.ir|org\.ir|sch\.ir|ac\.ir)$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("This is not an IR domain"), ['element' => $_element, 'code' => 1605]);
			}
			return false;

		}
		$data = urldecode($data);
		$data = mb_strtolower($data);

		$data = str_replace('http://', '', $data);
		$data = str_replace('https://', '', $data);
		$data = str_replace(':', '', $data);

		if(strpos($data, '/') !== false)
		{
			$data = str_replace(substr($data, strpos($data, '/')), '', $data);
		}

		$data = str_replace('/', '', $data);

		return $data;
	}



	public static function ip($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!filter_var($data, FILTER_VALIDATE_IP))
		{
			if($_notif)
			{
				\dash\notif::error(T_("IP is invalid"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		return $data;
	}


	public static function dns($_data, $_notif = false, $_element = null, $_field_title = null)
	{
		$data = \dash\validate\text::string($_data, $_notif, $_element, $_field_title, ['min' => 3, 'max' => 100]);

		if($data === false || $data === null)
		{
			return $data;
		}

		if(!preg_match("/^[a-zA-Z0-9\-\.]+$/", $data))
		{
			if($_notif)
			{
				\dash\notif::error(T_("DNS is invalid"), ['element' => $_element, 'code' => 1605]);
			}
			return false;
		}

		$data = urldecode($data);
		$data = mb_strtolower($data);


		return $data;
	}

}
?>