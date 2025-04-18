<div class="container-fluid">
    <div class="text-center mb-4">
      <img src="/storage/img/logo.jpg" width="120" height="74" class="d-inline-block align-text-top">
        <h4 class="mt-2">Acesso ao Sistema</h4>
    </div>
    <form method="post" action="/login">
      <div class="mb-3 text-start">
        <label for="email" class="form-label">E-mail</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-envelope"></i></span>
          <input type="email" class="form-control" name="email" id="email" placeholder="Digite seu e-mail" required />
        </div>
      </div>
      <div class="mb-5 text-start">
        <label for="password" class="form-label">Senha</label>
        <div class="input-group">
          <span class="input-group-text"><i class="fas fa-lock"></i></span>
          <input type="password" class="form-control" name="password" id="password" placeholder="Digite sua senha" required />
        </div>
      </div>
      <button type="submit" class="btn btn-login w-100 bg-primary-subtle">Entrar</button>
    </form>
</div>