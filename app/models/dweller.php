<?php
	require_once dirname(__FILE__).'/BaseModel.php';

	class Dweller extends BaseModel {
		private $id, $name, $email, $allotment_id;

		function __construct($attributes = NULL){
			if($attributes) {
				$this->id = empty($attributes['id']) ? null : $attributes['id'];
				$this->name = empty($attributes['name']) ? null : $attributes['name'];
				$this->email = empty($attributes['email']) ? null : $attributes['email'];
				$this->allotment_id = empty($attributes['allotment_id']) ? null : $attributes['allotment_id'];
			}
		}
		
		function getId() { return $this->id; }

		function getName() { return $this->name; }
		function setName($name) { $this->name = $name; }

		function getEmail() { return $this->email; }
		function setEmail($email) { $this->email = $email; }
        
        function getAllotment_id() { return $this->allotment_id; }
        function setAllotment_id($allotment_id) { $this->allotment_id = $allotment_id; }
	}