<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * User class
 */
class Feedback
{

    use Model;

    protected $table = 'feedbacks';
    protected $primaryKey = 'id';

    protected $allowedColumns = [
        'name',
        'email',
        'phone',
        'message',
        'image',
        'user_id',
        'is_accepted',
        'is_edited',
        'date'
    ];

    /*****************************
     * 	rules include:
		required
		alpha
		email
		numeric
		unique
		symbol
		longer_than_8_chars
		alpha_numeric_symbol
		alpha_numeric
		alpha_symbol
     * 
     ****************************/
    protected $validationRules = [

        'email' => [
            'email',
            'required',
        ],
        'name' => [
            'alpha',
            'required',
        ],
        'phone' => [
            'alpha',
            'required',
        ],
        'message' => [
            'alpha',
            'required',
        ],
        'file' => [
            'required',
        ],
    ];
    public function validateFeedback($post_data, $files_data, $id = null)
    {
        $this->errors = [];

        if (empty($post_data['feedback']) && empty($files_data['image']['name'])) {

            $this->errors['post'] = "All fields are required";
        }
        if (empty($post_data['name'])) {
            $this->errors['name'] = "Please type name";
        }
        if (empty($post_data['email'])) {
            $this->errors['email'] = "Please type email";
        }
        if (empty($post_data['message'])) {
            $this->errors['message'] = "Please type message";
        }

        if (empty($this->errors)) {
            return true;
        }

        return false;
    }
    public function get_validationError()
    {

        return empty($this->errors) ? 'Please type smth' : $this->errors;
    }
    public function get_user_feedbacks($data)
    {
        $feedbacks = $this->where($data);
        return $feedbacks;
    }
    public function get_feedback_by_id($data)
    {
        $feedback = $this->where($data);
        return $feedback;
    }
    public function get_accepted_feedbacks($data)
    {
        $feedbacks = $this->where($data);
        return $feedbacks;
    }
    public function update_feedback_by_admin($id, $data)
    {
        $feedback = $this->update($id, $data);
        return $feedback;
    }
    public function get_all_feedbacks_by_admin()
    {
        $feedbacks = $this->findAll();
        return $feedbacks;
    }
    public function search_feedback($data)
    {
        $allowes_columns = ['name' => $data, 'email' => $data];
        $feedbacks = $this->search($allowes_columns);
        return $feedbacks;
    }
    public function search_feedback_by_date($data)
    {
        $allowes_columns = ['date' => $data];
        $feedbacks = $this->search_date($allowes_columns);
        return $feedbacks;
    }
    public function create_user_table()
    {
        $conn = $this->connect();
        // sql to create table
        $sql = "CREATE TABLE IF NOT EXISTS feedbacks (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			name VARCHAR(30) NOT NULL,
			email VARCHAR(30) NOT NULL,
			message TEXT NOT NULL,
			image VARCHAR(255) NOT NULL, 
            is_accepted BOOLEAN default false, 
            is_edited BOOLEAN default false, 
			user_id INT(6) UNSIGNED, 
			date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
            FOREIGN KEY (user_id) REFERENCES users(id)
            )";
        $conn->exec($sql);
        return true;
    }
}
