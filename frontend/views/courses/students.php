<h1>Students Enrolled in <?= $course->course_name ?></h1>

<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Student ID</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($enrolledStudents as $index => $student): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= isset($studentNames[$index]) ? $studentNames[$index] : 'N/A' ?></td>
                <td><?= $student->student->memberID ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
