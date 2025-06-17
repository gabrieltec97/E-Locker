<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# E-Locker - Registro de Entregas
Sistema de recebimento e registro de entregas para condomínios, onde o mesmo dispõe de um perfil de autenticação onde o usuário irá logar e registrar a encomenda recebida, registrando por nome da empresa, nome do entregador (opcional), foto, descrição e a unidade destinatária. 

Para a retirada da entrega, o mesmo registra o nome da pessoa que retirou, sua assinatura e foto (opcional). Venha conferir!

## 🚀 Tecnologias Utilizadas no projeto

Front-end:
- HTML
- CSS
- JavaScript ES6
- Bootstrap
- Vue.Js
- LavaCharts
- Notyf
- SweetAlert2
- Signature Pad

Back-end:
- PHP
- Laravel
- MySql
- Livewire
- ACL

## ✨ Principais Funcionalidades

- Login com autenticação
- Validação de formulários
- Listagem e edição de dados
- Busca em tempo real de entregas via Id ou nome do cliente
- Gerenciamento de entregas
- Dashboard com comparativo de entregas ao longo dos meses
- Filtragem de entregas por mês
- Informações de unidades com mais entregas
- ACL para controle de permissões de usuário

Gerenciamento total (CRUD) de:

- Entregas
- Unidades
- Usuários

O sistema disponibiliza 2 (dois) tipos de usuário:

- Administrador
- Operador

## 🌐 O projeto está online!

Acesse em: (https://e-locker.online)

## 🛠️ Como rodar o projeto

1. Tenha em sua máquina um ambiente que faça a emulação de um servidor, como Xampp ou Docker instalado e parametrizado.
2. Clone o repositório:
```bash
git clone https://github.com/gabrieltec97/E-Locker.git
```
3. Copie o arquivo .env.example para .env
4. Instale as dependências com o Composer:
```bash
composer install
```
5. Gere a chave de API do Laravel.
```bash
php (ou sail) artisan key:generate
```
6. Parametrize crie seu banco de dados e preenchendo com as variáveis de nome do banco, usuário, senha e porta no arquivo .env.
7. Rode as migrations e seeders necessárias para dar a configuração inicial para o sistema executar corretamente.
```bash
php (ou sail) artisan migrate --seed
```
8. Inicie o servidor.
```bash
php (ou sail) artisan serve
```
9. Pronto! Agora é só acessar http://localhost:8000

## 📸 Screenshots

Inserir imagens
