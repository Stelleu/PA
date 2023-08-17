-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS esgi_article_id_seq;
CREATE SEQUENCE esgi_article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
                                         "id" integer DEFAULT nextval('esgi_article_id_seq') NOT NULL,
                                         "title" character varying(255) NOT NULL,
                                         "author" integer NOT NULL,
                                         "menu" boolean DEFAULT false NOT NULL,
                                         "status" boolean DEFAULT false NOT NULL,
                                         "comment" boolean DEFAULT false NOT NULL,
                                         "slug" character varying NOT NULL,
                                         "category" integer,
                                         "created_at" timestamp NOT NULL,
                                         CONSTRAINT "esgi_article_id" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_article" ("id", "title", "author", "menu", "status", "comment", "slug", "category", "created_at") VALUES
                                                                                                                        (2,	'Une photo zoomer est elle est un portrait',	4,	'f',	'f',	't',	'une-photo-zoomer-est-elle-est-un-portrait',	1,	'2023-08-11 19:37:09'),
                                                                                                                        (9,	'La photo portrait',	4,	'f',	'f',	't',	'la-photo-portrait',	1,	'2023-08-11 20:04:31'),
                                                                                                                        (10,	'Un zoom ou un portrait',	4,	'f',	'f',	't',	'un-zoom-ou-un-portrait',	1,	'2023-08-11 20:31:07'),
                                                                                                                        (1,	'Comment faire un beau portrait',	4,	'f',	'f',	't',	'comment-faire-un-beau-portrai',	1,	'2023-08-11 19:13:44');

DROP TABLE IF EXISTS "esgi_category";
DROP SEQUENCE IF EXISTS esgi_category_id_seq;
CREATE SEQUENCE esgi_category_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_category" (
                                          "id" integer DEFAULT nextval('esgi_category_id_seq') NOT NULL,
                                          "title" character(80) NOT NULL,
                                          CONSTRAINT "esgi_category_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_category" ("id", "title") VALUES
    (1,	'portrait                                                                        ');

