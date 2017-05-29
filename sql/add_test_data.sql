-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Owner
INSERT INTO Owner (username, password) VALUES ('Arnold', 'Arnold123');
-- Task
-- INSERT INTO Task (owner_id, taskname, description) VALUES (Owner.first.id, 'get to the choppa', 'do it now');
-- Tag
INSERT INTO Tag (tagname) VALUES ('gettin to the choppa');
-- TaskTag
-- INSERT INTO TaskTag (tag_id, task_id) VALUES (Tag.first.id, Task.first.id);
-- Priority
INSERT INTO Priority (priorityname) VALUES ('do it now!');
-- taskPriority
-- INSERT INTO TaskPriority (priority_id, task_id) VALUES (Priority.first.id, Task.first.id);
--INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());