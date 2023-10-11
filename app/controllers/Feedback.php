<?php

namespace Controller;

use Core\Session;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * feedback class
 */
class Feedback
{
    use MainController;

    public function index()
    {
        $ses = new Session;
        if ($ses->get('USER') == '') {
            redirect('home');
        }
        $id = $ses->get('USER')->id;
        $feedback = new \Model\Feedback;
        $data = $feedback->get_user_feedbacks(['user_id' => $id]);
        $this->view('feedback', [$data]);
    }
    public function single()
    {
        $feedback_id = extractParam('id');
        if (intval($feedback_id) == 0) {
            redirect('feedback');
        }
        $feedback = new \Model\Feedback;
        $data = $feedback->get_feedback_by_id(['id' => $feedback_id]);
        $this->view('single', [$data]);
    }
    public function search()
    {
        $feedback = new \Model\Feedback;
        $req = new \Core\Request;
        if ($req->posted()) {
            if (isset($_POST['search'])) {
                $data = $feedback->search_feedback($_POST['search']);
            }else{
                $data = $feedback->search_feedback_by_date($_POST['search_date']);
            }

            $this->view('home', [$data]);
        }
    }
}
