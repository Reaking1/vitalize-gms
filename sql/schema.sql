-- Create Database
CREATE DATABASE IF NOT EXISTS vitalize_gms
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_general_ci;

USE vitalize_gms;

-- Coaches Table
CREATE TABLE coaches (
    coach_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    contact VARCHAR(100)
);

-- Programs Table
CREATE TABLE programs (
    program_id INT AUTO_INCREMENT PRIMARY KEY,
    program_name VARCHAR(100) NOT NULL,
    description TEXT,
    coach_id INT,
    duration_weeks INT,
    skill_level ENUM('Beginner','Intermediate','Advanced'),
    FOREIGN KEY (coach_id) REFERENCES coaches(coach_id) ON DELETE SET NULL
);

-- Gymnasts Table
CREATE TABLE gymnasts (
    gymnast_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    age INT,
    experience_level ENUM('Beginner','Intermediate','Advanced')
);

-- Enrolments Table
CREATE TABLE enrolments (
    enrolment_id INT AUTO_INCREMENT PRIMARY KEY,
    gymnast_id INT,
    program_id INT,
    enrolment_date DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (gymnast_id) REFERENCES gymnasts(gymnast_id) ON DELETE CASCADE,
    FOREIGN KEY (program_id) REFERENCES programs(program_id) ON DELETE CASCADE
);

-- Attendance Table
CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    enrolment_id INT,
    session_date DATE,
    status ENUM('Present','Absent') DEFAULT 'Present',
    FOREIGN KEY (enrolment_id) REFERENCES enrolments(enrolment_id) ON DELETE CASCADE
);

-- Progress Table
CREATE TABLE progress (
    progress_id INT AUTO_INCREMENT PRIMARY KEY,
    enrolment_id INT,
    notes TEXT,
    score DECIMAL(5,2),
    progress_percentage INT CHECK (progress_percentage BETWEEN 0 AND 100),
    FOREIGN KEY (enrolment_id) REFERENCES enrolments(enrolment_id) ON DELETE CASCADE
);
