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
 * observer class
 *
 * You can have a rather longer description of the file as well,
 * if you like, and it can span multiple lines.
 *
 * @package     local_lytix
 * @author      Natalie Kukovetz
 * @copyright   2022 Educational Technologies, Graz, University of Technology
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lytix;

use tool_configurator\configuration\config;

/**
 * observer class
 */
class observer {

    /**
     * When a new course is created, this function adds the id to
     * the courselist setting for creators_dashboard
     *
     * @param mixed $event
     * @return void
     * @throws \dml_exception
     */
    public static function add_course($event) {

        if (get_config('local_lytix', 'add_courses_automatically') == 1) {
            if (get_config('local_lytix', 'platform') == 'creators_dashboard') {
                $courselist = get_config('local_lytix', 'course_list');

                if (empty($courselist)) {
                    $courselist = $event->courseid;
                } else {
                    $courselist .= ',' . $event->courseid;
                }

                set_config('course_list', $courselist, 'local_lytix');
            }
        }
    }
}
