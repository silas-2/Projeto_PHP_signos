<?php
// 1. Inclusão do cabeçalho
// Esta linha carrega o arquivo header.php, que contém o topo do nosso HTML.
include('layouts/header.php');
?>

<main class="container my-auto">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-5">
            <div class="card p-4 shadow-lg border-0" style="border-radius: 1rem;">
                <div class="card-body">
                    <h1 class="text-center mb-3">Descubra seu Signo</h1>
                    <p class="text-center text-muted mb-4">Insira sua data de nascimento para revelarmos o seu signo zodiacal.</p>
                    
                    <form method="POST" action="show_zodiac_sign.php">
                        <div class="mb-3">
                            <label for="data_nascimento" class="form-label fw-bold">Data de Nascimento:</label>
                            <input type="date" class="form-control form-control-lg" id="data_nascimento" name="data_nascimento" required>
                        </div>
                        <div class="d-grid mt-4">
                             <button type="submit" class="btn btn-primary btn-lg">Consultar</button>
                        </div>
                    </form>
                </div>
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