<?php
namespace Aws\DevOpsGuru;

use Aws\AwsClient;

/**
 * This client is used to interact with the **Amazon DevOps Guru** service.
 * @method \Aws\Result addNotificationChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise addNotificationChannelAsync(array $args = [])
 * @method \Aws\Result describeAccountHealth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountHealthAsync(array $args = [])
 * @method \Aws\Result describeAccountOverview(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAccountOverviewAsync(array $args = [])
 * @method \Aws\Result describeAnomaly(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeAnomalyAsync(array $args = [])
 * @method \Aws\Result describeInsight(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeInsightAsync(array $args = [])
 * @method \Aws\Result describeResourceCollectionHealth(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeResourceCollectionHealthAsync(array $args = [])
 * @method \Aws\Result describeServiceIntegration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise describeServiceIntegrationAsync(array $args = [])
 * @method \Aws\Result getResourceCollection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getResourceCollectionAsync(array $args = [])
 * @method \Aws\Result listAnomaliesForInsight(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAnomaliesForInsightAsync(array $args = [])
 * @method \Aws\Result listEvents(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listEventsAsync(array $args = [])
 * @method \Aws\Result listInsights(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listInsightsAsync(array $args = [])
 * @method \Aws\Result listNotificationChannels(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listNotificationChannelsAsync(array $args = [])
 * @method \Aws\Result listRecommendations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listRecommendationsAsync(array $args = [])
 * @method \Aws\Result putFeedback(array $args = [])
 * @method \GuzzleHttp\Promise\Promise putFeedbackAsync(array $args = [])
 * @method \Aws\Result removeNotificationChannel(array $args = [])
 * @method \GuzzleHttp\Promise\Promise removeNotificationChannelAsync(array $args = [])
 * @method \Aws\Result searchInsights(array $args = [])
 * @method \GuzzleHttp\Promise\Promise searchInsightsAsync(array $args = [])
 * @method \Aws\Result updateResourceCollection(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateResourceCollectionAsync(array $args = [])
 * @method \Aws\Result updateServiceIntegration(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateServiceIntegrationAsync(array $args = [])
 */
class DevOpsGuruClient extends AwsClient {}
