--
-- PostgreSQL database dump
--

-- Dumped from database version 12.2
-- Dumped by pg_dump version 12.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: nmr2web; Type: SCHEMA; Schema: -; Owner: feri
--

CREATE SCHEMA nmr2web;


ALTER SCHEMA nmr2web OWNER TO feri;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: analyses; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.analyses (
    id bigint NOT NULL,
    user_id numeric NOT NULL,
    status_id numeric NOT NULL,
    created_at timestamp with time zone,
    updated_at timestamp with time zone,
    lab_id numeric NOT NULL
);


ALTER TABLE nmr2web.analyses OWNER TO feri;

--
-- Name: analyses_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.analyses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.analyses_id_seq OWNER TO feri;

--
-- Name: analyses_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.analyses_id_seq OWNED BY nmr2web.analyses.id;


--
-- Name: grant_user; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.grant_user (
    id bigint NOT NULL,
    user_id numeric NOT NULL,
    grant_id numeric NOT NULL
);


ALTER TABLE nmr2web.grant_user OWNER TO feri;

--
-- Name: grant_user_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.grant_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.grant_user_id_seq OWNER TO feri;

--
-- Name: grant_user_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.grant_user_id_seq OWNED BY nmr2web.grant_user.id;


--
-- Name: grants; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.grants (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE nmr2web.grants OWNER TO feri;

--
-- Name: grants_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.grants_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.grants_id_seq OWNER TO feri;

--
-- Name: grants_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.grants_id_seq OWNED BY nmr2web.grants.id;


--
-- Name: labs; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.labs (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    address text NOT NULL
);


ALTER TABLE nmr2web.labs OWNER TO feri;

--
-- Name: labs_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.labs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.labs_id_seq OWNER TO feri;

--
-- Name: labs_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.labs_id_seq OWNED BY nmr2web.labs.id;


--
-- Name: migrations; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.migrations (
    id bigint NOT NULL,
    migration character varying(255) NOT NULL,
    batch bigint NOT NULL
);


ALTER TABLE nmr2web.migrations OWNER TO feri;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.migrations_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.migrations_id_seq OWNER TO feri;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.migrations_id_seq OWNED BY nmr2web.migrations.id;


--
-- Name: roles; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE nmr2web.roles OWNER TO feri;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.roles_id_seq OWNER TO feri;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.roles_id_seq OWNED BY nmr2web.roles.id;


--
-- Name: samples; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.samples (
    id bigint NOT NULL,
    user_id numeric NOT NULL,
    name character varying(255) NOT NULL,
    amount bigint,
    structure text NOT NULL,
    note text,
    created_at timestamp with time zone,
    updated_at timestamp with time zone,
    spectrometer_id numeric NOT NULL,
    analysis_id numeric,
    solvent_id numeric NOT NULL,
    grant_id numeric
);


ALTER TABLE nmr2web.samples OWNER TO feri;

--
-- Name: samples_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.samples_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.samples_id_seq OWNER TO feri;

--
-- Name: samples_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.samples_id_seq OWNED BY nmr2web.samples.id;


--
-- Name: solvents; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.solvents (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE nmr2web.solvents OWNER TO feri;

--
-- Name: solvents_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.solvents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.solvents_id_seq OWNER TO feri;

--
-- Name: solvents_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.solvents_id_seq OWNED BY nmr2web.solvents.id;


--
-- Name: spectrometers; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.spectrometers (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    type character varying(255) NOT NULL
);


ALTER TABLE nmr2web.spectrometers OWNER TO feri;

--
-- Name: spectrometers_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.spectrometers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.spectrometers_id_seq OWNER TO feri;

--
-- Name: spectrometers_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.spectrometers_id_seq OWNED BY nmr2web.spectrometers.id;


--
-- Name: statuses; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.statuses (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE nmr2web.statuses OWNER TO feri;

--
-- Name: statuses_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.statuses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.statuses_id_seq OWNER TO feri;

--
-- Name: statuses_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.statuses_id_seq OWNED BY nmr2web.statuses.id;


--
-- Name: users; Type: TABLE; Schema: nmr2web; Owner: feri
--

CREATE TABLE nmr2web.users (
    id bigint NOT NULL,
    login character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role_id numeric NOT NULL
);


ALTER TABLE nmr2web.users OWNER TO feri;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: nmr2web; Owner: feri
--

CREATE SEQUENCE nmr2web.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE nmr2web.users_id_seq OWNER TO feri;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: nmr2web; Owner: feri
--

ALTER SEQUENCE nmr2web.users_id_seq OWNED BY nmr2web.users.id;


--
-- Name: analyses; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.analyses (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    status_id bigint NOT NULL,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    lab_id bigint NOT NULL
);


ALTER TABLE public.analyses OWNER TO root;

--
-- Name: analyses_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.analyses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.analyses_id_seq OWNER TO root;

--
-- Name: analyses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.analyses_id_seq OWNED BY public.analyses.id;


--
-- Name: grant_user; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.grant_user (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    grant_id bigint NOT NULL
);


ALTER TABLE public.grant_user OWNER TO root;

--
-- Name: grant_user_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.grant_user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grant_user_id_seq OWNER TO root;

--
-- Name: grant_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.grant_user_id_seq OWNED BY public.grant_user.id;


--
-- Name: grants; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.grants (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.grants OWNER TO root;

--
-- Name: grants_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.grants_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.grants_id_seq OWNER TO root;

--
-- Name: grants_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.grants_id_seq OWNED BY public.grants.id;


--
-- Name: labs; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.labs (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    address text NOT NULL
);


ALTER TABLE public.labs OWNER TO root;

--
-- Name: labs_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.labs_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.labs_id_seq OWNER TO root;

--
-- Name: labs_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.labs_id_seq OWNED BY public.labs.id;


--
-- Name: migrations; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.migrations (
    id integer NOT NULL,
    migration character varying(255) NOT NULL,
    batch integer NOT NULL
);


ALTER TABLE public.migrations OWNER TO root;

--
-- Name: migrations_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.migrations_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.migrations_id_seq OWNER TO root;

--
-- Name: migrations_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.migrations_id_seq OWNED BY public.migrations.id;


--
-- Name: roles; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.roles (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.roles OWNER TO root;

--
-- Name: roles_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.roles_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.roles_id_seq OWNER TO root;

--
-- Name: roles_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.roles_id_seq OWNED BY public.roles.id;


--
-- Name: samples; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.samples (
    id bigint NOT NULL,
    user_id bigint NOT NULL,
    name character varying(255) NOT NULL,
    amount integer,
    structure text NOT NULL,
    note text,
    created_at timestamp(0) without time zone,
    updated_at timestamp(0) without time zone,
    spectrometer_id bigint NOT NULL,
    analysis_id bigint,
    solvent_id bigint NOT NULL,
    grant_id bigint
);


ALTER TABLE public.samples OWNER TO root;

--
-- Name: samples_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.samples_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.samples_id_seq OWNER TO root;

--
-- Name: samples_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.samples_id_seq OWNED BY public.samples.id;


--
-- Name: solvents; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.solvents (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.solvents OWNER TO root;

--
-- Name: solvents_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.solvents_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.solvents_id_seq OWNER TO root;

--
-- Name: solvents_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.solvents_id_seq OWNED BY public.solvents.id;


--
-- Name: spectrometers; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.spectrometers (
    id bigint NOT NULL,
    name character varying(255) NOT NULL,
    type character varying(255) NOT NULL
);


ALTER TABLE public.spectrometers OWNER TO root;

--
-- Name: spectrometers_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.spectrometers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.spectrometers_id_seq OWNER TO root;

--
-- Name: spectrometers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.spectrometers_id_seq OWNED BY public.spectrometers.id;


--
-- Name: statuses; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.statuses (
    id bigint NOT NULL,
    name character varying(255) NOT NULL
);


ALTER TABLE public.statuses OWNER TO root;

--
-- Name: statuses_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.statuses_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.statuses_id_seq OWNER TO root;

--
-- Name: statuses_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.statuses_id_seq OWNED BY public.statuses.id;


--
-- Name: users; Type: TABLE; Schema: public; Owner: root
--

CREATE TABLE public.users (
    id bigint NOT NULL,
    login character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    role_id bigint NOT NULL
);


ALTER TABLE public.users OWNER TO root;

--
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: root
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO root;

--
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: root
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- Name: analyses id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.analyses ALTER COLUMN id SET DEFAULT nextval('nmr2web.analyses_id_seq'::regclass);


--
-- Name: grant_user id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.grant_user ALTER COLUMN id SET DEFAULT nextval('nmr2web.grant_user_id_seq'::regclass);


--
-- Name: grants id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.grants ALTER COLUMN id SET DEFAULT nextval('nmr2web.grants_id_seq'::regclass);


--
-- Name: labs id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.labs ALTER COLUMN id SET DEFAULT nextval('nmr2web.labs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.migrations ALTER COLUMN id SET DEFAULT nextval('nmr2web.migrations_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.roles ALTER COLUMN id SET DEFAULT nextval('nmr2web.roles_id_seq'::regclass);


--
-- Name: samples id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.samples ALTER COLUMN id SET DEFAULT nextval('nmr2web.samples_id_seq'::regclass);


--
-- Name: solvents id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.solvents ALTER COLUMN id SET DEFAULT nextval('nmr2web.solvents_id_seq'::regclass);


--
-- Name: spectrometers id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.spectrometers ALTER COLUMN id SET DEFAULT nextval('nmr2web.spectrometers_id_seq'::regclass);


--
-- Name: statuses id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.statuses ALTER COLUMN id SET DEFAULT nextval('nmr2web.statuses_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.users ALTER COLUMN id SET DEFAULT nextval('nmr2web.users_id_seq'::regclass);


--
-- Name: analyses id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.analyses ALTER COLUMN id SET DEFAULT nextval('public.analyses_id_seq'::regclass);


--
-- Name: grant_user id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grant_user ALTER COLUMN id SET DEFAULT nextval('public.grant_user_id_seq'::regclass);


--
-- Name: grants id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grants ALTER COLUMN id SET DEFAULT nextval('public.grants_id_seq'::regclass);


--
-- Name: labs id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.labs ALTER COLUMN id SET DEFAULT nextval('public.labs_id_seq'::regclass);


--
-- Name: migrations id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.migrations ALTER COLUMN id SET DEFAULT nextval('public.migrations_id_seq'::regclass);


--
-- Name: roles id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.roles ALTER COLUMN id SET DEFAULT nextval('public.roles_id_seq'::regclass);


--
-- Name: samples id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples ALTER COLUMN id SET DEFAULT nextval('public.samples_id_seq'::regclass);


--
-- Name: solvents id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.solvents ALTER COLUMN id SET DEFAULT nextval('public.solvents_id_seq'::regclass);


--
-- Name: spectrometers id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.spectrometers ALTER COLUMN id SET DEFAULT nextval('public.spectrometers_id_seq'::regclass);


--
-- Name: statuses id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.statuses ALTER COLUMN id SET DEFAULT nextval('public.statuses_id_seq'::regclass);


--
-- Name: users id; Type: DEFAULT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- Name: analyses idx_16550_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.analyses
    ADD CONSTRAINT idx_16550_primary PRIMARY KEY (id);


--
-- Name: grants idx_16559_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.grants
    ADD CONSTRAINT idx_16559_primary PRIMARY KEY (id);


--
-- Name: grant_user idx_16565_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.grant_user
    ADD CONSTRAINT idx_16565_primary PRIMARY KEY (id);


--
-- Name: labs idx_16574_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.labs
    ADD CONSTRAINT idx_16574_primary PRIMARY KEY (id);


--
-- Name: migrations idx_16583_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.migrations
    ADD CONSTRAINT idx_16583_primary PRIMARY KEY (id);


--
-- Name: roles idx_16589_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.roles
    ADD CONSTRAINT idx_16589_primary PRIMARY KEY (id);


--
-- Name: samples idx_16595_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.samples
    ADD CONSTRAINT idx_16595_primary PRIMARY KEY (id);


--
-- Name: solvents idx_16604_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.solvents
    ADD CONSTRAINT idx_16604_primary PRIMARY KEY (id);


--
-- Name: spectrometers idx_16610_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.spectrometers
    ADD CONSTRAINT idx_16610_primary PRIMARY KEY (id);


--
-- Name: statuses idx_16619_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.statuses
    ADD CONSTRAINT idx_16619_primary PRIMARY KEY (id);


--
-- Name: users idx_16625_primary; Type: CONSTRAINT; Schema: nmr2web; Owner: feri
--

ALTER TABLE ONLY nmr2web.users
    ADD CONSTRAINT idx_16625_primary PRIMARY KEY (id);


--
-- Name: analyses analyses_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.analyses
    ADD CONSTRAINT analyses_pkey PRIMARY KEY (id);


--
-- Name: grant_user grant_user_grant_id_user_id_unique; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grant_user
    ADD CONSTRAINT grant_user_grant_id_user_id_unique UNIQUE (grant_id, user_id);


--
-- Name: grant_user grant_user_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grant_user
    ADD CONSTRAINT grant_user_pkey PRIMARY KEY (id);


--
-- Name: grants grants_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grants
    ADD CONSTRAINT grants_pkey PRIMARY KEY (id);


--
-- Name: labs labs_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.labs
    ADD CONSTRAINT labs_pkey PRIMARY KEY (id);


--
-- Name: migrations migrations_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.migrations
    ADD CONSTRAINT migrations_pkey PRIMARY KEY (id);


--
-- Name: roles roles_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.roles
    ADD CONSTRAINT roles_pkey PRIMARY KEY (id);


--
-- Name: samples samples_analysis_id_unique; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_analysis_id_unique UNIQUE (analysis_id);


--
-- Name: samples samples_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_pkey PRIMARY KEY (id);


--
-- Name: solvents solvents_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.solvents
    ADD CONSTRAINT solvents_pkey PRIMARY KEY (id);


--
-- Name: spectrometers spectrometers_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.spectrometers
    ADD CONSTRAINT spectrometers_pkey PRIMARY KEY (id);


--
-- Name: statuses statuses_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.statuses
    ADD CONSTRAINT statuses_pkey PRIMARY KEY (id);


--
-- Name: users users_login_unique; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_login_unique UNIQUE (login);


--
-- Name: users users_pkey; Type: CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (id);


--
-- Name: idx_16550_analyses_lab_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16550_analyses_lab_id_foreign ON nmr2web.analyses USING btree (lab_id);


--
-- Name: idx_16550_analyses_status_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16550_analyses_status_id_foreign ON nmr2web.analyses USING btree (status_id);


--
-- Name: idx_16550_analyses_user_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16550_analyses_user_id_foreign ON nmr2web.analyses USING btree (user_id);


--
-- Name: idx_16565_grant_user_grant_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16565_grant_user_grant_id_foreign ON nmr2web.grant_user USING btree (grant_id);


--
-- Name: idx_16565_grant_user_grant_id_user_id_unique; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE UNIQUE INDEX idx_16565_grant_user_grant_id_user_id_unique ON nmr2web.grant_user USING btree (grant_id, user_id);


--
-- Name: idx_16565_grant_user_user_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16565_grant_user_user_id_foreign ON nmr2web.grant_user USING btree (user_id);


--
-- Name: idx_16595_samples_analysis_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16595_samples_analysis_id_foreign ON nmr2web.samples USING btree (analysis_id);


--
-- Name: idx_16595_samples_grant_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16595_samples_grant_id_foreign ON nmr2web.samples USING btree (grant_id);


--
-- Name: idx_16595_samples_solvent_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16595_samples_solvent_id_foreign ON nmr2web.samples USING btree (solvent_id);


--
-- Name: idx_16595_samples_spectrometer_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16595_samples_spectrometer_id_foreign ON nmr2web.samples USING btree (spectrometer_id);


--
-- Name: idx_16595_samples_user_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16595_samples_user_id_foreign ON nmr2web.samples USING btree (user_id);


--
-- Name: idx_16625_users_login_unique; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE UNIQUE INDEX idx_16625_users_login_unique ON nmr2web.users USING btree (login);


--
-- Name: idx_16625_users_role_id_foreign; Type: INDEX; Schema: nmr2web; Owner: feri
--

CREATE INDEX idx_16625_users_role_id_foreign ON nmr2web.users USING btree (role_id);


--
-- Name: users_login_index; Type: INDEX; Schema: public; Owner: root
--

CREATE INDEX users_login_index ON public.users USING btree (login);


--
-- Name: analyses analyses_lab_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.analyses
    ADD CONSTRAINT analyses_lab_id_foreign FOREIGN KEY (lab_id) REFERENCES public.labs(id);


--
-- Name: analyses analyses_status_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.analyses
    ADD CONSTRAINT analyses_status_id_foreign FOREIGN KEY (status_id) REFERENCES public.statuses(id) ON DELETE CASCADE;


--
-- Name: analyses analyses_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.analyses
    ADD CONSTRAINT analyses_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: grant_user grant_user_grant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grant_user
    ADD CONSTRAINT grant_user_grant_id_foreign FOREIGN KEY (grant_id) REFERENCES public.grants(id);


--
-- Name: grant_user grant_user_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.grant_user
    ADD CONSTRAINT grant_user_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id);


--
-- Name: samples samples_analysis_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_analysis_id_foreign FOREIGN KEY (analysis_id) REFERENCES public.analyses(id) ON DELETE CASCADE;


--
-- Name: samples samples_grant_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_grant_id_foreign FOREIGN KEY (grant_id) REFERENCES public.grants(id) ON DELETE CASCADE;


--
-- Name: samples samples_solvent_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_solvent_id_foreign FOREIGN KEY (solvent_id) REFERENCES public.solvents(id) ON DELETE CASCADE;


--
-- Name: samples samples_spectrometer_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_spectrometer_id_foreign FOREIGN KEY (spectrometer_id) REFERENCES public.spectrometers(id);


--
-- Name: samples samples_user_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.samples
    ADD CONSTRAINT samples_user_id_foreign FOREIGN KEY (user_id) REFERENCES public.users(id) ON DELETE CASCADE;


--
-- Name: users users_role_id_foreign; Type: FK CONSTRAINT; Schema: public; Owner: root
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_role_id_foreign FOREIGN KEY (role_id) REFERENCES public.roles(id);


--
-- Name: SCHEMA nmr2web; Type: ACL; Schema: -; Owner: feri
--

GRANT ALL ON SCHEMA nmr2web TO root;


--
-- Name: TABLE analyses; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.analyses TO root;


--
-- Name: SEQUENCE analyses_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.analyses_id_seq TO root;


--
-- Name: TABLE grant_user; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.grant_user TO root;


--
-- Name: SEQUENCE grant_user_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.grant_user_id_seq TO root;


--
-- Name: TABLE grants; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.grants TO root;


--
-- Name: SEQUENCE grants_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.grants_id_seq TO root;


--
-- Name: TABLE labs; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.labs TO root;


--
-- Name: SEQUENCE labs_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.labs_id_seq TO root;


--
-- Name: TABLE migrations; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.migrations TO root;


--
-- Name: SEQUENCE migrations_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.migrations_id_seq TO root;


--
-- Name: TABLE roles; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.roles TO root;


--
-- Name: SEQUENCE roles_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.roles_id_seq TO root;


--
-- Name: TABLE samples; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.samples TO root;


--
-- Name: SEQUENCE samples_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.samples_id_seq TO root;


--
-- Name: TABLE solvents; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.solvents TO root;


--
-- Name: SEQUENCE solvents_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.solvents_id_seq TO root;


--
-- Name: TABLE spectrometers; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.spectrometers TO root;


--
-- Name: SEQUENCE spectrometers_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.spectrometers_id_seq TO root;


--
-- Name: TABLE statuses; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.statuses TO root;


--
-- Name: SEQUENCE statuses_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.statuses_id_seq TO root;


--
-- Name: TABLE users; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON TABLE nmr2web.users TO root;


--
-- Name: SEQUENCE users_id_seq; Type: ACL; Schema: nmr2web; Owner: feri
--

GRANT ALL ON SEQUENCE nmr2web.users_id_seq TO root;


--
-- PostgreSQL database dump complete
--

