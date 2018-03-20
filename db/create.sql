CREATE TABLE branches(
    id serial PRIMARY KEY,
    name text NOT NULL,
    address text NOT NULL,
    opening date NOT NULL
);

CREATE TABLE trainers(
    id serial PRIMARY KEY,
    name text NOT NULL,
    last_name text NOT NULL,
    hired_at date NOT NULL,

    branch_id int REFERENCES branches(id) ON DELETE CASCADE
);

CREATE TABLE classes(
    id serial PRIMARY KEY,
    name text NOT NULL,
    capacity int NOT NULL,
    
    trainer_id int REFERENCES trainers(id) ON DELETE CASCADE
);

CREATE TABLE schedules(
    id serial PRIMARY KEY,
    start_time timestamp NOT NULL,
    end_time timestamp NOT NULL,

    class_id int REFERENCES classes(id) ON DELETE CASCADE
);

CREATE TYPE membership_type AS ENUM ('standard', 'premium');

CREATE TABLE members(
    id serial PRIMARY KEY,
    membership membership_type NOT NULL,
    name text NOT NULL,
    last_name text NOT NULL,
    birthdate date NOT NULL,
    created_at timestamp,
    last_payment date,
    
    branch_id int REFERENCES branches(id) ON DELETE CASCADE,
    recommended_by int REFERENCES members(id) ON DELETE CASCADE NULL
);

CREATE TYPE card_type AS ENUM ('debit', 'credit');

CREATE TABLE cards(
    id serial PRIMARY KEY,
    card_t card_type NOT NULL,
    number text NOT NULL,
    due_date date NOT NULL,
    security_number text NOT NULL,
    
    member_id int REFERENCES members(id) ON DELETE CASCADE
);


CREATE TABLE member_schedule(
    absences int NOT NULL DEFAULT (0),

    member_id int NOT NULL REFERENCES members(id) ON DELETE CASCADE,
    schedule_id int NOT NULL REFERENCES schedules(id) ON DELETE CASCADE,
    PRIMARY KEY (member_id, schedule_id)
);