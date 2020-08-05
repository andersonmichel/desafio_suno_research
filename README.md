# Desafio Suno Research - realizado por Anderson Michel

## Descrição

Neste desafio foram desenvolvidos módulos utilizando funções nativas do Wordpress sem a ajuda de plugins externos. Foram utilizados _custom post types_, _custom taxonomies_, _meta fields_ e _widgets_ extendidos do Elementor. O objetivo é disponilizar para os assinantes do site benefícios que podem ser filtrados por categorias e locais. O _widget_ `Benefícios` fornece opções de ordenação e tabulação dos resultados com paginação ou carregamento ajax. Os _widgets_ `Categorias Benefício` e `Locais de Cobertura` oferecem opções de customização do título e exibição da quantidade de benefícios relacionados para cada item.

## Plataforma

`Wordpress versão 5.4.2`

## Page Builder

`Elementor versão 2.9.14`

## Localização dos arquivos

- wp-content/mu-plugins/
- wp-content/themes/desafio-suno-research/
- wp-content/themes/desafio-suno-research-child/
- wp-content/plugins/elementor-dsr-extention/

## Acesso ao painel

Login: **desafio**   
Senha: **desafio**

## Instalação local - opção 1

**1**. Faça um clone do projeto em localhost:

```
git clone https://github.com/andersonmichel/desafio_suno_research.git
```

**2**. Crie um banco de dados chamado `wordpress_dsr_anderson_michel`.

**3**. Rode o código .sql localizado em `wp-content/database.sql`.

## Instalação via plugin - opção 2

**1**. Crie uma instância da última versão do [Wordpress](https://br.wordpress.org/download/) e acesse o painel administrativo.

**2**. Insale e ative o plugin `All-in-One WP Migration`.

**3**. Baixe o [arquivo de migração](https://br.wordpress.org/download/) e realize a importação no menu `All-in-One WP Migration -> Importar`.

**4**. Vá até `Configurações -> Links Permanentes` e cliquem Salvar para atualizar o .htaccess 

## Instalação das ferramentas Front & build

**1**. Acesse https://nodejs.org/ e procure a melhor forma de instalar o Node para você. 

**2**. Instale o Gulp Cli globalmente:

```
npm install gulp-cli -g
```

**3**. Navegue até o diretório do projeto `wp-content/plugins/elementor-dsr-extension` e digite o comando:

```
npm install && gulp
```

## Modo dev

Build automático:

```
gulp watch
```

Outros comandos:

`gulp` para _build_ geral ou `gulp js`, `gulp css` e `gulp img` para _builds_ específicos.

Diretório de destino: _/dist_

## Estrutura dos diretórios

Dentro de wp-content/plugins/elementor-dsr-extention:

```
├── assets
│   ├── img
│   └── js
│   └── sass
├── dist
│   ├── css
│   └── img
│   └── js
```

Outras possíveis melhorias poderiam ser implementadas a este projeto caso o tempo fosse mais extenso.

Entre elas:

- Validação de Metafields via Javascript
- Widgets mais customizáveis no Elementor
- Documentação mais detalhada
