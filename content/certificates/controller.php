<?php
namespace content\certificates;


class controller
{
	public static function routing()
	{
		if(\dash\url::child())
		{
			$link;
			switch (\dash\url::child())
			{
				case 'nsr':
					$link = "http://qom-new.irannsr.org/fa/page/107243-%D9%85%D8%B4%D8%A7%D9%87%D8%AF%D9%87-%D8%A7%D8%B9%D8%B6%D8%A7.html?ctp_id=1086&id=22998";
					break;

				case 'daneshbonyan':
					$link = "https://pub.daneshbonyan.ir/";
					break;

				case 'irnic':
					$link = "https://www.nic.ir/List_of_Resellers";
					break;

				case 'enamad':
					$link = "https://trustseal.enamad.ir/?id=118387&Code=2iL8ULp5lVA5oSXMRiLp";
					break;

				default:
					break;
			}

			if($link)
			{
				\dash\redirect::to($link);
			}
		}

	}
}
?>