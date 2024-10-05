# Estructura del Projecte

Aquest projecte és un sistema de backend per a la gestió d'articles, proporcionant la funcionalitat CRUD (Crea, Llegir, Actualitzar, Suprimir) juntament amb la paginació i la gestió de sessions. L'estructura segueix un patró MVC, separant la llogica en models, vistes i controladors.

<pre>
<code style="color: #00BFFF;">
📂Andreu_Sanchez_Pt02/
│
├── 📂config/
│   ├── 🐘env.php                         
│   └── 📂database/
│       └── 🐘connection.php       
│
├── 📂controllers/
│   ├── 🐘ArticleController.php
│   ├── 🐘CustomSession.php
│   └── 🐘form-data-controller.php
│
├── 📂models/
│   └── 🐘Article.php 
│
├── 📂views/
│   ├── 📂components/
│   │   ├── 📂alert
│   │   │   ├── 🎨alert.css          
│   │   │   ├── 📜alert.js           
│   │   │   └── 🐘alert.php        
│   │   ├── 📂articles
│   │   │   ├── 🎨articles.css       
│   │   │   └── 🐘articles.php     
│   │   ├── 📂footer
│   │   │   ├── 🎨footer.css         
│   │   │   └── 🐘footer.php         
│   │   ├── 📂form
│   │   │   ├── 🎨form.css           
│   │   │   └── 🐘form.php           
│   │   └── 📂pagination
│   │       ├── 🎨pagination.css     
│   │       └── 🐘pagination.php
|   |   
|   ├── 🎨layout.css
│   └── 🐘layout.php           
│
├── 🐘index.php
│
|
└── ✍️README.md

</code>
</pre>

## 📄 Descripció del Projecte

### Connexió a la Base de Dades

La connexió a la base de dades es fa agafant les variables d'entorn del fitxer env.php. Aquest fitxer conté les credencials com el host, el nom de la base de dades, el nom d'usuari i la contrasenya. D'aquesta manera, podem gestionar les dades de forma segura i més fàcil de mantenir en diferents entorns (desenvolupament, producció, etc.).

### Classe Article

He creat una classe anomenada Article per gestionar el CRUD dels articles. Aquesta classe inclou tots els mètodes necessaris per interactuar amb la base de dades. Així podem crear nous articles, obtenir articles existents, actualitzar-los o eliminar-los. Els mètodes estan preparats per manipular les dades de manera eficient.

### Classe ArticleController

La classe ArticleController fa d'intermediari entre la vista i el model (Article). Controla el flux de dades i permet gestionar les operacions amb els articles de forma estructurada. És el responsable de delegar les peticions des de la vista a la capa de dades (model). Això facilita la mantenibilitat i escalabilitat del codi.

### Classe CustomSessionHandler

La classe CustomSessionHandler facilita la gestió de les sessions de manera centralitzada. Permet establir, recuperar i eliminar variables de sessió. Això ens ajuda a gestionar la informació temporal, com els missatges d'error, èxit o altres dades temporals que no necessiten ser emmagatzemades permanentment a la base de dades.
Afegirem el session destroy quan fem logout.

set($key, $value): Estableix una variable de sessió.
get($key): Recupera una variable de sessió.
remove($key): Elimina una variable de sessió.
clear(): Destrueix tota la sessió.

### Controlador de Formularis

El controlador de formularis (form-data-control.php) s'encarrega de validar i processar els formularis del projecte. Aquí es verifiquen els camps abans d'enviar-los a la base de dades, assegurant que les dades siguin correctes i segures. Si hi ha errors en la validació, es mostren a l'usuari.

### Arquitectura Modular amb Components

Dins de la carpeta views/components, he creat una estructura modular per organitzar les diferents parts de la interfície d'usuari. Això ens permet tenir un projecte més mantenible i escalable, ja que cada part de la vista està separada en components independents.

Per exemple:

    El component alert gestiona els missatges d'alerta (CSS, JS, PHP).
    El component pagination gestiona la paginació dels articles.
    El component form gestiona el formulari de creació i edició d'articles.


### Layout i Importació de Components

Dins del layout.php, fem les importacions dels diferents fitxers CSS, PHP i JS per a cada component. D'aquesta manera, podem reutilitzar components i mantenir el codi net i organitzat. Tots els components s'inclouen en el layout.php, assegurant que la pàgina es construeixi correctament amb tots els seus estils i funcions.

### index.php

El fitxer index.php inicialitza el projecte. Aquí es s'inclouen els required files com la connexió a la BD, es declaren les variables globals i es crea una instància del controlador d'articles (ArticleController). A partir d'aquí, es recuperen tots els articles per pintar-los a la vista, aplicant la paginació per mostrar un nombre limitat d'articles per pàgina.

També s'inicia la gestió dels formularis (layout).