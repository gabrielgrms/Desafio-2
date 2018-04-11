<?php
	require_once dirname(__FILE__).'/../models/company.php';

	class CompaniesController {

		public static function create(){
			if(!isset($_POST['company']['id']) && !empty($_POST['company']['name']) && !empty($_POST['company']['cnpj'])){
				$company = new Company($_POST['company']);
				try {
					$company->insert();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/company/index.php");
			}
		}

		public static function update(){
			if(!empty($_POST['company']['id']) && !empty($_POST['company']['name']) && !empty($_POST['company']['cnpj'])){
				$company = new Company($_POST['company']);
				try {
					$company->update();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/company/index.php");
			}
		}

		public static function delete() {
			if(!empty($_GET['id'])) {
				try {
					Company::delete(['id' => $_GET['id']]);
				}
				catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
			}
			header("Location: ../views/company/index.php");
		}

		public static function read($id=null){
			return Company::select($id);
		}
	}

	$getActions = array('delete');
	$postActions = array('create', 'update');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
		$action = $_POST['action'];
		CompaniesController::$action();
	}
	if(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
		$action = $_GET['action'];
		CompaniesController::$action();
	}
