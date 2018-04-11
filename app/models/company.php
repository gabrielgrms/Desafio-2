<?php
	require_once dirname(__FILE__).'/BaseModel.php';

	class Company extends BaseModel {
		private $id, $name, $cnpj;

		function __construct($attributes = NULL){
			if($attributes) {
				$this->id = empty($attributes['id']) ? null : $attributes['id'];
				$this->name = empty($attributes['name']) ? null : $attributes['name'];
				$this->cnpj = empty($attributes['cnpj']) ? null : $attributes['cnpj'];
			}
		}
		
		function getId() { return $this->id; }

		function getName() { return $this->name; }
		function setName($name) { $this->name = $name; }

        function getCnpj() { return $this->cnpj; }
        function setCnpj($cnpj) { $this->cnpj = $cnpj; }
	}