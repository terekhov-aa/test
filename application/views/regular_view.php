<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">

		<?
			if (isset($data['err'])) {
				echo "<h3>Следующие строки оказались невалидными, внесите изменения и загрузите их снова</h3>";
				?><pre><?print_r($data['err']);?></pre><?
			}
		?>
		

			<form role="form" action="/main/index" method="POST">
				<div class="form-group"> 
					<label for="input_text">
						Введите текст сюда
					</label>
					 <textarea class="form-control" rows="5" id="input_text" name="input_text"></textarea>
				</div>
				<button type="submit" class="btn btn-default" name="submit">
					Отправить
				</button>
			</form>
		</div>
		<div class="col-md-6">
			<table class="table">
				<thead>
					<tr>
						<th>
							#
						</th>
						<th>
							бренд 
						</th>
						<th>
							модель 
						</th>
						<th>
							ширина 
						</th>
						<th>
							высота 
						</th>
						<th>
							конструкция 
						</th>
						<th>
							диаметр 
						</th>
						<th>
							индекс нагрузки
						</th>
						<th>
							индекс скорости
						</th>
						<th>
							характеризующие аббревиатуры
						</th>
						<th>
							ранфлэт
						</th>
						<th>
							камерность
						</th>
						<th>
							сезон 
						</th>
					</tr>
				</thead>
				<tbody>
				<?php if (is_array($data['data']))foreach($data['data'] as $key=>$value): ?>
					<tr>
						<td>
							<?=$key?>
						</td>
						<td>
							<?=$value['mark']?>
						</td>
						<td>
							<?=$value['model']?>
						</td>
						<td>
							<?=$value['width']?>
						</td>
						<td>
							<?=$value['height']?>
						</td>
						<td>
							<?=$value['construction']?>
						</td>
						<td>
							<?=$value['diameter']?>
						</td>
						<td>
							<?=$value['load_index']?>
						</td>
						<td>
							<?=$value['rate_index']?>
						</td>
						<td>
							<?=$value['abbreviations']?>
						</td>
						<td>
							<?=$value['run_flat']?>
						</td>
						<td>
							<?=$value['chamberiness']?>
						</td>
						<td>
							<?=$value['season']?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>