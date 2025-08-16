# Gymnastics Attendance & Progress Module

This module allows coaches to **mark attendance**, **enter progress notes or scorecards**, and **update progress percentages** for gymnasts enrolled in programs. It is part of the larger Gymnastics Management System, but this README focuses only on the files relevant to attendance and progress tracking.

---

## Files in this Module

### 1. `controllers/AttendanceController.php`
- Handles marking gymnast attendance in the database.
- Functions:
  - `markAttendance($enrolment_id, $status, $date)`: Inserts a new attendance record with the selected status and date.
  - `getAttendance($program_id)`: Retrieves all attendance records for a program.

### 2. `controllers/ProgressController.php`
- Handles storing and retrieving gymnast progress notes and completion percentages.
- Functions:
  - `updateProgress($gymnast_id, $program_id, $progress_percent, $notes)`: Inserts or updates progress records for a gymnast in a program.
  - `getProgress($gymnast_id, $program_id)`: Retrieves progress records for a gymnast in a program.

### 3. `views/attendance/mark.php`
- Web form for coaches to mark attendance and enter progress.
- Features:
  - Dropdown to select gymnast and program (fetched from `enrolments` table).
  - Attendance status selection (`Present`, `Absent`, `Late`).
  - Input for progress percentage (0–100%).
  - Text area for progress notes or scorecards.
  - Date picker for the session date.
- Handles form submission by:
  - Updating attendance via `AttendanceController`.
  - Updating progress via `ProgressController`.

### 4. `views/progress/view.php`
- Displays gymnast progress per program.
- Shows:
  - Program name
  - Gymnast name
  - Progress notes
  - Completion percentage with a progress bar
  - Last updated date

---

## Database Tables Required

1. `enrolments`
   - Columns: `enrolment_id`, `gymnast_id`, `program_id`
2. `attendance`
   - Columns: `attendance_id`, `enrolment_id`, `status`, `attendance_date`
3. `progress`
   - Columns: `progress_id`, `gymnast_id`, `program_id`, `progress_percent`, `notes`, `last_updated`

> Note: Other database tables like `gymnasts`, `programs`, and `coaches` should exist, but this module primarily interacts with the above tables.

---

## How to Run

1. Ensure **PHP** and **MySQL** are installed and configured.
2. Place the files inside your project directory:
3. Configure the database connection in `db.php`.
4. Open `mark.php` in a browser (e.g., `http://localhost/vitalize-gms/views/attendance/mark.php`) to mark attendance and enter progress.
5. Open `view.php` in a browser (e.g., `http://localhost/vitalize-gms/views/progress/view.php`) to view gymnast progress and completion bars.

---

## Notes

- Attendance and progress are linked through the `enrolments` table.
- Progress notes and percentage are optional but recommended to maintain accurate records.
- The module does not handle user authentication—assumes access to coaches only.
- Other files in the system are ignored; this README focuses only on attendance and progress features.

---

**Author:** Your Name  
**Date:** 2025
