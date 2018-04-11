<?php
	require_once dirname(__FILE__).'/BaseModel.php';

	class Allotment extends BaseModel {
		private $id, $number, $condom_id;

		function __construct($attributes = NULL){
			if($attributes) {
				$this->id = empty($attributes['id']) ? null : $attributes['id'];
				$this->number = empty($attributes['number']) ? null : $attributes['number'];
				$this->condom_id = empty($attributes['condom_id']) ? null : $attributes['condom_id'];
			}
		}
		
		function getId() { return $this->id; }

		function getNumber() { return $this->number; }
		function setNumber($number) { $this->number = $number; }

        function getCondom_id() { return $this->condom_id; }
        function setCondom_id($condom_id) { $this->condom_id = $condom_id; }
	}