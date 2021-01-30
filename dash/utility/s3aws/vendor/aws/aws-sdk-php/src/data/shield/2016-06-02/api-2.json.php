<?php
// This file was auto-generated from sdk-root/src/data/shield/2016-06-02/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2016-06-02', 'endpointPrefix' => 'shield', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceAbbreviation' => 'AWS Shield', 'serviceFullName' => 'AWS Shield', 'serviceId' => 'Shield', 'signatureVersion' => 'v4', 'targetPrefix' => 'AWSShield_20160616', 'uid' => 'shield-2016-06-02', ], 'operations' => [ 'AssociateDRTLogBucket' => [ 'name' => 'AssociateDRTLogBucket', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AssociateDRTLogBucketRequest', ], 'output' => [ 'shape' => 'AssociateDRTLogBucketResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'NoAssociatedRoleException', ], [ 'shape' => 'LimitsExceededException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'AccessDeniedForDependencyException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'AssociateDRTRole' => [ 'name' => 'AssociateDRTRole', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AssociateDRTRoleRequest', ], 'output' => [ 'shape' => 'AssociateDRTRoleResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'AccessDeniedForDependencyException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'AssociateHealthCheck' => [ 'name' => 'AssociateHealthCheck', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AssociateHealthCheckRequest', ], 'output' => [ 'shape' => 'AssociateHealthCheckResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'LimitsExceededException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'AssociateProactiveEngagementDetails' => [ 'name' => 'AssociateProactiveEngagementDetails', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'AssociateProactiveEngagementDetailsRequest', ], 'output' => [ 'shape' => 'AssociateProactiveEngagementDetailsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'CreateProtection' => [ 'name' => 'CreateProtection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateProtectionRequest', ], 'output' => [ 'shape' => 'CreateProtectionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidResourceException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'LimitsExceededException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'CreateProtectionGroup' => [ 'name' => 'CreateProtectionGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateProtectionGroupRequest', ], 'output' => [ 'shape' => 'CreateProtectionGroupResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'LimitsExceededException', ], ], ], 'CreateSubscription' => [ 'name' => 'CreateSubscription', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'CreateSubscriptionRequest', ], 'output' => [ 'shape' => 'CreateSubscriptionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceAlreadyExistsException', ], ], ], 'DeleteProtection' => [ 'name' => 'DeleteProtection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteProtectionRequest', ], 'output' => [ 'shape' => 'DeleteProtectionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'DeleteProtectionGroup' => [ 'name' => 'DeleteProtectionGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteProtectionGroupRequest', ], 'output' => [ 'shape' => 'DeleteProtectionGroupResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DeleteSubscription' => [ 'name' => 'DeleteSubscription', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeleteSubscriptionRequest', ], 'output' => [ 'shape' => 'DeleteSubscriptionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'LockedSubscriptionException', ], [ 'shape' => 'ResourceNotFoundException', ], ], 'deprecated' => true, ], 'DescribeAttack' => [ 'name' => 'DescribeAttack', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeAttackRequest', ], 'output' => [ 'shape' => 'DescribeAttackResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'AccessDeniedException', ], ], ], 'DescribeAttackStatistics' => [ 'name' => 'DescribeAttackStatistics', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeAttackStatisticsRequest', ], 'output' => [ 'shape' => 'DescribeAttackStatisticsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], ], ], 'DescribeDRTAccess' => [ 'name' => 'DescribeDRTAccess', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeDRTAccessRequest', ], 'output' => [ 'shape' => 'DescribeDRTAccessResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DescribeEmergencyContactSettings' => [ 'name' => 'DescribeEmergencyContactSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeEmergencyContactSettingsRequest', ], 'output' => [ 'shape' => 'DescribeEmergencyContactSettingsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DescribeProtection' => [ 'name' => 'DescribeProtection', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeProtectionRequest', ], 'output' => [ 'shape' => 'DescribeProtectionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DescribeProtectionGroup' => [ 'name' => 'DescribeProtectionGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeProtectionGroupRequest', ], 'output' => [ 'shape' => 'DescribeProtectionGroupResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DescribeSubscription' => [ 'name' => 'DescribeSubscription', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeSubscriptionRequest', ], 'output' => [ 'shape' => 'DescribeSubscriptionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DisableProactiveEngagement' => [ 'name' => 'DisableProactiveEngagement', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DisableProactiveEngagementRequest', ], 'output' => [ 'shape' => 'DisableProactiveEngagementResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'DisassociateDRTLogBucket' => [ 'name' => 'DisassociateDRTLogBucket', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DisassociateDRTLogBucketRequest', ], 'output' => [ 'shape' => 'DisassociateDRTLogBucketResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'NoAssociatedRoleException', ], [ 'shape' => 'AccessDeniedForDependencyException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DisassociateDRTRole' => [ 'name' => 'DisassociateDRTRole', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DisassociateDRTRoleRequest', ], 'output' => [ 'shape' => 'DisassociateDRTRoleResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'DisassociateHealthCheck' => [ 'name' => 'DisassociateHealthCheck', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DisassociateHealthCheckRequest', ], 'output' => [ 'shape' => 'DisassociateHealthCheckResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'EnableProactiveEngagement' => [ 'name' => 'EnableProactiveEngagement', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'EnableProactiveEngagementRequest', ], 'output' => [ 'shape' => 'EnableProactiveEngagementResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidOperationException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], ], ], 'GetSubscriptionState' => [ 'name' => 'GetSubscriptionState', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetSubscriptionStateRequest', ], 'output' => [ 'shape' => 'GetSubscriptionStateResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], ], ], 'ListAttacks' => [ 'name' => 'ListAttacks', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListAttacksRequest', ], 'output' => [ 'shape' => 'ListAttacksResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'InvalidOperationException', ], ], ], 'ListProtectionGroups' => [ 'name' => 'ListProtectionGroups', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListProtectionGroupsRequest', ], 'output' => [ 'shape' => 'ListProtectionGroupsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidPaginationTokenException', ], ], ], 'ListProtections' => [ 'name' => 'ListProtections', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListProtectionsRequest', ], 'output' => [ 'shape' => 'ListProtectionsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidPaginationTokenException', ], ], ], 'ListResourcesInProtectionGroup' => [ 'name' => 'ListResourcesInProtectionGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListResourcesInProtectionGroupRequest', ], 'output' => [ 'shape' => 'ListResourcesInProtectionGroupResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidPaginationTokenException', ], ], ], 'UpdateEmergencyContactSettings' => [ 'name' => 'UpdateEmergencyContactSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateEmergencyContactSettingsRequest', ], 'output' => [ 'shape' => 'UpdateEmergencyContactSettingsResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'ResourceNotFoundException', ], ], ], 'UpdateProtectionGroup' => [ 'name' => 'UpdateProtectionGroup', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateProtectionGroupRequest', ], 'output' => [ 'shape' => 'UpdateProtectionGroupResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'OptimisticLockException', ], [ 'shape' => 'InvalidParameterException', ], ], ], 'UpdateSubscription' => [ 'name' => 'UpdateSubscription', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateSubscriptionRequest', ], 'output' => [ 'shape' => 'UpdateSubscriptionResponse', ], 'errors' => [ [ 'shape' => 'InternalErrorException', ], [ 'shape' => 'LockedSubscriptionException', ], [ 'shape' => 'ResourceNotFoundException', ], [ 'shape' => 'InvalidParameterException', ], [ 'shape' => 'OptimisticLockException', ], ], ], ], 'shapes' => [ 'AccessDeniedException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'AccessDeniedForDependencyException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'AssociateDRTLogBucketRequest' => [ 'type' => 'structure', 'required' => [ 'LogBucket', ], 'members' => [ 'LogBucket' => [ 'shape' => 'LogBucket', ], ], ], 'AssociateDRTLogBucketResponse' => [ 'type' => 'structure', 'members' => [], ], 'AssociateDRTRoleRequest' => [ 'type' => 'structure', 'required' => [ 'RoleArn', ], 'members' => [ 'RoleArn' => [ 'shape' => 'RoleArn', ], ], ], 'AssociateDRTRoleResponse' => [ 'type' => 'structure', 'members' => [], ], 'AssociateHealthCheckRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionId', 'HealthCheckArn', ], 'members' => [ 'ProtectionId' => [ 'shape' => 'ProtectionId', ], 'HealthCheckArn' => [ 'shape' => 'HealthCheckArn', ], ], ], 'AssociateHealthCheckResponse' => [ 'type' => 'structure', 'members' => [], ], 'AssociateProactiveEngagementDetailsRequest' => [ 'type' => 'structure', 'required' => [ 'EmergencyContactList', ], 'members' => [ 'EmergencyContactList' => [ 'shape' => 'EmergencyContactList', ], ], ], 'AssociateProactiveEngagementDetailsResponse' => [ 'type' => 'structure', 'members' => [], ], 'AttackDetail' => [ 'type' => 'structure', 'members' => [ 'AttackId' => [ 'shape' => 'AttackId', ], 'ResourceArn' => [ 'shape' => 'ResourceArn', ], 'SubResources' => [ 'shape' => 'SubResourceSummaryList', ], 'StartTime' => [ 'shape' => 'AttackTimestamp', ], 'EndTime' => [ 'shape' => 'AttackTimestamp', ], 'AttackCounters' => [ 'shape' => 'SummarizedCounterList', ], 'AttackProperties' => [ 'shape' => 'AttackProperties', ], 'Mitigations' => [ 'shape' => 'MitigationList', ], ], ], 'AttackId' => [ 'type' => 'string', 'max' => 128, 'min' => 1, 'pattern' => '[a-zA-Z0-9\\\\-]*', ], 'AttackLayer' => [ 'type' => 'string', 'enum' => [ 'NETWORK', 'APPLICATION', ], ], 'AttackProperties' => [ 'type' => 'list', 'member' => [ 'shape' => 'AttackProperty', ], ], 'AttackProperty' => [ 'type' => 'structure', 'members' => [ 'AttackLayer' => [ 'shape' => 'AttackLayer', ], 'AttackPropertyIdentifier' => [ 'shape' => 'AttackPropertyIdentifier', ], 'TopContributors' => [ 'shape' => 'TopContributors', ], 'Unit' => [ 'shape' => 'Unit', ], 'Total' => [ 'shape' => 'Long', ], ], ], 'AttackPropertyIdentifier' => [ 'type' => 'string', 'enum' => [ 'DESTINATION_URL', 'REFERRER', 'SOURCE_ASN', 'SOURCE_COUNTRY', 'SOURCE_IP_ADDRESS', 'SOURCE_USER_AGENT', 'WORDPRESS_PINGBACK_REFLECTOR', 'WORDPRESS_PINGBACK_SOURCE', ], ], 'AttackStatisticsDataItem' => [ 'type' => 'structure', 'required' => [ 'AttackCount', ], 'members' => [ 'AttackVolume' => [ 'shape' => 'AttackVolume', ], 'AttackCount' => [ 'shape' => 'Long', ], ], ], 'AttackStatisticsDataList' => [ 'type' => 'list', 'member' => [ 'shape' => 'AttackStatisticsDataItem', ], ], 'AttackSummaries' => [ 'type' => 'list', 'member' => [ 'shape' => 'AttackSummary', ], ], 'AttackSummary' => [ 'type' => 'structure', 'members' => [ 'AttackId' => [ 'shape' => 'String', ], 'ResourceArn' => [ 'shape' => 'String', ], 'StartTime' => [ 'shape' => 'AttackTimestamp', ], 'EndTime' => [ 'shape' => 'AttackTimestamp', ], 'AttackVectors' => [ 'shape' => 'AttackVectorDescriptionList', ], ], ], 'AttackTimestamp' => [ 'type' => 'timestamp', ], 'AttackVectorDescription' => [ 'type' => 'structure', 'required' => [ 'VectorType', ], 'members' => [ 'VectorType' => [ 'shape' => 'String', ], ], ], 'AttackVectorDescriptionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'AttackVectorDescription', ], ], 'AttackVolume' => [ 'type' => 'structure', 'members' => [ 'BitsPerSecond' => [ 'shape' => 'AttackVolumeStatistics', ], 'PacketsPerSecond' => [ 'shape' => 'AttackVolumeStatistics', ], 'RequestsPerSecond' => [ 'shape' => 'AttackVolumeStatistics', ], ], ], 'AttackVolumeStatistics' => [ 'type' => 'structure', 'required' => [ 'Max', ], 'members' => [ 'Max' => [ 'shape' => 'Double', ], ], ], 'AutoRenew' => [ 'type' => 'string', 'enum' => [ 'ENABLED', 'DISABLED', ], ], 'ContactNotes' => [ 'type' => 'string', 'max' => 1024, 'min' => 1, 'pattern' => '^[\\w\\s\\.\\-,:/()+@]*$', ], 'Contributor' => [ 'type' => 'structure', 'members' => [ 'Name' => [ 'shape' => 'String', ], 'Value' => [ 'shape' => 'Long', ], ], ], 'CreateProtectionGroupRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', 'Aggregation', 'Pattern', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], 'Aggregation' => [ 'shape' => 'ProtectionGroupAggregation', ], 'Pattern' => [ 'shape' => 'ProtectionGroupPattern', ], 'ResourceType' => [ 'shape' => 'ProtectedResourceType', ], 'Members' => [ 'shape' => 'ProtectionGroupMembers', ], ], ], 'CreateProtectionGroupResponse' => [ 'type' => 'structure', 'members' => [], ], 'CreateProtectionRequest' => [ 'type' => 'structure', 'required' => [ 'Name', 'ResourceArn', ], 'members' => [ 'Name' => [ 'shape' => 'ProtectionName', ], 'ResourceArn' => [ 'shape' => 'ResourceArn', ], ], ], 'CreateProtectionResponse' => [ 'type' => 'structure', 'members' => [ 'ProtectionId' => [ 'shape' => 'ProtectionId', ], ], ], 'CreateSubscriptionRequest' => [ 'type' => 'structure', 'members' => [], ], 'CreateSubscriptionResponse' => [ 'type' => 'structure', 'members' => [], ], 'DeleteProtectionGroupRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], ], ], 'DeleteProtectionGroupResponse' => [ 'type' => 'structure', 'members' => [], ], 'DeleteProtectionRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionId', ], 'members' => [ 'ProtectionId' => [ 'shape' => 'ProtectionId', ], ], ], 'DeleteProtectionResponse' => [ 'type' => 'structure', 'members' => [], ], 'DeleteSubscriptionRequest' => [ 'type' => 'structure', 'members' => [], 'deprecated' => true, ], 'DeleteSubscriptionResponse' => [ 'type' => 'structure', 'members' => [], 'deprecated' => true, ], 'DescribeAttackRequest' => [ 'type' => 'structure', 'required' => [ 'AttackId', ], 'members' => [ 'AttackId' => [ 'shape' => 'AttackId', ], ], ], 'DescribeAttackResponse' => [ 'type' => 'structure', 'members' => [ 'Attack' => [ 'shape' => 'AttackDetail', ], ], ], 'DescribeAttackStatisticsRequest' => [ 'type' => 'structure', 'members' => [], ], 'DescribeAttackStatisticsResponse' => [ 'type' => 'structure', 'required' => [ 'TimeRange', 'DataItems', ], 'members' => [ 'TimeRange' => [ 'shape' => 'TimeRange', ], 'DataItems' => [ 'shape' => 'AttackStatisticsDataList', ], ], ], 'DescribeDRTAccessRequest' => [ 'type' => 'structure', 'members' => [], ], 'DescribeDRTAccessResponse' => [ 'type' => 'structure', 'members' => [ 'RoleArn' => [ 'shape' => 'RoleArn', ], 'LogBucketList' => [ 'shape' => 'LogBucketList', ], ], ], 'DescribeEmergencyContactSettingsRequest' => [ 'type' => 'structure', 'members' => [], ], 'DescribeEmergencyContactSettingsResponse' => [ 'type' => 'structure', 'members' => [ 'EmergencyContactList' => [ 'shape' => 'EmergencyContactList', ], ], ], 'DescribeProtectionGroupRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], ], ], 'DescribeProtectionGroupResponse' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroup', ], 'members' => [ 'ProtectionGroup' => [ 'shape' => 'ProtectionGroup', ], ], ], 'DescribeProtectionRequest' => [ 'type' => 'structure', 'members' => [ 'ProtectionId' => [ 'shape' => 'ProtectionId', ], 'ResourceArn' => [ 'shape' => 'ResourceArn', ], ], ], 'DescribeProtectionResponse' => [ 'type' => 'structure', 'members' => [ 'Protection' => [ 'shape' => 'Protection', ], ], ], 'DescribeSubscriptionRequest' => [ 'type' => 'structure', 'members' => [], ], 'DescribeSubscriptionResponse' => [ 'type' => 'structure', 'members' => [ 'Subscription' => [ 'shape' => 'Subscription', ], ], ], 'DisableProactiveEngagementRequest' => [ 'type' => 'structure', 'members' => [], ], 'DisableProactiveEngagementResponse' => [ 'type' => 'structure', 'members' => [], ], 'DisassociateDRTLogBucketRequest' => [ 'type' => 'structure', 'required' => [ 'LogBucket', ], 'members' => [ 'LogBucket' => [ 'shape' => 'LogBucket', ], ], ], 'DisassociateDRTLogBucketResponse' => [ 'type' => 'structure', 'members' => [], ], 'DisassociateDRTRoleRequest' => [ 'type' => 'structure', 'members' => [], ], 'DisassociateDRTRoleResponse' => [ 'type' => 'structure', 'members' => [], ], 'DisassociateHealthCheckRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionId', 'HealthCheckArn', ], 'members' => [ 'ProtectionId' => [ 'shape' => 'ProtectionId', ], 'HealthCheckArn' => [ 'shape' => 'HealthCheckArn', ], ], ], 'DisassociateHealthCheckResponse' => [ 'type' => 'structure', 'members' => [], ], 'Double' => [ 'type' => 'double', ], 'DurationInSeconds' => [ 'type' => 'long', 'min' => 0, ], 'EmailAddress' => [ 'type' => 'string', 'max' => 150, 'min' => 1, 'pattern' => '^\\S+@\\S+\\.\\S+$', ], 'EmergencyContact' => [ 'type' => 'structure', 'required' => [ 'EmailAddress', ], 'members' => [ 'EmailAddress' => [ 'shape' => 'EmailAddress', ], 'PhoneNumber' => [ 'shape' => 'PhoneNumber', ], 'ContactNotes' => [ 'shape' => 'ContactNotes', ], ], ], 'EmergencyContactList' => [ 'type' => 'list', 'member' => [ 'shape' => 'EmergencyContact', ], 'max' => 10, 'min' => 0, ], 'EnableProactiveEngagementRequest' => [ 'type' => 'structure', 'members' => [], ], 'EnableProactiveEngagementResponse' => [ 'type' => 'structure', 'members' => [], ], 'GetSubscriptionStateRequest' => [ 'type' => 'structure', 'members' => [], ], 'GetSubscriptionStateResponse' => [ 'type' => 'structure', 'required' => [ 'SubscriptionState', ], 'members' => [ 'SubscriptionState' => [ 'shape' => 'SubscriptionState', ], ], ], 'HealthCheckArn' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => '^arn:aws:route53:::healthcheck/\\S{36}$', ], 'HealthCheckId' => [ 'type' => 'string', ], 'HealthCheckIds' => [ 'type' => 'list', 'member' => [ 'shape' => 'HealthCheckId', ], ], 'Integer' => [ 'type' => 'integer', ], 'InternalErrorException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, 'fault' => true, ], 'InvalidOperationException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'InvalidPaginationTokenException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'InvalidParameterException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], 'reason' => [ 'shape' => 'ValidationExceptionReason', ], 'fields' => [ 'shape' => 'ValidationExceptionFieldList', ], ], 'exception' => true, ], 'InvalidResourceException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'Limit' => [ 'type' => 'structure', 'members' => [ 'Type' => [ 'shape' => 'String', ], 'Max' => [ 'shape' => 'Long', ], ], ], 'LimitNumber' => [ 'type' => 'long', ], 'LimitType' => [ 'type' => 'string', ], 'Limits' => [ 'type' => 'list', 'member' => [ 'shape' => 'Limit', ], ], 'LimitsExceededException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], 'Type' => [ 'shape' => 'LimitType', ], 'Limit' => [ 'shape' => 'LimitNumber', ], ], 'exception' => true, ], 'ListAttacksRequest' => [ 'type' => 'structure', 'members' => [ 'ResourceArns' => [ 'shape' => 'ResourceArnFilterList', ], 'StartTime' => [ 'shape' => 'TimeRange', ], 'EndTime' => [ 'shape' => 'TimeRange', ], 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListAttacksResponse' => [ 'type' => 'structure', 'members' => [ 'AttackSummaries' => [ 'shape' => 'AttackSummaries', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'ListProtectionGroupsRequest' => [ 'type' => 'structure', 'members' => [ 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListProtectionGroupsResponse' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroups', ], 'members' => [ 'ProtectionGroups' => [ 'shape' => 'ProtectionGroups', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'ListProtectionsRequest' => [ 'type' => 'structure', 'members' => [ 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListProtectionsResponse' => [ 'type' => 'structure', 'members' => [ 'Protections' => [ 'shape' => 'Protections', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'ListResourcesInProtectionGroupRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'MaxResults', ], ], ], 'ListResourcesInProtectionGroupResponse' => [ 'type' => 'structure', 'required' => [ 'ResourceArns', ], 'members' => [ 'ResourceArns' => [ 'shape' => 'ResourceArnList', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'LockedSubscriptionException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'LogBucket' => [ 'type' => 'string', 'max' => 63, 'min' => 3, 'pattern' => '^([a-z]|(\\d(?!\\d{0,2}\\.\\d{1,3}\\.\\d{1,3}\\.\\d{1,3})))([a-z\\d]|(\\.(?!(\\.|-)))|(-(?!\\.))){1,61}[a-z\\d]$', ], 'LogBucketList' => [ 'type' => 'list', 'member' => [ 'shape' => 'LogBucket', ], 'max' => 10, 'min' => 0, ], 'Long' => [ 'type' => 'long', ], 'MaxResults' => [ 'type' => 'integer', 'box' => true, 'max' => 10000, 'min' => 0, ], 'Mitigation' => [ 'type' => 'structure', 'members' => [ 'MitigationName' => [ 'shape' => 'String', ], ], ], 'MitigationList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Mitigation', ], ], 'NoAssociatedRoleException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'OptimisticLockException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], ], 'exception' => true, ], 'PhoneNumber' => [ 'type' => 'string', 'max' => 16, 'min' => 1, 'pattern' => '^\\+[1-9]\\d{1,14}$', ], 'ProactiveEngagementStatus' => [ 'type' => 'string', 'enum' => [ 'ENABLED', 'DISABLED', 'PENDING', ], ], 'ProtectedResourceType' => [ 'type' => 'string', 'enum' => [ 'CLOUDFRONT_DISTRIBUTION', 'ROUTE_53_HOSTED_ZONE', 'ELASTIC_IP_ALLOCATION', 'CLASSIC_LOAD_BALANCER', 'APPLICATION_LOAD_BALANCER', 'GLOBAL_ACCELERATOR', ], ], 'Protection' => [ 'type' => 'structure', 'members' => [ 'Id' => [ 'shape' => 'ProtectionId', ], 'Name' => [ 'shape' => 'ProtectionName', ], 'ResourceArn' => [ 'shape' => 'ResourceArn', ], 'HealthCheckIds' => [ 'shape' => 'HealthCheckIds', ], ], ], 'ProtectionGroup' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', 'Aggregation', 'Pattern', 'Members', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], 'Aggregation' => [ 'shape' => 'ProtectionGroupAggregation', ], 'Pattern' => [ 'shape' => 'ProtectionGroupPattern', ], 'ResourceType' => [ 'shape' => 'ProtectedResourceType', ], 'Members' => [ 'shape' => 'ProtectionGroupMembers', ], ], ], 'ProtectionGroupAggregation' => [ 'type' => 'string', 'enum' => [ 'SUM', 'MEAN', 'MAX', ], ], 'ProtectionGroupArbitraryPatternLimits' => [ 'type' => 'structure', 'required' => [ 'MaxMembers', ], 'members' => [ 'MaxMembers' => [ 'shape' => 'Long', ], ], ], 'ProtectionGroupId' => [ 'type' => 'string', 'max' => 36, 'min' => 1, 'pattern' => '[a-zA-Z0-9\\\\-]*', ], 'ProtectionGroupLimits' => [ 'type' => 'structure', 'required' => [ 'MaxProtectionGroups', 'PatternTypeLimits', ], 'members' => [ 'MaxProtectionGroups' => [ 'shape' => 'Long', ], 'PatternTypeLimits' => [ 'shape' => 'ProtectionGroupPatternTypeLimits', ], ], ], 'ProtectionGroupMembers' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceArn', ], 'max' => 10000, 'min' => 0, ], 'ProtectionGroupPattern' => [ 'type' => 'string', 'enum' => [ 'ALL', 'ARBITRARY', 'BY_RESOURCE_TYPE', ], ], 'ProtectionGroupPatternTypeLimits' => [ 'type' => 'structure', 'required' => [ 'ArbitraryPatternLimits', ], 'members' => [ 'ArbitraryPatternLimits' => [ 'shape' => 'ProtectionGroupArbitraryPatternLimits', ], ], ], 'ProtectionGroups' => [ 'type' => 'list', 'member' => [ 'shape' => 'ProtectionGroup', ], ], 'ProtectionId' => [ 'type' => 'string', 'max' => 36, 'min' => 1, 'pattern' => '[a-zA-Z0-9\\\\-]*', ], 'ProtectionLimits' => [ 'type' => 'structure', 'required' => [ 'ProtectedResourceTypeLimits', ], 'members' => [ 'ProtectedResourceTypeLimits' => [ 'shape' => 'Limits', ], ], ], 'ProtectionName' => [ 'type' => 'string', 'max' => 128, 'min' => 1, 'pattern' => '[ a-zA-Z0-9_\\\\.\\\\-]*', ], 'Protections' => [ 'type' => 'list', 'member' => [ 'shape' => 'Protection', ], ], 'ResourceAlreadyExistsException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], 'resourceType' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'ResourceArn' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => '^arn:aws.*', ], 'ResourceArnFilterList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceArn', ], ], 'ResourceArnList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceArn', ], ], 'ResourceNotFoundException' => [ 'type' => 'structure', 'members' => [ 'message' => [ 'shape' => 'errorMessage', ], 'resourceType' => [ 'shape' => 'String', ], ], 'exception' => true, ], 'RoleArn' => [ 'type' => 'string', 'max' => 2048, 'min' => 1, 'pattern' => '^arn:aws:iam::\\d{12}:role/?[a-zA-Z_0-9+=,.@\\-_/]+', ], 'String' => [ 'type' => 'string', ], 'SubResourceSummary' => [ 'type' => 'structure', 'members' => [ 'Type' => [ 'shape' => 'SubResourceType', ], 'Id' => [ 'shape' => 'String', ], 'AttackVectors' => [ 'shape' => 'SummarizedAttackVectorList', ], 'Counters' => [ 'shape' => 'SummarizedCounterList', ], ], ], 'SubResourceSummaryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'SubResourceSummary', ], ], 'SubResourceType' => [ 'type' => 'string', 'enum' => [ 'IP', 'URL', ], ], 'Subscription' => [ 'type' => 'structure', 'required' => [ 'SubscriptionLimits', ], 'members' => [ 'StartTime' => [ 'shape' => 'Timestamp', ], 'EndTime' => [ 'shape' => 'Timestamp', ], 'TimeCommitmentInSeconds' => [ 'shape' => 'DurationInSeconds', ], 'AutoRenew' => [ 'shape' => 'AutoRenew', ], 'Limits' => [ 'shape' => 'Limits', ], 'ProactiveEngagementStatus' => [ 'shape' => 'ProactiveEngagementStatus', ], 'SubscriptionLimits' => [ 'shape' => 'SubscriptionLimits', ], ], ], 'SubscriptionLimits' => [ 'type' => 'structure', 'required' => [ 'ProtectionLimits', 'ProtectionGroupLimits', ], 'members' => [ 'ProtectionLimits' => [ 'shape' => 'ProtectionLimits', ], 'ProtectionGroupLimits' => [ 'shape' => 'ProtectionGroupLimits', ], ], ], 'SubscriptionState' => [ 'type' => 'string', 'enum' => [ 'ACTIVE', 'INACTIVE', ], ], 'SummarizedAttackVector' => [ 'type' => 'structure', 'required' => [ 'VectorType', ], 'members' => [ 'VectorType' => [ 'shape' => 'String', ], 'VectorCounters' => [ 'shape' => 'SummarizedCounterList', ], ], ], 'SummarizedAttackVectorList' => [ 'type' => 'list', 'member' => [ 'shape' => 'SummarizedAttackVector', ], ], 'SummarizedCounter' => [ 'type' => 'structure', 'members' => [ 'Name' => [ 'shape' => 'String', ], 'Max' => [ 'shape' => 'Double', ], 'Average' => [ 'shape' => 'Double', ], 'Sum' => [ 'shape' => 'Double', ], 'N' => [ 'shape' => 'Integer', ], 'Unit' => [ 'shape' => 'String', ], ], ], 'SummarizedCounterList' => [ 'type' => 'list', 'member' => [ 'shape' => 'SummarizedCounter', ], ], 'TimeRange' => [ 'type' => 'structure', 'members' => [ 'FromInclusive' => [ 'shape' => 'AttackTimestamp', ], 'ToExclusive' => [ 'shape' => 'AttackTimestamp', ], ], ], 'Timestamp' => [ 'type' => 'timestamp', ], 'Token' => [ 'type' => 'string', 'max' => 4096, 'min' => 1, 'pattern' => '^.*$', ], 'TopContributors' => [ 'type' => 'list', 'member' => [ 'shape' => 'Contributor', ], ], 'Unit' => [ 'type' => 'string', 'enum' => [ 'BITS', 'BYTES', 'PACKETS', 'REQUESTS', ], ], 'UpdateEmergencyContactSettingsRequest' => [ 'type' => 'structure', 'members' => [ 'EmergencyContactList' => [ 'shape' => 'EmergencyContactList', ], ], ], 'UpdateEmergencyContactSettingsResponse' => [ 'type' => 'structure', 'members' => [], ], 'UpdateProtectionGroupRequest' => [ 'type' => 'structure', 'required' => [ 'ProtectionGroupId', 'Aggregation', 'Pattern', ], 'members' => [ 'ProtectionGroupId' => [ 'shape' => 'ProtectionGroupId', ], 'Aggregation' => [ 'shape' => 'ProtectionGroupAggregation', ], 'Pattern' => [ 'shape' => 'ProtectionGroupPattern', ], 'ResourceType' => [ 'shape' => 'ProtectedResourceType', ], 'Members' => [ 'shape' => 'ProtectionGroupMembers', ], ], ], 'UpdateProtectionGroupResponse' => [ 'type' => 'structure', 'members' => [], ], 'UpdateSubscriptionRequest' => [ 'type' => 'structure', 'members' => [ 'AutoRenew' => [ 'shape' => 'AutoRenew', ], ], ], 'UpdateSubscriptionResponse' => [ 'type' => 'structure', 'members' => [], ], 'ValidationExceptionField' => [ 'type' => 'structure', 'required' => [ 'name', 'message', ], 'members' => [ 'name' => [ 'shape' => 'String', ], 'message' => [ 'shape' => 'String', ], ], ], 'ValidationExceptionFieldList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ValidationExceptionField', ], ], 'ValidationExceptionReason' => [ 'type' => 'string', 'enum' => [ 'FIELD_VALIDATION_FAILED', 'OTHER', ], ], 'errorMessage' => [ 'type' => 'string', ], ],];
