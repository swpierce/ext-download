<?php

/**
 * @copyright Copyright (c) 12 Paw Paperie, 2015
 * @license LGPLv3, http://opensource.org/licenses/LGPL-3.0
 */

return array(
	'item' => array(
		'delete' => '
			DELETE FROM "mshop_user_download"
			WHERE :cond AND siteid = ?
		',
		'insert' => '
			INSERT INTO "mshop_user_download" (
				"siteid", "userid", "fileid", "prodid", "orderid", "downloads", "url", "mtime", "editor", "ctime"
			) VALUES (
				?, ?, ?, ?, ?, ?, ?, ?, ?, ?
			)
		',
		'update' => '
			UPDATE "mshop_user_download"
			SET "siteid" = ?, "userid" = ?, "fileid" = ?, "prodid" = ?, "orderid" = ?, "downloads" = ?, "url" = ?, 
				"mtime" = ?, "editor" = ?
			WHERE "id" = ?
		',
		'search' => '
			SELECT DISTINCT msdl."id", msdl."siteid", msdl."userid",
				msdl."fileid", msdl."prodid", msdl."orderid", msdl."url",
                msdl."downloads", msdl."mtime", msdl."editor",
				msdl."ctime"
			FROM "mshop_user_download" AS msdl
			:joins
			WHERE :cond
			/*-orderby*/ ORDER BY :order /*orderby-*/
			LIMIT :size OFFSET :start
		',
		'count' => '
			SELECT COUNT(*) AS "count"
			FROM (
				SELECT DISTINCT msdl."id"
				FROM "mshop_user_download" AS msdl
				:joins
				WHERE :cond
				LIMIT 10000 OFFSET 0
			) AS list
		',
	),
);