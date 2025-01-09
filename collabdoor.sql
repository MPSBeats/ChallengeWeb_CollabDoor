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
