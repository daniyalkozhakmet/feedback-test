<?php

namespace Controller;

use Core\Session;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * feedback class
 */
class Admin
{
    use MainController;

    public function index()
    {
        $ses = new Session;
        if ($ses->get('USER')->is_admin == false) {
            redirect('home');
        }
        $feedback = new \Model\Feedback;
        $data = $feedback->get_all_feedbacks_by_admin();
        $this->view('admin', [$data]);
    }
    public function edit()
    {
        $ses = new Session;
        if ($ses->get('USER')->is_admin == false) {
            redirect('home');
        }
        $feedback_id = extractParam('id');
        if (intval($feedback_id) == 0) {
            redirect('feedback');
        }
        $feedback = new \Model\Feedback;
        $data = $feedback->get_feedback_by_id(['id' => $feedback_id]);
        $this->view('edit', [$data]);
    }
    public function update()
    {
        $data = new \Model\Feedback;
        $ses = new Session;
        if ($ses->get('USER')->is_admin == false) {
            redirect('home');
        }
        $feedback_id = extractParam('id');
        if (intval($feedback_id) == 0) {
            redirect('feedback');
        }
        $req = new \Core\Request;
        if ($req->posted()) {
            if (!isset($_POST['is_accepted'])) {
                $_POST['is_accepted'] = false;
            } else {
                $_POST['is_accepted'] = true;
            }
            $_POST['is_edited'] = true;
            $data->update_feedback_by_admin($feedback_id, $_POST);
            // var_dump($_POST['is_accepted']);
            redirect('admin');
        }
        redirect('home');
    }
}
