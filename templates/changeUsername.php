<form action="index.php" method="post" class="changePassword">

   <div>
       <table class="tabellemittig">
           <tr>
               <th>Akuteller Username: </th>
               <th><?= $user->getName() ?></th>
           </tr>
           <tr>
               <th>Neuer Username: </th>
               <th><input id="neuerUsername" type="text" name="neuerUsername"></th>
           </tr>
       </table>
   </div>

   <input type="submit" name="bestaetigenUsername" value="Bestätigen">
   <input type="submit" name="abbrechen" value="Abbrechen">
</form>