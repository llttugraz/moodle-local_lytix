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
 * This class has functions to check if and which modules are installed.
 *
 * @package   local_lytix
 * @copyright 2022 Educational Technologies, Graz, University of Technology
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace local_lytix\helper;

use core_component;

/**
 * Class tests
 */
class plugin_check {

    /**
     * Gets the names of installed lytix subplugins.
     *
     * @return array
     * @throws \coding_exception
     */
    public static function get_installed_plugins() {

        $plugins = [];
        foreach (core_component::get_plugin_list('lytix') as $plugin => $plugindir) {
            if (get_string_manager()->string_exists('pluginname', 'lytix_' . $plugin)) {
                $strpluginname = get_string('pluginname', 'lytix_' . $plugin);
            } else {
                $strpluginname = $plugin;
            }
            $plugins[$plugin] = $strpluginname;
        }

        return $plugins;
    }

    /**
     * Checks if a specific subplugin ist installed.
     *
     * @param string $neelde
     * @return false|int|string
     * @throws \coding_exception
     */
    public static function is_installed($neelde) {

        $plugins = self::get_installed_plugins();
        return array_key_exists($neelde, $plugins);
    }
}
