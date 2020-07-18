# Florent.tech : a quick learning demo

As you may know, I'm mostly using ReactJs/NodeJs as my code stack. So here is a Symfony/vueJs little project to explore new options.

## install on windows 10

this project will be developped on my gaming PC (windows 10) and will be published on a OVH VPS.

Stack :

* Symfony 5
* MariaDb 10.5
* VueJs
* VSCode

### Symfony

* install [PHP7.4](https://windows.php.net/download/) in C:\PHP
* activate extension pdo_mysql
* add C:\PHP to path
* install [composer](https://getcomposer.org/download/)
* install [symfony cli](https://get.symfony.com/cli/setup.exe)
* install [MariaDb](https://downloads.mariadb.org/)
* execute this command `symfony new server`  in work folder

### Vue

https://router.vuejs.org/guide/essentials/history-mode.html
vue.js devtools : https://chrome.google.com/webstore/detail/vuejs-devtools/nhdogjmejiglipccpnnnanhbledajbpd/related

* install [nodejs / npm](https://nodejs.org/en/)
* install yarn with the command `npm install -g yarn`
* install vue-cli with command `yarn global add @vue/cli`
* execute this command `vue create client` in the work folder, with the answers:
  * PWA
  * router
  * e2e testing (cypress)

### VSCode

Add vue extension

## target

* [ ] be able to list series from the marvel api
  * [x] create an api key
  * [ ] make a list series api query
  * [ ] make a series view
* [ ] be able to search series by title from the marvel api
  * [ ] text search
  * [ ] pagination
* [ ] show a serie detail
  * [ ] thumbnail
  * [ ] creators/ characters
  * [ ] comics pagination
* [ ] mark a comic from a serie as read
  * [x] create database
  * [ ] create entities
  * [ ] create server routes
* [ ] Security
  * [ ] user authentication
  * [ ] ensure a user can only update his own reading list
  * [ ] use symfony as a proxy, injecting the marvel api key
* [ ] Deployment
  * [ ] create remote database with minimal data
  * [ ] install required components
  * [ ] deploy builded source (client and server)
