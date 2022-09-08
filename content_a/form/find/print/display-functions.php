<?php


function HTMLIsPrintBefore()
{
	$ids = \dash\data::ids();
	return in_array($ids->printed, \dash\data::tagsSavedID());
}


function HTMLDetectData()
{
	$ids = \dash\data::ids();

	$allTagID       = \dash\data::tagsSavedID();
	$tagWinner      = in_array($ids->win, $allTagID);
	$tagRemain      = in_array($ids->remain, $allTagID);
	$tagPrintBefore = HTMLIsPrintBefore();
	$province       = \dash\data::provinceCode();
	$eastProvince   = isEastProvince($province);

	if($tagWinner)
	{
		$payablePrice = 2000000;

		if($eastProvince)
		{
			$payablePrice = 2500000;
		}
	}
	elseif($tagRemain)
	{
		$payablePrice = 500000;
	}
	else
	{
		$payablePrice = 0;
	}

	$currency = T_("Toman");

	$data = (object)
	[
		'tagPrintBefore' => $tagPrintBefore,
		'tagWinner'      => $tagWinner,
		'eastProvince'   => $eastProvince,
		'tagRemain'      => $tagRemain,
		'payablePrice'   => $payablePrice,
		'currency'       => $currency,
	];

	return $data;
}

function isEastProvince($_province)
{
	// مبلغ هدیه برای ساکنین استان‌های شرقی شامل سیستان، کرمان، خراسان‌ها و گلستان معادل ۲.۵ میلیون تومان و برای سایر استان‌ها ۲ میلیون تومان می‌باشد
	$eastProvince =
		[
			'IR-13', // systan
			'IR-15', // kerman
			'IR-29', // khorasan
			'IR-30', // khorasan
			'IR-31', // khorasan
			'IR-27', // golestan

		];

	if(in_array($_province, $eastProvince))
	{
		return true;
	}
	else
	{
		return false;
	}
}


function HTMLWinnerMessage(object $data)
{
	$html = '';
	$html .= '<div class="alert">';
	{
		$html .= '
			ضمن عرض تسلیت به مناسبت فرارسیدن اربعین حسینی
			<br>
		 خدا را شکر که در جوانی توفیق تشرف به کربلای معلی نصیب و‌ روزی‌تان شد.
		 ';
	}
	$html .= '</div>';

	$html .= <<<HTML

		<div class="">
		
		 اینجانب هدیه برنامه سمت خدا و موسسه حضرت خدیجه سلام الله علیها را دریافت نمودم و متعهد می‌شوم این مبلغ را صرفا برای سفر اربعین هزینه کنم
		<br>
		همچنین با امضاء این فرم اعلام میدارم که از سایر نهادها کمک حمایتی اربعین دریافت نکرده ام
			
			<div class="txtRa">
			امضا
			</div>
		</div>

HTML;

	return $html;
}


function HTMLOtherMessage(object $data)
{
	$html = '';
	$html .= <<<HTML
متاسفانه شما شرایط لازم را برای دریافت هدیه ندارید. 
HTML;

	return $html;
}


function HTMLPaAblePrice(object $data)
{
	$price = \dash\fit::number($data->payablePrice);
	$html  = '';
	$html  .= '<div class="alert">';
	{
		$html .= <<<HTML
<div>
مبلغ هدیه شما

<span class="font-bold">$price</span>

تومان
می باشد

</div>
HTML;


	}
	$html .= '</div>';
	return $html;
}


function HTMLPrintBefore(object $data)
{
	$date = date("Y-m-d H:i:s");
	$date = \dash\fit::date_time($date);
	$html = '';
	$html .= '<div class="alert text-xl">';
	{
		$html .= <<<HTML

هدیه تحویل داده شد 

<span class="ltr">$date</span>

HTML;

	}
	$html .= '</div>';
	return $html;
}


?>