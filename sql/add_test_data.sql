-- Lisää INSERT INTO lauseet tähän tiedostoon
-- Owner
INSERT INTO Owner (username, password) VALUES ('Arnold', 'Arnold123');

INSERT INTO Priority (priorityname) VALUES ('do it now!');
INSERT INTO Priority (priorityname) VALUES ('do it later!');
INSERT INTO Priority (priorityname) VALUES ('not important');
-- Task
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'go shopping', 'buy eggs');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'clean livingroom', 'clean it good!');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'take out the trash', 'every bag');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'do laundry', 'mmm laundry');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 1, 'study for exams', 'chemistry');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 3, 'finish project', 'almost done');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 2, 'buy more stamps', 'never enough stamps');
INSERT INTO Task (owner_id, priority_id, taskname, description) VALUES (1, 3, 'create more tasks', '...');


-- Tag
INSERT INTO Tag (tagname) VALUES ('household');
INSERT INTO Tag (tagname) VALUES ('shopping');
INSERT INTO Tag (tagname) VALUES ('cleaning');
INSERT INTO Tag (tagname) VALUES ('studying');
-- TaskTag
INSERT INTO TaskTag (tag_id, task_id) VALUES (2, 1);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 1);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 2);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 2);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 3);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 3);
INSERT INTO TaskTag (tag_id, task_id) VALUES (3, 4);
INSERT INTO TaskTag (tag_id, task_id) VALUES (1, 4);
INSERT INTO TaskTag (tag_id, task_id) VALUES (4, 5);
INSERT INTO TaskTag (tag_id, task_id) VALUES (4, 6);
INSERT INTO TaskTag (tag_id, task_id) VALUES (2, 7);
INSERT INTO TaskTag (tag_id, task_id) VALUES (4, 8);
-- Priority
-- taskPriority
-- INSERT INTO TaskPriority (priority_id, task_id) VALUES (Priority.first.id, Task.first.id);
--INSERT INTO Game (name, description, published, publisher, added) VALUES ('The Elder Scrolls V: Skyrim', 'Arrow to the knee', '2011-11-11', 'Bethesda Softworks', NOW());
