<?php
require_once('../../config.php');
require_login();
require_capability('moodle/site:config', context_system::instance());

$context = context_system::instance();
$PAGE->set_context($context);
$PAGE->set_url('/report/user_report/index.php');
$PAGE->set_title(get_string('report_user_report', 'report_user_report'));
$PAGE->set_heading(get_string('report_user_report', 'report_user_report'));

echo $OUTPUT->header();

echo '<table class="generaltable">';
echo '<tr><th>' . get_string('user', 'report_user_report') . '</th><th>' . get_string('course', 'report_user_report') . '</th></tr>';

$random_users = $DB->get_records_sql("SELECT * FROM {user} ORDER BY RAND() LIMIT 10");

foreach ($random_users as $user) {
    echo '<tr><td>' . fullname($user) . '</td><td>';
    $courses = enrol_get_users_courses($user->id);
    foreach ($courses as $course) {
        echo format_string($course->shortname) . '<br>';
    }
    echo '</td></tr>';
}

echo '</table>';

echo $OUTPUT->footer();
