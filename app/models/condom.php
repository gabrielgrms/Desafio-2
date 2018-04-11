<?php
	require_once dirname(__FILE__).'/BaseModel.php';

	class Condom extends BaseModel {
		private $id, $name, $company_id;

		function __construct($attributes = NULL){
			if($attributes) {
				$this->id = empty($attributes['id']) ? null : $attributes['id'];
				$this->name = empty($attributes['name']) ? null : $attributes['name'];
				$this->company_id = empty($attributes['company_id']) ? null : $attributes['company_id'];
			}
		}
		
		function getId() { return $this->id; }

		function getName() { return $this->name; }
		function setName($name) { $this->name = $name; }

        function getCompany_id() { return $this->company_id; }
        function setCompany_id($company_id) { $this->company_id = $company_id; }
	}