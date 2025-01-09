------------------------------------------------------------
--        Script Postgre 
------------------------------------------------------------



------------------------------------------------------------
-- Table: Users
------------------------------------------------------------
CREATE TABLE public.Users(
	id_user     SERIAL NOT NULL ,
	firstname   VARCHAR (50) NOT NULL ,
	pseudo      VARCHAR (50) NOT NULL UNIQUE ,
	lastname    VARCHAR (50) NOT NULL ,
	birth       DATE  NOT NULL ,
	mail        VARCHAR (255) NOT NULL UNIQUE,
	country     VARCHAR (50) NOT NULL ,
	phone       VARCHAR (15) NOT NULL ,
	password    VARCHAR (255) NOT NULL ,
	picture     VARCHAR (255) NOT NULL  ,
	CONSTRAINT Users_PK PRIMARY KEY (id_user)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Collaboration
------------------------------------------------------------
CREATE TABLE public.Collaboration(
	id_collaboration   SERIAL NOT NULL ,
	title              VARCHAR (50) NOT NULL ,
	thumbnail          VARCHAR (255) NOT NULL ,
	published_at       DATE  NOT NULL  ,
	CONSTRAINT Collaboration_PK PRIMARY KEY (id_collaboration)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: UsersCollaborations
------------------------------------------------------------
CREATE TABLE public.UsersCollaborations(
	id_usercollaboration   SERIAL NOT NULL ,
	id_user                INT  NOT NULL ,
	id_collaboration       INT  NOT NULL  ,
	CONSTRAINT UsersCollaborations_PK PRIMARY KEY (id_usercollaboration)

	,CONSTRAINT UsersCollaborations_Users_FK FOREIGN KEY (id_user) REFERENCES public.Users(id_user)
	,CONSTRAINT UsersCollaborations_Collaboration0_FK FOREIGN KEY (id_collaboration) REFERENCES public.Collaboration(id_collaboration)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Learnings
------------------------------------------------------------
CREATE TABLE public.Learnings(
	id_learning   SERIAL NOT NULL ,
	title         VARCHAR (50) NOT NULL ,
	thumbnail     VARCHAR (255) NOT NULL ,
	description   VARCHAR (255) NOT NULL ,
	price         DECIMAL (10,2)  NOT NULL ,
	date          DATE  NOT NULL ,
	rate          INT  NOT NULL  ,
	CONSTRAINT Learnings_PK PRIMARY KEY (id_learning)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: MediaType
------------------------------------------------------------
CREATE TABLE public.MediaType(
	id_media_type   SERIAL NOT NULL ,
	label           VARCHAR (50) NOT NULL  ,
	CONSTRAINT MediaType_PK PRIMARY KEY (id_media_type)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Media
------------------------------------------------------------
CREATE TABLE public.Media(
	id_media           SERIAL NOT NULL ,
	name               VARCHAR (50) NOT NULL ,
	id_media_type      INT  NOT NULL ,
	id_collaboration   INT   ,
	id_learning        INT    ,
	CONSTRAINT Media_PK PRIMARY KEY (id_media)

	,CONSTRAINT Media_MediaType_FK FOREIGN KEY (id_media_type) REFERENCES public.MediaType(id_media_type)
	,CONSTRAINT Media_Collaboration0_FK FOREIGN KEY (id_collaboration) REFERENCES public.Collaboration(id_collaboration)
	,CONSTRAINT Media_Learnings1_FK FOREIGN KEY (id_learning) REFERENCES public.Learnings(id_learning)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: UsersLearnings
------------------------------------------------------------
CREATE TABLE public.UsersLearnings(
	id_userlearning   SERIAL NOT NULL ,
	id_user           INT  NOT NULL ,
	id_learning       INT  NOT NULL  ,
	CONSTRAINT UsersLearnings_PK PRIMARY KEY (id_userlearning)

	,CONSTRAINT UsersLearnings_Users_FK FOREIGN KEY (id_user) REFERENCES public.Users(id_user)
	,CONSTRAINT UsersLearnings_Learnings0_FK FOREIGN KEY (id_learning) REFERENCES public.Learnings(id_learning)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: Filters
------------------------------------------------------------
CREATE TABLE public.Filters(
	id_filter   SERIAL NOT NULL ,
	name        VARCHAR (50) NOT NULL  ,
	CONSTRAINT Filters_PK PRIMARY KEY (id_filter)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: UsersFilters
------------------------------------------------------------
CREATE TABLE public.UsersFilters(
	id_userfilter   SERIAL NOT NULL ,
	id_filter       INT  NOT NULL ,
	id_user         INT  NOT NULL  ,
	CONSTRAINT UsersFilters_PK PRIMARY KEY (id_userfilter)

	,CONSTRAINT UsersFilters_Filters_FK FOREIGN KEY (id_filter) REFERENCES public.Filters(id_filter)
	,CONSTRAINT UsersFilters_Users0_FK FOREIGN KEY (id_user) REFERENCES public.Users(id_user)
)WITHOUT OIDS;

------------------------------------------------------------
-- Table: Chats
------------------------------------------------------------
CREATE TABLE public.Chats(
	id_chat      SERIAL NOT NULL ,
	sender       VARCHAR (50) NOT NULL ,
	receiver     VARCHAR (50) NOT NULL ,
	message      VARCHAR (2000)  NOT NULL ,
	created_at   TIMESTAMP  NOT NULL  ,
	CONSTRAINT Chats_PK PRIMARY KEY (id_chat)
)WITHOUT OIDS;


------------------------------------------------------------
-- Table: UsersChats
------------------------------------------------------------
CREATE TABLE public.UsersChats(
	id_userchat   SERIAL NOT NULL ,
	id_user       INT  NOT NULL ,
	id_chat       INT  NOT NULL  ,
	CONSTRAINT UsersChats_PK PRIMARY KEY (id_userchat)

	,CONSTRAINT UsersChats_Users_FK FOREIGN KEY (id_user) REFERENCES public.Users(id_user)
	,CONSTRAINT UsersChats_Chats0_FK FOREIGN KEY (id_chat) REFERENCES public.Chats(id_chat)
)WITHOUT OIDS;

------------------------------------------------------------

-- Insertion des données dans la table MediaType
INSERT INTO public.MediaType (label) VALUES
('Video'),
('Image'),
('Music');

-- Insertion des données dans la table Collaboration
INSERT INTO public.Collaboration (title, thumbnail, published_at) VALUES
('ProjectA', '/assets/media/collaboration/thumbnail/ProjectA.jpg', '2023-01-15'),
('ProjectB', '/assets/media/collaboration/thumbnail/ProjectB.jpg', '2023-02-20'),
('ProjectC', '/assets/media/collaboration/thumbnail/ProjectC.jpg', '2023-03-25'),
('ProjectD', '/assets/media/collaboration/thumbnail/ProjectD.jpg', '2023-04-30'),
('ProjectE', '/assets/media/collaboration/thumbnail/ProjectE.jpg', '2023-05-10'),
('ProjectF', '/assets/media/collaboration/thumbnail/ProjectF.jpg', '2023-06-15'),
('ProjectG', '/assets/media/collaboration/thumbnail/ProjectG.jpg', '2023-07-20'),
('ProjectH', '/assets/media/collaboration/thumbnail/ProjectH.jpg', '2023-08-25'),
('ProjectI', '/assets/media/collaboration/thumbnail/ProjectI.jpg', '2023-09-30'),
('ProjectJ', '/assets/media/collaboration/thumbnail/ProjectJ.jpg', '2023-10-10');

-- Insertion des données dans la table Learnings
INSERT INTO public.Learnings (title, thumbnail, description, price, date, rate) VALUES
('LearningA', '/assets/media/learning/thumbnail/LearningA.jpg', 'Description A', 9.99, '2023-01-10', 5),
('LearningB', '/assets/media/learning/thumbnail/LearningB.jpg', 'Description B', 19.99, '2023-02-15', 4),
('LearningC', '/assets/media/learning/thumbnail/LearningC.jpg', 'Description C', 29.99, '2023-03-20', 4),
('LearningD', '/assets/media/learning/thumbnail/LearningD.jpg', 'Description D', 39.99, '2023-04-25', 5),
('LearningE', '/assets/media/learning/thumbnail/LearningE.jpg', 'Description E', 49.99, '2023-05-30', 5),
('LearningF', '/assets/media/learning/thumbnail/LearningF.jpg', 'Description F', 59.99, '2023-06-10', 3),
('LearningG', '/assets/media/learning/thumbnail/LearningG.jpg', 'Description G', 69.99, '2023-07-15', 5),
('LearningH', '/assets/media/learning/thumbnail/LearningH.jpg', 'Description H', 79.99, '2023-08-20', 4),
('LearningI', '/assets/media/learning/thumbnail/LearningI.jpg', 'Description I', 89.99, '2023-09-25', 4),
('LearningJ', '/assets/media/learning/thumbnail/LearningJ.jpg', 'Description J', 99.99, '2023-10-30', 5);

-- Insertion des données dans la table Filters
INSERT INTO public.Filters (name) VALUES 
('Salsa'),
('Bachata'),
('Merengue'),
('Zouk'),
('K-pop'),
('Afrobeat'),
('Gospel'),
('Trap'),
('Dubstep'),
('Chillout'),
('Lo-fi'),
('Ambient'),
('Hard Rock'),
('Punk'),
('Ska'),
('Grunge'),
('Indie'),
('Bluegrass'),
('Blues'),
('Pop'),
('Reggae'),
('Metal'),
('Funk'),
('Soul'),
('Country'),
('Techno'),
('R&B'),
('Folk'),
('Disco'),
('Opéra'),
('Ocarina'),
('Maracas'),
('Tuba'),
('Congas'),
('Cajón'),
('Xylophone'),
('Vibraphone'),
('Didgeridoo'),
('Cornemuse'),
('Kora'),
('Balalaïka'),
('Kalimba'),
('Hang Drum'),
('Mélodica'),
('Glockenspiel'),
('Ukulélé'),
('Harmonica'),
('Trompette'),
('Contrebasse'),
('Clarinette'),
('Mandoline'),
('Banjo'),
('Accordéon'),
('Harpe'),
('Synthétiseur'),
('Flûte traversière'),
('Tambourin'),
('Sombre'),
('Intense'),
('Joyeuse'),
('Spirituelle'),
('Aventureuse'),
('Urbaine'),
('Minimaliste'),
('Dynamique'),
('Zen'),
('Chaotique'),
('Festive'),
('Romantique'),
('Triste'),
('Relaxante'),
('Énergique'),
('Mystérieuse'),
('Épique'),
('Nostalgique'),
('Méditation'),
('Russe'),
('Japonais'),
('Chinois'),
('Arabe'),
('Coréen'),
('Polynésien'),
('Scandinave'),
('Français'),
('Anglais'),
('Espagnol'),
('Italien'),
('Allemand'),
('Brésilien'),
('Africain'),
('Indien'),
('Asiatique'),
('Latino'),
('Psychedelic Trap'),
('Dark Trap'),
('Rage Beat'),
('Cloud Rap'),
('Chicago Drill'),
('UK Drill'),
('French Drill'),
('Mumble Rap'),
('Emo Rap'),
('Experimental Rap'),
('Industrial Rap'),
('Hyperpop Rap'),
('Lo-Fi Rap'),
('Plugg'),
('PluggnB'),
('Afro-Trap'),
('Afro-Rap'),
('Synthwave Rap'),
('Phonk'),
('Vapor Trap'),
('Chill Trap'),
('Boom Bap Revival'),
('Jazz Rap'),
('Neo-Soul Rap'),
('Pop-Rap'),
('SoundCloud Rap'),
('Cyber Trap'),
('Alternative Rap'),
('Bedroom Rap'),
('Latin Trap'),
('Memphis Rap'),
('Horrorcore'),
('Trap Metal'),
('Ambient Rap'),
('Grime'),
('Nerdcore'),
('Nerd Rap'),
('Chopped and Screwed'),
('Crunk'),
('G-Funk Revival'),
('Psychedelic Rap'),
('Glitch Rap'),
('Experimental Trap'),
('Ethereal Rap'),
('Boom Trap'),
('Minimal Trap'),
('Synth Trap'),
('Drill n’ B'),
('Conscious Trap'),
('Future Bounce'),
('Vaporwave Rap'),
('Trap-Soul'),
('New Age Rap'),
('Progressive Trap'),
('Garage Rap'),
('Neo-Trap'),
('Punk Rap'),
('Funk Rap'),
('New wave'),
('Electro Trap');

-- Insertion des données dans la table UsersCollaborations
INSERT INTO public.UsersCollaborations (id_user, id_collaboration) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);


-- Insertion des données dans la table UsersLearnings
INSERT INTO public.UsersLearnings (id_user, id_learning) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- Insertion des données dans la table Media
INSERT INTO public.Media (name, id_media_type, id_collaboration, id_learning) VALUES
('CollaborationDocument1', 1, 1, NULL),
('CollaborationImage1', 2, 2, NULL),
('LearningVideo3', 1, NULL, NULL),
('CollaborationPodcast1', 3, 3, NULL),
('CollaborationInfographic1', 2, 4, NULL),
('LearningA', 1, NULL, 1),
('LearningB', 1, NULL, 2),
('LearningC', 3, NULL, 3),
('LearningD', 1, NULL, 4),
('LearningE', 1, NULL, 5),
('LearningF', 1, NULL, 6),
('LearningG', 1, NULL, 7),
('LearningH', 1, NULL, 8),
('LearningI', 3, NULL, 9),
('LearningJ', 1, NULL, 10);