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
 * Open Educational Resources Plugin
 *
 * @author     Natalie Kukovetz
 * @copyright  2022 Educational Technologies, Graz, University of Technology
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

import * as ModalFactory from 'core/modal_factory';
import * as ModalEvents from 'core/modal_events';
import * as Fragment from 'core/fragment';

const showForm = (setting) => {
    let args = {setting};
    let context = 1;
    let form = Fragment.loadFragment('local_lytix', 'courselistform', context, args);

    form.done(function() {
        ModalFactory.create({
            type: ModalFactory.types.SAVE_CANCEL,
            title: setting,
            body: form,
        }).then(function(modal) {
            modal.setLarge();
            modal.show();
            modal.getRoot().on(ModalEvents.hidden, function() {
                modal.destroy();
            });
            modal.getRoot().on(ModalEvents.save, function() {
                var formData = modal.getRoot().find('form').serialize();
                let saveargs = {
                    params: formData
                };
                Fragment.loadFragment('local_lytix', 'courselistformsave', 1, saveargs);
                location.reload(); // TODO clean reload without question.
            });
            return; // For eslint.
        }).catch(function(error) {
            window.console.debug(error);
        });
    });
};

export const initListener = () => {
    let element = document.getElementById("courselist");

    // Update christian 20.10.2022: do not add listener when object does not exist.
    if (element === null) {
        return;
    }

    element.addEventListener("click", function() {
        showForm('courselist');
    });

    let gradeelement = document.getElementById("grademonitor");

    if (gradeelement === null) {
        return;
    }

    gradeelement.addEventListener("click", function() {
        showForm('grademonitor');
    });
};
