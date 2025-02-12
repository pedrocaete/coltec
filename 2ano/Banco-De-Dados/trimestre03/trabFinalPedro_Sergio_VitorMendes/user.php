<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

session_start();

require 'DAO/userDAO.php'; // Substitua pelo seu arquivo de conexão ao banco de dados
$userDAO = new UserDAO();

$user = $userDAO->getUser(1);

$_SESSION['user'] = $user;

?>

<?php include 'includes/header.php'; ?>

<body>

    <!-- Single Page Header start -->
    <div class="container-fluid page-header py-5">
        <h1 class="text-center text-white display-6">User</h1>
        <ol class="breadcrumb justify-content-center mb-0">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="#">Pages</a></li>
            <li class="breadcrumb-item active text-white">User</li>
        </ol>
    </div>
    <!-- Single Page Header End -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            <h2 class="mb-4">Perfil do Usuário</h2>
            <form method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($user['nome']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" value="<?= htmlspecialchars($user['telefone']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" value="<?= htmlspecialchars($user['cpf']) ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                    <input type="date" class="form-control" id="data_nascimento" value="<?= htmlspecialchars($user['data_nascimento']) ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="genero" class="form-label">Gênero</label>
                    <input type="text" class="form-control" id="genero" value="<?= htmlspecialchars($user['genero']) ?>" disabled>
                </div>
                <div class="mb-3">
                    <label for="endereco" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="endereco" name="endereco" value="<?= htmlspecialchars($user['endereco']) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="acesso" class="form-label">Tipo de Acesso</label>
                    <input type="text" class="form-control" id="acesso" value="<?= htmlspecialchars($user['acesso']) ?>" disabled>
                </div>

                <?php if ($user['acesso'] === 'funcionario'): ?>
                    <div class="mb-3">
                        <label for="salario" class="form-label">Salário</label>
                        <input type="text" class="form-control" id="salario" value="<?= htmlspecialchars($user['salario']) ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="setor" class="form-label">Setor</label>
                        <input type="text" class="form-control" id="setor" value="<?= htmlspecialchars($user['setor']) ?>" disabled>
                    </div>
                <?php endif; ?>

                <button type="submit" class="btn btn-primary" style="color:#fff;">Salvar Alterações</button>
            </form>
        </div>
    </div>

    <?php include 'includes/footer.php'; ?>
</body>