<?php
session_start();
if (!$_SESSION['loggedin']) {
    header('Location: vhod.php');
}
require_once 'inc/connect_db.php';
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
        <h2>Заявка на покупку валюты</h2>
        <form action="#" method="post" id="form">
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label>Введите ФИО</label>
                    <input type="text" class="form-control" name="name" id="name" onkeydown="validation()">
                    <span id="text_name"></span>
                </div>
                <div class="col-md-6 mb-3">
                    <label >Введите номер телефона</label>
                    <input type="text" class="form-control" name="number" id="number" onkeydown="validation()">
                    <span id="text_number"></span>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-6 mb-3">
                    <label >Введите email</label>
                    <input type="text" class="form-control" id="email" name="email" onkeydown="validation()">
                    <span id="text"></span>
                </div>
                <div class="col-md-3 mb-3">
                    <label>Выберите валюту</label>
                    <select class="custom-select" name="currency">
                        <option>Euro €</option>
                        <option>Dollar $</option>
                        <option>Pound £</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label >Сколько хотите купить?</label>
                    <input type="number" class="form-control" name="amount" min="100">
                </div>
            </div>
            <button class="btn btn-primary" type="submit" name="sub" value="Submit">Submit form</button>
            <button class="btn btn-primary" type="submit" name="order" value="Submit_order">Show orders</button>
        </form>
        <?php
        if (!empty($_POST['sub']) && $_POST['sub'] == "Submit"){
            if (empty($_POST['name']) || empty($_POST['number']) || empty($_POST['email'])|| empty($_POST['amount'])) {
                echo("Заполните все поля!");
            }
            else {
            try {
                $query = "INSERT INTO orders VALUES (NULL, :name, :number, :email, :currency , :amount, NOW())";
                $msg = $connect->prepare($query);
                $msg->execute(['name' => $_POST['name'], 'number' => $_POST['number'], 'email' => $_POST['email'], 'currency' => $_POST['currency'], 'amount' => $_POST['amount']]);
            } catch (PDOException $e) {
                echo "error" . $e->getMessage();
            }
        }
        }
        ?>
        <?php
        if (!empty($_POST['order']) ) {
            $query = "SELECT * FROM orders";
            $connect=mysqli_connect('localhost','root','root','goloshubov_lab2');
            $result = mysqli_query($connect,$query);
            $row = mysqli_fetch_array($result);
            printf('  <table style="margin: 10px 0;"  class="table table-bordered"> <tr>
    <th scope="col">ID заказа</th>
    <th scope="col">Имя заказчика</th>
    <th scope="col">Номер телефона</th>
    <th scope="col">Email</th>
    <th scope="col">Валюта</th>
    <th scope="col">Количество</th>
    <th scope="col">Время заказа</th>
   </tr>');
            do {
                printf('
   <tr>
    <td>' . $row['order_id'] . '</td>
    <td>' . $row['name'] . '</td>
    <td>' . $row['number'] . '</td>
    <td>' . $row['email'] . '</td>
    <td>' . $row['currency'] . '</td>
    <td>' . $row['amount'] . '</td>
    <td>' . $row['time'] . '</td>
  </tr> ');
            }
            while($row = mysqli_fetch_array($result));
            printf('</table>');
           }
        ?>
</main>
<?php require_once 'inc/footer.html'; ?>
<script src="validation.js" type="text/javascript"></script>

</body>
</html>