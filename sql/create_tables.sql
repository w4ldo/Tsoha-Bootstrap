-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Owner (
  id SERIAL PRIMARY KEY, -- <-- huom! serial
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Task (
  id SERIAL PRIMARY KEY,
  owner_id INTEGER REFERENCES Owner(id) NOT NULL,
  taskname varchar(50) NOT NULL,
--  played boolean DEFAULT FALSE,
  description varchar(400)
);

CREATE TABLE Tag (
  id SERIAL PRIMARY KEY,
  tagname varchar(50) NOT NULL
);

CREATE TABLE TaskTag (
  tag_id INTEGER REFERENCES Tag(id) NOT NULL,
  task_id INTEGER REFERENCES Task(id) NOT NULL
);

CREATE TABLE Priority (
  id SERIAL PRIMARY KEY,
  priorityname varchar(50) NOT NULL
);

CREATE TABLE TaskPriority (
  priority_id INTEGER REFERENCES Priority(id) NOT NULL,
  task_id INTEGER REFERENCES Task(id) NOT NULL
);