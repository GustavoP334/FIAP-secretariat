## Sobre
Projeto desenvolvido em **PHP** com funcionalidades para administração de **alunos** e **turmas**.

---

## ✨ Funcionalidades

- 👨‍🎓 Gerenciamento de Alunos  
- 🏫 Gerenciamento de Turmas  

---

## 🛠️ Tecnologias Utilizadas

### Backend
- PHP (versão 7.4)

### Frontend
- [Bootstrap](https://getbootstrap.com/) – Framework CSS para design responsivo e componentes visuais prontos
- [DataTables](https://datatables.net/) – Exibição dinâmica e interativa de tabelas
- [Selectize.js](https://selectize.github.io/selectize.js/) – Inputs de seleção com busca e múltiplas opções

---

## ⚙️ Instalação

#### 1. Baixar as dependências do projeto
```bash
  composer install
```
#### 2. Copiar o arquivo `.env.example` e renomear para `.env`

#### 3. Atualizar as variáveis de ambiente no arquivo `.env`

#### 4. Executar os scripts SQL que estão no arquivo `dump.sql`, para criar as tabelas no banco de dados

#### 5. Inicializar o projeto
```bash
  php -S 0.0.0.0:8000 router.php
```

#### 6. Acessar o projeto
```bash
  http://localhost:8000/inicio
```

---

## 👤 Acesso ao Sistema
Para acessar o sistema, utilize o seguinte usuário padrão:

🔐 Login: 
```bash
  admin@admin.com  
```
🔑 Senha: 
```bash
  Senha@Admin12
```

⚠️ Esses dados estarão cadastrados no banco por padrão após importar o dump.sql.