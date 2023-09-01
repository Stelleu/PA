-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS esgi_article_id_seq;
CREATE SEQUENCE esgi_article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
                                         "id" integer DEFAULT nextval('esgi_article_id_seq') NOT NULL,
                                         "title" character(80) NOT NULL,
                                         "created_at" timestamp NOT NULL,
                                         "author" integer NOT NULL,
                                         "category" integer DEFAULT '0',
                                         "comment" boolean DEFAULT false NOT NULL,
                                         "menu" boolean DEFAULT false NOT NULL,
                                         "status" boolean DEFAULT false NOT NULL,
                                         "slug" character varying,
                                         "img_url" character varying,
                                         CONSTRAINT "esgi_article_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_article" ("id", "title", "created_at", "author", "category", "comment", "menu", "status", "slug", "img_url") VALUES
    (9,	'Une photo zoomer est elle est un portrait                                       ',	'2023-08-11 19:37:09',	4,	5,	't',	'f',	'f',	'une-photo-zoomer-est-elle-est-un-portrait',	NULL);

DROP TABLE IF EXISTS "esgi_category";
DROP SEQUENCE IF EXISTS esgi_category_id_seq;
CREATE SEQUENCE esgi_category_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_category" (
                                          "id" integer DEFAULT nextval('esgi_category_id_seq') NOT NULL,
                                          "title" character(80) NOT NULL,
                                          CONSTRAINT "esgi_category_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_category" ("id", "title") VALUES
    (5,	'portrait                                                                        ');

DROP TABLE IF EXISTS "esgi_comment";
DROP SEQUENCE IF EXISTS esgi_comment_id_seq;
CREATE SEQUENCE esgi_comment_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_comment" (
                                         "id" integer DEFAULT nextval('esgi_comment_id_seq') NOT NULL,
                                         "comment" character varying NOT NULL,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         "report" integer DEFAULT '0',
                                         "article_id" integer NOT NULL,
                                         "author" integer NOT NULL,
                                         CONSTRAINT "esgi_comment_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


