<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="utf-8">
	<title>Главная</title>
	<link rel="stylesheet" type="text/css" href="/css/bootstrap.min.css">

	<script type="text/javascript" src="/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ul class="nav nav-tabs">
				<li class="<?if ($active == "main" && isset($active))echo "active"?>">
					<a href="/main">Банер</a>
				</li>
				<li class="<?if ($active == "query" && isset($active))echo "active"?>">
					<a href="/query">Запрос</a>
				</li>
				<li class="<?if ($active == "regular" && isset($active))echo "active"?>">
					<a href="/regular">Регулярка</a>
				</li>
			</ul>
		</div>
	</div>
</div>
	<?php include 'application/views/'.$content_view; ?>
</body>
</html>