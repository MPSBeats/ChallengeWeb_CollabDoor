DROP TABLE IF EXISTS Users CASCADE;
DROP TABLE IF EXISTS Collaborations CASCADE;
DROP TABLE IF EXISTS Media CASCADE;
DROP TABLE IF EXISTS MediaType CASCADE;
DROP TABLE IF EXISTS Learnings CASCADE;
DROP TABLE IF EXISTS Chats CASCADE;
DROP TABLE IF EXISTS Filters CASCADE;
DROP TABLE IF EXISTS UserFilters CASCADE;
DROP TABLE IF EXISTS SearchCollaborationFilters CASCADE;
DROP TABLE IF EXISTS SearchCollaborations CASCADE;
DROP TABLE IF EXISTS UserCollaborations CASCADE;
DROP TABLE IF EXISTS UserLearnings CASCADE;
DROP TABLE IF EXISTS LearningFilters CASCADE;

CREATE TABLE Users (
    id_user SERIAL PRIMARY KEY,
    firstname VARCHAR(50),
    lastname VARCHAR(50),
    birth DATE,
    mail VARCHAR(255) UNIQUE,
    country VARCHAR(50),
    phone VARCHAR(15),
    password VARCHAR(255),
    picture VARCHAR(255),
    pseudo VARCHAR(50) UNIQUE
);

CREATE TABLE Collaborations (
    id_collaborations SERIAL PRIMARY KEY,
    title VARCHAR(255),
    thumbnail VARCHAR(255),
    published_at TIMESTAMP
);

CREATE TABLE SearchCollaborations (
    id_searchcollaborations SERIAL PRIMARY KEY,
    title VARCHAR(255),
    thumbnail VARCHAR(255),
    published_at TIMESTAMP
);

CREATE TABLE Learnings (
    id_learning SERIAL PRIMARY KEY,
    title VARCHAR(255),
    thumbnail VARCHAR(255),
    description TEXT,
    price DECIMAL,
    date DATE,
    rate INT
);

CREATE TABLE Filters (
    id_filter SERIAL PRIMARY KEY,
    name VARCHAR(255)
);

CREATE TABLE MediaType (
    id_media_type SERIAL PRIMARY KEY,
    label VARCHAR(50)
);

CREATE TABLE Media (
    id_media SERIAL PRIMARY KEY,
    name VARCHAR(255),
    id_collaborations INT,
    FOREIGN KEY (id_collaborations) REFERENCES Collaborations(id_collaborations)
);

CREATE TABLE Chats (
    id_chat SERIAL PRIMARY KEY,
    sender INT,
    receiver INT,
    message TEXT,
    created_at TIMESTAMP,
    FOREIGN KEY (sender) REFERENCES Users(id_user),
    FOREIGN KEY (receiver) REFERENCES Users(id_user)
);

CREATE TABLE UserFilters (
    id_userfilter SERIAL PRIMARY KEY,
    id_user INT,
    id_filter INT,
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_filter) REFERENCES Filters(id_filter)
);

CREATE TABLE SearchCollaborationFilters (
    id_searchcollaborationfilters SERIAL PRIMARY KEY,
    id_filter INT,
    id_searchcollaborations INT,
    FOREIGN KEY (id_filter) REFERENCES Filters(id_filter),
    FOREIGN KEY (id_searchcollaborations) REFERENCES SearchCollaborations(id_searchcollaborations)
);

CREATE TABLE UserCollaborations (
    id_usercollaborations SERIAL PRIMARY KEY,
    id_user INT,
    id_collaborations INT,
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_collaborations) REFERENCES Collaborations(id_collaborations)
);

CREATE TABLE UserLearnings (
    id_userlearning SERIAL PRIMARY KEY,
    id_user INT,
    id_learning INT,
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_learning) REFERENCES Learnings(id_learning)
);

CREATE TABLE LearningFilters (
    id_learningfilters SERIAL PRIMARY KEY,
    id_learning INT,
    id_filter INT,
    FOREIGN KEY (id_learning) REFERENCES Learnings(id_learning),
    FOREIGN KEY (id_filter) REFERENCES Filters(id_filter)
);

CREATE TABLE UsersSearchCollaborations (
    id_userssearchcollaborations SERIAL PRIMARY KEY,
    id_user INT,
    id_searchcollaborations INT,
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_searchcollaborations) REFERENCES SearchCollaborations(id_searchcollaborations)
);

CREATE TABLE CollaborationsFilters (
    id_collaborationsfilters SERIAL PRIMARY KEY,
    id_collaborations INT,
    id_filter INT,
    FOREIGN KEY (id_collaborations) REFERENCES Collaborations(id_collaborations),
    FOREIGN KEY (id_filter) REFERENCES Filters(id_filter)
);

CREATE TABLE UsersChats (
    id_userchat SERIAL PRIMARY KEY,
    id_user INT,
    id_chat INT,
    FOREIGN KEY (id_user) REFERENCES Users(id_user),
    FOREIGN KEY (id_chat) REFERENCES Chats(id_chat)
);

