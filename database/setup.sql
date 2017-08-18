-- Database: traffictalk

-- DROP DATABASE traffictalk;

CREATE DATABASE traffictalk
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'en_US.utf8'
    LC_CTYPE = 'en_US.utf8'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- Table: public.cars

-- DROP TABLE public.cars;

CREATE TABLE public.cars
(
    id text COLLATE pg_catalog."default" NOT NULL,
    kenteken text COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT cars_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cars
    OWNER to postgres;