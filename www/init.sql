-- Adminer 4.8.1 PostgreSQL 15.3 (Debian 15.3-1.pgdg110+1) dump


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

INSERT INTO "esgi_user" ("firstname", "lastname", "email", "pwd", "role", "token", "id", "date_inserted", "status", "logo") VALUES
                                                                                                                                                ('Estelle                                                         ',	'NKUMBA                                                                                                                  ',	'nkumba.estelle@gmail.com',	'$2y$10$n2ZGl3NubqQaMI8vALOQ5esKiFNZD8l3EZeD.IZJ6r87HVWcUxnaW',	0,	NULL,	'd077e9f1a7',	8,	NULL,	't',	'../Views/Dash/theme/dist/assets/media/avatars/blank.png'),
                                                                                                                                                ('test                                                            ',	'popo                                                                                                                    ',	'popo@gmail.com',	'test1236@',	1,	'2023-06-23 13:23:51.672034',	'          ',	1,	'2023-06-23 13:23:51.672034',	't',	'../Views/Dash/theme/dist/assets/media/avatars/300-2.jpg'),
                                                                                                                                                ('Estelle                                                         ',	'NKUMBA                                                                                                                  ',	'estelle272001@gmail.com',	'$2y$10$QeQAj7I38fC1i1cBzOhf4uYrMROZsn7.GGQt7F6CCt4nHyHcZv9s6',	0,	NULL,	'          ',	5,	NULL,	'f',	'../Views/Dash/theme/dist/assets/media/avatars/blank.png');

-- 2023-07-14 14:21:52.162891+00