DROP TABLE IF EXISTS "esgi_setting";
CREATE TABLE "public"."esgi_setting" (
                                         "id" integer NOT NULL,
                                         "website_name" character varying NOT NULL,
                                         "H1_color" character varying DEFAULT '#black' NOT NULL,
                                         "polices" character varying DEFAULT 'Arial,sans-serif' NOT NULL,
                                         "p_color" character varying DEFAULT '#black' NOT NULL,
                                         "p_size" character varying DEFAULT '12px' NOT NULL,
                                         "btn_color" character varying DEFAULT '#black' NOT NULL
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_user";
DROP SEQUENCE IF EXISTS esgi_user_id_seq;
CREATE SEQUENCE esgi_user_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_user" (
                                      "id" integer DEFAULT nextval('esgi_user_id_seq') NOT NULL,
                                      "firstname" character(64) NOT NULL,
                                      "lastname" character(120) NOT NULL,
                                      "email" character varying(320) NOT NULL,
                                      "pwd" character varying(128) NOT NULL,
                                      "role" smallint NOT NULL,
                                      "token" character(10) NOT NULL,
                                      "date_inserted" timestamp DEFAULT now(),
                                      "status" boolean DEFAULT false NOT NULL,
                                      CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

COMMENT ON COLUMN "public"."esgi_user"."role" IS '[0=>admin,1=>editor,2=>modo,3=>user]';

INSERT INTO "esgi_user" ("id", "firstname", "lastname", "email", "pwd", "role", "token", "date_inserted", "status") VALUES
                                                                                                                        (1,	'Estelle                                                         ',	'Nkumba                                                                                                                  ',	'nkumba.estelle@gmail.com',	'$2y$10$n2ZGl3NubqQaMI8vALOQ5esKiFNZD8l3EZeD.IZJ6r87HVWcUxnaW',	0,	'          ',	'2023-08-01 08:51:53.774247',	't'),
                                                                                                                        (4,	'Kilyan                                                          ',	'KIKI                                                                                                                    ',	'halimikilyan@gmail.com',	'$2y$10$100Mktvn2qS1EuymuUrV4eOtmFFb7Y7kRD1XCO07BzIG7ztlrQHO6',	0,	'2b8c3e264e',	'2023-08-03 08:16:31',	'f');

DROP TABLE IF EXISTS "esgi_version";
DROP SEQUENCE IF EXISTS esgi_memento_id_seq;
CREATE SEQUENCE esgi_memento_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_version" (
                                         "id" integer DEFAULT nextval('esgi_memento_id_seq') NOT NULL,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         "content" json NOT NULL,
                                         "user_id" integer NOT NULL,
                                         "article_id" integer NOT NULL,
                                         CONSTRAINT "esgi_memento_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_version" ("id", "created_at", "content", "user_id", "article_id") VALUES
                                                                                        (5,	'2023-08-11 20:31:07',	'{"time":1691785867220,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	10),
                                                                                        (6,	'2023-08-13 18:51:48',	'{}',	4,	1),
                                                                                        (7,	'2023-08-13 18:56:34',	'{}',	4,	1),
                                                                                        (8,	'2023-08-13 18:58:22',	'{}',	4,	1),
                                                                                        (9,	'2023-08-13 18:59:21',	'{}',	4,	1),
                                                                                        (10,	'2023-08-13 20:32:52',	'{"time":1691958772662,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}}],"version":"2.27.2"}',	4,	1),
                                                                                        (11,	'2023-08-13 21:04:01',	'{"time":1691960640972,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (12,	'2023-08-13 21:04:01',	'{"time":1691960641764,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (13,	'2023-08-13 21:04:04',	'{"time":1691960644689,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":";,dxcn"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (14,	'2023-08-13 21:04:07',	'{"time":1691960647613,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting..."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (15,	'2023-08-13 22:01:24',	'{"time":1691964084894,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"b6ji-DvaKb","type":"paragraph","data":{"text":"Start writting.."}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (16,	'2023-08-13 22:01:26',	'{"time":1691964086781,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (17,	'2023-08-13 22:01:31',	'{"time":1691964091062,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp; est"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (18,	'2023-08-13 22:02:14',	'{"time":1691964134178,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"VqXImg0jHo","type":"paragraph","data":{"text":"Je test&nbsp; est&nbsp;"}},{"id":"Ekj9SBqqcl","type":"paragraph","data":{"text":",n blmk"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (19,	'2023-08-13 22:02:22',	'{"time":1691964142873,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (20,	'2023-08-13 22:02:23',	'{"time":1691964143302,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je t"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (21,	'2023-08-13 22:02:25',	'{"time":1691964145495,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais test&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (22,	'2023-08-13 22:02:27',	'{"time":1691964146985,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais test Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (23,	'2023-08-13 22:02:38',	'{"time":1691964158905,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (24,	'2023-08-13 22:03:45',	'{"time":1691964225308,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (25,	'2023-08-13 22:03:55',	'{"time":1691964235134,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento, lmjc"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (26,	'2023-08-13 22:04:03',	'{"time":1691964243063,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,&nbsp;"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (27,	'2023-08-13 22:04:13',	'{"time":1691964253233,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento, ,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (28,	'2023-08-13 22:04:20',	'{"time":1691964260152,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (29,	'2023-08-13 22:05:28',	'{"time":1691964328042,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (30,	'2023-08-13 22:05:35',	'{"time":1691964335555,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (31,	'2023-08-13 22:06:28',	'{"time":1691964387973,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (32,	'2023-08-13 22:06:46',	'{"time":1691964406668,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (33,	'2023-08-13 22:06:54',	'{"time":1691964414450,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (34,	'2023-08-13 22:07:17',	'{"time":1691964437005,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (35,	'2023-08-13 22:07:23',	'{"time":1691964443329,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (36,	'2023-08-13 22:08:24',	'{"time":1691964504831,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (37,	'2023-08-13 22:10:02',	'{"time":1691964602885,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (38,	'2023-08-13 22:11:51',	'{"time":1691964711518,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (39,	'2023-08-13 22:12:56',	'{"time":1691964776358,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (40,	'2023-08-13 22:13:43',	'{"time":1691964823515,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (41,	'2023-08-13 22:15:13',	'{"time":1691964913549,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}}],"version":"2.27.2"}',	4,	10),
                                                                                        (42,	'2023-08-15 20:48:10',	'{"time":1692132490622,"blocks":[{"id":"zcKCF1S7X8","type":"header","data":{"text":"Un zoom ou un portrait&nbsp;","level":1}},{"id":"uOUPxsJssu","type":"paragraph","data":{"text":"Je vais tester Memento,ok"}},{"id":"YtIOaLLEEF","type":"image","data":{"url":"https://i.topito.com/ZyCyTNCnfnjCiTDk96awVEMZVAmloeTA6mGxJRLZgyw=/1340x703/smart/filters:fill(white):format(webp):quality(70)/https%3A%2F%2Fmedia.topito.com%2Fwp-content%2Fuploads%2F2020%2F01%2FUNE_TOPITO_homer-meuble-TV.jpg","caption":"","withBorder":false,"withBackground":false,"stretched":false}}],"version":"2.27.2"}',	4,	10),
                                                                                        (43,	'2023-08-15 22:14:01',	'{"time":1692137641252,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"C"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (44,	'2023-08-15 22:15:46',	'{"time":1692137746350,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"CT"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (45,	'2023-08-15 22:15:57',	'{"time":1692137757096,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"T"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (46,	'2023-08-15 22:16:00',	'{"time":1692137760796,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"TEs"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (47,	'2023-08-15 22:17:02',	'{"time":1692137822728,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (48,	'2023-08-15 22:17:37',	'{"time":1692137857231,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregis"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (49,	'2023-08-15 22:20:31',	'{"time":1692138031154,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistreem"}}],"version":"2.27.2"}',	4,	2),
                                                                                        (50,	'2023-08-15 22:21:14',	'{"time":1692138074373,"blocks":[{"id":"PsNVidtBTg","type":"paragraph","data":{"text":"Test enregistre"}}],"version":"2.27.2"}',	4,	2);

ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_author_fkey" FOREIGN KEY (author) REFERENCES esgi_user(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_category_fkey" FOREIGN KEY (category) REFERENCES esgi_category(id) ON DELETE SET NULL NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_article_id_fkey" FOREIGN KEY (article_id) REFERENCES esgi_article(id) ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_user(id) NOT DEFERRABLE;

-- 2023-08-17 12:50:26.572772+00