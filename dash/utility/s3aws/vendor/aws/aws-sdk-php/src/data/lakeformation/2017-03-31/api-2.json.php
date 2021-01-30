<?php
// This file was auto-generated from sdk-root/src/data/lakeformation/2017-03-31/api-2.json
return [ 'version' => '2.0', 'metadata' => [ 'apiVersion' => '2017-03-31', 'endpointPrefix' => 'lakeformation', 'jsonVersion' => '1.1', 'protocol' => 'json', 'serviceFullName' => 'AWS Lake Formation', 'serviceId' => 'LakeFormation', 'signatureVersion' => 'v4', 'signingName' => 'lakeformation', 'targetPrefix' => 'AWSLakeFormation', 'uid' => 'lakeformation-2017-03-31', ], 'operations' => [ 'BatchGrantPermissions' => [ 'name' => 'BatchGrantPermissions', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'BatchGrantPermissionsRequest', ], 'output' => [ 'shape' => 'BatchGrantPermissionsResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'OperationTimeoutException', ], ], ], 'BatchRevokePermissions' => [ 'name' => 'BatchRevokePermissions', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'BatchRevokePermissionsRequest', ], 'output' => [ 'shape' => 'BatchRevokePermissionsResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'OperationTimeoutException', ], ], ], 'DeregisterResource' => [ 'name' => 'DeregisterResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DeregisterResourceRequest', ], 'output' => [ 'shape' => 'DeregisterResourceResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'EntityNotFoundException', ], ], ], 'DescribeResource' => [ 'name' => 'DescribeResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'DescribeResourceRequest', ], 'output' => [ 'shape' => 'DescribeResourceResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'EntityNotFoundException', ], ], ], 'GetDataLakeSettings' => [ 'name' => 'GetDataLakeSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetDataLakeSettingsRequest', ], 'output' => [ 'shape' => 'GetDataLakeSettingsResponse', ], 'errors' => [ [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'EntityNotFoundException', ], ], ], 'GetEffectivePermissionsForPath' => [ 'name' => 'GetEffectivePermissionsForPath', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GetEffectivePermissionsForPathRequest', ], 'output' => [ 'shape' => 'GetEffectivePermissionsForPathResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'EntityNotFoundException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'InternalServiceException', ], ], ], 'GrantPermissions' => [ 'name' => 'GrantPermissions', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'GrantPermissionsRequest', ], 'output' => [ 'shape' => 'GrantPermissionsResponse', ], 'errors' => [ [ 'shape' => 'ConcurrentModificationException', ], [ 'shape' => 'EntityNotFoundException', ], [ 'shape' => 'InvalidInputException', ], ], ], 'ListPermissions' => [ 'name' => 'ListPermissions', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListPermissionsRequest', ], 'output' => [ 'shape' => 'ListPermissionsResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'InternalServiceException', ], ], ], 'ListResources' => [ 'name' => 'ListResources', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'ListResourcesRequest', ], 'output' => [ 'shape' => 'ListResourcesResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'OperationTimeoutException', ], ], ], 'PutDataLakeSettings' => [ 'name' => 'PutDataLakeSettings', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'PutDataLakeSettingsRequest', ], 'output' => [ 'shape' => 'PutDataLakeSettingsResponse', ], 'errors' => [ [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'InvalidInputException', ], ], ], 'RegisterResource' => [ 'name' => 'RegisterResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'RegisterResourceRequest', ], 'output' => [ 'shape' => 'RegisterResourceResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'AlreadyExistsException', ], ], ], 'RevokePermissions' => [ 'name' => 'RevokePermissions', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'RevokePermissionsRequest', ], 'output' => [ 'shape' => 'RevokePermissionsResponse', ], 'errors' => [ [ 'shape' => 'ConcurrentModificationException', ], [ 'shape' => 'EntityNotFoundException', ], [ 'shape' => 'InvalidInputException', ], ], ], 'UpdateResource' => [ 'name' => 'UpdateResource', 'http' => [ 'method' => 'POST', 'requestUri' => '/', ], 'input' => [ 'shape' => 'UpdateResourceRequest', ], 'output' => [ 'shape' => 'UpdateResourceResponse', ], 'errors' => [ [ 'shape' => 'InvalidInputException', ], [ 'shape' => 'InternalServiceException', ], [ 'shape' => 'OperationTimeoutException', ], [ 'shape' => 'EntityNotFoundException', ], ], ], ], 'shapes' => [ 'AlreadyExistsException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, ], 'BatchGrantPermissionsRequest' => [ 'type' => 'structure', 'required' => [ 'Entries', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Entries' => [ 'shape' => 'BatchPermissionsRequestEntryList', ], ], ], 'BatchGrantPermissionsResponse' => [ 'type' => 'structure', 'members' => [ 'Failures' => [ 'shape' => 'BatchPermissionsFailureList', ], ], ], 'BatchPermissionsFailureEntry' => [ 'type' => 'structure', 'members' => [ 'RequestEntry' => [ 'shape' => 'BatchPermissionsRequestEntry', ], 'Error' => [ 'shape' => 'ErrorDetail', ], ], ], 'BatchPermissionsFailureList' => [ 'type' => 'list', 'member' => [ 'shape' => 'BatchPermissionsFailureEntry', ], ], 'BatchPermissionsRequestEntry' => [ 'type' => 'structure', 'required' => [ 'Id', ], 'members' => [ 'Id' => [ 'shape' => 'Identifier', ], 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'Resource' => [ 'shape' => 'Resource', ], 'Permissions' => [ 'shape' => 'PermissionList', ], 'PermissionsWithGrantOption' => [ 'shape' => 'PermissionList', ], ], ], 'BatchPermissionsRequestEntryList' => [ 'type' => 'list', 'member' => [ 'shape' => 'BatchPermissionsRequestEntry', ], ], 'BatchRevokePermissionsRequest' => [ 'type' => 'structure', 'required' => [ 'Entries', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Entries' => [ 'shape' => 'BatchPermissionsRequestEntryList', ], ], ], 'BatchRevokePermissionsResponse' => [ 'type' => 'structure', 'members' => [ 'Failures' => [ 'shape' => 'BatchPermissionsFailureList', ], ], ], 'CatalogIdString' => [ 'type' => 'string', 'max' => 255, 'min' => 1, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*', ], 'CatalogResource' => [ 'type' => 'structure', 'members' => [], ], 'ColumnNames' => [ 'type' => 'list', 'member' => [ 'shape' => 'NameString', ], ], 'ColumnWildcard' => [ 'type' => 'structure', 'members' => [ 'ExcludedColumnNames' => [ 'shape' => 'ColumnNames', ], ], ], 'ComparisonOperator' => [ 'type' => 'string', 'enum' => [ 'EQ', 'NE', 'LE', 'LT', 'GE', 'GT', 'CONTAINS', 'NOT_CONTAINS', 'BEGINS_WITH', 'IN', 'BETWEEN', ], ], 'ConcurrentModificationException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, ], 'DataLakePrincipal' => [ 'type' => 'structure', 'members' => [ 'DataLakePrincipalIdentifier' => [ 'shape' => 'DataLakePrincipalString', ], ], ], 'DataLakePrincipalList' => [ 'type' => 'list', 'member' => [ 'shape' => 'DataLakePrincipal', ], 'max' => 10, 'min' => 0, ], 'DataLakePrincipalString' => [ 'type' => 'string', 'max' => 255, 'min' => 1, ], 'DataLakeResourceType' => [ 'type' => 'string', 'enum' => [ 'CATALOG', 'DATABASE', 'TABLE', 'DATA_LOCATION', ], ], 'DataLakeSettings' => [ 'type' => 'structure', 'members' => [ 'DataLakeAdmins' => [ 'shape' => 'DataLakePrincipalList', ], 'CreateDatabaseDefaultPermissions' => [ 'shape' => 'PrincipalPermissionsList', ], 'CreateTableDefaultPermissions' => [ 'shape' => 'PrincipalPermissionsList', ], 'TrustedResourceOwners' => [ 'shape' => 'TrustedResourceOwners', ], ], ], 'DataLocationResource' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], ], ], 'DatabaseResource' => [ 'type' => 'structure', 'required' => [ 'Name', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Name' => [ 'shape' => 'NameString', ], ], ], 'DeregisterResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], ], ], 'DeregisterResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'DescribeResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], ], ], 'DescribeResourceResponse' => [ 'type' => 'structure', 'members' => [ 'ResourceInfo' => [ 'shape' => 'ResourceInfo', ], ], ], 'DescriptionString' => [ 'type' => 'string', 'max' => 2048, 'min' => 0, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\r\\n\\t]*', ], 'DetailsMap' => [ 'type' => 'structure', 'members' => [ 'ResourceShare' => [ 'shape' => 'ResourceShareList', ], ], ], 'EntityNotFoundException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, ], 'ErrorDetail' => [ 'type' => 'structure', 'members' => [ 'ErrorCode' => [ 'shape' => 'NameString', ], 'ErrorMessage' => [ 'shape' => 'DescriptionString', ], ], ], 'FieldNameString' => [ 'type' => 'string', 'enum' => [ 'RESOURCE_ARN', 'ROLE_ARN', 'LAST_MODIFIED', ], ], 'FilterCondition' => [ 'type' => 'structure', 'members' => [ 'Field' => [ 'shape' => 'FieldNameString', ], 'ComparisonOperator' => [ 'shape' => 'ComparisonOperator', ], 'StringValueList' => [ 'shape' => 'StringValueList', ], ], ], 'FilterConditionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'FilterCondition', ], 'max' => 20, 'min' => 1, ], 'GetDataLakeSettingsRequest' => [ 'type' => 'structure', 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], ], ], 'GetDataLakeSettingsResponse' => [ 'type' => 'structure', 'members' => [ 'DataLakeSettings' => [ 'shape' => 'DataLakeSettings', ], ], ], 'GetEffectivePermissionsForPathRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'PageSize', ], ], ], 'GetEffectivePermissionsForPathResponse' => [ 'type' => 'structure', 'members' => [ 'Permissions' => [ 'shape' => 'PrincipalResourcePermissionsList', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'GrantPermissionsRequest' => [ 'type' => 'structure', 'required' => [ 'Principal', 'Resource', 'Permissions', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'Resource' => [ 'shape' => 'Resource', ], 'Permissions' => [ 'shape' => 'PermissionList', ], 'PermissionsWithGrantOption' => [ 'shape' => 'PermissionList', ], ], ], 'GrantPermissionsResponse' => [ 'type' => 'structure', 'members' => [], ], 'IAMRoleArn' => [ 'type' => 'string', 'pattern' => 'arn:aws:iam::[0-9]*:role/.*', ], 'Identifier' => [ 'type' => 'string', 'max' => 255, 'min' => 1, ], 'InternalServiceException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, 'fault' => true, ], 'InvalidInputException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, ], 'LastModifiedTimestamp' => [ 'type' => 'timestamp', ], 'ListPermissionsRequest' => [ 'type' => 'structure', 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'ResourceType' => [ 'shape' => 'DataLakeResourceType', ], 'Resource' => [ 'shape' => 'Resource', ], 'NextToken' => [ 'shape' => 'Token', ], 'MaxResults' => [ 'shape' => 'PageSize', ], ], ], 'ListPermissionsResponse' => [ 'type' => 'structure', 'members' => [ 'PrincipalResourcePermissions' => [ 'shape' => 'PrincipalResourcePermissionsList', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'ListResourcesRequest' => [ 'type' => 'structure', 'members' => [ 'FilterConditionList' => [ 'shape' => 'FilterConditionList', ], 'MaxResults' => [ 'shape' => 'PageSize', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'ListResourcesResponse' => [ 'type' => 'structure', 'members' => [ 'ResourceInfoList' => [ 'shape' => 'ResourceInfoList', ], 'NextToken' => [ 'shape' => 'Token', ], ], ], 'MessageString' => [ 'type' => 'string', ], 'NameString' => [ 'type' => 'string', 'max' => 255, 'min' => 1, 'pattern' => '[\\u0020-\\uD7FF\\uE000-\\uFFFD\\uD800\\uDC00-\\uDBFF\\uDFFF\\t]*', ], 'NullableBoolean' => [ 'type' => 'boolean', 'box' => true, ], 'OperationTimeoutException' => [ 'type' => 'structure', 'members' => [ 'Message' => [ 'shape' => 'MessageString', ], ], 'exception' => true, ], 'PageSize' => [ 'type' => 'integer', 'box' => true, 'max' => 1000, 'min' => 1, ], 'Permission' => [ 'type' => 'string', 'enum' => [ 'ALL', 'SELECT', 'ALTER', 'DROP', 'DELETE', 'INSERT', 'DESCRIBE', 'CREATE_DATABASE', 'CREATE_TABLE', 'DATA_LOCATION_ACCESS', ], ], 'PermissionList' => [ 'type' => 'list', 'member' => [ 'shape' => 'Permission', ], ], 'PrincipalPermissions' => [ 'type' => 'structure', 'members' => [ 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'Permissions' => [ 'shape' => 'PermissionList', ], ], ], 'PrincipalPermissionsList' => [ 'type' => 'list', 'member' => [ 'shape' => 'PrincipalPermissions', ], ], 'PrincipalResourcePermissions' => [ 'type' => 'structure', 'members' => [ 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'Resource' => [ 'shape' => 'Resource', ], 'Permissions' => [ 'shape' => 'PermissionList', ], 'PermissionsWithGrantOption' => [ 'shape' => 'PermissionList', ], 'AdditionalDetails' => [ 'shape' => 'DetailsMap', ], ], ], 'PrincipalResourcePermissionsList' => [ 'type' => 'list', 'member' => [ 'shape' => 'PrincipalResourcePermissions', ], ], 'PutDataLakeSettingsRequest' => [ 'type' => 'structure', 'required' => [ 'DataLakeSettings', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'DataLakeSettings' => [ 'shape' => 'DataLakeSettings', ], ], ], 'PutDataLakeSettingsResponse' => [ 'type' => 'structure', 'members' => [], ], 'RAMResourceShareArn' => [ 'type' => 'string', ], 'RegisterResourceRequest' => [ 'type' => 'structure', 'required' => [ 'ResourceArn', ], 'members' => [ 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], 'UseServiceLinkedRole' => [ 'shape' => 'NullableBoolean', ], 'RoleArn' => [ 'shape' => 'IAMRoleArn', ], ], ], 'RegisterResourceResponse' => [ 'type' => 'structure', 'members' => [], ], 'Resource' => [ 'type' => 'structure', 'members' => [ 'Catalog' => [ 'shape' => 'CatalogResource', ], 'Database' => [ 'shape' => 'DatabaseResource', ], 'Table' => [ 'shape' => 'TableResource', ], 'TableWithColumns' => [ 'shape' => 'TableWithColumnsResource', ], 'DataLocation' => [ 'shape' => 'DataLocationResource', ], ], ], 'ResourceArnString' => [ 'type' => 'string', ], 'ResourceInfo' => [ 'type' => 'structure', 'members' => [ 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], 'RoleArn' => [ 'shape' => 'IAMRoleArn', ], 'LastModified' => [ 'shape' => 'LastModifiedTimestamp', ], ], ], 'ResourceInfoList' => [ 'type' => 'list', 'member' => [ 'shape' => 'ResourceInfo', ], ], 'ResourceShareList' => [ 'type' => 'list', 'member' => [ 'shape' => 'RAMResourceShareArn', ], ], 'RevokePermissionsRequest' => [ 'type' => 'structure', 'required' => [ 'Principal', 'Resource', 'Permissions', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'Principal' => [ 'shape' => 'DataLakePrincipal', ], 'Resource' => [ 'shape' => 'Resource', ], 'Permissions' => [ 'shape' => 'PermissionList', ], 'PermissionsWithGrantOption' => [ 'shape' => 'PermissionList', ], ], ], 'RevokePermissionsResponse' => [ 'type' => 'structure', 'members' => [], ], 'StringValue' => [ 'type' => 'string', ], 'StringValueList' => [ 'type' => 'list', 'member' => [ 'shape' => 'StringValue', ], ], 'TableResource' => [ 'type' => 'structure', 'required' => [ 'DatabaseName', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'DatabaseName' => [ 'shape' => 'NameString', ], 'Name' => [ 'shape' => 'NameString', ], 'TableWildcard' => [ 'shape' => 'TableWildcard', ], ], ], 'TableWildcard' => [ 'type' => 'structure', 'members' => [], ], 'TableWithColumnsResource' => [ 'type' => 'structure', 'required' => [ 'DatabaseName', 'Name', ], 'members' => [ 'CatalogId' => [ 'shape' => 'CatalogIdString', ], 'DatabaseName' => [ 'shape' => 'NameString', ], 'Name' => [ 'shape' => 'NameString', ], 'ColumnNames' => [ 'shape' => 'ColumnNames', ], 'ColumnWildcard' => [ 'shape' => 'ColumnWildcard', ], ], ], 'Token' => [ 'type' => 'string', ], 'TrustedResourceOwners' => [ 'type' => 'list', 'member' => [ 'shape' => 'CatalogIdString', ], ], 'UpdateResourceRequest' => [ 'type' => 'structure', 'required' => [ 'RoleArn', 'ResourceArn', ], 'members' => [ 'RoleArn' => [ 'shape' => 'IAMRoleArn', ], 'ResourceArn' => [ 'shape' => 'ResourceArnString', ], ], ], 'UpdateResourceResponse' => [ 'type' => 'structure', 'members' => [], ], ],];
