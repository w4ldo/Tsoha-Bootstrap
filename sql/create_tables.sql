-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Owner (
  id SERIAL PRIMARY KEY, -- <-- huom! serial
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Priority (
  id SERIAL PRIMARY KEY,
  priorityname varchar(50) NOT NULL
);

CREATE TABLE Task (
  id SERIAL PRIMARY KEY,
  owner_id INTEGER,
  priority_id INTEGER,
  taskname varchar(50) NOT NULL,
  description varchar(400)
);
ALTER TABLE Task
ADD FOREIGN KEY (owner_id)
REFERENCES Owner(id)
ON DELETE CASCADE;
ALTER TABLE Task
ADD FOREIGN KEY (priority_id)
REFERENCES Priority(id)
ON DELETE CASCADE;

CREATE TABLE Tag (
  id SERIAL PRIMARY KEY,
  tagname varchar(50) NOT NULL
);

CREATE TABLE TaskTag (
  tag_id INTEGER NOT NULL,
  task_id INTEGER NOT NULL
);
ALTER TABLE TaskTag
ADD FOREIGN KEY (tag_id)
REFERENCES Tag(id)
ON DELETE CASCADE;

ALTER TABLE TaskTag
ADD FOREIGN KEY (task_id)
REFERENCES Task(id)
ON DELETE CASCADE;
