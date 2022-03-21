<!DOCTYPE html>
<html>
  <head>Home</head>

  <body>
   
    <h1> Welcome</h1>
    <?php echo htmlspecialchars($Emp_ID)?><br>
    <?php echo htmlspecialchars($Emp_FName)?><br>
    <?php echo htmlspecialchars($Emp_LName)?><br>
    <p>hello <?php echo htmlspecialchars($name)?></p>
  <?php

 
      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        echo "hello, " . htmlspecialchars($_POST['name']);

      }
  
  
  ?>
  <ul>
    <?php foreach($colours as $colour){?>
      <li><?php echo htmlspecialchars($colour);?></li>
    <?php }?>
  </ul>
  <form method = "post">
    <div>
      <label>your name</label>
      <input id="name" name="name" />

    </div>
    <div>
      <button type="submit">Submit</button>
    </div>
  </form>
  </body>
</html>