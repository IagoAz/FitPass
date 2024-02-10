<a name="readme-top"></a>

# FitPass

<p style="text-align: justify;">FitPass, um protótipo de uma plataforma online que oferece informações e serviços relacionados à alimentação saudável, saúde e academia. O FitPass foi criado para auxiliar pessoas que desejam adotar hábitos saudáveis e alcançar seus objetivos de bem-estar físico. A plataforma fornece orientações sobre exercícios físicos, oque são e uso adequado de vitaminas e suplementos.
</p>

<p align="center">
    <img alt="license" src="https://img.shields.io/github/license/IagoAz/FitPass.svg"/>
</p>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#preview">Preview</a>
<!--      <ul>
        <li><a href="#text">Text</a></li>
        <li><a href="#text">Text</a></li>
      </ul>
-->
    </li>
    <li><a href="#built-with">Built with</a></li>
    <li><a href="#key-features">Key Features</a></li>
    <li><a href="#how-to-use">How To Use</a></li>
    <li><a href="#credits">Credits</a></li>
    <li><a href="#license">License</a></li>
  </ol>
</details>

<!-- PREVIEW AND FIGMA -->

## 📌 Preview <a name="preview"></a>

<p align="center">
  <a href="https://www.figma.com/file/aukjmm6YwIdGzfN5N8KqU1/FitPass-Desing?type=design&node-id=0%3A1&mode=design&t=A8i1iF70CSJYO8st-1" target="_blank" style="display: inline-block; text-align: center;">
    <img alt="figma" width="px" src="https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white" style="padding-right:10px;"/>
  </a>
</p>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LANGUAGES ESED -->

## 🔨 Built with <a name="built-with"></a>

* [![PHP][PHP.com]][PHP-url]
* [![HTML][HTML.com]][HTML-url]
* [![CSS3][CSS3.com]][CSS3.url]
* [![JavaScript][JavaScript.com]][JavaScript-url]
* [![MySQL][MySql.com]][MySql-url]


<p align="right">(<a href="#readme-top">back to top</a>)</p>


## 🔑 Key Features <a name="key-features"></a>

* ...

<p align="right">(<a href="#readme-top">back to top</a>)</p>


<!-- LANGUAGES ESED -->

## 📑 How To Use <a name="how-to-use"></a>

Navegar pelo FitPass é uma tarefa simples. Siga os passos abaixo para começar a utilizar o FitPass:

### Prerequisites

Antes de iniciar, certifique-se de ter o XAMPP instalado em seu sistema. Este conjunto de ferramentas é essencial para criar um ambiente de desenvolvimento local que suporta a execução de PHP e o gerenciamento de bancos de dados MySQL.

* XAMPP

<!-- XAMPP INSTALL -->

<details>
  <summary><b>Step by step on how to install XAMPP</b></summary>
<br>

1. Baixe gratuitamento o XAMPP aqui [www.apachefriends.org](https://www.apachefriends.org/pt_br/download.html)


2. Navegue até o diretório de downloads:

    ```bash
    cd ~/Downloads/
    ```

3. Torne o arquivo baixado executável:
    ```bash
    sudo chmod 755 xampp-linux*.run
    ```

4. Execute o instalador:

    ```bash
    sudo ./xampp-linux*.run
    ```

    Siga as instruções do assistente de instalação.

<br>

5. Seleção de Componentes do XAMPP
    
    Selecione ou desmarque os componentes conforme sua preferência e clique em "Next".

<br>

6. Diretório de Instalação do XAMPP

    O diretório de instalação padrão é /opt/lampp/ ou /opt/xampp/. Recomenda-se deixar como está. O XAMPP não cria arquivos em outros locais padrão do Linux.

7. Pronto para Instalar o XAMPP

    Clique em "Next" na página "Ready to install".

8. Execução do XAMPP no Linux via interface gráfica

    Execute o código abaixo para iniciar o XAMPP via interface gráfica:

    ```bash
    sudo /opt/lampp/manager-linux-x64.run
    ```

</details>

<!-- GETTING STARTED -->

### Getting Started

Para começar, siga os seguintes passos:

<details>
  <summary><b>Linux Comands</b></summary>
<br>

1. Primeiro rode o XAMPP, execute para rodar o programa:
    ```bash
    sudo /opt/lampp/manager-linux-x64.run
    ```
    
2. Na aba  `Manage Servers` deixaremos rodando os Serviços `MySQL Database` e `Apache Web Server`.

3. Coloque a pasta <a href="https://github.com/IagoAz/FitPass">AAP_SITE</a> na pasta `htdocs` clicando em `Open Application Folder`

4. Você agora pode entrar nesse link local que entrará na página.
http://localhost/AAP_SITE/index.php

5. Para conectar no Banco entre no <a href="http://localhost/phpmyadmin/index.php">phpmyadmin</a>.</br>
Clique uma vez em `New` e depois em `Import` e estão coloque o arquivo <a href="https://github.com/IagoAz/FitPass/blob/main/BancoDeDados/aap_fitpass.sql">aap_fitpass</a>.

Pronto! Você agora pode navegar na Fitpass.

<details>
  <summary>Problemas que podem acontecer</summary><br>

  Talvez apareça este problema quando você clicar no `Import`

  *Column count of mysql.proc is wrong. Expected 21, found 20. Created with MariaDB 100108, now running 100432. Please use mysql_upgrade to fix this error*

  Para resolver este problema basta executar essas duas linha de comando no terminal:

  Para ir ao diretório onde o XAMPP está instalado.
  ```bash
  cd /opt/lampp
  ```

  Isso assume que o usuário do MySQL é "root". Se você estiver usando um usuário diferente, substitua "root" pelo nome de usuário correto.
  ```bash
  sudo ./bin/mysql_upgrade -u root -p
  ```

  Caso este problema venha acontecer você precisaram excluir o Bando de dados aap_fitpass no <a href="http://localhost/phpmyadmin/index.php">phpmyadmin</a>. 
  Clique na aba `SQL` no topo da página e digite no campo `DROP DATABASE aap_fitpass;`, após isso clique no `Go`.
  </details>
  </details>

<p align="right">(<a href="#readme-top">back to top</a>)</p>

## 🎞️ Credits <a name="credits"></a>

- [@IagoAz](https://github.com/IagoAz)
- [@Luiz]()
- [@Fred]()
- [@Pedro]()
- [@Vitor]()
- [@Julio]()
- [@NicolasSSantos](https://github.com/NicolasSSantos)

<p align="right">(<a href="#readme-top">back to top</a>)</p>


## ✅ License <a name="license"></a>

This project is under license GPL-3.0 license - see the [LICENSE](https://github.com/IagoAz/FitPass/blob/main/LICENSE) file for details.

<p align="right">(<a href="#readme-top">back to top</a>)</p>


---


<!-- MARKDOWN LINKS & IMAGES -->
<!-- https://www.markdownguide.org/basic-syntax/#reference-style-links -->

[PHP.com]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[HTML.com]: https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white
[HTML-url]: https://html.com/
[CSS3.com]: https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white
[CSS3.url]: https://css3.com/
[JavaScript.com]: https://img.shields.io/badge/JavaScript-323330?style=for-the-badge&logo=javascript&logoColor=F7DF1E
[JavaScript-url]: https://www.javascript.com/
[MySql.com]: https://img.shields.io/badge/MySQL-005C84?style=for-the-badge&logo=mysql&logoColor=white
[MySql-url]: https://www.mysql.com/