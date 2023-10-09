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
 * @author     Philipp Leitner
 * @copyright  2020 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Extended navigation.
 * @param \navigation_node $navigation
 * @param \stdClass $course
 * @param \context $context
 * @return void
 * @throws coding_exception
 * @throws dml_exception
 * @throws moodle_exception
 */
function local_lytix_extend_navigation_course($navigation, $course, $context) {
    global $USER;

    if (isset($course->id) && $course->id > 1 &&
        in_array($course->id, explode(',', get_config('local_lytix', 'course_list')))) {
        $show = false;
        if (((get_config('local_lytix', 'platform') == 'course_dashboard') ||
                (get_config('local_lytix', 'platform') == 'learners_corner')) &&
            \local_lytix\helper\plugin_check::is_installed('planner')) {
            $show = true;
        } else {
            $iscreator = \lytix_config\render_view::is_creator($context, $USER->id);
            if ((get_config('local_lytix', 'platform') == 'creators_dashboard') && $iscreator) {
                $show = true;
            }
        }
        if ($show) {
            $navigation->add(
                get_string(get_config('local_lytix', 'platform'), 'local_lytix'),
                new moodle_url('/local/lytix/index.php?id=', ['id' => $course->id]),
                navigation_node::TYPE_SETTING,
                null,
                null,
                new pix_icon('i/valid', '')
            );
        }
    }
}

/**
 * Fragment output.
 *
 * @param array $args
 * @return string
 * @throws dml_exception
 */
function local_lytix_output_fragment_courselistform(array $args): string {
    $settingname = '';
    switch ($args['setting']) {
        case 'courselist':
            $settingname = 'course_list';
            break;
        case 'grademonitor' :
            $settingname = 'grade_monitor_list';
            break;
        default:
            break;
    }

    $courses = explode(',', get_config('local_lytix', $settingname));
    $data    = array(
            'areasids' => $courses,
            'setting'  => $args['setting']
    );
    $form    = new \local_lytix\forms\courselist_form();
    $form->set_data($data);
    return $form->render();
}

/**
 * Save Data from form fragment.
 *
 * @param array $args
 * @return string
 */
function local_lytix_output_fragment_courselistformsave(array $args): string {
    parse_str($args['params'], $result);
    $settingname = '';
    switch ($result['setting']) {
        case 'courselist':
            $settingname = 'course_list';
            break;
        case 'grademonitor' :
            $settingname = 'grade_monitor_list';
            break;
        default:
            break;
    }
    $string = ($result['areasids'] == '_qf__force_multiselect_submission') ? '' : implode(',', $result['areasids']);
    set_config($settingname, $string, 'local_lytix');
    return '';
}
