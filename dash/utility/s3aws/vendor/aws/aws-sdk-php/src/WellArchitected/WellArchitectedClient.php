<?php
namespace Aws\WellArchitected;

use Aws\AwsClient;

/**
 * This client is used to interact with the **AWS Well-Architected Tool** service.
 * @method \Aws\Result associateLenses(array $args = [])
 * @method \GuzzleHttp\Promise\Promise associateLensesAsync(array $args = [])
 * @method \Aws\Result createMilestone(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createMilestoneAsync(array $args = [])
 * @method \Aws\Result createWorkload(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createWorkloadAsync(array $args = [])
 * @method \Aws\Result createWorkloadShare(array $args = [])
 * @method \GuzzleHttp\Promise\Promise createWorkloadShareAsync(array $args = [])
 * @method \Aws\Result deleteWorkload(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteWorkloadAsync(array $args = [])
 * @method \Aws\Result deleteWorkloadShare(array $args = [])
 * @method \GuzzleHttp\Promise\Promise deleteWorkloadShareAsync(array $args = [])
 * @method \Aws\Result disassociateLenses(array $args = [])
 * @method \GuzzleHttp\Promise\Promise disassociateLensesAsync(array $args = [])
 * @method \Aws\Result getAnswer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getAnswerAsync(array $args = [])
 * @method \Aws\Result getLensReview(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLensReviewAsync(array $args = [])
 * @method \Aws\Result getLensReviewReport(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLensReviewReportAsync(array $args = [])
 * @method \Aws\Result getLensVersionDifference(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getLensVersionDifferenceAsync(array $args = [])
 * @method \Aws\Result getMilestone(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getMilestoneAsync(array $args = [])
 * @method \Aws\Result getWorkload(array $args = [])
 * @method \GuzzleHttp\Promise\Promise getWorkloadAsync(array $args = [])
 * @method \Aws\Result listAnswers(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listAnswersAsync(array $args = [])
 * @method \Aws\Result listLensReviewImprovements(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listLensReviewImprovementsAsync(array $args = [])
 * @method \Aws\Result listLensReviews(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listLensReviewsAsync(array $args = [])
 * @method \Aws\Result listLenses(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listLensesAsync(array $args = [])
 * @method \Aws\Result listMilestones(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listMilestonesAsync(array $args = [])
 * @method \Aws\Result listNotifications(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listNotificationsAsync(array $args = [])
 * @method \Aws\Result listShareInvitations(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listShareInvitationsAsync(array $args = [])
 * @method \Aws\Result listWorkloadShares(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listWorkloadSharesAsync(array $args = [])
 * @method \Aws\Result listWorkloads(array $args = [])
 * @method \GuzzleHttp\Promise\Promise listWorkloadsAsync(array $args = [])
 * @method \Aws\Result updateAnswer(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateAnswerAsync(array $args = [])
 * @method \Aws\Result updateLensReview(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateLensReviewAsync(array $args = [])
 * @method \Aws\Result updateShareInvitation(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateShareInvitationAsync(array $args = [])
 * @method \Aws\Result updateWorkload(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateWorkloadAsync(array $args = [])
 * @method \Aws\Result updateWorkloadShare(array $args = [])
 * @method \GuzzleHttp\Promise\Promise updateWorkloadShareAsync(array $args = [])
 * @method \Aws\Result upgradeLensReview(array $args = [])
 * @method \GuzzleHttp\Promise\Promise upgradeLensReviewAsync(array $args = [])
 */
class WellArchitectedClient extends AwsClient {}
