<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * This is a one-line short description of the file.
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package    local_lytix
 * @author     Günther Moser <moser@tugraz.at>
 * @copyright  2023 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use local_lytix\helper\plugin_check;

require_once(__DIR__ . '/../../config.php');

global $CFG, $PAGE, $OUTPUT, $USER, $DB;

require_once($CFG->libdir . '/pagelib.php');
defined('MOODLE_INTERNAL') || die();

$courseid = required_param('id', PARAM_INT);
$course   = get_course($courseid);
require_login($course);
$context = context_course::instance($courseid);

// Simple test to figure out, if learners corner is active in course.
if (!in_array($course->id, explode(',', get_config('local_lytix', 'course_list')))) {
    $urltogo = new moodle_url('/course/view.php', ['id' => $PAGE->course->id]);
    redirect($urltogo, 'There is no Learners Corner in this course');
}

// ToDo: Check again if dependencies can be removed as soon as the planner and/or activities have been updated.
if (get_config('local_lytix', 'platform') === 'learners_corner') {
    $PAGE->requires->js('/local/lytix/js/moment.js', true);
    $PAGE->requires->js('/local/lytix/js/d3.js', true);
    $PAGE->requires->js('/local/lytix/js/d3-scale-chromatic.js', true);
} else if (get_config('local_lytix', 'platform') == 'creators_dashboard') {
    if (!\lytix_config\render_view::is_creator($context, $USER->id)) {
        $urltogo = new moodle_url('/course/view.php', ['id' => $PAGE->course->id]);
        redirect($urltogo, 'You do not have the necessary permissions to visit this website.
         Please contact the course teacher or administrator.');
    }
}

$platform = get_config('local_lytix', 'platform');
$PAGE->set_url(new moodle_url('/local/lytix/index.php', ['id' => $course->id]));
$PAGE->set_context(context_course::instance($course->id));
$PAGE->set_heading($course->fullname);
$PAGE->set_pagelayout('incourse');
$sitetext = get_string(get_config('local_lytix', 'platform'), 'local_lytix');
$PAGE->set_title($sitetext . " - " . $course->fullname);

// Display page header.
echo $OUTPUT->header();

if (count(plugin_check::get_installed_plugins()) <= 1) {
    \lytix_basic\basic_render::render();
}

if (plugin_check::is_installed('logs')) {
    \lytix_logs\logger::add($USER->id, $courseid, $context->id,
        \lytix_logs\logger::TYPE_LOAD, \lytix_logs\logger::TYPE_PAGE, $courseid);
}

if (plugin_check::is_installed('config')) {
    $render = new \lytix_config\render_view();
    $render->render($course, $USER);
}

// Display page footer.
echo $OUTPUT->footer();
