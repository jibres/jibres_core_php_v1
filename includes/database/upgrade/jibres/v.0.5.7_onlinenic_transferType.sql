
ALTER TABLE jibres_onlinenic_log.log CHANGE `type` `type` enum(
		'checkDomain',
		'registerDomain',
		'renewDomain',
		'queryTransferStatus',
		'cancelDomainTransfer',
		'getAuthCode',
		'updateAuthCode',
		'infoDomain',
		'updateDomainStatus',
		'updateDomainDns',
		'setDomainPassword',
		'createContact',
		'infoContact',
		'domainChangeContact',
		'updateContact',
		'transferDomain'
	) DEFAULT NULL;


UPDATE jibres_nic.domain SET `available` = 0, `verify` = 1 WHERE `domain`.`id` = 12; -- for domain useclass.ir Test failed