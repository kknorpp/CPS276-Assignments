 <html>
 <a href="controller.php">Go Back</a>
 <form action="controller.php" method="post">
     <input type="hidden" value="<?= $personID ?>" name="editid">
     <input type="submit" value="Save" name="save">
     <br><br>
     <table border="1" cellspacing="0" cellpadding="2">
         <tr>
             <td><b>ID</b></td>
             <td><?= $personID ?></td>
         </tr>
         <tr>
             <td><b>Person Name</b></td>
             <td><input name="person_name" type="text" value="<?= $person_name ?>" size="35"></td>
         </tr>
         <tr>
             <td><b>Provider</b></td>
             <td><input name="provider_number" type="text" value="<?= $provider_number ?>" size="35"></td>
         </tr>
         <tr>
             <td><b>Location</b></td>
             <td><input name="locationID" type="text" value="<?= $locationID ?>" size="35"></td>
         </tr>
     </table>
 </form>

 </html>