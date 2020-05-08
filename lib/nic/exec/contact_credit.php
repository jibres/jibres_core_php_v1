<?php
namespace lib\nic\exec;


class contact_credit
{


	public static function credit()
	{

		$contact = 'ji128-irnic';

		$credit = self::analyze_contact_credit($contact);
		if(!$credit || !is_array($credit))
		{
			return false;
		}

		return $credit;
	}




	private static function analyze_contact_credit($_args)
	{

		$object_result = self::send_xml($_args);
		// $object_result = file_get_contents('/home/reza/projects/jibres/lib/nic/exec/contact_credit_sample_response.xml');
		// $object_result = @new \SimpleXMLElement($object_result);


		if(!$object_result)
		{
			return false;
		}

		$result = [];

		if(!isset($object_result->response->extension))
		{
			return false;
		}

		foreach ($object_result->response->extension as  $extension)
		{
			foreach ($extension as  $creditLog)
			{

				foreach ($creditLog as  $credit)
				{
					$attr             = $credit->attributes();
					$attr             = (array) $attr;
					$temp = [];

					if(isset($attr['@attributes']))
					{
						$attr = $attr['@attributes'];
					}

					if(isset($attr['roid']))
					{
						$temp['roid'] = $attr['roid'];
					}


					if(isset($credit->date))
					{
						$date = $credit->date->__toString();
						if(strtotime($date) !== false)
						{
							$date = date("Y-m-d H:i:s", strtotime($date));
						}
						else
						{
							$date = null;
						}
						$temp['date'] = $date;
					}

					if(isset($credit->description))
					{
						$temp['description'] = trim($credit->description->__toString());
					}

					if(isset($credit->amount))
					{
						$amount = $credit->amount->__toString();

						if(is_numeric($amount))
						{
							$amount = floatval($amount) * 100;
						}
						else
						{
							$amount = null;
						}

						$temp['amount'] = $amount;
					}

					if(isset($credit->balance))
					{
						$balance = $credit->balance->__toString();
						if(is_numeric($balance))
						{
							$balance = floatval($balance) * 100;
						}
						else
						{
							$balance = null;
						}
						$temp['balance'] = $balance;
					}

					$result[] = $temp;
				}
			}
		}

		return $result;
	}



	private static function send_xml($_contact)
	{
		$addr = root. 'lib/nic/exec/samples/contact_credit.xml';
		$xml = \dash\file::read($addr);

		if(!$xml)
		{
			return false;
		}

		$xml = str_replace('JIBRES-CONACT-FOR-INFO', $_contact, $xml);
		$xml = str_replace('JIBRES-START-DATE', "2020-01-01", $xml);
		$xml = str_replace('JIBRES-END-DATE', date("Y-m-d"), $xml);

		$response = \lib\nic\exec\run::send($xml, 'contact_credit', 1, null, $_contact);

		return $response;
	}
}
?>