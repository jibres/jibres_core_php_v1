ALTER TABLE jibres.store ADD `dbversion` VARCHAR(100) NULL DEFAULT NULL AFTER `status`;
ALTER TABLE jibres.store ADD `dbversiondate` datetime NULL DEFAULT NULL AFTER `dbversion`;

UPDATE jibres.store SET jibres.store.dbversion = (SELECT jibres.store_data.dbversion FROM jibres.store_data WHERE jibres.store_data.id = jibres.store.id);
UPDATE jibres.store SET jibres.store.dbversiondate = (SELECT jibres.store_data.dbversiondate FROM jibres.store_data WHERE jibres.store_data.id = jibres.store.id);