<?php
namespace content_site\assemble;


class cert
{
	public static function enamad($_class = null)
	{
		// load enamad data
		$storeData = \dash\data::store_store_data();

		if(isset($storeData['enamad']))
		{
			$explode_enamad = explode('_', $storeData['enamad']);
			if(isset($explode_enamad[0]) && isset($explode_enamad[1]))
			{
				$linkHref = 'https://trustseal.enamad.ir/?id='. $explode_enamad[0]. '&amp;Code='. $explode_enamad[1];
				$imgSrc = 'https://Trustseal.eNamad.ir/logo.aspx?id='. $explode_enamad[0]. '&amp;Code='. $explode_enamad[1];
				// $imgSrc = \dash\url::icon();

				$html = '<a data-cert="enamad" referrerpolicy="origin" target="_blank" href="'. $linkHref. '"';
				if($_class)
				{
					$html .= ' class="'. $_class. '"';
				}
				$html .= '>';
				$html .= '<img referrerpolicy="origin" src="'. $imgSrc. '" alt="'. T_("Enamad Certificate"). '" id="'.$explode_enamad[1].'">';
				$html .= '</a>';

				return $html;
			}
		}
		return null;
	}


	public static function samandehi($_class = null)
	{
		$storeData = \dash\data::store_store_data();
		$samandehi_link1 = isset($storeData['samandehi_link1']) ? $storeData['samandehi_link1'] : null;
		$samandehi_link2 = isset($storeData['samandehi_link2']) ? $storeData['samandehi_link2'] : null;


		$linkHref = '#';
		$imgSrc = '';
		$imgSrc = \dash\url::icon();

		if($linkHref && $imgSrc)
		{
			$html = '<div data-cert="samandehi" id="samandehiCert" data-open="'. $linkHref. '"';
			if($_class)
			{
				$html .= ' class="'. $_class. '"';
			}
			$html .= '>';
			$html .= '<img src="'. $imgSrc.'" alt="'. T_("Samandehi Certificate").'">';
			$html .= '</div>';

			return $html;
		}

		return null;
	}

}
?>