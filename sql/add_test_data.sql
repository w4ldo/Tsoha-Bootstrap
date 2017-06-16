-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Owner
INSERT INTO Owner (username, password) VALUES ('Arnold', 'Arnold123');

INSERT INTO Priority (priorityname) VALUES ('do it now!');
INSERT INTO Priority (priorityname) VALUES ('do it later!');
-- Task
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'get to the choppa', 'do it now');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'Hasta la vista', 'baby');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'Tonights forecast:', 'a freeze is coming!');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'Come with me', 'if you want to live');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'Your clothes', 'give them to me now!');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'Ill be', 'back');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'What killed the dinosaurs?', 'The ice age!');


-- Tag
INSERT INTO Tag (tagname) VALUES ('arnold');
INSERT INTO Tag (tagname) VALUES ('predator');
INSERT INTO Tag (tagname) VALUES ('terminator');
INSERT INTO Tag (tagname) VALUES ('mr.freeze');
-- TaskTag
INSERT INTO TaskTag (tag_id, task_id) VALUES (2, 1);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 1);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 2);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 2);
INSERT INTO TaskTag (tag_id, task_id) VALUES (4, 3);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 3);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 4);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 4);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 5);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 5);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 6);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 6);
INSERT INTO TaskTag (tag_id, task_id) VALUES (4, 7);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 7);
-- Priority
-- taskPriority
-- INSERT INTO TaskPriority (priority_id, task_id) VALUES (Priority.first.id, Task.first.id);
--INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());