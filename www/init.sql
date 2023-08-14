-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump

DROP TABLE IF EXISTS "esgi_article";
DROP SEQUENCE IF EXISTS esgi_article_id_seq;
CREATE SEQUENCE esgi_article_id_seq INCREMENT 1 MINVALUE 1 MAXVALUE 2147483647 CACHE 1;

CREATE TABLE "public"."esgi_article" (
                                         "id" integer DEFAULT nextval('esgi_article_id_seq') NOT NULL,
                                         "title" character(80) NOT NULL,
                                         "created_at" timestamp NOT NULL,
                                         "author" integer NOT NULL,
                                         "category" integer NOT NULL,
                                         "comment" boolean DEFAULT false NOT NULL,
                                         "menu" boolean DEFAULT false NOT NULL,
                                         "status" boolean DEFAULT false NOT NULL,
                                         "slug" character varying,
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


ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_article_id_fkey" FOREIGN KEY (article_id) REFERENCES esgi_article(id) ON UPDATE CASCADE ON DELETE CASCADE NOT DEFERRABLE;
ALTER TABLE ONLY "public"."esgi_version" ADD CONSTRAINT "esgi_version_user_id_fkey" FOREIGN KEY (user_id) REFERENCES esgi_user(id) NOT DEFERRABLE;

-- 2023-08-14 07:50:30.339084+00