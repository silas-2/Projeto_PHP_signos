<?php
$data = $_POST['data_nascimento'] ?? null;

function descobrirSigno($data) {
    $dia = (int)date('d', strtotime($data));
    $mes = (int)date('m', strtotime($data));

    $signos = [
        ['nome' => 'aquario',     'inicio' => [1, 20],  'fim' => [2, 18]],
        ['nome' => 'peixes',      'inicio' => [2, 19],  'fim' => [3, 20]],
        ['nome' => 'aries',       'inicio' => [3, 21],  'fim' => [4, 19]],
        ['nome' => 'touro',       'inicio' => [4, 20],  'fim' => [5, 20]],
        ['nome' => 'gemeos',      'inicio' => [5, 21],  'fim' => [6, 20]],
        ['nome' => 'cancer',      'inicio' => [6, 21],  'fim' => [7, 22]],
        ['nome' => 'leao',        'inicio' => [7, 23],  'fim' => [8, 22]],
        ['nome' => 'virgem',      'inicio' => [8, 23],  'fim' => [9, 22]],
        ['nome' => 'libra',       'inicio' => [9, 23],  'fim' => [10, 22]],
        ['nome' => 'escorpiao',   'inicio' => [10, 23], 'fim' => [11, 21]],
        ['nome' => 'sagitario',   'inicio' => [11, 22], 'fim' => [12, 21]],
        ['nome' => 'capricornio', 'inicio' => [12, 22], 'fim' => [1, 19]],
    ];

    foreach ($signos as $signo) {
        [$mesInicio, $diaInicio] = $signo['inicio'];
        [$mesFim, $diaFim] = $signo['fim'];

        if (
            ($mes == $mesInicio && $dia >= $diaInicio) ||
            ($mes == $mesFim && $dia <= $diaFim)
        ) {
            return $signo['nome'];
        }
    }

    return 'desconhecido';
}

$signo = descobrirSigno($data);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Seu Signo</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <main class="container text-center mt-5">
        <h1>Seu signo é: <span style="text-transform: capitalize;"><?php echo $signo; ?></span></h1>
        <img src="CSS/imgs/svg/<?php echo $signo; ?>.svg" alt="<?php echo $signo; ?>" class="signo-img mt-3">
        <p class="mt-4 text-muted">
            <?php
            $descricao = [
                'aries' => 'Áries é impulsivo, corajoso e cheio de energia.',
                'touro' => 'Touro é estável, confiável e aprecia conforto.',
                'gemeos' => 'Gêmeos é comunicativo, curioso e versátil.',
                'cancer' => 'Câncer é sensível, protetor e emocional.',
                'leao' => 'Leão é confiante, generoso e adora brilhar.',
                'virgem' => 'Virgem é detalhista, prático e organizado.',
                'libra' => 'Libra é diplomático, sociável e busca equilíbrio.',
                'escorpiao' => 'Escorpião é intenso, misterioso e apaixonado.',
                'sagitario' => 'Sagitário é aventureiro, otimista e filosófico.',
                'capricornio' => 'Capricórnio é disciplinado, ambicioso e responsável.',
                'aquario' => 'Aquário é inovador, independente e visionário.',
                'peixes' => 'Peixes é sonhador, empático e artístico.',
            ];

            echo $descricao[$signo] ?? 'Signo não identificado.';
            ?>
        </p>
        <a href="index.php" class="btn btn-secondary mt-4">Consultar outro signo</a>
    </main>
</body>
</html>