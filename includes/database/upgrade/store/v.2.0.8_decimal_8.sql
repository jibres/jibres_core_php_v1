
ALTER TABLE jibres_XXXXXXX.ir_vat ADD `total2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.ir_vat ADD `subtotalitembyvat2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.ir_vat ADD `sumvat2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.ir_vat ADD `items2` DECIMAL(22, 4) NULL DEFAULT NULL;
ALTER TABLE jibres_XXXXXXX.ir_vat ADD `itemsvat2` DECIMAL(22, 4) NULL DEFAULT NULL;


UPDATE jibres_XXXXXXX.ir_vat SET ir_vat.total2             = CAST(ir_vat.total AS DECIMAL(22, 4));
UPDATE jibres_XXXXXXX.ir_vat SET ir_vat.subtotalitembyvat2 = CAST(ir_vat.subtotalitembyvat AS DECIMAL(22, 4));
UPDATE jibres_XXXXXXX.ir_vat SET ir_vat.sumvat2            = CAST(ir_vat.sumvat AS DECIMAL(22, 4));
UPDATE jibres_XXXXXXX.ir_vat SET ir_vat.items2             = CAST(ir_vat.items AS DECIMAL(22, 4));


ALTER TABLE jibres_XXXXXXX.ir_vat DROP `total`;
ALTER TABLE jibres_XXXXXXX.ir_vat DROP `subtotalitembyvat`;
ALTER TABLE jibres_XXXXXXX.ir_vat DROP `sumvat`;
ALTER TABLE jibres_XXXXXXX.ir_vat DROP `items`;
ALTER TABLE jibres_XXXXXXX.ir_vat DROP `itemsvat`;


ALTER TABLE jibres_XXXXXXX.ir_vat CHANGE `itemsvat2` `itemsvat` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `type`;
ALTER TABLE jibres_XXXXXXX.ir_vat CHANGE `items2` `items` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `type`;
ALTER TABLE jibres_XXXXXXX.ir_vat CHANGE `sumvat2` `sumvat` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `type`;
ALTER TABLE jibres_XXXXXXX.ir_vat CHANGE `subtotalitembyvat2` `subtotalitembyvat` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `type`;
ALTER TABLE jibres_XXXXXXX.ir_vat CHANGE `total2` `total` DECIMAL(22, 4) NULL DEFAULT NULL AFTER `type`;
