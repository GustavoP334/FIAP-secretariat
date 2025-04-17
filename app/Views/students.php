<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAluno">
  Cadastrar
</button>

<div class="modal fade" id="modalAluno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAlunoLabel">Gerenciar Aluno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/alunos/store" class="needs-validation" novalidate id="formAluno">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text" id="nomeHelp">
                            <i class="fa-solid fa-user"></i>
                        </span>
                        <input type="text" class="form-control" name="name" id="name" minlength="3" placeholder="Nome" aria-label="Nome" aria-describedby="nomeHelp" required>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="input-group">
                        <span class="input-group-text" id="documentHelp">
                            <i class="fa-solid fa-id-card"></i>
                        </span>
                        <input type="text" class="form-control" name="document" id="document" minlength="14" maxlength="14" onchange="onCpfKeyUp(this); maskCpf(this)" onkeyup="onCpfKeyUp(this); maskCpf(this)" placeholder="Documento" aria-label="Documento" aria-describedby="documentHelp" required>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-6">
                    <label for="birth_date" class="form-label">Data de Nascimento</label>
                    <div class="input-group">
                        <span class="input-group-text" id="birthHelp">
                            <i class="fa-solid fa-calendar"></i>
                        </span>
                        <input type="date" class="form-control" name="birth_date" id="birth_date" max="<?= date('Y-m-d') ?>" placeholder="Data de Nascimento" aria-label="Data de Nascimento" aria-describedby="birthHelp" required>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text" id="emailHelp">
                            <i class="fa-solid fa-envelope"></i>
                        </span>
                        <input type="text" class="form-control" name="email" id="email" placeholder="E-mail" aria-label="E-mail" aria-describedby="emailHelp" required>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="input-group">
                        <span class="input-group-text" id="passwordHelp">
                            <i class="fa-solid fa-key"></i>
                        </span>
                        <input type="password" name="password" id="password" onkeyup="validarSenha(this.value)"  class="form-control" aria-describedby="passwordHelp" minlength="11" placeholder="Senha" aria-label="Senha" required>
                        <div id="passwordHelp" class="form-text">
                            A senha precisa ter no mínimo <span id="8caracteres">8 caracteres</span>, conter <span id="maiuscula">letras maiúsculas</span> e <span id="minusculas">letras minúsculas</span>, <span id="numeros">números</span> e <span id="simbolos">símbolos</span>.
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="modalDeletar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalDeletaAlunoLabel">Deletar Aluno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/alunos/" method="POST" id="deleteForm">
        <input type="hidden" name="_method" value="DELETE">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <h4>Confirma a exclusão do aluno?</h4>
            </div>
        </div>
        <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Não</button>
            <button type="submit" class="btn btn-danger">Sim</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="m-2">
    <div class="row d-flex justify-content-end mb-2">
        <div class="col-sm-3">
            <form action="/alunos" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar pelo nome do aluno" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">E-mail</th>
                <th scope="col">Documento</th>
                <th scope="col">Data de Nascimento</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum aluno cadastrado</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $value): ?>
                    <tr>
                        <?php foreach ($value as $key => $student): ?>
                            <td <?= $key == 'id' ? 'scope="row"' : '' ?> title="<?= $student ?>">
                                <?= $key == 'birth_date' ? date('d/m/Y', strtotime($student)) : $student ?>
                            </td>
                        <?php endforeach ?>

                        <td <?= $key == 'id' ? 'scope="row"' : '' ?>>
                            <button type="button" class="btn btn-primary" data-bs-data='<?= json_encode($value, JSON_HEX_APOS | JSON_HEX_QUOT) ?>' data-bs-toggle="modal" data-bs-target="#modalAluno">
                                <i class="fa-solid fa-pen"></i>
                            </button>
                            
                            <button type="button" class="btn btn-danger" data-bs-id="<?= $value['id'] ?>" data-bs-toggle="modal" data-bs-target="#modalDeletar">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach ?>
            <?php endif; ?>
        </tbody>
    </table>
    
    <?php 
        $search = $_GET['search'] ?? ''; 
        $currentPage = (int) ($_GET['page'] ?? 1);
    ?>

    <div class="d-flex justify-content-center">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php for ($i = 1; $i <= ceil($paginate / $perPage); $i++): ?>
                    <li class="page-item">
                        <a class="page-link <?= ($i === $currentPage) ? 'active' : '' ?>" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                <?php endfor ?>
            </ul>
        </nav>
    </div>

</div>
