<?php
session_start();
if (!$_SESSION['loggedin']) {
    header('Location: vhod.php');
}
?>

<!DOCTYPE html>
<head>
    <title>Personal account</title>
    <?php require_once 'inc/head.html';?>
</head>
<body>
<?php require_once 'inc/header.html'; ?>
<main>
    <div class="container">
        <h3> Добро пожаловать в ваш личный кабинет! Здесь вы можете посмотреть остатки валют, доступных на данный момент и сделать заказ.  <a class="btn btn-primary" href="order.php" role="button">Make an order</a></h3>
    <?php
    if (!empty($_POST['log']) && $_POST['log'] == "Logout") {
        unset($_SESSION['loggedin']);
        session_destroy();
        header('Location: index.php');
    }
    ?>
        <div style="width: 40%; margin: 0 auto;">
            <form action="" method="post">
                <select class="form-control form-control-lg" name="currency">
                    <option value="Euro">Euro €</option>
                    <option value="Dollar">Dollar $</option>
                    <option value="Pound">Pound £</option>
                    <input class="btn btn-primary" style = "margin: 5px 370px;" type="submit" value="Submit">
                </select>
            </form>
            <?php
            require_once 'inc/connect_db.php';
            if (!empty($_POST['currency']) )
            {
                $query = "SELECT * FROM currency WHERE nazv=?";
                $msg = $connect->prepare($query);
                $msg->execute([$_POST['currency']]);
                $category = $msg->fetch(PDO::FETCH_LAZY);
                printf(' <table style="margin: 10px 0;"  class="table table-bordered"> <tr>
    <th scope="col">Валюта</th>
    <th scope="col">Резервный остаток</th>
    <th scope="col">Курс к RUB</th>
   </tr>
   <tr>
    <td>'.$category['nazv'].'</td>
    <td>'.$category['amount'].'</td>
    <td>'.$category['rate'].'</td>
  </tr> </table>');
            }

            ?>
        </div>
    </div>


    <h3 style="text-align:center;"> <br> Хотите покинуть личный кабинет? <form  action="" method="post"> <input type="submit"  class="btn btn-primary"  name="log" value="Logout"> </form> </h3>
</main>
<?php require_once 'inc/footer.html'; ?>
</body>
</html>