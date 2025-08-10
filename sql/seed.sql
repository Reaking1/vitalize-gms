USE vitalize_gms;

-- Insert Coaches
INSERT INTO coaches (name, contact) VALUES
('Sarah Thompson', 'sarah@example.com'),
('James Carter', 'james@example.com');

-- Insert Programs
INSERT INTO programs (program_name, description, coach_id, duration_weeks, skill_level) VALUES
('Beginner Tumbling', 'Introduction to basic tumbling moves for beginners.', 1, 6, 'Beginner'),
('Advanced Floor Routine', 'Complex floor routines for advanced gymnasts.', 2, 12, 'Advanced');

-- Insert Gymnasts
INSERT INTO gymnasts (name, age, experience_level) VALUES
('Emily Johnson', 12, 'Beginner'),
('Lucas Brown', 15, 'Advanced');

-- Insert Enrolments
INSERT INTO enrolments (gymnast_id, program_id) VALUES
(1, 1),
(2, 2);

-- Insert Attendance
INSERT INTO attendance (enrolment_id, session_date, status) VALUES
(1, '2025-08-01', 'Present'),
(1, '2025-08-02', 'Absent'),
(2, '2025-08-01', 'Present');

-- Insert Progress
INSERT INTO progress (enrolment_id, notes, score, progress_percentage) VALUES
(1, 'Good improvement in balance.', 80.5, 60),
(2, 'Excellent routine execution.', 92.0, 85);
