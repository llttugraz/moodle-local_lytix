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
 * Delete entries in lytix tables if a course or a user is deleted.
 *
 * @package    local_lytix
 * @author     Gerhard unger <gerhard.unger@tugraz.at>
 * @copyright  2024 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lytix\cleanup;

/**
 * Class cleanup
 */
class cleanup {
    /**
     * Delete all entries of a course / user in tables of the subplugins of local_lytix
     *
     *
     * @param string $entrytype
     * @param int $id
     */
    public static function delete_entries(string $entrytype, int $id) {
        global $DB;
        $arrofarrofsubplugins = \core_component::get_subplugins('local_lytix');
        $arrayofsubplugins = $arrofarrofsubplugins['lytix'];

        // The following tables have user and course entries.
        $tablesnames = ['activity' => ['lytix_activity_customization'],
                'basic' => ['lytix_basic'],
                'diary' => ['lytix_diary_diary_entries'],
                'helper' => ['lytix_helper_last_aggreg', 'lytix_helper_dly_mdl_acty'],
                'logs' => ['lytix_logs_logs', 'lytix_logs_aggregated_logs'],
                'planner' => ['lytix_planner_milestone', 'lytix_planner_event_comp'],
                'grademonitor' => ['lytix_grademonitor']];

        if ($entrytype == "course") {
            // If course is not in the course_list for lytix we have to do nothing.
            if (!in_array($id, explode(',', get_config('local_lytix', 'course_list')))) {
                return;
            } else {
                // Tables where only course entries (no user entries) are stored.
                $tablesnames['planner'][] = 'lytix_planner_events';
                $tablesnames['planner'][] = 'lytix_planner_crs_settings';
                $tablesnames['measure'] = ['lytix_measure_last_report'];
            }
        }

        foreach ($arrayofsubplugins as $subplugin) {
            if (array_key_exists($subplugin, $tablesnames)) {
                foreach ($tablesnames[$subplugin] as $table) {
                    if ($entrytype == "course") {
                        $DB->delete_records($table, ['courseid' => $id]);
                    } else {
                        $DB->delete_records($table, ['userid' => $id]);
                    }
                }
            }
        }
    }
}
