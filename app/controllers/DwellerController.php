<?php
	require_once dirname(__FILE__).'/../models/dweller.php';

	class DwellerController {

		public static function create(){
			if(!isset($_POST['dweller']['id']) && !empty($_POST['dweller']['name']) && !empty($_POST['dweller']['email'] && !empty($_POST['dweller']['allotment_id']))){
				$dweller = new Dweller($_POST['dweller']);
				try {
					$dweller->insert();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/dweller/index.php");
			}
		}

		public static function update(){
			if(!empty($_POST['dweller']['id']) && !empty($_POST['dweller']['name']) && !empty($_POST['dweller']['email'] && !empty($_POST['dweller']['allotment_id']))){
				$dweller = new Dweller($_POST['dweller']);
				try {
					$dweller->update();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/dweller/index.php");
			}
		}

		public static function delete() {
			if(!empty($_GET['id'])) {
				try {
					Dweller::delete(['id' => $_GET['id']]);
				}
				catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
			}
			header("Location: ../views/dweller/index.php");
		}

		public static function read($id=null){
			return Dweller::select($id);
		}
	}

	$getActions = array('delete');
	$postActions = array('create', 'update');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
		$action = $_POST['action'];
		DwellerController::$action();
	}
	if(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
		$action = $_GET['action'];
		DwellerController::$action();
	}
