<?php
namespace lib\app\irvat;


class ready
{
	public static function row($_data, $_option = [])
	{
		$default_option =
		[
			'load_gallery' => true,
		];

		if(!is_array($_option))
		{
			$_option = [];
		}

		$_option = array_merge($default_option, $_option);

		if(!is_array($_data))
		{
			return false;
		}

		$result = [];
		foreach ($_data as $key => $value)
		{
			switch ($key)
			{
				case 'id':
					$result[$key] = $value;
					break;


				case 'file':
					if($value)
					{
						$result['gallery_array'] = json_decode($value, true);
						if($_option['load_gallery'] && is_array($result['gallery_array']) && $result['gallery_array'])
						{
							$result['gallery_array'] = \lib\app\irvat\gallery::load_detail($result['gallery_array']);
						}
					}
					else
					{
						$result['gallery_array'] = null;
					}
					break;


				case 'factordate':
					$result[$key] = $value;
					if($value)
					{

						if(\dash\language::current() === 'fa')
						{
							$result['factordate_raw'] = \dash\utility\convert::to_en_number(\dash\fit::date($value));
						}
						else
						{
							$result['factordate_raw'] = $value;
						}
					}
					break;


				default:
					$result[$key] = $value;
					break;
			}
		}

		if(isset($result['subtotalitembyvat']) && isset($result['sumvat']))
		{
			$vat_ok = false;
			$vat_9_percent = floatval($result['subtotalitembyvat']) * 0.09;

			if(round($vat_9_percent) === round(floatval($result['sumvat'])))
			{
				$vat_ok = true;
			}
			elseif(abs(round($vat_9_percent) - floatval($result['sumvat'])) === floatval(1))
			{
				$vat_ok = true;
			}

			$result['vat_9_percent'] = $vat_9_percent;

			$result['vat_ok'] = $vat_ok;

		}

		return $result;
	}
}
?>