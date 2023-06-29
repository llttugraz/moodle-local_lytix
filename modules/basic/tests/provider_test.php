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

use lytix_basic\privacy\provider;

/**
 * Test local courselist privacy provider.
 *
 * @coversDefaultClass  \lytix_basic\privacy\provider
 */
class provider_test extends \advanced_testcase {

    /**
     * This plugin does not store any data by itself, so only a null provider is needed.
     *
     * @return void
     * @covers ::get_reason
     */
    public function test_get_reason() {
        $this->resetAfterTest();

        $this->assertTrue(is_subclass_of(provider::class, '\core_privacy\local\metadata\null_provider'));
        $this->assertEquals('privacy:metadata', provider::get_reason(),
            'The correct string will be loaded from Moodle in privacy context.');
    }
}
