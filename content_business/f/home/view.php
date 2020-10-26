<?php
namespace content_business\f\home;

class view
{
	public static function config()
	{
		if(\dash\data::formDetail_title())
		{
			\dash\face::title(\dash\data::formDetail_title());
		}
		else
		{
			$store_title = \lib\store::detail('title');
			if($store_title)
			{
				\dash\face::title(T_("Forms"). ' | '. $store_title);
			}

		}

		if(\dash\data::formDetail_desc())
		{
			\dash\face::desc(strip_tags(\dash\data::formDetail_desc()));
		}
		else
		{
			\dash\face::desc(\dash\data::formDetail_title());
		}

		if(\dash\data::formDetail_file())
		{
			\dash\face::cover(\dash\data::formDetail_file());
			\dash\face::twitterCard('summary_large_image');
		}

		if(\dash\data::inquiryForm())
		{
			if(\dash\data::formDetail_inquiryimage())
			{
				\dash\face::cover(\dash\data::formDetail_inquiryimage());
				\dash\face::twitterCard('summary_large_image');
			}

			if(\dash\data::formDetail_inquirymsg())
			{
				\dash\face::desc(strip_tags(\dash\data::formDetail_inquirymsg()));
			}
		}

		self::static_var();
	}

	private static function static_var()
	{
		$countryList = \dash\utility\location\countres::$data;
		\dash\data::countryList($countryList);

		$cityList    = \dash\utility\location\cites::$data;
		$proviceList = \dash\utility\location\provinces::key_list('localname');

		$new = [];
		foreach ($cityList as $key => $value)
		{
			$temp = '';

			if(isset($value['province']) && isset($proviceList[$value['province']]))
			{
				$temp .= $proviceList[$value['province']]. ' - ';
			}
			if(isset($value['localname']))
			{
				$temp .= $value['localname'];
			}
			$new[$key] = $temp;
		}
		asort($new);

		\dash\data::cityList($new);
	}
}
?>