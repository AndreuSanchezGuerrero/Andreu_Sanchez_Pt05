# Estructura del Projecte

El projecte està organitzat segons l'arquitectura MVC.

Cada fitxer està comentat per resoldre qualsevol dubte.

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
│   │   ├── ├── alert
│   │   │   ├── alert.css          
│   │   │   ├── alert.js           
│   │   │   └── 🐘alert.php        
│   │   ├── articles
│   │   │   ├── articles.css       
│   │   │   └── 🐘articles.php     
│   │   ├── footer
│   │   │   ├── footer.css         
│   │   │   └── 🐘footer.php         
│   │   ├── form
│   │   │   ├── form.css           
│   │   │   └── 🐘form.php           
│   │   ├── pagination
│   │   │   ├── pagination.css     
│   │   │   └── 🐘pagination.php
│   ├── 📂js/
│   │   └── 📜customAlert.js
│   └── 🐘layout.php           
│
├── 🐘index.php
│
|
└── ✍️README.md

</code>
</pre>

