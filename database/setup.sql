--
-- PostgreSQL database dump
--

-- Dumped from database version 9.6.3
-- Dumped by pg_dump version 10.0

-- Started on 2017-10-11 15:13:01 CEST

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- TOC entry 186 (class 1259 OID 24578)
-- Name: cars; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE cars (
    id integer NOT NULL,
    kenteken text NOT NULL,
    data json
);


ALTER TABLE cars OWNER TO postgres;

--
-- TOC entry 185 (class 1259 OID 24576)
-- Name: cars_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE cars_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE cars_id_seq OWNER TO postgres;

--
-- TOC entry 2138 (class 0 OID 0)
-- Dependencies: 185
-- Name: cars_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE cars_id_seq OWNED BY cars.id;


--
-- TOC entry 188 (class 1259 OID 24589)
-- Name: drivers; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE drivers (
    id integer NOT NULL,
    name text
);


ALTER TABLE drivers OWNER TO postgres;

--
-- TOC entry 187 (class 1259 OID 24587)
-- Name: drivers_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE drivers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE drivers_id_seq OWNER TO postgres;

--
-- TOC entry 2139 (class 0 OID 0)
-- Dependencies: 187
-- Name: drivers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE drivers_id_seq OWNED BY drivers.id;


--
-- TOC entry 2010 (class 2604 OID 24581)
-- Name: cars id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cars ALTER COLUMN id SET DEFAULT nextval('cars_id_seq'::regclass);


--
-- TOC entry 2011 (class 2604 OID 24592)
-- Name: drivers id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY drivers ALTER COLUMN id SET DEFAULT nextval('drivers_id_seq'::regclass);


--
-- TOC entry 2013 (class 2606 OID 24586)
-- Name: cars cars_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY cars
    ADD CONSTRAINT cars_pkey PRIMARY KEY (id);


--
-- TOC entry 2015 (class 2606 OID 24597)
-- Name: drivers drivers_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY drivers
    ADD CONSTRAINT drivers_pkey PRIMARY KEY (id);


-- Completed on 2017-10-11 15:13:01 CEST

--
-- PostgreSQL database dump complete
--

