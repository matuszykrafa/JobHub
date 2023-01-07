--
-- PostgreSQL database dump
--

-- Dumped from database version 15.1 (Debian 15.1-1.pgdg110+1)
-- Dumped by pg_dump version 15.1

-- Started on 2023-01-07 17:15:07

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
-- TOC entry 3396 (class 1262 OID 16384)
-- Name: dbname; Type: DATABASE; Schema: -; Owner: dbuser
--

CREATE DATABASE dbname WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'en_US.utf8';


ALTER DATABASE dbname OWNER TO dbuser;

\connect dbname

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
-- TOC entry 2 (class 3079 OID 16385)
-- Name: uuid-ossp; Type: EXTENSION; Schema: -; Owner: -
--

CREATE EXTENSION IF NOT EXISTS "uuid-ossp" WITH SCHEMA public;


--
-- TOC entry 3397 (class 0 OID 0)
-- Dependencies: 2
-- Name: EXTENSION "uuid-ossp"; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION "uuid-ossp" IS 'generate universally unique identifiers (UUIDs)';


SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 220 (class 1259 OID 32910)
-- Name: offers; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.offers (
    id integer NOT NULL,
    title character varying(255) NOT NULL,
    company character varying(255) NOT NULL,
    localization character varying(255) NOT NULL,
    salary integer NOT NULL,
    requirements text,
    details text,
    contact character varying(255),
    "userId" integer NOT NULL
);


ALTER TABLE public.offers OWNER TO dbuser;

--
-- TOC entry 221 (class 1259 OID 32916)
-- Name: offers_tags; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.offers_tags (
    id integer NOT NULL,
    "offerId" integer NOT NULL,
    "tagId" integer NOT NULL
);


ALTER TABLE public.offers_tags OWNER TO dbuser;

--
-- TOC entry 223 (class 1259 OID 32925)
-- Name: tags; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.tags (
    id integer NOT NULL,
    "tagName" character varying(16) NOT NULL
);


ALTER TABLE public.tags OWNER TO dbuser;

--
-- TOC entry 225 (class 1259 OID 32936)
-- Name: offersWithTags; Type: VIEW; Schema: public; Owner: dbuser
--

CREATE VIEW public."offersWithTags" AS
 SELECT offers.id,
    offers.title,
    offers.company,
    offers.localization,
    offers.salary,
    offers.requirements,
    offers.details,
    offers.contact,
    offers."userId",
    string_agg((tags."tagName")::text, ';'::text) AS tags
   FROM ((public.offers
     JOIN public.offers_tags ON ((offers.id = offers_tags."offerId")))
     JOIN public.tags ON ((offers_tags."tagId" = tags.id)))
  GROUP BY offers.id, offers.title, offers.company, offers.localization, offers.salary, offers.requirements, offers.details, offers.contact, offers."userId";


ALTER TABLE public."offersWithTags" OWNER TO dbuser;

--
-- TOC entry 215 (class 1259 OID 32905)
-- Name: offers_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.offers_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.offers_id_seq OWNER TO dbuser;

--
-- TOC entry 3398 (class 0 OID 0)
-- Dependencies: 215
-- Name: offers_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.offers_id_seq OWNED BY public.offers.id;


--
-- TOC entry 216 (class 1259 OID 32906)
-- Name: offers_tags_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.offers_tags_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.offers_tags_id_seq OWNER TO dbuser;

--
-- TOC entry 3399 (class 0 OID 0)
-- Dependencies: 216
-- Name: offers_tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.offers_tags_id_seq OWNED BY public.offers_tags.id;


--
-- TOC entry 222 (class 1259 OID 32920)
-- Name: sessions; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.sessions (
    id integer NOT NULL,
    "userId" integer NOT NULL,
    "sessionGuid" character varying(36) NOT NULL,
    "dateGenerated" timestamp(6) without time zone DEFAULT now() NOT NULL
);


ALTER TABLE public.sessions OWNER TO dbuser;

--
-- TOC entry 217 (class 1259 OID 32907)
-- Name: sessions_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.sessions_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.sessions_id_seq OWNER TO dbuser;

--
-- TOC entry 3400 (class 0 OID 0)
-- Dependencies: 217
-- Name: sessions_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.sessions_id_seq OWNED BY public.sessions.id;


--
-- TOC entry 218 (class 1259 OID 32908)
-- Name: tags_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.tags_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.tags_id_seq OWNER TO dbuser;

--
-- TOC entry 3401 (class 0 OID 0)
-- Dependencies: 218
-- Name: tags_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.tags_id_seq OWNED BY public.tags.id;


--
-- TOC entry 224 (class 1259 OID 32929)
-- Name: users; Type: TABLE; Schema: public; Owner: dbuser
--

