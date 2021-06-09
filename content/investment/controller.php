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
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1.pdf?v=1');
				break;

			case 'businessplan-onepage':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1-OnePage.jpg?v=1');
				break;

			case 'swot':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1-SWOT.jpg?v=1');
				break;

			case 'canvas':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-model-canvas/jibres-business-model-canvas-v1.jpg?v=1');
				break;

		}
	}
}
?>