<?php
namespace content_site\assemble;


class cert
{
	public static function enamad($_class = null)
	{
		// load enamad data
		$enamad = \lib\store::detail('enamad');

		if($enamad)
		{
			$explode_enamad = explode('_', $enamad);
			if(isset($explode_enamad[0]) && isset($explode_enamad[1]))
			{
				$linkHref = 'https://trustseal.enamad.ir/?id='. $explode_enamad[0]. '&amp;Code='. $explode_enamad[1];
				$imgSrc = 'https://Trustseal.eNamad.ir/logo.aspx?id='. $explode_enamad[0]. '&amp;Code='. $explode_enamad[1];


				$html = '<a data-cert="enamad" referrerpolicy="origin" target="_blank" href="'. $linkHref. '"';
				if($_class)
				{
					$html .= ' class="'. $_class. '"';
				}
				$html .= '>';
				$html .= '<img class="max-w-full max-h-full m-auto" referrerpolicy="origin" src="'. $imgSrc. '" alt="'. T_("Enamad Certificate"). '" id="'.$explode_enamad[1].'">';
				$html .= '</a>';

				return $html;
			}
		}
		return null;
	}


	public static function samandehi($_class = null)
	{
		$samandehi_link1 = \lib\store::detail('samandehi_link1');
		$samandehi_link2 = \lib\store::detail('samandehi_link2');


		$html = '';

		if($samandehi_link1 && $samandehi_link2)
		{
			$html .= '<div data-cert="samandehi" id="samandehiCert" data-open="'. $samandehi_link1. '"';
			if($_class)
			{
				$html .= ' class="'. $_class. '"';
			}
			$html .= '>';

			$html .= '<img class="max-w-full max-h-full m-auto" src="'. $samandehi_link2.'" alt="'. T_("Samandehi Certificate").'">';

			$html .= '</div>';
		}

		return $html;
	}


	public static function payping($_class = null)
	{
		$linkHref = 'https://oauth.payping.ir/trust';
		$imgSrc = \dash\url::cdn(). '/img/thirdparty/bank/payping-logo-blue.svg';
		$html = '';

		$payping = a(\lib\app\setting\get::bank_payment_setting(), 'payping');
		if(a($payping, 'status') && a($payping, 'token'))
		{
			$html = '<a data-cert="payping" referrerpolicy="origin" target="_blank" href="'. $linkHref. '"';
			if($_class)
			{
				$html .= ' class="'. $_class. '"';
			}
			$html .= '>';
			$html .= '<img class="max-w-full max-h-full m-auto" referrerpolicy="origin" src="'. $imgSrc. '" alt="'. T_("Payping Certificate"). '">';
			$html .= '</a>';
		}

		return $html;
	}
}
?>