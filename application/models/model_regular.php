<?php
class Model_Regular extends Model
{
	public function get_data()
	{
		// echo $_POST['input_text'];

		$stmt = $this->db->prepare("SELECT `goods`.`mark`, `goods`.`model`, `characteristics`.`width`, `characteristics`.`height`, `characteristics`.`construction`, `characteristics`.`diameter`, `characteristics`.`load_index`, `characteristics`.`rate_index`, `characteristics`.`abbreviations`, `characteristics`.`run_flat`, `characteristics`.`chamberiness`, `characteristics`.`season`
			FROM `goods`
			INNER JOIN `characteristics` ON `goods`.`id` = `characteristics`.`id_product`");
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$result['data'][] = $row;
				}
		}
		return $result;
	}

	public function insert_data()
	{
		$text = explode ("\r\n",trim($_POST['input_text']));
		$mask = '/(\w+\40)(.+)(\40[\d]{3})(\/)([\d]{2})([A-Za-z]{1})([\d]{2}\40)([\d]{3}\/[\d]{3}|[\d]{2,3})([A-Za-z]{1}\40)(.*\40|)(RunFlat\40.*\40|Run\40Flat\40.*\40|ROF\40.*\40|ZP\40.*\40|SSR\40.*\40|ZPS\40.*\40|HRS\40.*\40|RFT\40.*\40|)(ТТ\40|TL\40|TL\/TT\40|)(Зимние\40\(шипованные\)|Внедорожные|Летние|Зимние\40\(нешипованные\)|Всесезонные)/';
		$i = 0;
		foreach ($text as $key => $value) {
			preg_match($mask, $value, $matches);
			
			if (isset($matches[0])) {
				if (preg_match('/(.*ТТ.*|.*TL.*|.*TL\/TT.*)/', $matches[10])) {
					if (preg_match('/(.*)(\40ТТ\40|\40TL\40|\40TL\/TT\40)/', $matches[10], $tmp_matches)) {

						if ($tmp_matches[1] != "")$matches[10] = $tmp_matches[1];
						if ($tmp_matches[2] != "")$matches[12] = $tmp_matches[2];

						
					}
					else{
						$matches[12] = $matches[10];
						$matches[10] = "";
					}
				}

				if (preg_match('/(.*RunFlat.*|.*Run\40Flat.*|.*ROF.*|.*ZP.*|.*SSR.*|.*ZPS.*|.*HRS.*|.*RFT.*)/', $matches[10])) {
					preg_match('/(.*)(.?RunFlat.*|.?Run\40Flat.*|.?ROF.*|.?ZP.*|.?SSR.*|.?ZPS.*|.?HRS.*|.?RFT.*)/', $matches[10], $tmp_matches);
					if ($tmp_matches[2] != ""){
						$matches[10] = $tmp_matches[1];
						$matches[11] = $tmp_matches[2];
					}
				}

				if (preg_match('/(.*ТТ.*|.*TL.*|.*TL\/TT.*)/', $matches[11])) {
					preg_match('/(.*)(\40ТТ\40|\40TL\40|\40TL\/TT\40)/', $matches[11], $tmp_matches);
					if ($tmp_matches[1] != "")$matches[11] = $tmp_matches[1];
					if ($tmp_matches[2] != "")$matches[12] = $tmp_matches[2];
				}

				$result[$i] = $matches;

			}
			else{
				$error[] = $value;
			}

			$i++;
				
		}

		
		
		if (is_array($result)) {
			foreach ($result as $key => $value) {
				$result[$key] = array_map('trim', $result[$key]);
				unset($result[$key][0]);
				unset($result[$key][4]);
				$result[$key] = array_values($result[$key]);
				// print_r($result[$key]);

				$stmt = $this->db->prepare("SELECT `goods`.`mark`, `goods`.`model`, `characteristics`.`width`, `characteristics`.`height`, `characteristics`.`construction`, `characteristics`.`diameter`, `characteristics`.`load_index`, `characteristics`.`rate_index`, `characteristics`.`abbreviations`, `characteristics`.`run_flat`, `characteristics`.`chamberiness`, `characteristics`.`season`
				FROM `goods`
				INNER JOIN `characteristics` ON `goods`.`id` = `characteristics`.`id_product`
				WHERE `goods`.`mark` = ? 
				AND `goods`.`model` = ?
				AND `characteristics`.`width` = ?
				AND `characteristics`.`height` = ?
				AND `characteristics`.`construction` = ?
				AND `characteristics`.`diameter` = ?
				AND `characteristics`.`load_index` = ?
				AND `characteristics`.`rate_index` = ?
				AND `characteristics`.`abbreviations` = ?
				AND `characteristics`.`run_flat` = ?
				AND `characteristics`.`chamberiness` = ?
				AND `characteristics`.`season` = ?");
				$stmt->execute($result[$key]);
				
				if ($stmt->rowCount() > 0) {
					// echo $stmt->rowCount();
				}
				else{
					$stmt = $this->db->prepare("
						INSERT INTO `goods` (`mark`, `model`) VALUES (:mark, :model);
						SET @last_id = LAST_INSERT_ID();
						INSERT INTO `characteristics` (`id_product`, `width`, `height`, `construction`, `diameter`, `load_index`, `rate_index`, `abbreviations`, `run_flat`, `chamberiness`, `season`) VALUES (@last_id, :width, :height, :construction, :diameter, :load_index, :rate_index, :abbreviations, :run_flat, :chamberiness, :season);");

					$stmt->bindParam(':mark', $mark);
					$stmt->bindParam(':model', $model);
					$stmt->bindParam(':width', $width);
					$stmt->bindParam(':height', $height);
					$stmt->bindParam(':construction', $construction);
					$stmt->bindParam(':diameter', $diameter);
					$stmt->bindParam(':load_index', $load_index);
					$stmt->bindParam(':rate_index', $rate_index);
					$stmt->bindParam(':abbreviations', $abbreviations);
					$stmt->bindParam(':run_flat', $run_flat);
					$stmt->bindParam(':chamberiness', $chamberiness);
					$stmt->bindParam(':season', $season);

					
					$mark			= $result[$key][0];
					$model 			= $result[$key][1];
					$width			= $result[$key][2];
					$height			= $result[$key][3];
					$construction	= $result[$key][4];
					$diameter		= $result[$key][5];
					$load_index		= $result[$key][6];
					$rate_index		= $result[$key][7];
					$abbreviations	= $result[$key][8];
					$run_flat		= $result[$key][9];
					$chamberiness	= $result[$key][10];
					$season			= $result[$key][11];
					$stmt->execute();
				}

			}
		}

		$stmt = $this->db->prepare("SELECT `goods`.`mark`, `goods`.`model`, `characteristics`.`width`, `characteristics`.`height`, `characteristics`.`construction`, `characteristics`.`diameter`, `characteristics`.`load_index`, `characteristics`.`rate_index`, `characteristics`.`abbreviations`, `characteristics`.`run_flat`, `characteristics`.`chamberiness`, `characteristics`.`season`
			FROM `goods`
			INNER JOIN `characteristics` ON `goods`.`id` = `characteristics`.`id_product`");
			if ($stmt->execute()) {
				while ($row = $stmt->fetch()) {
					$res['data'][] = $row;
				}
			}

		
		$res['err'] = $error;
		return $res;
	}
}
