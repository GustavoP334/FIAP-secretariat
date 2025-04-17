<div class="modal fade" id="modalClasses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalClassesLabel">Gerenciar Matrículas</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/matriculas/store" class="needs-validation" novalidate multiple id="formClasses">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-6">
                    <div class="input-group">
                        <span class="input-group-text" id="nomeHelp">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </span>
                        <input type="text" class="form-control" id="name" minlength="3" placeholder="Nome da turma" aria-label="Nome da turma" aria-describedby="nomeHelp" required readonly>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-center mb-3">
                <div class="col-sm-8">
                  <select name="selectStudent[]" id="selectStudent" placeholder="Adicionar um aluno..." multiple>
                    <?php foreach ($students as $student): ?>
                      <option value="<?= $student['id'] ?>"><?= $student['name'] . ' - ' . $student['document'] ?></option>
                    <?php endforeach ?>
                  </select>
                </div>
            </div>

            <table class="table table-bordered table-hover table-striped" id="registrationTable">
              <thead>
                  <tr>
                      <th scope="col">Aluno</th>
                      <th scope="col">Documento</th>
                      <th scope="col">Data da entrada na Turma</th>
                      <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
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
      <form action="/matriculas/" method="POST" id="deleteForm">
        <input type="hidden" name="_method" value="DELETE">
        <div class="row d-flex justify-content-center">
            <div class="col-sm-6">
                <h4>Confirma a exclusão da matrícula do aluno?</h4>
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
            <form action="/turmas" method="GET">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Buscar turma pelo nome" value="<?= isset($_GET['search']) ? $_GET['search'] : '' ?>">
                    <button class="btn btn-primary" type="submit">Buscar</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Turma</th>
                <th scope="col">Alunos na turma</th>
                <th scope="col">Data Criação da Turma</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($data)): ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhuma Matrícula cadastrada</td>
                </tr>
            <?php else: ?>
                <?php foreach ($data as $value): ?>
                    <tr>
                        <?php foreach ($value as $key => $class): ?>
                          <?php if ($key !== "students"): ?>
                            <td <?= $key == 'id' ? 'scope="row"' : '' ?> title="<?= $class ?>">
                                <?= $key == 'created_at' ? date('d/m/Y h:m', strtotime($class)) : $class ?>
                            </td>
                          <?php endif ?>
                        <?php endforeach ?>

                        <td <?= $key == 'id' ? 'scope="row"' : '' ?>>
                            <button type="button" class="btn btn-primary" data-bs-data='<?= json_encode($value, JSON_HEX_APOS | JSON_HEX_QUOT) ?>' data-bs-toggle="modal" data-bs-target="#modalClasses">
                                <i class="fa-solid fa-plus"></i>
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
