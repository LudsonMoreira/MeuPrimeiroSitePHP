<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agenda Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Betania+Patmos&display=swap" rel="stylesheet">
    <style>
        .betania-patmos-regular {
            font-family: "Betania Patmos", cursive;
            font-weight: 400;
            font-style: normal;
        }

        body {
            background: #2A7B9B;
            background: linear-gradient(90deg, rgba(42, 123, 155, 1) 0%, rgba(87, 199, 133, 1) 50%, rgba(237, 221, 83, 1) 100%);
            background-color: #f723a2;
            padding: 1em;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php
		date_default_timezone_set('America/Sao_Paulo');
		$arquivo = "agenda.json";
		$tarefas = json_decode(file_get_contents($arquivo), true);

		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$nova_tarefa = $_POST["tarefa"];
			$tarefas[] = [
				"tarefa" => $nova_tarefa,
				"data" => date("d/m/Y H:i:s")
			];
		}

		file_put_contents($arquivo, json_encode($tarefas, JSON_PRETTY_PRINT));
		$tarefas = json_decode(file_get_contents($arquivo), true);
	?>

    <h1 class="betania-patmos-regular"><strong>Minha Lista de Tarefas</strong></h1>
    <h2 class="betania-patmos-regular">Hoje é dia
        <?php echo date('d/m/Y'); ?>
    </h2>
    <h2 class="betania-patmos-regular">Agora são
        <?php echo date('H:i:s'); ?>
    </h2>

    <br />

    <div class="card" style="width: 18rem;" class="d-flex flex-column mb-3">
        <img src="work.jpg" class="card-img-top" alt="...">
        <div class="card-body" class="d-flex flex-column mb-3">
            <h5 class="betania-patmos-regular card-title d-flex flex-column mb-3">Tarefa</h5>
            <form method="post" action="" class="d-flex flex-column mb-3">
                <div class="mb-3">
                    <input type="text" class="form-control" id="tarefa" name="tarefa">
                </div>
                <button type="submit" class="btn btn-primary mb-3">Salvar</button>
            </form>
        </div>
    </div>

    <br />

    <h2 class="betania-patmos-regular">Para hoje temos: </h2>
    <?php
        foreach ($tarefas as $item):
    ?>
    <ul>
        <li><?php echo htmlspecialchars($item["tarefa"]); ?></li>
    </ul>
    <?php endforeach; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>
</body>

</html>