<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

use \Core\Session;
use \Model\User;
use \Model\Feedback;
use \Core\Request;
use \Model\Image;

/**
 * ajax class
 */
class Ajax
{
    use MainController;

    public function index()
    {
        $ses = new Session;
        if (!$ses->is_logged_in()) {
            die;
        }
        $req = new Request;
        $info['success'] = false;
        $info['message'] = "";

        if ($req->posted()) {
            $data_type = $req->input('data_type');
            $info['data_type'] = $data_type;
            if ($data_type == 'create-feedback') {
                $id = $ses->get("USER")->id;
                $feedback = new Feedback;

                if ($feedback->validateFeedback($req->post(), $req->files())) {
                    $image_row = $req->files('image');

                    if (!empty($image_row['name']) && $image_row['error'] == 0) {

                        $folder = "uploads/";
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }

                        $destination = $folder . time() . $image_row['name'];
                        move_uploaded_file($image_row['tmp_name'], $destination);

                        $image_class = new Image;
                        $image_class->resize($destination, 1000);
                    }


                    $arr = [];
                    $arr['name']     = $req->input('name');
                    $arr['email']     = $req->input('email');
                    $arr['message']     = $req->input('message');
                    $arr['user_id']     = $id;
                    $arr['image']     = $destination;

                    $feedback->insert($arr);
                    $info['message'] = "Feedback created successfully";
                    $info['success'] = true;
                    $info['data'] = $arr;
                } else {
                    $info['message'] = $feedback->get_validationError();
                    $info['success'] = false;
                }
            }

            echo json_encode($info);
        }
    }
}
