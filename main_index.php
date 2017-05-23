<?php include  "main.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Lab 7</title>
        <meta charset="utf-8">
    </head>
    <body>
        <table>
            <tr>
                <td width="15%">
                  <form method="post" >
                      <label for="NameOfSubject">Ім'я предмету</label><br>
                      <input type="text" name="NameOfSubject"><br>
                      <label for="NumberOfTerm">Номер семестру</label><br>
                      <input type="text" name="NumberOfTerm"><br>
                      <label for="CountOfHours">Кількість годин</label><br>
                      <input type="text" name="CountOfHours"><br>
                      <?php echo $selectForFormControl; ?>
                      <?php echo $selectForLectors; ?>
                      <input type="submit" name="Add" value="Додати" ><br>
                  </form>
                </td>
                <td width="85%">
                  <form method="post" >
                      <input type="radio" name="atrybut" checked value="Name">Ім'я предмету<br>
                      <input type="radio" name="atrybut" value="NumberOfSemestr">Номер семестру<br>
                      <input type="radio" name="atrybut" value="CountOfHours">Кількість годин<br>
                      <input type="text" name="atrybut_text"><br>
                      <input type="submit" name="selectAtrybut" value="Готово"><br>
                  </form>

                <?php
                  echo Subject::makeTable($data);
                ?>
                </td>
            </tr>
        </table>
    </body>
</html>
