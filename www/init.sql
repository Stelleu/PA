-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS esgi_article_id_seq;
CREATE SEQUENCE esgi_article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
                                         "id" integer DEFAULT nextval('esgi_article_id_seq') NOT NULL,
                                         "title" character(80) NOT NULL,
                                         "text" json NOT NULL,
                                         "date_updated" timestamp NOT NULL,
                                         "author" integer NOT NULL,
                                         "last_update" integer NOT NULL,
                                         "category" integer NOT NULL,
                                         CONSTRAINT "esgi_article_pkey" PRIMARY KEY ("id")
) WITH (oids = false);

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
                                                                                                                        (1,	'Estelle                                                         ',	'Nkumba                                                                                                                  ',	'nkumba.estelle@gmail.com',	'$2y$10$n2ZGl3NubqQaMI8vALOQ5esKiFNZD8l3EZeD.IZJ6r87HVWcUxnaW',	0,	'          ',	'2023-08-01 08:51:53.774247',	't'),
                                                                                                                        (4,	'Kilyan                                                          ',	'KIKI                                                                                                                    ',	'halimikilyan@gmail.com',	'$2y$10$100Mktvn2qS1EuymuUrV4eOtmFFb7Y7kRD1XCO07BzIG7ztlrQHO6',	0,	'5754ee8731',	'2023-08-03 08:16:31',	'f');

-- 2023-08-07 14:52:46.255451+00