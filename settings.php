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
 * @category   backup
 * @author     Philipp Leitner
 * @copyright  2020 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die;
global $ADMIN, $PAGE;

if ($hassiteconfig) {
    $settings = new admin_settingpage('local_lytix', get_string('pluginname', 'local_lytix'));
    $ADMIN->add('localplugins', $settings);

    $names = [
            'learners_corner'    => get_string('learners_corner', 'local_lytix'),
            'creators_dashboard' => get_string('creators_dashboard', 'local_lytix'),
            'course_dashboard'   => get_string('course_dashboard', 'local_lytix'),
            // TODO add more platforms here.
    ];
    $settings->add(new admin_setting_configselect('local_lytix/platform',
                                                  get_string('pluginname', 'local_lytix'), '', 'learner_corner', $names));

    $settings->add(new admin_setting_configcheckbox('local_lytix/add_courses_automatically',
                                                    get_string('add_courses_automatically', 'local_lytix'),
                                                    get_string('add_courses_automatically_desc', 'local_lytix'), '0'));

    $settings->add(new admin_setting_configtext('local_lytix/semester_start',
                                                get_string('semester_start', 'local_lytix'),
                                                get_string('semester_start_description', 'local_lytix'), '2022-10-01'));

    $settings->add(new admin_setting_configtext('local_lytix/semester_end',
                                                get_string('semester_end', 'local_lytix'),
                                                get_string('semester_end_description', 'local_lytix'), '2023-02-28'));
    
    $settings->add(new admin_setting_configtext('local_lytix/last_aggregation_date',
                                                get_string('last_aggregation_date', 'local_lytix'),
                                                get_string('last_aggregation_date_description', 'local_lytix'), '2023-06-01'));

    $settings->add(new admin_setting_configtextarea('local_lytix/course_list',
        get_string('course_list', 'local_lytix'),
        get_string('course_list_description', 'local_lytix'), ''));

    $settings->add(new admin_setting_configtextarea('local_lytix/grade_monitor_list',
        get_string('grade_monitor_list', 'local_lytix'),
        get_string('grade_monitor_list_description', 'local_lytix'), ''));

    $PAGE->requires->js_call_amd('local_lytix/main', 'initListener');
    $button = "<a href='#' id='courselist' class='btn btn-primary'>Course List</a>";
    $settings->add(new admin_setting_heading('course_list', get_string('course_list_header', 'local_lytix'), $button));

    $button1 = "<a href='#' id='grademonitor' class='btn btn-primary'>Grade Monitor List</a>";
    $settings->add(new admin_setting_heading('grade_monitor', get_string('grade_monitor_header', 'local_lytix'), $button1));
}
