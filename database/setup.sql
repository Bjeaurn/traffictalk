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
    data json,
    CONSTRAINT cars_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.cars
    OWNER to postgres;
    
-- Table: public.drivers

-- DROP TABLE public.drivers;

CREATE TABLE public.drivers
(
    id integer NOT NULL DEFAULT nextval('drivers_id_seq'::regclass),
    name text COLLATE pg_catalog."default",
    CONSTRAINT drivers_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

ALTER TABLE public.drivers
    OWNER to postgres;