CREATE TABLE public.users (
    id integer NOT NULL,
    email character varying(255) NOT NULL,
    password character varying(255) NOT NULL,
    login character varying(50),
    role integer DEFAULT 0
);


ALTER TABLE public.users OWNER TO dbuser;

--
-- TOC entry 219 (class 1259 OID 32909)
-- Name: users_id_seq; Type: SEQUENCE; Schema: public; Owner: dbuser
--

CREATE SEQUENCE public.users_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    MAXVALUE 2147483647
    CACHE 1;


ALTER TABLE public.users_id_seq OWNER TO dbuser;

--
-- TOC entry 3402 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: dbuser
--

ALTER SEQUENCE public.users_id_seq OWNED BY public.users.id;


--
-- TOC entry 3211 (class 2604 OID 32913)
-- Name: offers id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers ALTER COLUMN id SET DEFAULT nextval('public.offers_id_seq'::regclass);


--
-- TOC entry 3212 (class 2604 OID 32919)
-- Name: offers_tags id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers_tags ALTER COLUMN id SET DEFAULT nextval('public.offers_tags_id_seq'::regclass);


--
-- TOC entry 3213 (class 2604 OID 32923)
-- Name: sessions id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sessions ALTER COLUMN id SET DEFAULT nextval('public.sessions_id_seq'::regclass);


--
-- TOC entry 3215 (class 2604 OID 32928)
-- Name: tags id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.tags ALTER COLUMN id SET DEFAULT nextval('public.tags_id_seq'::regclass);


--
-- TOC entry 3216 (class 2604 OID 32932)
-- Name: users id; Type: DEFAULT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users ALTER COLUMN id SET DEFAULT nextval('public.users_id_seq'::regclass);


