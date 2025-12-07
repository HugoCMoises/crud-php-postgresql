# 🛒 Sistema de Gerenciamento de Produtos (CRUD)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=for-the-badge&logo=postgresql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![XAMPP](https://img.shields.io/badge/XAMPP-F37623?style=for-the-badge&logo=xampp&logoColor=white)
![Git](https://img.shields.io/badge/GIT-E44C30?style=for-the-badge&logo=git&logoColor=white)

![Status](https://img.shields.io/badge/STATUS-CONCLUÍDO-brightgreen?style=for-the-badge)
![License](https://img.shields.io/badge/LICENSE-MIT-yellow?style=for-the-badge)

Este projeto é um sistema **CRUD** (Create, Read, Update, Delete) desenvolvido em **PHP** puro, utilizando **PostgreSQL** como banco de dados.

O objetivo principal foi aplicar conceitos de **Orientação a Objetos**, arquitetura **MVC simplificada**, organização de arquivos e segurança contra **SQL Injection**.

---

## ⚙️ Funcionalidades

- ✅ **Listagem:** Visualização de todos os produtos cadastrados em uma tabela organizada.
- ✅ **Cadastro:** Inserção de novos produtos com validação de campos (backend).
- ✅ **Edição:** Atualização de nome e preço de produtos existentes.
- ✅ **Exclusão:** Remoção de produtos com confirmação de segurança via JavaScript.
- 🔒 **Segurança:** Uso de *Prepared Statements* (PDO) para prevenir SQL Injection e *Sanitization* para prevenir XSS.

---

## 📂 Estrutura do Projeto

O projeto foi organizado para separar responsabilidades e facilitar a manutenção:

```text
/projeto
│
├── /assets        # Arquivos CSS (Estilos)
├── /config        # Configuração de conexão com o banco
├── /includes      # Cabeçalho e Rodapé reutilizáveis (Templates)
├── /src           # Classes e Lógica de Negócio (Model)
│
├── index.php      # Listagem (Home)
├── create.php     # Controlador de Criação
├── update.php     # Controlador de Edição
└── delete.php     # Controlador de Exclusão

🔧 Como rodar o projeto localmente
1. Pré-requisitos
Certifique-se de ter instalado em sua máquina:

XAMPP (Servidor Apache + PHP)

PostgreSQL (Banco de Dados)

Git

2. Clonar o repositório
Bash
git clone [https://github.com/HugoCMoises/crud-php-postgresql.git](https://github.com/HugoCMoises/crud-php-postgresql.git)
cd crud-php-postgresql

3. Configurar o Banco de Dados
Abra seu gerenciador de banco (DBeaver, pgAdmin) e rode o script SQL do arquivo "database.sql" para a criação da tabela.

4. Configurar a Conexão
Como as credenciais do banco de dados variam de máquina para máquina, você precisa configurar o arquivo com a sua senha local:

Vá até a pasta /config.

Abra o arquivo db.php.

Localize a variável $pass e insira a senha que você configurou ao instalar o PostgreSQL:

PHP

<?php
$host = 'localhost';
$db   = 'loja_local';
$user = 'postgres';
$pass = 'SUA_SENHA_AQUI'; // <--- INSIRA SUA SENHA DO POSTGRESQL AQUI
$port = '5432';
// ...
?>

5. Habilitar o Driver PostgreSQL no XAMPP
O XAMPP vem com o driver do PostgreSQL desativado por padrão.

Abra o arquivo php.ini (no painel do XAMPP: Config > PHP (php.ini)).

Procure pela linha: ;extension=pdo_pgsql.

Remova o ponto e vírgula (;) do início da linha para descomentar.

Salve o arquivo e Reinicie o Apache.

6. Acessar
Abra seu navegador e acesse: http://localhost/crud-php-postgresql/

📝 Licença
Este projeto está sob a licença MIT. Sinta-se à vontade para usá-lo para estudos e melhorias.
