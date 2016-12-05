<?php
class ControllerCommonTest extends Controller {
	
	public function db() {
		echo '<pre>';
		
		$result = DB::table('product')->find([28, 29])->get();
		
		print_r($result);
		
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function index() {
		// 8 - Шафа
		// 9 - Ліжко
		// 14 - круглий металевий стіл
		// 17 - Круглий металевий стіл на трьох ніжках
		// 18 - Круглий металевий стіл на чотирьох ніжках
		// 25 - Iphone 5s
		// 27 - Ракета 2000
		
		echo '<pre>';
		
		$query = $this->db->multiQuery("CALL get_tree(27)");
		print_r($query->rows);
		
		echo '</pre>';
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	public function refreshProcedure() {
		$query = $this->db->query("DROP PROCEDURE IF EXISTS get_tree");
		
		$query = $this->db->query("
			CREATE PROCEDURE get_tree(IN current_id INT)
			BEGIN
				CREATE TEMPORARY TABLE IF NOT EXISTS temp_table AS (SELECT * FROM oc_test WHERE 1=0);
				REPEAT
					INSERT INTO temp_table SELECT * FROM oc_test WHERE id=current_id;
					SELECT parent_id INTO current_id FROM oc_test WHERE id=current_id;
				UNTIL current_id = 0
				END REPEAT;
				SELECT name FROM temp_table;
				DROP TABLE temp_table;
			END
		");
	}

}
