-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Owner
INSERT INTO Owner (username, password) VALUES ('Arnold', 'Arnold123');
INSERT INTO Owner (username, password) VALUES ('Homer', 'Homer123');

INSERT INTO Priority (priorityname) VALUES ('do it now!');
INSERT INTO Priority (priorityname) VALUES ('do it later!');
-- Task
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'get to the choppa', 'do it now');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'Hasta la vista', 'baby');
INSERT INTO Task (owner_id, taskname, description) VALUES (2, 'mmmmmm Donuts', 'eating this donut can wait');
INSERT INTO Task (owner_id, taskname, description) VALUES (2, 'mmmmm Bagels', 'mmmm Bagels');

-- Tag
INSERT INTO Tag (tagname) VALUES ('gettin to the choppa');
INSERT INTO Tag (tagname) VALUES ('eating');
-- TaskTag
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 1);
INSERT INTO TaskTag (tag_id, task_id) VALUES (2, 2);
-- Priority
-- taskPriority
-- INSERT INTO TaskPriority (priority_id, task_id) VALUES (Priority.first.id, Task.first.id);
--INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());