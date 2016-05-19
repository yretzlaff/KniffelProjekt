<!DOCTYPE HTML>
<html>
 <head>
     <title>Kniffel - <?= $title ?: 'Übersicht' ?></title>
     <meta charset="UTF-8">
     <link rel="stylesheet" href="assets/stylesheets/stylesheet.css">

 </head>
 <body>
     <div class="page">
         <header>
             <h1>Kniffel - <?= $title ?: 'Übersicht' ?></h1>
         </header>
         <main>
             <?= $content_for_layout ?>
         </main>
     </div>
 </body>
</html>
