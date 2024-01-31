<!DOCTYPE html>
<html>
<head>
    <title>Select Courses</title>
</head>
<body>
    <form action="insert_courses.php" method="post">
        <label for="student_name">Student Name:</label>
        <input type="text" name="student_name" required><br><br>

        <label>Select Courses:</label><br>
        <input type="radio" name="course_exam_data[Course1]" value="regular"> Course 1 (Regular)
        <input type="radio" name="course_exam_data[Course1]" value="recourse"> Course 1 (Recourse)
        <input type="radio" name="course_exam_data[Course1]" value="retake"> Course 1 (Retake)<br>

        <input type="radio" name="course_exam_data[Course2]" value="regular"> Course 2 (Regular)
        <input type="radio" name="course_exam_data[Course2]" value="recourse"> Course 2 (Recourse)
        <input type="radio" name="course_exam_data[Course2]" value="retake"> Course 2 (Retake)<br>

        <!-- Add more courses as needed -->

        <input type="submit" name="submit" value="Submit">
    </form>
</body>
</html>
$course_exam_data = $_POST['course_exam_data'];

    foreach ($course_exam_data as $course => $exam_type) {
        $sql = "INSERT INTO student_courses (student_name, course_name, exam_type) VALUES ('$student_name', '$course', '$exam_type')";

