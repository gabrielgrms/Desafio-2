<?php
	require_once dirname(__FILE__).'/../models/allotment.php';

	class AllotmentController {

		public static function create(){
			if(!isset($_POST['allotment']['id']) && !empty($_POST['allotment']['number']) && !empty($_POST['allotment']['condom_id'])){
				$allotment = new Allotment($_POST['allotment']);
				try {
					$allotment->insert();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/allotment/index.php");
			}
		}

		public static function update(){
			if(!empty($_POST['allotment']['id']) && !empty($_POST['allotment']['number']) && !empty($_POST['allotment']['condom_id'])){
				$allotment = new Allotment($_POST['allotment']);
				try {
					$allotment->update();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/allotment/index.php");
			}
		}

		public static function delete() {
			if(!empty($_GET['id'])) {
				try {
					Allotment::delete(['id' => $_GET['id']]);
				}
				catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
			}
			header("Location: ../views/allotment/index.php");
		}

		public static function read($id=null){
			return Allotment::select($id);
		}
	}

	$getActions = array('delete');
	$postActions = array('create', 'update');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
		$action = $_POST['action'];
		AllotmentController::$action();
	}
	if(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
		$action = $_GET['action'];
		AllotmentController::$action();
	}
