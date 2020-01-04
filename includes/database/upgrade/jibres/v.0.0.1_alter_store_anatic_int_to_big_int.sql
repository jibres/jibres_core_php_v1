ALTER TABLE jibres.store_analytics CHANGE `dbtrafic` `dbtrafic` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `dbsize` `dbsize` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `sumplustransaction` `sumplustransaction` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `summinustransaction` `summinustransaction` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `factor` `factor` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `factorbuy` `factorbuy` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `factorsale` `factorsale` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `factordetail` `factordetail` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics CHANGE `sumfactor` `sumfactor` bigint(20) UNSIGNED NULL DEFAULT NULL;

ALTER TABLE jibres.store_analytics ADD `log` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics ADD `cart` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics ADD `sync` bigint(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE jibres.store_analytics ADD `apilog` bigint(20) UNSIGNED NULL DEFAULT NULL;
