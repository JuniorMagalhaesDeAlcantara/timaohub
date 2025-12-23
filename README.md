# 🖤 TimãoHub

![Laravel](https://img.shields.io/badge/Laravel-11-red?style=flat-square) ![PHP](https://img.shields.io/badge/PHP-8.2-blue?style=flat-square) ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3.3-teal?style=flat-square) ![Build](https://img.shields.io/badge/build-passing-brightgreen?style=flat-square) ![License](https://img.shields.io/badge/License-MIT-lightgrey?style=flat-square)

TimãoHub é uma aplicação web desenvolvida em **Laravel 11** que oferece um **dashboard completo do Corinthians**, com estatísticas de jogos, artilheiros e informações essenciais do time. ⚽🖤  

Os dados são obtidos da **[API-Football](https://www.api-football.com/)**, garantindo informações atualizadas sobre partidas, times e jogadores.

---

## 🏆 Funcionalidades

- Dashboard exclusivo com dados do Corinthians  
- Estatísticas de partidas (home e away)  
- Artilheiro do time destacado  
- Placar de jogos recentes  
- Layout responsivo usando **TailwindCSS**  
- Dados atualizados via **API-Football**  

---

## 🚀 Tecnologias

- **Backend:** Laravel 11 (PHP 8.2)  
- **Frontend:** Blade Templates, TailwindCSS, JavaScript  
- **Banco de Dados:** MySQL / PostgreSQL  
- **Integração:** API-Football  
- **Ferramentas:** Vite, Composer, NPM  
- **Controle de versão:** Git / GitHub  

---

## ⚙️ Pré-requisitos

- PHP >= 8.2  
- Composer  
- Node.js + NPM  
- Banco de dados MySQL ou PostgreSQL  
- Laravel 11  

---

## 🛠️ Instalação

1. **Clone o repositório:**
   ```bash
   git clone <seu-repositorio>
   cd timãohub
   ```
2. **Instale as dependências do Laravel:**  
    ```bash
    composer install
    ```
3. **Instale as dependências do frontend:**
    ```bash
      npm install
      npm run dev
    ```

4. **Configure o arquivo .env com suas credenciais do banco de dados, chave da API-Football e outras variáveis de ambiente.**

5. **Rode as migrations:**
    ```bash
    php artisan migrate
    ```

6.**Inicie o servidor:**
    ```bash
    php artisan serve
    ```

7. **Acesse a aplicação no navegador:**
   http://localhost:8000


**Contribuição**

Contribuições são bem-vindas! Para contribuir:

Fork o projeto

**Crie uma branch:**
```bash
git checkout -b feature/nome-da-feature
```

**Faça commit das alterações:**
```bash
git commit -m "Adicionei nova feature"
```

**Push para a branch:**
```bash
git push origin feature/nome-da-feature
```

**Abra um Pull Request**

🌐 Links Úteis

API-Football

https://api-sports.io/documentation/widgets/v3#section/Introduction

**Documentação Laravel**

https://laravel.com/docs/12.x/installation

**TailwindCSS**

https://tailwindcss.com/

**📄 Licença**

Este projeto é licenciado sob a MIT License