INSERT INTO branches (name, address, opening) VALUES ('Bugamblias', 'Av. 16 de septiembre no. 3507', CURRENT_TIMESTAMP - INTERVAL '1 month');
INSERT INTO branches (name, address, opening) VALUES ('San francisco', 'Av. 5 de mayo no 305', CURRENT_TIMESTAMP - INTERVAL '2 month');

INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('Alberto', 'Oliart', 1, CURRENT_TIMESTAMP - INTERVAL '3 weeks');
INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('Rosa', 'Paredes', 1, CURRENT_TIMESTAMP - INTERVAL '3 weeks');
INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('David', 'Sol', 1, CURRENT_TIMESTAMP - INTERVAL '3 weeks');

INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('Claudia', 'Lezama', 1, CURRENT_TIMESTAMP - INTERVAL '7 weeks');
INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('Juan', 'Calleros', 1, CURRENT_TIMESTAMP - INTERVAL '7 weeks');
INSERT INTO trainers (name, last_name, branch_id, hired_at) VALUES('Alberto', 'Palomares', 1, CURRENT_TIMESTAMP - INTERVAL '7 weeks');

INSERT INTO Classes (name, capacity, trainer_id) VALUES('Box', 10, 1);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Kick-boxing', 10, 1);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Spining', 10, 2);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Pilates', 10, 2);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Cross fit', 10, 3);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Insanity', 10, 3);

INSERT INTO Classes (name, capacity, trainer_id) VALUES('Box', 10, 4);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Kick-boxing', 10, 4);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Spining', 10, 5);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Pilates', 10, 5);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Cross fit', 10, 6);
INSERT INTO Classes (name, capacity, trainer_id) VALUES('Insanity', 10, 6);

INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 1);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 1);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 2);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 3);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 3);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 4);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 4);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 5);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 6);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 6);

INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 7);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 8);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 8);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 8);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 9);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 10);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 10);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 11);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR', CURRENT_TIMESTAMP + INTERVAL '1 hour', 11);
INSERT INTO schedules (start_time, end_time, class_id) VALUES(CURRENT_TIMESTAMP + INTERVAL '2 HOUR' + INTERVAL '1 DAY', CURRENT_TIMESTAMP + INTERVAL '1 hour' + INTERVAL '1 DAY', 12);

INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Carlos', 'Amador', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Mónica', 'Perez', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Pirri', 'Ramirez', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Angel', 'Ruiz', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Rafael', 'Comonfort', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Fernando', 'Castillo', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 1);

INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Estefania', 'Pitol', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Jorge', 'Beauregard', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('J', 'P', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Andrés', 'Reynoso', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Aranzza', 'Abascal', 'standard', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);
INSERT INTO members (name, last_name, membership, birthdate, last_payment, created_at, recommended_by, branch_id)
VALUES('Francisco', 'Huerta', 'premium', '1996-10-23', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP - INTERVAL '2 WEEK', NULL, 2);

INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789101', '2019-10-31', '123', 'credit', 1);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789102', '2019-10-31', '124', 'debit', 2);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789103', '2019-10-31', '125', 'credit', 3);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789104', '2019-10-31', '126', 'debit', 4);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789105', '2019-10-31', '127', 'credit', 5);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789106', '2019-10-31', '128', 'debit', 6);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789107', '2019-10-31', '129', 'credit', 7);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789108', '2019-10-31', '120', 'debit', 8);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789109', '2019-10-31', '320', 'credit', 9);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789110', '2019-10-31', '321', 'debit', 10);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789111', '2019-10-31', '322', 'credit', 11);
INSERT INTO cards(number, due_date, security_number, card_t, member_id) VALUES('123456789112', '2019-10-31', '323', 'debit', 12);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 1);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 1);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 1);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 2);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 2);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 2);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 3);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 3);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 3);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 4);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 4);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 4);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 5);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 5);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 5);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 6);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 6);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 6);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 7);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 7);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 7);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 8);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 8);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 8);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 9);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 9);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 9);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 10);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 10);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 10);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(4, 11);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(5, 11);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(6, 11);

INSERT INTO member_schedule (member_id, schedule_id) VALUES(1, 12);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(2, 12);
INSERT INTO member_schedule (member_id, schedule_id) VALUES(3, 12);