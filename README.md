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


## 📑 How To Use <a name="how-to-use"></a>


<details>
  <summary>Linux Comands</summary>
  Clone o repositório:

```bash
git clone https://github.com/IagoAz/FitPass.git
```
Navegue até o diretório do projeto:

```bash
cd FitPass
```


Inicie o servidor PHP:


```bash
php -S localhost:8000
```

Este comando inicia um servidor PHP local na porta 8000. Certifique-se de que esteja no diretório raiz do seu projeto PHP ao executar esse comando.

Abra seu navegador da web favorito e digite o seguinte na barra de endereços:

http://localhost:8000

Isso deve abrir o seu site localmente no navegador.

Lembre-se de que, enquanto o servidor PHP estiver em execução, o terminal ficará ocupado. Você pode abrir um novo terminal para continuar trabalhando ou deixar o terminal atual aberto para monitorar logs e mensagens do servidor PHP. Se precisar encerrar o servidor, você pode pressionar Ctrl+C no terminal onde o servidor está em execução. Isso encerrará o servidor PHP.

## XAMPP

Baixe o <a href="https://www.apachefriends.org/pt_br/download.html">XAMPP:</a>

Clique com o botão direito no arquivo e selecionar a opção que torna o arquivo executável.
<br>
Navegue até o diretório do arquivo:

```bash
cd Downloads/
```
Para alterar as permissões para o instalador.

```bash
chmod 755 xampp-linux-*-installer.run
```
Para executar o instalador.

```bash
sudo ./xampp-linux-*-installer.run
```
Após o processo de instalação, o Terminal que você digitou os comandos será o "programa em execução", se fecha-lo, irá encerrar os serviços do XAMPP.

Para executa-lo novamente você precisar digitar esses comando no Terminal:<br/>
Para ir ao destino padrão do arquivo
```bash
cd /opt/lampp/
```

Para rodar o programa
```bash
sudo ./manager-linux-x64.run
```
Na aba  `Manage Servers` deixaremos rodando os Serviços `MySQL Database` e `Apache Web Server`


Coloque a pasta <a href="https://github.com/IagoAz/FitPass">AAP_SITE</a> na pasta `htdocs` clicando em `Open Application Folder`

Você agora pode entrar nesse link local que entrará na página.
http://localhost/AAP_SITE/index.php

Para conectar no Banco entre no <a href="http://localhost/phpmyadmin/index.php">phpmyadmin</a>.</br>
Clique uma vez em `New` e depois em `Import` e estão coloque o arquivo <a href="https://github.com/IagoAz/FitPass/blob/main/BancoDeDados/aap_fitpass.sql">aap_fitpass</a>.

Pronto! Você agora pode navegar na Fitpass.

<details>
  <summary>Problemas que podem acontecer</summary>

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

<details>
  <summary>Windows Comands</summary>

[Workind]

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