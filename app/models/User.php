<?php

namespace Model;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * User class
 */
class User
{

	use Model;

	protected $table = 'users';
	protected $primaryKey = 'id';
	protected $loginUniqueColumn = ['email' => 'email', 'username' => 'username'];

	protected $allowedColumns = [

		'username',
		'email',
		'password',
		'is_admin'
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
			'unique',
			'required',
		],
		'username' => [
			'alpha',
			'unique',
			'required',
		],
		'password' => [
			'not_less_than_3_chars',
			'required',
		],
	];

	public function signup($data)
	{

		if ($this->validate($data)) {
			//add extra user columns here
			if ($data['username'] == 'admin' && $data['password'] == '123') {
				$data['is_admin'] = true;
			}
			$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
			$data['date'] = date("Y-m-d H:i:s");
			$data['date_created'] = date("Y-m-d H:i:s");

			$this->insert($data);
			redirect('login');
		}
	}

	public function login($data_raw)
	{
		$data = [
			'username' => $data_raw['email'],
			'email' => $data_raw['email'],
		];
		$data['password'] = $data_raw['password'];
		$row = $this->first_by_multiple([$this->loginUniqueColumn['username'] => $data['username'], $this->loginUniqueColumn['email'] => $data['email']]);

		if ($row) {
			//confirm password
			if (password_verify($data['password'], $row->password)) {

				$ses = new \Core\Session;
				$ses->auth($row);

				redirect('home');
			} else {
				$this->errors[$this->loginUniqueColumn['email']] = "Wrong " . $this->loginUniqueColumn['email'] . " or " . $this->loginUniqueColumn['username'] . " or password";
			}
		} else {
			$this->errors[$this->loginUniqueColumn['email']] = "Wrong " . $this->loginUniqueColumn['email'] . " or " . $this->loginUniqueColumn['username'] . " or password";
		}
	}
	public function create_user_table()
	{
		$conn = $this->connect();
		// sql to create table
		$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			username VARCHAR(30) NOT NULL,
			email VARCHAR(30) NOT NULL,
			password VARCHAR(255) NOT NULL,
			is_admin BOOLEAN default false, 
			reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
			)";
		$conn->exec($sql);
		return true;
	}
}
