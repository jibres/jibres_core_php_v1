<?php
namespace lib\app\business_domain;


class ready
{
	public static function row($_data)
	{
		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'status':
					$result[$key] = $value;

					switch ($value) {

						case 'pending':
						case 'failed':
						case 'deleted':
						case 'inprogress':
						case 'cancel':
							$result['tstatus'] = T_(ucfirst($value));
							break;

						case 'ok':
							$result['tstatus'] = T_("Connected");
							break;

						case 'pending_delete':
							$result['tstatus'] = T_("Deleting");
							break;

						case 'dns_not_resolved':
							$result['tstatus'] = T_("DNS not resolved");
							break;

						case 'pending_verify':
							$result['tstatus'] = T_("Pending verify");
							break;

						default:
							$result['tstatus'] = T_("Unknown");
							break;
					}
					break;
				default:
					$result[$key] = $value;
					break;
			}
		}

		return $result;
	}
}
?>