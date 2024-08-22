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
 * Unit tests for the event observers used by the weeks course format.
 *
 * @package    local_lytix
 * @author     Günther Moser <moser@tugraz.at>
 * @copyright  2023 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lytix;

use backup;

defined('MOODLE_INTERNAL') || die();
global $CFG;

require_once($CFG->dirroot . '/backup/util/includes/backup_includes.php');

/**
 * Testclass for the observer
 * @coversDefaultClass \local_lytix\observer
 */
final class observer_test extends \advanced_testcase {

    /**
     * Test setup.
     */
    public function setUp(): void {
        $this->resetAfterTest();
        set_config('platform', 'creators_dashboard', 'local_lytix');
    }

    /**
     * Tests the course created observer.
     *
     * @covers ::add_course
     * @return void
     * @throws \dml_exception
     */
    public function test_course_created_observer(): void {
        // Generate a course without option enabled.
        $this->getDataGenerator()->create_course();
        $courselist = get_config('local_lytix', 'course_list');
        $this->assertFalse((boolean) $courselist, "Should be false.");

        // Generate a course with option enabled.
        set_config('add_courses_automatically', 1, 'local_lytix');
        $course = $this->getDataGenerator()->create_course();
        $courselist = get_config('local_lytix', 'course_list');
        $this->assertEquals($course->id, $courselist); // New course added.
    }

    /**
     * Tests the course restored observer.
     *
     * @covers ::add_course
     * @return void
     * @throws \dml_exception
     */
    public function test_course_restored_observer(): void {
        $course1 = $this->getDataGenerator()->create_course();

        set_config('add_courses_automatically', 1, 'local_lytix');

        $course2 = $this->getDataGenerator()->create_course();
        $courselist = get_config('local_lytix', 'course_list');
        $this->assertEquals($course2->id, $courselist); // New course added.

        $otherarray = [
            'type' => backup::TYPE_1COURSE,
            'target' => backup::TARGET_NEW_COURSE,
            'mode' => backup::MODE_GENERAL,
            'operation' => backup::OPERATION_RESTORE,
            'samesite' => true,
        ];

        $event = \core\event\course_restored::create([
            'objectid' => $course1->id,
            'userid' => get_admin()->id,
            'context' => \context_course::instance($course1->id),
            'other' => $otherarray,
        ]);
        $event->trigger();

        $courselist = get_config('local_lytix', 'course_list');
        $this->assertEquals($course2->id . ',' . $course1->id, $courselist); // Restored course added.

        $event = \core\event\course_restored::create([
            'objectid' => $course2->id,
            'userid' => get_admin()->id,
            'context' => \context_course::instance($course2->id),
            'other' => $otherarray,
        ]);
        $event->trigger();

        $courselist = get_config('local_lytix', 'course_list');
        $this->assertEquals($course2->id . ',' . $course1->id, $courselist); // Restored course already present.

    }
}