--
-- TOC entry 3386 (class 0 OID 32910)
-- Dependencies: 220
-- Data for Name: offers; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.offers VALUES (43, 'Junior C# Developer - zdalnie', 'ITEdge', 'zdalnie', 10000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- C# i .NET Core
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
- Angular, Web API

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach .NET
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji .Net
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'praca@itedge.pl', 15);
INSERT INTO public.offers VALUES (45, 'Senior .Net developer', 'ITEdge', 'zdalnie', 20000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- C# i .NET Core
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
- Angular, Web API

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach .NET
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji .Net
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'praca@itedge.pl', 15);
INSERT INTO public.offers VALUES (46, 'Senior .Net developer', 'ITEdge', 'zdalnie', 20000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- C# i .NET Core
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
- Angular, Web API

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach .NET
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji .Net
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'praca@itedge.pl', 15);
INSERT INTO public.offers VALUES (47, 'Fullstack developer .NET ANGULAR', 'IEdge', 'zdalnie', 15000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- C# i .NET Core
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
- Angular, Web API

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach .NET
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji .Net
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'praca@itedge.pl', 15);
INSERT INTO public.offers VALUES (48, 'PHP Developer', 'NewSpace', 'kraków', 7000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- C# i .NET Core
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Mile widziane:
- Angular, Web API

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach PHP
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji PHP
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'NewSpace@praca.pl', 16);
INSERT INTO public.offers VALUES (49, 'Java developer', 'NewSpace', 'warszawa', 13000, 'Poszukujemy pracownika na stanowisko junior c# developer.

Minimum roczne doświadczenie w branży
- Java
- język angielski B2
- Podstawowa wiedza na temat metod programowania (Agile, Scrum, CI/CD, etc.)

Do twoich zadań będzie należało:
- tworzenie i implementacja oprogramowania w technologiach Java
- tworzenie przejrzystego i dobrze zaprojektowanego kodu
- rozwiązywanie problemów i testowanie aplikacji Java
- wdrażanie w pełni funkcjonalnych aplikacji
- tworzenie dokumentacji technicznej
- współpraca z zespołem', 'Oferujemy:
- Praca na pełny/część etatu
- Umowa o pracę/zlecenie
- Benefity (multisport, prywatna opieka zdrowotna)
- Urlop przy umowie o pracę', 'NewSpace@praca.pl', 16);


--
-- TOC entry 3387 (class 0 OID 32916)
-- Dependencies: 221
-- Data for Name: offers_tags; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.offers_tags VALUES (41, 43, 1);
INSERT INTO public.offers_tags VALUES (44, 46, 1);
INSERT INTO public.offers_tags VALUES (45, 46, 2);
INSERT INTO public.offers_tags VALUES (46, 47, 1);
INSERT INTO public.offers_tags VALUES (47, 47, 2);
INSERT INTO public.offers_tags VALUES (48, 48, 3);
INSERT INTO public.offers_tags VALUES (49, 49, 3);


--
-- TOC entry 3388 (class 0 OID 32920)
-- Dependencies: 222
-- Data for Name: sessions; Type: TABLE DATA; Schema: public; Owner: dbuser
--



--
-- TOC entry 3389 (class 0 OID 32925)
-- Dependencies: 223
-- Data for Name: tags; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.tags VALUES (1, '.Net');
INSERT INTO public.tags VALUES (2, 'Angular');
INSERT INTO public.tags VALUES (3, 'PHP');
INSERT INTO public.tags VALUES (4, 'Java');


--
-- TOC entry 3390 (class 0 OID 32929)
-- Dependencies: 224
-- Data for Name: users; Type: TABLE DATA; Schema: public; Owner: dbuser
--

INSERT INTO public.users VALUES (14, 'admin@admin.admin', '$2y$10$mGh5nBdgBykLXxLF08RrvuzJII.Ui6C7Tq76.y.n.WUbQp4aQULGG', 'admin', 1);
INSERT INTO public.users VALUES (15, 'test@test.test', '$2y$10$4fmj3LUdYCZxCI7xgQjgLOioY2s4PeuNbkon8N5sDTUv3eWFEUEWa', 'test1', 0);
INSERT INTO public.users VALUES (16, 'test2@test2.test2', '$2y$10$vaxR45isi9hn9Txml.dU6uiFC8VKHErdCTSvQ.apJQRSf532MVEJe', 'test2', 0);


--
-- TOC entry 3403 (class 0 OID 0)
-- Dependencies: 215
-- Name: offers_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.offers_id_seq', 49, true);


--
-- TOC entry 3404 (class 0 OID 0)
-- Dependencies: 216
-- Name: offers_tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.offers_tags_id_seq', 49, true);


--
-- TOC entry 3405 (class 0 OID 0)
-- Dependencies: 217
-- Name: sessions_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.sessions_id_seq', 109, true);


--
-- TOC entry 3406 (class 0 OID 0)
-- Dependencies: 218
-- Name: tags_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.tags_id_seq', 6, true);


--
-- TOC entry 3407 (class 0 OID 0)
-- Dependencies: 219
-- Name: users_id_seq; Type: SEQUENCE SET; Schema: public; Owner: dbuser
--

SELECT pg_catalog.setval('public.users_id_seq', 16, true);


--
-- TOC entry 3219 (class 2606 OID 32942)
-- Name: offers offers_pk; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers
    ADD CONSTRAINT offers_pk PRIMARY KEY (id);


--
-- TOC entry 3221 (class 2606 OID 32944)
-- Name: offers_tags offers_tags_pk; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers_tags
    ADD CONSTRAINT offers_tags_pk PRIMARY KEY (id);


--
-- TOC entry 3223 (class 2606 OID 32950)
-- Name: sessions sessions_pk; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pk PRIMARY KEY (id);


--
-- TOC entry 3225 (class 2606 OID 32946)
-- Name: sessions sessions_pk2; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_pk2 UNIQUE ("sessionGuid");


--
-- TOC entry 3227 (class 2606 OID 32948)
-- Name: sessions sessions_userId_key; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT "sessions_userId_key" UNIQUE ("userId");


--
-- TOC entry 3229 (class 2606 OID 32952)
-- Name: tags tags_pk; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.tags
    ADD CONSTRAINT tags_pk PRIMARY KEY (id);


--
-- TOC entry 3231 (class 2606 OID 32956)
-- Name: users users_pk; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pk PRIMARY KEY (id);


--
-- TOC entry 3233 (class 2606 OID 32954)
-- Name: users users_pk2; Type: CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pk2 UNIQUE (email);


--
-- TOC entry 3235 (class 2606 OID 32962)
-- Name: offers_tags offers_tags_offers_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers_tags
    ADD CONSTRAINT offers_tags_offers_id_fk FOREIGN KEY ("offerId") REFERENCES public.offers(id) ON DELETE CASCADE;


--
-- TOC entry 3236 (class 2606 OID 32967)
-- Name: offers_tags offers_tags_tags_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers_tags
    ADD CONSTRAINT offers_tags_tags_id_fk FOREIGN KEY ("tagId") REFERENCES public.tags(id) ON DELETE CASCADE;


--
-- TOC entry 3234 (class 2606 OID 32957)
-- Name: offers offers_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.offers
    ADD CONSTRAINT offers_users_id_fk FOREIGN KEY ("userId") REFERENCES public.users(id);


--
-- TOC entry 3237 (class 2606 OID 32972)
-- Name: sessions sessions_users_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: dbuser
--

ALTER TABLE ONLY public.sessions
    ADD CONSTRAINT sessions_users_id_fk FOREIGN KEY ("userId") REFERENCES public.users(id);


-- Completed on 2023-01-07 17:15:07

--
-- PostgreSQL database dump complete
--