ALTER SEQUENCE users_id_user_seq RESTART WITH 1;
ALTER SEQUENCE collaborations_id_collaborations_seq RESTART WITH 1;
ALTER SEQUENCE searchcollaborations_id_searchcollaborations_seq RESTART WITH 1;
ALTER SEQUENCE learnings_id_learning_seq RESTART WITH 1;
ALTER SEQUENCE filters_id_filter_seq RESTART WITH 1;
ALTER SEQUENCE mediatype_id_media_type_seq RESTART WITH 1;
ALTER SEQUENCE media_id_media_seq RESTART WITH 1;
ALTER SEQUENCE chats_id_chat_seq RESTART WITH 1;
ALTER SEQUENCE userfilters_id_userfilter_seq RESTART WITH 1;
ALTER SEQUENCE searchcollaborationfilters_id_searchcollaborationfilters_seq RESTART WITH 1;
ALTER SEQUENCE usercollaborations_id_usercollaborations_seq RESTART WITH 1;
ALTER SEQUENCE userlearnings_id_userlearning_seq RESTART WITH 1;
ALTER SEQUENCE learningfilters_id_learningfilters_seq RESTART WITH 1;
ALTER SEQUENCE collaborationsfilters_id_collaborationsfilters_seq RESTART WITH 1;
ALTER SEQUENCE userschats_id_userchat_seq RESTART WITH 1;


-- Insertion des données dans la table MediaType
INSERT INTO public.MediaType (label) VALUES
('Video'),
('Image'),
('Music');

-- Insertion des données dans la table Users
INSERT INTO public.Users (firstname, pseudo, lastname, birth, mail, country, phone, password, picture) VALUES
('Alice', 'alice01', 'Dupont', '1990-01-01', 'alice@example.com', 'France', '0123456789', 'password123', '/assets/media/user/picture/alice01.jpg'),
('Bob', 'bobster', 'Martin', '1985-02-14', 'bob@example.com', 'France', '0987654321', 'password123', '/assets/media/user/picture/bobster.jpg'),
('Charlie', 'charlie2020', 'Durand', '1992-03-03', 'charlie@example.com', 'France', '0123987456', 'password123', '/assets/media/user/picture/charlie2020.jpg'),
('David', 'dave', 'Lefevre', '1988-04-22', 'david@example.com', 'France', '0543219876', 'password123', '/assets/media/user/picture/dave.jpg'),
('Eve', 'eve123', 'Petit', '1995-05-30', 'eve@example.com', 'France', '0678901234', 'password123', '/assets/media/user/picture/eve123.jpg'),
('Frank', 'frankie', 'Moreau', '1987-06-18', 'frank@example.com', 'France', '0789012345', 'password123', '/assets/media/user/picture/frankie.jpg'),
('Grace', 'graceful', 'Roux', '1991-07-07', 'grace@example.com', 'France', '0890123456', 'password123', '/assets/media/user/picture/graceful.jpg'),
('Hank', 'hanky', 'Simon', '1986-08-19', 'hank@example.com', 'France', '0901234567', 'password123', '/assets/media/user/picture/hanky.jpg'),
('Ivy', 'ivyivy', 'Blanc', '1993-09-23', 'ivy@example.com', 'France', '0012345678', 'password123', '/assets/media/user/picture/ivyivy.jpg'),
('Jack', 'jacko', 'Faure', '1989-10-10', 'jack@example.com', 'France', '0912345678', 'password123', '/assets/media/user/picture/jacko.jpg');

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

-- Insertion des données dans la table Collaboration
INSERT INTO public.Collaborations (title, thumbnail, published_at) VALUES
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

-- Insertion des données dans la table UsersCollaborations
INSERT INTO public.UserCollaborations (id_user, id_collaborations) VALUES
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
INSERT INTO public.UserLearnings (id_user, id_learning) VALUES
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

INSERT INTO public.searchcollaborations (title, thumbnail, published_at) VALUES
('SearchA', '/assets/media/collaboration/thumbnail/SearchA.jpg', '2023-01-15'),
('SearchB', '/assets/media/collaboration/thumbnail/SearchB.jpg', '2023-02-20'),
('SearchC', '/assets/media/collaboration/thumbnail/SearchC.jpg', '2023-03-25'),
('SearchD', '/assets/media/collaboration/thumbnail/ProjectD.jpg', '2023-04-30'),
('SearchE', '/assets/media/collaboration/thumbnail/SearchD.jpg', '2023-05-10'),
('SearchF', '/assets/media/collaboration/thumbnail/SearchF.jpg', '2023-06-15'),
('SearchH', '/assets/media/collaboration/thumbnail/SearchH.jpg', '2023-07-20'),
('SearchI', '/assets/media/collaboration/thumbnail/SearchI.jpg', '2023-08-25'),
('SearchJ', '/assets/media/collaboration/thumbnail/SearchJ.jpg', '2023-09-30'),
('SearchH', '/assets/media/collaboration/thumbnail/SearchH.jpg', '2023-10-10');

INSERT INTO public.userssearchcollaborations (id_user, id_searchcollaborations) VALUES
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
