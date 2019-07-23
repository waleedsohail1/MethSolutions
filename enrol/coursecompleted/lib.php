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
 * coursecompleted enrolment plugin.
 *
 * @package   enrol_coursecompleted
 * @copyright 2017 eWallah (www.eWallah.net)
 * @author    Renaat Debleu (info@eWallah.net)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * coursecompleted enrolment plugin.
 *
 * @package   enrol_coursecompleted
 * @copyright 2017 eWallah (www.eWallah.net)
 * @author    Renaat Debleu (info@eWallah.net)
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class enrol_coursecompleted_plugin extends enrol_plugin {

    /**
     * Returns localised name of enrol instance
     *
     * @param object $instance (null is accepted too)
     * @return string
     */
    public function get_instance_name($instance) {
        global $DB;
        if ($short = $DB->get_field('course', 'shortname', ['id' => $instance->customint1])) {
            $coursename = format_string($short, true, ['context' => context_course::instance($instance->customint1)]);
            return get_string('aftercourse', 'enrol_coursecompleted', $coursename);
        }
        return get_string('coursedeleted', '', $instance->customint1);
    }

    /**
     * Returns optional enrolment information icons.
     *
     * @param array $instances all enrol instances of this type in one course
     * @return array of pix_icon
     */
    public function get_info_icons(array $instances) {
        global $DB, $USER;
        $arr = [];
        if (!isguestuser()) {
            foreach ($instances as $instance) {
                if ($course = $DB->get_record('course', ['id' => $instance->customint1])) {
                    $context = context_course::instance($course->id);
                    if (is_enrolled($context, $USER->id, 'moodle/course:isincompletionreports', true)) {
                        $name = format_string($course->fullname, true, ['context' => $context]);
                        $name = get_string('aftercourse', 'enrol_coursecompleted', $name);
                        $arr[] = new pix_icon('icon', $name, 'enrol_coursecompleted');
                    }
                }
            }
        }
        return $arr;
    }

    /**
     * Returns optional enrolment instance description text.
     *
     * @param object $instance
     * @return string short html text
     */
    public function get_description_text($instance) {
        return 'Enrolment by completion of course with id ' . $instance->customint1;
    }

    /**
     * Add information for people who want to enrol.
     *
     * @param stdClass $instance
     * @return string html text, usually a form in a text box
     */
    public function enrol_page_hook(stdClass $instance) {
        global $DB, $OUTPUT;
        if (!isguestuser()) {
            if ($course = $DB->get_record('course', ['id' => $instance->customint1])) {
                $context = context_course::instance($instance->customint1);
                $name = format_string($course->fullname, true, ['context' => $context]);
                $link = html_writer::link(new moodle_url('/course/view.php', ['id' => $course->id]), $name);
                return $OUTPUT->box(get_string('willbeenrolled', 'enrol_coursecompleted', $link));
            }
        }
        return '';
    }

    /**
     * Gets an array of the user enrolment actions
     *
     * @param course_enrolment_manager $manager
     * @param stdClass $ue A user enrolment object
     * @return array An array of user_enrolment_actions
     */
    public function get_user_enrolment_actions(course_enrolment_manager $manager, $ue) {
        $actions = [];
        $context = $manager->get_context();
        $instance = $ue->enrolmentinstance;
        $params = $manager->get_moodlepage()->url->params();
        $params['ue'] = $ue->id;
        if ($this->allow_unenrol($instance) && has_capability("enrol/coursecompleted:unenrol", $context)) {
            $url = new moodle_url('/enrol/unenroluser.php', $params);
            $pix = new pix_icon('t/delete', '');
            $arr = ['class' => 'unenrollink', 'rel' => $ue->id];
            $actions[] = new user_enrolment_action($pix, get_string('unenrol', 'enrol'), $url, $arr);
        }
        if ($this->allow_manage($instance) && has_capability("enrol/coursecompleted:manage", $context)) {
            $url = new moodle_url('/enrol/editenrolment.php', $params);
            $pix = new pix_icon('t/edit', '');
            $arr = ['class' => 'editenrollink', 'rel' => $ue->id];
            $actions[] = new user_enrolment_action($pix, get_string('edit'), $url, $arr);
        }
        return $actions;
    }

    /**
     * Returns edit icons for the page with list of instances
     * @param stdClass $instance
     * @return array
     */
    public function get_action_icons(stdClass $instance) {
        global $OUTPUT;

        if ($instance->enrol !== 'coursecompleted') {
            throw new coding_exception('invalid enrol instance!');
        }
        $icons = parent::get_action_icons($instance);
        $context = context_course::instance($instance->courseid);
        if (has_capability('enrol/coursecompleted:enrolpast', $context)) {
            $managelink = new moodle_url("/enrol/coursecompleted/manage.php", ['enrolid' => $instance->id]);
            $icon = new pix_icon('t/enrolusers', get_string('enrolusers', 'enrol_manual'), 'core', ['class' => 'iconsmall']);
            $icons[] = $OUTPUT->action_icon($managelink, $icon);
        }
        return $icons;
    }

    /**
     * Restore instance and map settings.
     *
     * @param restore_enrolments_structure_step $step
     * @param stdClass $data
     * @param stdClass $course
     * @param int $oldid
     */
    public function restore_instance(restore_enrolments_structure_step $step, stdClass $data, $course, $oldid) {
        global $DB;
        if ($step->get_task()->get_target() == backup::TARGET_NEW_COURSE) {
            $merge = false;
        } else {
            $merge = ['courseid' => $course->id, 'enrol' => 'coursecompleted', 'roleid' => $data->roleid,
                      'customint1' => $data->customint1];
        }
        if ($merge and $instances = $DB->get_records('enrol', $merge, 'id')) {
            $instance = reset($instances);
            $instanceid = $instance->id;
        } else {
            $instanceid = $this->add_instance($course, (array)$data);
        }
        $step->set_mapping('enrol', $oldid, $instanceid);
    }

    /**
     * Restore user enrolment.
     *
     * @param restore_enrolments_structure_step $step
     * @param stdClass $data
     * @param stdClass $instance
     * @param int $userid
     * @param int $oldinstancestatus
     */
    public function restore_user_enrolment(restore_enrolments_structure_step $step, $data, $instance, $userid, $oldinstancestatus) {
        if ($step->get_task()->get_target() == backup::TARGET_NEW_COURSE) {
            $this->enrol_user($instance, $userid, null, $data->timestart, $data->timeend, $data->status);
            mark_user_dirty($userid);
        }
    }

    /**
     * Is it possible to add enrol instance via standard UI?
     *
     * @param int $courseid id of the course to add the instance to
     * @return boolean
     */
    public function can_add_instance($courseid) {
        return has_capability('enrol/coursecompleted:manage', context_course::instance($courseid));
    }

    /**
     * Is it possible to delete enrol instance via standard UI?
     *
     * @param object $instance
     * @return bool
     */
    public function can_delete_instance($instance) {
        return has_capability('enrol/coursecompleted:manage', context_course::instance($instance->courseid));
    }

    /**
     * Is it possible to hide/show enrol instance via standard UI?
     *
     * @param stdClass $instance
     * @return bool
     */
    public function can_hide_show_instance($instance) {
        return has_capability('enrol/coursecompleted:manage', context_course::instance($instance->courseid));
    }

    /**
     * Does this plugin allow manual unenrolment of all users?
     *
     * @param stdClass $instance course enrol instance
     * @return bool - true means user with 'enrol/xxx:unenrol' may unenrol others freely
     */
    public function allow_unenrol(stdClass $instance) {
        return has_capability('enrol/coursecompleted:manage', context_course::instance($instance->courseid));
    }

    /**
     * Does this plugin allow manual changes in user_enrolments table?
     *
     * @param stdClass $instance course enrol instance
     * @return bool - true means it is possible to change enrol period and status in user_enrolments table
     */
    public function allow_manage(stdClass $instance) {
        return has_capability('enrol/coursecompleted:manage', context_course::instance($instance->courseid));
    }

    /**
     * Does this plugin shows enrol me?
     *
     * @param stdClass $instance course enrol instance
     * @return bool - true means it is possible to enrol.
     */
    public function show_enrolme_link(stdClass $instance) {
        return ($instance->status == ENROL_INSTANCE_ENABLED);
    }

    /**
     * Execute synchronisation.
     * @param progress_trace $trace
     * @return int exit code, 0 means ok
     */
    public function sync(progress_trace $trace) {
        $this->process_expirations($trace);
        return 0;
    }

    /**
     * We are a good plugin and don't invent our own UI/validation code path.
     *
     * @return bool
     */
    public function use_standard_editing_ui() {
        return true;
    }

    /**
     * Add elements to the edit instance form.
     *
     * @param stdClass $instance
     * @param MoodleQuickForm $mform
     * @param context $context
     * @return bool
     */
    public function edit_instance_form($instance, MoodleQuickForm $mform, $context) {

        $options = [ENROL_INSTANCE_ENABLED  => get_string('yes'), ENROL_INSTANCE_DISABLED => get_string('no')];
        $mform->addElement('select', 'status', get_string('enabled', 'admin'), $options);
        $mform->setDefault('status', $this->get_config('status'));

        $role = ($instance->id) ? $instance->roleid : $this->get_config('roleid');
        $roles = get_default_enrol_roles($context, $role);
        $mform->addElement('select', 'roleid', get_string('assignrole', 'enrol_paypal'), $roles);
        $mform->setDefault('roleid', $this->get_config('roleid'));

        $s = get_string('enrolperiod', 'enrol_paypal');
        $mform->addElement('duration', 'enrolperiod', $s, ['optional' => true, 'defaultunit' => 86400]);
        $mform->setDefault('enrolperiod', $this->get_config('enrolperiod'));
        $mform->addHelpButton('enrolperiod', 'enrolperiod', 'enrol_paypal');

        $s = get_string('enrolstartdate', 'enrol_paypal');
        $mform->addElement('date_time_selector', 'enrolstartdate', $s, ['optional' => true]);
        $mform->setDefault('enrolstartdate', 0);
        $mform->addHelpButton('enrolstartdate', 'enrolstartdate', 'enrol_paypal');

        $s = get_string('enrolenddate', 'enrol_paypal');
        $mform->addElement('date_time_selector', 'enrolenddate', $s, ['optional' => true]);
        $mform->setDefault('enrolenddate', 0);
        $mform->addHelpButton('enrolenddate', 'enrolenddate', 'enrol_paypal');

        $mform->addElement('course', 'customint1', get_string('course'), ['multiple' => false, 'includefrontpage' => false]);
        $mform->addRule('customint1', get_string('required'), 'required', null, 'client');
        $mform->addHelpButton('customint1', 'compcourse', 'enrol_coursecompleted');
    }

    /**
     * Perform custom validation of the data used to edit the instance.
     *
     * @param array $data array of ("fieldname"=>value) of submitted data
     * @param array $files array of uploaded files "element_name"=>tmp_file_path
     * @param object $instance The instance loaded from the DB
     * @param context $context The context of the instance we are editing
     * @return array of "element_name"=>"error_description" if there are errors,
     *         or an empty array if everything is OK.
     */
    public function edit_instance_validation($data, $files, $instance, $context) {
        global $DB;
        $errors = [];
        if ($data['status'] == ENROL_INSTANCE_ENABLED) {
            if (!empty($data['enrolenddate']) and $data['enrolenddate'] < $data['enrolstartdate']) {
                $errors['enrolenddate'] = get_string('enrolenddaterror', 'enrol_paypal');
            }
            if (empty($data['customint1']) or
                $data['customint1'] == 1 or
                !$DB->record_exists('course', ['id' => $data['customint1']])) {
                $errors['customint'] = get_string('error_nonexistingcourse', 'tool_generator');
            }
        }
        return $errors;
    }
}
