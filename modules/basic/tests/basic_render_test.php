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
 * Privacy Provider Test
 *
 * @package    lytix_basic
 * @author     Günther Moser <moser@tugraz.at>
 * @copyright  2023 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace lytix_basic;

/**
 * Test local courselist privacy provider.
 *
 * @coversDefaultClass  \lytix_basic\basic_render
 */
class basic_render_test extends \advanced_testcase {
    /**
     * Sets up course for tests.
     */
    public function setUp(): void {
        $this->resetAfterTest();
        $this->setAdminUser();
    }

    /**
     * Test render for lytix_basic.
     * @covers ::render
     * @return void
     * @throws \coding_exception
     */
    public function test_render_learners_corner_student_view() {
        $this->resetAfterTest();

        $out = '<div class="alert alert-warning">' . get_string('no_plugins', 'lytix_basic') . '</div>';

        $render = new basic_render();
        $render->render();
        $this->expectOutputString($out);
    }
}
