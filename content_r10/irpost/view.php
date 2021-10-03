<?php
namespace content_r10\irpost;


class view
{
	public static function config()
	{

		$irpostResult = [];
		$weight       = \dash\request::get('weight');
		$type         = \dash\request::get('type');

		if($weight && $type)
		{
			$meta                  = [];
			$meta['detail']        = 1;
			$meta['type']          = $type;
			$meta['package_type']  = \dash\request::get('package_type');
			$meta['from_province'] = \dash\request::get('from_province');
			$meta['from_city']     = \dash\request::get('from_city');
			$meta['send_type']     = \dash\request::get('send_type');
			$meta['to_province']   = \dash\request::get('to_province');
			$meta['to_city']       = \dash\request::get('to_city');

			$irpostResult = \dash\utility\ir_post::calculate($weight, $meta);
			\dash\data::irpostResult($irpostResult);
		}
		else
		{
			\dash\notif::info('Hello, welcome. Please read the below');
			$irpostResult =
			[
				'Param' =>
				[
					'weight'        => 'integer, Required',
					'type'          => '[sefareshi|pishtaz] Required',
					'send_type'     => '[inprovince|otherprovince]',
					'from_province' => '[Province Code]',
					'from_city'     => '[City Code]',
					'to_province'   => '[Province Code]',
					'to_city'       => '[City Code]',
				],
				'Method'            => 'GET',
				'Get province code' => \dash\url::here(). '/location/province?country=IR',
				'Get city code'     => \dash\url::here(). '/location/city?province=IR-07',
				'example'           => \dash\url::this(). '?weight=1000&type=pishtaz&from_province=IR-07&from_city=tehran&send_type=otherprovince&to_province=IR-30&to_city=mashahd',
				"sample result"     =>
				[
					"basic"           => 112000,
					"province_center" => 11200,
					"insurance"       => 8000,
					"vat"             => 11808,
					"price"           => 143008,
					"currency"        => "Rial"
				],
			];
		}

		\content_r10\tools::say($irpostResult);
	}
}
?>