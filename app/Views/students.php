<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalAluno">
  Cadastrar
</button>

<div class="modal fade" id="modalAluno" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="modalAlunoLabel">Cadastrar Aluno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST" action="/alunos/store" class="needs-validation" novalidate>
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
                        <input type="text" class="form-control" name="document" id="document" minlength="14" maxlength="14" onkeyup="onCpfKeyUp(this); aplicarMascaraCPF(this)" placeholder="Documento" aria-label="Documento" aria-describedby="documentHelp" required>
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