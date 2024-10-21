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

use local_lytix\helper\plugin_check;

/**
 * Testclass for plugin_check
 * @coversDefaultClass \local_lytix\helper\plugin_check
 */
final class plugin_check_test extends \advanced_testcase {

    /**
     * Test setup.
     */
    public function setUp(): void {
        parent::setUp();
        $this->resetAfterTest();
    }

    /**
     * Tests list of installed plugins.
     *
     * @covers ::get_installed_plugins
     * @return void
     * @throws \coding_exception
     */
    public function test_get_installed_plugins(): void {
        $list = plugin_check::get_installed_plugins();
        self::assertIsArray($list, "No array provided");
        self::assertArrayHasKey('basic', $list, "Basic module should always be installed");
    }

    /**
     * Tests list of installed plugins.
     *
     * @covers ::is_installed
     * @return void
     * @throws \coding_exception
     */
    public function test_is_installed(): void {
        $active = plugin_check::is_installed('basic');
        self::assertTrue((boolean) $active, "This moudule should always exist!");

        $active = plugin_check::is_installed('Dirty');
        self::assertFalse((boolean) $active, "This moudule cannot exist!");
    }
}
