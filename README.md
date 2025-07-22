## Apresentação Geral

**Nome do Projeto:** Gerenciador de Vagas

**Descrição:**

O Gerenciador de Vagas é uma plataforma prática para gerenciar vagas de emprego. Com ela, você pode criar, editar e excluir suas vagas de forma fácil. 
Além disso, é possível visualizar e baixar vagas de outros usuários em PDF. O sistema de usuários permite cadastro, login e recuperação de senha, 
garantindo uma experiência segura e eficiente para quem busca gerenciar ou encontrar oportunidades de trabalho.

![demo](./public/images/demo/vacancy-manager.gif)

**Objetivo:**

Implementar um sistema de usuários e permissões utilizando PHP.

**Tecnologias Utilizadas:**

![DOCKER](https://img.shields.io/badge/Docker-2496ED?style=for-the-badge&logo=docker&logoColor=fff)
![COMPOSER](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MYSQL](https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white)
![HTML](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![BOOTSTRAP](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![JAVASCRIPT](https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E)
![JQUERY](https://img.shields.io/badge/jQuery-0769AD?style=for-the-badge&logo=jquery&logoColor=white)

## Para Desenvolvedores

Se você é um desenvolvedor interessado em contribuir ou entender melhor o funcionamento do projeto, aqui estão algumas informações adicionais.

**Ambiente:**

![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php)
![MYSQL](https://img.shields.io/badge/MySQL-8.0-005C84?style=for-the-badge&logo=mysql)

```sql
CREATE DATABASE IF NOT EXISTS `vacancy_manager`;

USE `vacancy_manager`;

CREATE TABLE IF NOT EXISTS `user` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) NOT NULL,
    `password` VARCHAR(60) NOT NULL,
    `token` VARCHAR(32),
    PRIMARY KEY (`id`)
);

CREATE TABLE IF NOT EXISTS `job` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `user_id` INT NOT NULL,
    `title` VARCHAR(100) NOT NULL,
    `description` VARCHAR(1000) NOT NULL,
    `status` CHAR(1) NOT NULL DEFAULT 1,
    `date` DATETIME NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`user_id`) REFERENCES `user`(`id`)
);
```

**Instruções de Instalação e Configuração:**

> Atenção: Obrigatório o uso de Docker em sua máquina.

1. Clone o repositório do projeto:
```
git clone https://github.com/edssaac/gerenciador-de-vagas
```

2. Navegue até o diretório do projeto:
```
cd gerenciador-de-vagas
```

3. Inicie a aplicação atráves do script que configura o Docker:
```
.ci_cd/init.sh  
```
Com isso a aplicação estará acessivel: [http://localhost:8080](http://localhost:8080)

---

4. Quando desejar encerrar a aplicação, use:
```
.ci_cd/stop.sh
```
Caso deseje encerrar e remover os volumes criados, use:
```
.ci_cd/stop.sh -v
```

## Contato

[![GitHub](https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white)](https://github.com/edssaac)
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:edssaac@gmail.com)
[![Outlook](https://img.shields.io/badge/Outlook-0078D4?style=for-the-badge&logo=microsoft-outlook&logoColor=white)](mailto:edssaac@outlook.com)
[![Linkedin](https://img.shields.io/badge/LinkedIn-black.svg?style=for-the-badge&logo=linkedin&color=informational)](https://www.linkedin.com/in/edssaac)
