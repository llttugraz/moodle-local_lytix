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

/**
 * Testclass for the observer
 * @coversDefaultClass \local_lytix\observer
 */
class observer_test extends \advanced_testcase {

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
    public function test_create_course_observer() {
        // Generate a course without option enabled.
        $this->getDataGenerator()->create_course();
        $courselist = get_config('local_lytix', 'course_list');
        self::assertFalse((boolean) $courselist, "Should be false.");

        // Generate a course with option enabled.
        set_config('add_courses_automatically', 1, 'local_lytix');
        $this->getDataGenerator()->create_course();
        $courselist = get_config('local_lytix', 'course_list');
        self::assertTrue((boolean) $courselist, "Should be true.");
    }
}
