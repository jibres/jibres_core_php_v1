<?php

namespace lib\app\plan\feature;

use lib\app\plan\plan;

class generate
{

	public static function loadFeature($_feature, $_args)
	{
		$class       = __NAMESPACE__ . '\\' . $_feature;
		$loadFeature = new $class($_args);
		return $loadFeature;
	}


	public static function featureList(plan $_plan) : array
	{
		$result  = [];
		$contain = $_plan->contain();

		foreach ($contain as $feature => $initArgs)
		{
			$loadFeature = self::loadFeature($feature, $initArgs);

			$group = $loadFeature->group();
			$title = $loadFeature->title();
			$value = $loadFeature->value();

			if(!isset($result[$group]))
			{
				$result[$group] = [];
			}

			$result[$group][$title] = $value;
		}

		return $result;
	}


	public static function outstandingFeatures(plan $_plan)
	{
		$result  = [];
		$contain = $_plan->contain();

		foreach ($contain as $feature => $initArgs)
		{
			$loadFeature = self::loadFeature($feature, $initArgs);

			$title = $loadFeature->title();
			$value = $loadFeature->value();

			if($value)
			{
				if(is_string($value))
				{
					$result[] = $title . ' '. $value;
				}
				else
				{
					$result[] = $title;
				}
			}


		}

		return $result;
	}

}