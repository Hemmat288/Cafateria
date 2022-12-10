<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" href="style.css">
    <title>login</title>
</head>
<body>
    <div class="back">

    <div class="login">
    <h1 >Cafateria</h1>
<form role="form" method="post" action="coffeeController.php">
      <div class="form-group ">
        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
        <br>
        <div class="col-sm-10">
          <input type="email" class="form-control" id="inputEmail" name="email">
        </div>
      </div>

      <div class="form-group ">
        <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
        <br>
        <div class="col-sm-10">
          <input type="password" class="form-control" id="inputPassword" name="password" >
        </div>
      </div>
      <div class="form-group ">
        <div class="offset-sm-2 col-sm-10">
          <input type="submit" value="Sign in" name="login" class="submitbtn"  />
        </div>
      </div>
    </form>
    </div>
    </div>
</body>
</html>