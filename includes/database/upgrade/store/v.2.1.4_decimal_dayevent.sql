ALTER TABLE jibres_XXXXXXX.dayevent ADD `sumfactor2` DECIMAL(31, 4) NULL DEFAULT NULL;
UPDATE jibres_XXXXXXX.dayevent SET `sumfactor2`            = CAST((dayevent.sumfactor / 100000) AS DECIMAL(31, 4));
ALTER TABLE jibres_XXXXXXX.dayevent DROP `sumfactor`;
ALTER TABLE jibres_XXXXXXX.dayevent CHANGE `sumfactor2` `sumfactor` DECIMAL(22, 4) NULL DEFAULT NULL;