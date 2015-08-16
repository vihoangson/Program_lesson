<?php
	class My_sqlite extends SQLite3{
		public function __construct()
		{
			define("PATH_UPLOAD", $_SERVER["DOCUMENT_ROOT"]."/Lesson_2/db/");
			$this->open(PATH_UPLOAD.'lesson_2.db.sqlites');
		}

		public function fetchAll($result){
			while($row = $result->fetchArray(SQLITE3_ASSOC)){
				$return[]=$row;
			}
			return $return;
		}

	}
