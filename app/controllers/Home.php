<?php

namespace Controller;

defined('ROOTPATH') or exit('Access Denied!');

/**
 * home class
 */
class Home
{
	use MainController;

	public function index()
	{
		$feedbacks = new \Model\Feedback;
		$data = $feedbacks->get_accepted_feedbacks(['is_accepted' => true]);
		$this->view('home', [$data]);
	}
}
