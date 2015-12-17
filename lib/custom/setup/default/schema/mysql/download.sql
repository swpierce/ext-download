--
-- Download database definitions
--
-- Copyright (c) 12 Paw Paperie, 2015
-- License LGPLv3, http://opensource.org/licenses/LGPL-3.0
--


SET SESSION sql_mode='ANSI';

--
-- User Downloads
--

CREATE TABLE "mshop_user_download" (
	-- Unique id of the download
	"id" INTEGER NOT NULL AUTO_INCREMENT,
	-- site id
	"siteid" INTEGER NOT NULL,
	-- user id
	"userid" INTEGER NOT NULL,
	-- Unique file identifier sent to user
	"fileid" BIGINT NOT NULL,
	-- order id
	"orderid" BIGINT NOT NULL,
    -- product id
    "prodid" BIGINT NOT NULL,
	-- True URL of the file to be downloaded
	"url" VARCHAR(255) NOT NULL,
    -- number of times the user has downloaded
    "downloads" INTEGER NOT NULL DEFAULT 0,
    -- status of the download item
	"mtime" DATETIME NOT NULL,
	-- Date of creation of this database entry
	"ctime" DATETIME NOT NULL,
	-- Editor who modified this entry at last
	"editor" VARCHAR(255) NOT NULL,
CONSTRAINT "pk_msdl_id" PRIMARY KEY ("id"),
CONSTRAINT "unq_msdl_uid,fid,ordid" UNIQUE("userid", "fileid", "orderid"),
CONSTRAINT "unq_msdl_sid_uid_ordid" UNIQUE("siteid", "userid", "orderid")
) Engine=InnoDB CHARACTER SET = utf8;

CREATE INDEX "idx_msdl_sid_uid" ON "mshop_user_download" ("siteid", "userid");

CREATE INDEX "idx_msdl_sid_oid" ON "mshop_user_download" ("siteid", "orderid");

CREATE INDEX "idx_msdl_sid_oid_pid" ON "mshop_user_download" ("siteid", "orderid", "prodid" );
