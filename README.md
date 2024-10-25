# local_lytix Plugin for Moodle

The `local_lytix` plugin is a comprehensive tool designed to enhance the digital learning experience in Moodle for both educators and students. Emphasizing the concept of Human-Centred Learning Analytics (HCLA), this tool facilitates better organization, learning, and interaction within Moodle.

## Installation

1. Download the plugin and extract the files.
2. Move the extracted folder to your `moodle/local` directory.
3. Log in as an admin in Moodle and navigate to `Site Administration > Plugins > Install plugins`.
4. Follow the on-screen instructions to complete the installation.
5. Have a look at settings.md file and configure the plugin settings to your needs.

> **Note**: Ensure you have the required permissions to install and activate the `local_lytix` plugin in your Moodle courses.

## Requirements

- Supported Moodle Version: 4.1 - 4.5
- Supported PHP Version:    7.4 - 8.2
- Supported Databases:      MariaDB, PostgreSQL
- Supported Moodle Themes:  Boost

This plugin has only been tested under the above system requirements against the specified versions.
However, it may work under other system requirements and versions as well.

## Features

- Promotes active engagement of users with the dashboard, encouraging both educators and students to interact and organize effectively.
- Offers a range of widgets, including those tailored for task planning and lecture scheduling, ensuring users get a holistic learning experience.
- [list of subplugins](https://github.com/llttugraz?tab=repositories&q=lytix_&type=&language=&sort=)

## Configuration

See [settings.md](https://github.com/llttugraz/moodle-local_lytix/blob/main/settings.md).

## Usage

The `local_lytix` plugin has three different modes of operation (`Learner's Corner`, `Creator's Dashboard` and `Course Dashboard`).

Switching between these three modes happens on global scope of the deployed Moodle instance and can be done under `Site administration` --> `Plugins` --> `LYTIX`.

One of the modes is selected in the `platform` dropdown and also additional settings are available there, other crucial one being list of courses for which the plugin is active.

After adding the course ID of the desired course and saving the changes the UI of the selected mode can be accessed on main course view in `More` dropdown.

`Creator's Dashboard` is shown only to course creators and managers and provides data about number of enrollments in the course, number of participants and graduates, and time they spent on specific areas.

`Learner's Corner` is available to both students and teachers but provide partially different functionalities depending on the role. Teachers can set events for all students and connect
them to specific existing activities like quizzes, which students can then mark as done. Students can also create their own custom events which are seen only by themselves, and also `Learning Diary` entries.

`Course Dashboard` can also be seen by both types of users, students can see their score and how it compares to other participants percentage-wise. Teachers in this mode again have additional data on activity completion by students and time-tracking details.

## Dependencies
- [lytix_config](https://github.com/llttugraz/moodle-lytix_config)
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs)

## Subplugins

All subplugins are located in the `moodle/local/lytix/modules` directory and can be found [here](https://github.com/llttugraz?tab=repositories&q=lytix_&type=&language=&sort=).

For `Learner's corner`:

- [lytix_config](https://github.com/llttugraz/moodle-lytix_config)
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs)
- [lytix_timeoverview](https://github.com/llttugraz/moodle-lytix_timeoverview)
- [lytix_activity](https://github.com/llttugraz/moodle-lytix_activity)
- [lytix_diary](https://github.com/llttugraz/moodle-lytix_diary)
- [lytix_planner](https://github.com/llttugraz/moodle-lytix_planner)
- [lytix_grademonitor](https://github.com/llttugraz/moodle-lytix_grademonitor) (only optional, only supported for Moodle version <= 4.1)

For `Course dashboard`:

- [lytix_config](https://github.com/llttugraz/moodle-lytix_config)
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs)
- [lytix_timeoverview](https://github.com/llttugraz/moodle-lytix_timeoverview)
- [lytix_completion](https://github.com/llttugraz/moodle-lytix_completion)
- [lytix_measure](https://github.com/llttugraz/moodle-lytix_measure)
- [lytix_planner](https://github.com/llttugraz/moodle-lytix_planner)
- lytix_timedetail (not available on GitHub)

For `Creators dashboard`:

- [lytix_config](https://github.com/llttugraz/moodle-lytix_config)
- [lytix_logs](https://github.com/llttugraz/moodle-lytix_logs)
- [lytix_timeoverview](https://github.com/llttugraz/moodle-lytix_timeoverview)
- lytix_actions (not available on GitHub)
- lytix_completions (not available on GitHub)
- lytix_coursecompl (not available on GitHub)
- lytix_participants (not available on GitHub)


## Privacy

No personal data are stored.

## License

This plugin is licensed under the [GNU GPL v3](https://github.com/llttugraz/moodle-local_lytix?tab=GPL-3.0-1-ov-file).

## Contributors

- **Günther Moser** - Developer - [GitHub](https://github.com/ghinta)
- **Alex Kremser** - Developer
