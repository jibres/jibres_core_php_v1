UPDATE jibres_XXXXXXX.files SET   files.totalsize = files.size * 1.7 WHERE files.totalsize IS NULL AND files.ext IN ('jpg', 'png', 'gif');
UPDATE jibres_XXXXXXX.files SET   files.totalsize = files.size  WHERE files.totalsize IS NULL AND files.ext NOT IN ('jpg', 'png', 'gif');