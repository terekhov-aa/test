
<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<h3>Схема БД</h3>
			<img src="/imges/db.png">
			<h3>Запрос</h3>
			<p>
				SELECT  `projects`.`name` AS project, COUNT(  `workers`.`name` ) AS count
				FROM  `involved_workers` 
				INNER JOIN  `projects` ON  `involved_workers`.`id_project` =  `projects`.`id` 
				INNER JOIN  `workers` ON  `involved_workers`.`id_worker` =  `workers`.`id` 
				WHERE  `workers`.`status` =  'proger'
				GROUP BY  `projects`.`name` 
				HAVING COUNT(  `involved_workers`.`id_project` ) >=  '3'
			</p>
		</div>
		<div class="col-md-6">
				<table class="table table-striped">
					<thead>
						<tr>
							<th>
								#
							</th>
							<th>
								проект 
							</th>
							<th>
								кол-во сотрудников 
							</th>
						</tr>
					</thead>
					<tbody>
					<?php if (is_array($data))foreach ($data as $key => $value): ?>
						<tr>
							<td>
								<?=$key?>
							</td>
							<td>
								<?=$value['project']?>
							</td>
							<td>
								<?=$value['count']?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
	</div>
</div>