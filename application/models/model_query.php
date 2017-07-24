<?php
class Model_Query extends Model
{
	public function get_data()
	{
		$stmt = $this->db->prepare("
			SELECT  `projects`.`name` AS project, COUNT(  `workers`.`name` ) AS count
			FROM  `involved_workers` 
			INNER JOIN  `projects` ON  `involved_workers`.`id_project` =  `projects`.`id` 
			INNER JOIN  `workers` ON  `involved_workers`.`id_worker` =  `workers`.`id` 
			WHERE  `workers`.`status` =  'proger'
			GROUP BY  `projects`.`name` 
			HAVING COUNT(  `involved_workers`.`id_project` ) >=  '3'
			");
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$result[] = $row;
				}
		}
		return $result;
	}
}