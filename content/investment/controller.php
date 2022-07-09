<?php
namespace content\investment;


class controller
{
	public static function routing()
	{
		$pitchdeckVersion = "1.5";
		$FinancialVersion = "";
		switch (\dash\url::child())
		{
			case 'pitchdeck':
				\dash\redirect::to(\dash\url::cdn(). '/business/pitch-deck/v1/Jibres-PitchDeck-v'. $pitchdeckVersion. '.pdf?v=5');
				break;

			case 'pitchdeck-ppt':
				\dash\redirect::to(\dash\url::cdn(). '/business/pitch-deck/v1/Jibres-PitchDeck-v'. $pitchdeckVersion. '.pptx?v=5');
				break;

			case 'financial':
				\dash\redirect::to(\dash\url::cdn(). '/business/financial/Jibres-Financial-Projection-5b-latest.xlsx?v=6');
				break;

			case 'financial-10b':
				\dash\redirect::to(\dash\url::cdn(). '/business/financial/Jibres-Financial-Projection-10b-latest.xlsx?v=6');
				break;

			case 'financial-20b':
				\dash\redirect::to(\dash\url::cdn(). '/business/financial/Jibres-Financial-Projection-20b-latest.xlsx?v=6');
				break;

			case 'businessplan':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1.2.pdf?v=2');
				break;

			case 'businessplan-onepage':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1.2-OnePage.jpg?v=2');
				break;

			case 'swot':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-plan/Jibres-BusinessPlan-v1.0-SWOT.jpg?v=2');
				break;

			case 'canvas':
				\dash\redirect::to(\dash\url::cdn(). '/business/business-model-canvas/jibres-business-model-canvas-v1.jpg?v=2');
				break;

		}
	}
}
?>