# Plugin Settings Guide: local_lytix

This guide provides detailed information on how to configure the `local_lytix` Moodle plugin.

## Table of Contents

- [Dashboard Settings](#dashboard-settings)
- [Data Aggregation](#data-aggregation)
- [Semester Configuration](#semester-configuration)
- [Course and Grade Monitor Lists](#course-and-grade-monitor-lists)
- [Additional Notes](#additional-notes)

## Dashboard Settings

### Platform Selection

You can select the dashboard you want to use. Currently, the available options are:

- **Learners Corner**: Suitable for most users.
- **Course Dashboard**: Another option available for all users.
- **Creators Dashboard**: This is not yet available for public use and should not be selected.

To set this, navigate to the `local_lytix/platform` setting and choose the desired platform.

## Data Aggregation

### Last Aggregation Date

This setting (`local_lytix/last_aggregation_date`) determines the date for data aggregation. If you are unsure about this setting, it's recommended to leave it at its default value.

## Semester Configuration

You can set the start and end dates for the semester using the following settings:

- **Semester Start Date**: `local_lytix/semester_start`
- **Semester End Date**: `local_lytix/semester_end`

## Course Lists

This setting (`local_lytix/course_list`) allows you to specify a list of courses. Additionally, there's a button labeled "Course List" that provides more options related to courses.

## Additional Notes

- Ensure you have the necessary permissions to modify these settings.
- Always backup your Moodle instance before making significant changes.
- If you encounter any issues or need further assistance, please refer to the official documentation or contact the plugin author.
