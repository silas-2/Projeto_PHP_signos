<?php
// Inclui o cabeçalho
include('layouts/header.php');
?>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-7">

            <?php
            // 1. VERIFICAÇÃO INICIAL
            // Checa se a data de nascimento foi realmente enviada pelo formulário
            if (isset($_POST['data_nascimento']) && !empty($_POST['data_nascimento'])) {
                
                // 2. RECEBIMENTO E PREPARAÇÃO DOS DADOS
                $data_nascimento_str = $_POST['data_nascimento']; // Ex: "1990-07-25"
                $signos_xml = simplexml_load_file("signos.xml");

                // 3. CONVERSÃO DA DATA DO USUÁRIO
                // Transforma a data de nascimento em um número fácil de comparar (MêsDia)
                // Ex: 25/07 vira 725. 10/11 vira 1110.
                $data_obj = new DateTime($data_nascimento_str);
                $dia_nasc = (int)$data_obj->format('d');
                $mes_nasc = (int)$data_obj->format('m');
                $data_nasc_num = ($mes_nasc * 100) + $dia_nasc;

                $signo_encontrado = null; // Variável para guardar o signo quando o encontrarmos

                // 4. LÓGICA PRINCIPAL: ITERAÇÃO E COMPARAÇÃO
                // Loop que passa por cada <signo> dentro do nosso XML
                foreach ($signos_xml->signo as $signo) {
                    
                    // Converte as datas de início e fim do XML para o mesmo formato numérico
                    list($dia_inicio, $mes_inicio) = explode('/', (string)$signo->dataInicio);
                    list($dia_fim, $mes_fim) = explode('/', (string)$signo->dataFim);

                    $data_inicio_num = ((int)$mes_inicio * 100) + (int)$dia_inicio;
                    $data_fim_num = ((int)$mes_fim * 100) + (int)$dia_fim;

                    // 5. A COMPARAÇÃO MÁGICA
                    
                    // Caso especial para Capricórnio (e outros que cruzam o ano, se houvesse)
                    // Onde a data de início (1222) é MAIOR que a data de fim (120)
                    if ($data_inicio_num > $data_fim_num) {
                        if ($data_nasc_num >= $data_inicio_num || $data_nasc_num <= $data_fim_num) {
                            $signo_encontrado = $signo;
                            break; // Encontrou o signo, para o loop!
                        }
                    } 
                    // Para todos os outros signos (onde início < fim)
                    else {
                        if ($data_nasc_num >= $data_inicio_num && $data_nasc_num <= $data_fim_num) {
                            $signo_encontrado = $signo;
                            break; // Encontrou o signo, para o loop!
                        }
                    }
                }

                // 6. EXIBIÇÃO DO RESULTADO
                if ($signo_encontrado) {
                    echo "<div class='card shadow-lg card-signo border-0' style='border-radius: 1rem;'>";
                    echo "<div class='card-header card-header-signo text-center p-3 bg-dark text-white'>";
                    echo "<h2 class='h4 mb-0'>Seu signo é " . htmlspecialchars($signo_encontrado->signoNome) . "!</h2>";
                    echo "</div>";
                    echo "<div class='card-body p-4'>";
                    echo "<h5 class='card-title text-muted'>Período: " . htmlspecialchars($signo_encontrado->dataInicio) . " a " . htmlspecialchars($signo_encontrado->dataFim) . "</h5>";
                    echo "<p class='card-text mt-3 fs-5'>" . htmlspecialchars($signo_encontrado->descricao) . "</p>";
                    echo "</div>";
                    echo "</div>";
                } else {
                    echo "<div class='alert alert-danger'>Não foi possível determinar o seu signo. Tente novamente.</div>";
                }

            } else {
                // Se alguém tentar acessar a página diretamente sem enviar o formulário
                echo "<div class='alert alert-warning'>Por favor, retorne à página inicial e insira uma data de nascimento.</div>";
            }
            ?>

            <div class="text-center mt-4">
                <a href="index.php" class="btn btn-secondary">← Voltar e consultar outra data</a>
            </div>
        </div>
    </div>
</main>

<footer class="text-center mt-auto py-3 text-muted">
     <p>&copy; <span id="currentYear"> - Atividade Prática</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>