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
 * @package     local_lytix
 * @author      Natalie Kukovetz
 * @copyright   2022 Educational Technologies, Graz, University of Technology
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lytix\forms;

defined('MOODLE_INTERNAL') || die();

require_once("$CFG->libdir/formslib.php");

/**
 * Moodle Form
 */
class courselist_form extends \moodleform {

    /**
     * Add elements to form.
     *
     * @return void
     * @throws \coding_exception
     */
    public function definition() {
        $mform = $this->_form;

        $mform->addElement('hidden', 'setting', null);
        $mform->setType('setting', PARAM_TEXT);

        $searchareas = get_courses('all');
        $areanames   = [];
        foreach ($searchareas as $areaid => $searcharea) {
            if ($areaid == 1) {
                continue;
            }
            $areanames[$areaid] = $areaid . ':' . $searcharea->fullname . '(' . $searcharea->shortname . ')';
        }
        $options = [
                'multiple'          => true,
                'noselectionstring' => get_string('allareas', 'local_lytix'),
        ];
        $mform->addElement('autocomplete', 'areasids', get_string('searcharea', 'local_lytix'), $areanames, $options);
        $mform->disable_form_change_checker();
    }
}

