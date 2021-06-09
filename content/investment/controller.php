<?php
namespace content\investment;


class controller
{
	public static function routing()
	{
		$pitchdeckVersion = "1.1";
		switch (\dash\url::child())
		{
			case 'pitchdeck':
				\dash\redirect::to(\dash\url::cdn(). '/business/pitch-deck/v1/Jibres-PitchDeck-v'. $pitchdeckVersion. '.pdf?v=1');
				break;

			case 'pitchdeck-ppt':
				\dash\redirect::to(\dash\url::cdn(). '/business/pitch-deck/v1/Jibres-PitchDeck-v'. $pitchdeckVersion. '.pptx?v=1');
				break;

			case 'financial':
				\dash\redirect::to(\dash\url::cdn(). '/business/financial/Jibres-Financial-Projection-v1.xlsx?v=1');
				break;

			case 'businessplan':
				\dash\redirect::to(\dash\url::cdn(). '/business/pitch-deck/v1/Jibres-PitchDeck-v1.1.pdf?v=1');
				break;
		}
	}
}
?>