DROP TABLE IF EXISTS "esgi_page";
DROP SEQUENCE IF EXISTS esgi_pages_id_seq;
CREATE SEQUENCE esgi_pages_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_page" (
                                      "id" integer DEFAULT nextval('esgi_pages_id_seq') NOT NULL,
                                      "title" character varying(255) NOT NULL,
                                      "slug" character varying(255) NOT NULL,
                                      "description" character varying NOT NULL,
                                      "status" integer DEFAULT '0' NOT NULL,
                                      "content" text NOT NULL,
                                      "updated_at" timestamp DEFAULT now() NOT NULL,
                                      "menu" integer DEFAULT '0' NOT NULL,
                                      "category" integer,
                                      CONSTRAINT "esgi_pages_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_page" ("id", "title", "slug", "description", "status", "content", "updated_at", "menu", "category") VALUES
    (1,	'',	'',	'ici vous pourrait prendre contact avec nous à n''importe quel moment ! ',	0,	'<div class="row">
            <div class="col-sm-12 ui-resizable" data-type="container-content"><div data-type="component-form">

            </div><div class="form-data" style="display: none !important;" data-type="component-form">[{"type":"text","subtype":"email","label":"Email","className":"form-control","name":"testexamplefr"},{"type":"textarea","label":"Message","className":"form-control","name":"textarea-1692953228716","subtype":"textarea"},{"type":"button","subtype":"submit","label":"Send","className":"btn btn-info","name":"button-1692953243875","style":"info"}]</div><form class="form-content" data-type="component-form"><div class="fb-text form-group field-testexamplefr"><label for="testexamplefr" class="fb-text-label">Email</label><input type="email" class="form-control" name="testexamplefr" id="testexamplefr"></div><div class="fb-textarea form-group field-textarea-1692953228716"><label for="textarea-1692953228716" class="fb-textarea-label">Message</label><textarea type="textarea" class="form-control" name="textarea-1692953228716" id="textarea-1692953228716"></textarea></div><div class="fb-button form-group field-button-1692953243875"><button type="submit" class="btn btn-info" name="button-1692953243875" style="info" id="button-1692953243875">Send</button></div></form></div>
        </div>',	'2023-08-25 09:04:46',	0,	NULL);

DROP TABLE IF EXISTS "esgi_pageviews";
DROP SEQUENCE IF EXISTS esgi_pageviews_id_seq;
CREATE SEQUENCE esgi_pageviews_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_pageviews" (
                                           "id" integer DEFAULT nextval('esgi_pageviews_id_seq') NOT NULL,
                                           "slug" character varying NOT NULL,
                                           "date_inserted" timestamp DEFAULT now() NOT NULL,
                                           CONSTRAINT "esgi_pageviews_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

INSERT INTO "esgi_pageviews" ("id", "slug", "date_inserted") VALUES
                                                                 (1,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 09:45:41'),
                                                                 (2,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:45'),
                                                                 (3,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:45'),
                                                                 (4,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:46'),
                                                                 (5,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:47'),
                                                                 (6,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:48'),
                                                                 (7,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 10:25:48'),
                                                                 (8,	'une-photo-zoomer-est-elle-est-un-portrait',	'2023-08-31 13:29:14');

DROP TABLE IF EXISTS "esgi_setting";
CREATE TABLE "public"."esgi_setting" (
                                         "id" integer NOT NULL,
                                         "website_name" smallint NOT NULL,
                                         "H1_color" character varying NOT NULL,
                                         "polices" character varying NOT NULL,
                                         "p_color" character varying NOT NULL,
                                         "p_size" integer NOT NULL,
                                         "btn_color" character varying NOT NULL
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
                                      "token" character(10),
                                      "date_inserted" timestamp DEFAULT now(),
                                      "status" boolean DEFAULT false NOT NULL,
                                      CONSTRAINT "esgi_user_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

COMMENT ON COLUMN "public"."esgi_user"."role" IS '[0=>admin,1=>editor,2=>modo,3=>user]';

INSERT INTO "esgi_user" ("id", "firstname", "lastname", "email", "pwd", "role", "token", "date_inserted", "status") VALUES
                                                                                                                        (7,	'Sabrina                                                         ',	'Banoune                                                                                                                 ',	'banounesabrina@gmail.com',	'$2y$10$Az0x3NYW29z56QTF8DD03O3glwtTG0VcA3srBRI0Df6ROWd2HyYBu',	4,	'0f54      ',	'2023-08-30 08:19:26',	'f'),
                                                                                                                        (8,	'Sabrina                                                         ',	'Banoune                                                                                                                 ',	'banounesabrina@gmail.com',	'$2y$10$mz6UFIROJklUmesInNUvceKb9KQ7H/1Cq2ddINCeyVOgkSFXR83Q6',	4,	'7d25      ',	'2023-08-30 08:36:42',	'f'),
                                                                                                                        (1,	'Estelle                                                         ',	'Nkumba                                                                                                                  ',	'nkumba.estelle@gmail.com',	'$2y$10$n2ZGl3NubqQaMI8vALOQ5esKiFNZD8l3EZeD.IZJ6r87HVWcUxnaW',	0,	'd85aca3590',	'2023-08-01 08:51:53.774247',	't'),
                                                                                                                        (4,	'Kilyan                                                          ',	'KIKI                                                                                                                    ',	'halimikilyan@gmail.com',	'$2y$10$100Mktvn2qS1EuymuUrV4eOtmFFb7Y7kRD1XCO07BzIG7ztlrQHO6',	0,	'18a65a6ee8',	'2023-08-03 08:16:31',	'f'),
                                                                                                                        (6,	'Sabrina                                                         ',	'Banoune                                                                                                                 ',	'sabrina.banoune@gmail.com',	'$2y$10$aPB3bh00/gEqSibOUV6GNO.Do7vLucbsMHW1fLoOfVASeWTQRtMp.',	4,	'0b77      ',	'2023-08-30 08:11:41',	'f');

DROP TABLE IF EXISTS "esgi_version";
DROP SEQUENCE IF EXISTS esgi_version_id_seq;
CREATE SEQUENCE esgi_version_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_version" (
                                         "id" integer DEFAULT nextval('esgi_version_id_seq') NOT NULL,
                                         "created_at" timestamp DEFAULT now() NOT NULL,
                                         "content" json NOT NULL,
                                         "user_id" integer NOT NULL,
                                         "article_id" integer NOT NULL,
                                         CONSTRAINT "esgi_version_pkey" PRIMARY KEY ("id")
) WITH (oids = false);


ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_author_fkey" FOREIGN KEY (author) REFERENCES esgi_user(id) NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_article" ADD CONSTRAINT "esgi_article_category_fkey" FOREIGN KEY (category) REFERENCES esgi_category(id) ON DELETE SET DEFAULT NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_page" ADD CONSTRAINT "esgi_pages_category_fkey" FOREIGN KEY (category) REFERENCES esgi_category(id) NOT DEFERRABLE;

ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_article_id_fkey" FOREIGN KEY (article_id) REFERENCES esgi_article(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_user(id) NOT DEFERRABLE;

-- 2023-09-01 10:48:53.910861+00