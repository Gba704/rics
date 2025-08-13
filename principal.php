<?php
include './backend/conexao.php';
include './backend/validacao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
  <link rel="stylesheet" href="estilo.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notyf/3.5.0/notyf.min.js" integrity="sha512-aHV4XrWccxFPcqcV1MPkCVjKAunNLGJ/18RIeGVIIb70LbqxL3PMQsoC1Bu78CcwTE5lPx1GR2zNw6KX0bXQMw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>

<?php
    //se existir uma requisição get ERRO e se ERRO = 1
    if(isset($_GET['mensagem'])){
      echo "<script>
        var notyf = new Notyf();
        notyf.error('Login e senha invalida ');
      </script>";
    }
    ?>

  <nav class="navbar navbar-expand-lg bg-primary navbar-dark navegacao">
    <div class="container-fluid">
      <a class="navbar-brand" href="#"> <i class="fa-solid fa-handshake"></i> R.I.C.S </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              opções
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Action</a></li>
              <li><a class="dropdown-item" href="#">Another action</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" />
          <button class="btn btn-outline-light " type="submit"> <i class="fa-solid fa-magnifying-glass"></i> </button>
          <a href="./backend/sair.php" class="btn btn-outline-light ms-2"> <i class="fa-solid fa-right-from-bracket"></i> </a>
        </form>


      </div>
    </div>
  </nav>

  <div class="container-fluid">

    <div class="row">

      <div class="col-2 menu">
        <ul class="menu">
          <p style="color:white;">
            Bem vindo(a) <?php  echo $_SESSION['usuario'];?>
          </p>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-user"></i> Usuário </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-location-dot"></i> Regiões </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-house"></i> Cidades </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-user-tie"></i> Pontos Focais </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-graduation-cap"></i> Áreas </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-money-bill-wave"></i> Efetuar Venda </a> </li>
          <li> <a href="#" class="menu-item"> <i class="fa-solid fa-magnifying-glass"></i> Pesquisar Vendas </a> </li>
        </ul>
      </div>

      <div class="col-5">
        <h1>Cadrasto</h1>

        <form action="./backend/usuario/inserir.php" method="post">
          <div class="mb-3">
            <label class="form-label">NOME</label>
            <input name="nome" type="text" class="form-control">
          </div>

          <div class="mb-3">
            <label class="form-label">EMAIL</label>
            <input name="email" type="email" class="form-control">
          </div>

            <div class="mb-3">
              <label class="form-label">CPF</label>
              <input name="cpf" type="text" class="form-control cpf">
            </div>

            <div class="mb-3">
              <label class="form-label">Senha</label>
              <div class="input-group">
                <input name="senha" type="password" class="form-control" id="senha" autocomplete="new-passwoed">
                <span onclick="visualizar()" style="cursor: pointer;" class="input-group-text">
                  <i id="olho" class="fa-solid fa-eye"></i>
                </span>
              </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
      </div>

 

    <div class="col-5">
      <h1> Listagem</h1>

      <table id="tabela" class="table">
        <thead class="table-primary">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">E-mail</th>
            <th scope="col">Senha</th> 
            <th scope="col">cpf</th>
            <th scope="col">opcoes</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $sql = "SELECT * FROM usuario";
          //executar o comando
          $dados = mysqli_query($conexao, $sql);
          //percorrer todos os registros do banco 
          while($coluna = mysqli_fetch_assoc($dados)){
            ?>
          
          <tr>
            <th scope="row"><?php echo $coluna['id'] ?></th>
            <td><?php echo $coluna ['nome'] ?></td>
            <td><?php echo $coluna ['email'] ?></td>
            <td><?php echo $coluna ['senha'] ?></td>
            <td><?php echo $coluna ['cpf'] ?></td>
            <td> 
                <a href="#"><i class="fa-solid fa-pen-to-square me-3" style="color: blue;"></i></a>  
                <a href="<?php echo"./backend/usuario/excluir.php?id=".$coluna['id']?>" onclick="return confirm('Deseja realmente excluir?')"><i class="fa-solid fa-trash ms-2" style="color: #ff0000;"></i></a>  
              </td>
          </tr>
            <?php } ?>
        </tbody>
      </table>
    </div>

  </div>

  </div>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ndDqU0Gzau9qJ1lfW4pNLlhNTkCfHzAVBReH9diLvGRem5+R9g2FzA8ZGN954O5Q"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"
    integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="script.js"></script>

</body>

</html>