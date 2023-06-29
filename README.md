# local_lytix

A plugin for Learning Analytics. The intention is to provide a learning analytics (LA) overview for Coursecreator's, Teachers and Students as well.
Lytix is the main plugin with several widgets. Each widget is a subplugin and can be added or removed accordingly.
Each platform we support uses a different constellation of these widgets.

### Platforms

Currently, lytix is provided for 3 moodle instances:
- Learner's Cornerj (LC) for the TeachCenter (https://tc.tugraz.at/main/), University of Graz (https://learn.moodle.uni-graz.at) and University of Vienna (https://moodle.univie.ac.at)
- Creator's Dashboard (CD) for iMooX (https://imoox.at/mooc/)
- Course Dashboard (outdated) is currently not in use and not maintained!

### Subplugins

Currently, there are 12 widgets and 3 helper subplugins:

- basic (dummy)
- activity (LC)
- diary (LC)
- planner (LC)
- grademonitor (LC)
- timeoverview (LC, CD)
- actions (CD)
- coursecompletion (CD)
- completions (CD)
- participations (CD)
- measure (outdated)
- timedetail (outdated)

- config (all)
- helper (all)
- logs   (all)

Each platform view can be selected in the plugin settings. A mustache template is then used to provide the correct widgets.

### Settings

There are 4 plugin settings to consider.
- **platform**: selects the correct platform (TUG, IMX or KF)
- **semester_start**: Start of the semester. It is relevant for several plugins. This value gets overwritten by the course start.
- **semester_end**: End of the semester. It is relevant for several plugins. This value gets overwritten by the course end or ignored at iMooX.
- **course_list**: This setting is a list of courses (ID's). When a course is added here, lytix is enabled for this course.
- **grademonitor list**: This setting is a list of courses (ID's). When a course is added here, the grademonitor is enabled for this course.
