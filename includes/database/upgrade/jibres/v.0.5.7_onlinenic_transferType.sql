
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


