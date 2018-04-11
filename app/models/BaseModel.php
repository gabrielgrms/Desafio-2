<?php
	require_once dirname(__FILE__).'/../helpers/connection.php';

    class BaseModel{

        public function __construct() {}

        public static function getTableName(){
            return strtolower(preg_replace('/\B([A-Z])/', '_$1', lcfirst(get_called_class())));
        }

        public static function buildQuery($action, $table_name, $attributes, $condition){
            switch ($action) {
                case 'insert':
                    unset($attributes['id']);
                    $query = "INSERT INTO `".$table_name."` (`".implode("`, `", $attributes)."`) VALUES (". ":".implode(", :", $attributes).")";
                    break;

                case 'delete':
					if(sizeof($condition) > 1){
						$query = "DELETE FROM ".$table_name." WHERE (".$attributes.") IN (:".implode(", :", array_keys($condition)). ")";
					}else{
						$query = "DELETE FROM $table_name WHERE `".array_keys($condition)[0]."` = :".array_keys($condition)[0]." ";
					}
                    break;

				case 'select':
                    if(empty($attributes)){
                        if (empty($condition)) {
                            $query = "SELECT * FROM ".$table_name;
                        }else{
                            $query = "SELECT * FROM ".$table_name." WHERE ".$condition." = :". $condition;
                        }
                    }else{
                        if (empty($condition)) {
                            $query = "SELECT `".implode("`, `", $attributes)."` FROM ".$table_name;
                        }else{
                            $query = "SELECT `".implode("`, `", $attributes)."` FROM ".$table_name." WHERE ".$condition." = :". $condition;
                        }
                    }
                    break;

				case 'update':
					$update_string = "";
					foreach (array_keys($attributes) as $attribute) {
                		$update_string .= "`$attribute` =:$attribute, ";
            		}
            		$update_string = substr($update_string, 0, -2);
                    $query = "UPDATE ".$table_name." SET ".$update_string." WHERE ".array_keys($condition)[0]." = :where_condition";
                    break;
            }
            return $query;
        }

        public static function bindValues($action, $stmt, $attributes, $condition){
			switch ($action) {
				case 'insert':
					unset($attributes['id']);
					foreach($attributes as $attribute => $value){
						if(is_numeric($value)){
							$stmt->BindValue(":".$attribute, $value, PDO::PARAM_INT);
						}else{
							$stmt->BindValue(":".$attribute, $value, PDO::PARAM_STR);
						}
					}
					break;

				case 'delete':
                    if(sizeof($attributes) > 1){
                        for ($i=0; $i < sizeof($attributes); $i++) {
                            $stmt->BindValue(":".$i, $attributes[$i], PDO::PARAM_INT);
                        }
                    }else{
						$stmt->BindValue(":".array_keys($attributes)[0], $attributes[array_keys($attributes)[0]], PDO::PARAM_INT);
					}
					break;

				case 'select':
                    if(!empty($attributes)){
                        $stmt->BindValue(":".array_keys($attributes)[0], $attributes[array_keys($attributes)[0]], PDO::PARAM_INT);
                    }
                    break;

				case 'update':
					foreach($attributes as $attribute => $value){
						if(is_numeric($value)){
							$stmt->BindValue(":".$attribute, $value, PDO::PARAM_INT);
						}else{
							$stmt->BindValue(":".$attribute, $value, PDO::PARAM_STR);
						}
					}
                    if(is_numeric($value)){
                        $stmt->BindValue(":where_condition", $condition[array_keys($condition)[0]], PDO::PARAM_INT);
                    }else{
                        $stmt->BindValue(":where_condition", $condition[array_keys($condition)[0]], PDO::PARAM_STR);
                    }

					break;

			}
        }
        //CRUD
        public function insert(){
		        $obj = self::objToArr($this);
		        $connection = Connection::connect();
		        $stmt = $connection->prepare(self::buildQuery("insert", self::getTableName(), array_keys($obj), null));
		        self::bindValues("insert", $stmt, $obj, null);
		        $stmt->execute();
		        return $connection->lastInsertId();
        }
		/*
		//seleciona todos os parametros, sem restricao
		User::select();

		//seleciona so alguns parametros, sem restricao
		User::select(array("name", "id", "email"));

		//seleciona todos os parametros, restringindo pelo id
		User::select("1");

		//seleciona so alguns parametros, restringindo pelo id
		User::select("1", array("name", "id", "email"));

		//seleciona todas, com uma condicao
		User::select("email", "hof@gmail.com");

		//seleciona so alguns paramentro, com restricao
		User::select("name", "value", array("name", "id", "email"));
		*/

		public static function select($conditionName = null, $conditionValue = null, $returnedAttributes = null){
            $connection = Connection::connect();
            if(is_array($conditionName)){
                $stmt = $connection->prepare(self::buildQuery("select", self::getTableName(), $conditionName, null));
            }else{
                if(!empty($conditionName) && $conditionValue == null && $returnedAttributes == null){
                    $stmt = $connection->prepare(self::buildQuery("select", self::getTableName(), null, "id"));
					$conditionValue = $conditionName;
					$conditionName = "id";
                }else if(is_array($conditionValue)){
					$stmt = $connection->prepare(self::buildQuery("select", self::getTableName(), $conditionValue, "id"));
					$conditionValue = $conditionName;
					$conditionName = "id";
				}else{
                    $stmt = $connection->prepare(self::buildQuery("select", self::getTableName(), $returnedAttributes, $conditionName));
                }
            }
            $condition = array();
            if(!empty($conditionName)){
                if(is_array($conditionName)){
                    $condition = null;
                }else{
					$condition = [$conditionName => $conditionValue];
                }

            }
            self::bindValues("select", $stmt, $condition, null);
            $stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_CLASS, get_called_class());

        }

        // mande somente uma coluna e o valor dela, pra eu procurar e mandar o objeto em contexto
		public function update($conditionName = 'id', $conditionValue = null){
			$conditionValue = ($conditionValue) ? $conditionValue : $this->getId();
            $connection = Connection::connect();
            $condition = [$conditionName => $conditionValue];
            $obj = self::objToArr($this);
			$obj = array_filter($obj, function($value) { return $value !== null; });
            $stmt = $connection->prepare(self::buildQuery("update", self::getTableName(), $obj, $condition));
			self::bindValues("update", $stmt, $obj, $condition);
            $stmt->execute();
        }

        public static function delete($condition){
            $connection = Connection::connect();
            $stmt = $connection->prepare(self::buildQuery("delete", self::getTableName(), null, $condition));
            self::bindValues("delete", $stmt, $condition, null);
            $stmt->execute();
        }
		public function deleteMultiple($col, $condition){
            $connection = Connection::connect();
            $stmt = $connection->prepare(self::buildQuery("delete", self::getTableName(), $col, $condition));
            self::bindValues("delete", $stmt, $condition, null);
            $stmt->execute();
        }

        //Deleta do banco a partir do id do usuario
        public static function deleteByUser($user){
            $connection = Connection::connect();
            $stmt = $connection->prepare("DELETE FROM ".self::getTableName()." WHERE user_id = :user_id");
            $stmt->BindValue(":user_id", $user, PDO::PARAM_INT);
            $stmt->execute();
        }


        protected static function objToArr($obj) {
            if (is_object($obj)) {
                $arr = (array)$obj;
                foreach ($arr as $key => $value) {
                    $newKey = self::processKey($key);
                    if ($key != $newKey) {
                        $arr[$newKey] = $value;
                        unset($arr[$key]);
                    }
                }
                unset($arr['id']);
                return $arr;
            }
            else {
                return $obj;
            }
        }

		public function returnArray() {
			return self::objToArr($this);
		}

        protected static function processKey($key) {
            $class = get_called_class();
            $fixPrivate = strlen($class) + 2;
            if (strpos($key, $class) !== false) {
                $key = substr($key, $fixPrivate);
            }
            else if (strpos($key, "*") !== false) {
                $key = substr($key, 3);
            }
            return $key;
        }



    }
