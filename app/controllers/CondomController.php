<?php
	require_once dirname(__FILE__).'/../models/condom.php';

	class CondomController {

		public static function create(){
			if(!isset($_POST['condom']['id']) && !empty($_POST['condom']['name']) && !empty($_POST['condom']['company_id'])){
				$condom = new Condom($_POST['condom']);
				try {
					$condom->insert();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/condom/index.php");
			}
		}

		public static function update(){
			if(!empty($_POST['condom']['id']) && !empty($_POST['condom']['name']) && !empty($_POST['condom']['company_id'])){
				$condom = new Condom($_POST['condom']);
				try {
					$condom->update();
				} catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
				header("Location: ../views/condom/index.php");
			}
		}

		public static function delete() {
			if(!empty($_GET['id'])) {
				try {
					Condom::delete(['id' => $_GET['id']]);
				}
				catch (PDOException $e) {
					echo $e->getMessage();
					exit();
				}
			}
			header("Location: ../views/condom/index.php");
		}

		public static function read($id=null){
			return Condom::select($id);
		}
	}

	$getActions = array('delete');
	$postActions = array('create', 'update');

	if(isset($_POST['action']) && in_array($_POST['action'], $postActions)) {
		$action = $_POST['action'];
		CondomController::$action();
	}
	if(isset($_GET['action']) && in_array($_GET['action'], $getActions)) {
		$action = $_GET['action'];
		CondomController::$action();
	}
