<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Вход</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <?php 
            session_start();
            require('connect.php');

            if (isset($_POST['login']) and isset($_POST['pass'])){
                $login=$_POST['login'];
                $pass=$_POST['pass'];
                
                $query="SELECT * FROM users WHERE login='$login' and pas='$pass'";    // здесь надо было сделать по другому в целях безопастности, но думаю для работы сойдет
                            
                $result=mysqli_query($connection, $query) or die(mysqli_error($connection));                
                $count=mysqli_num_rows($result);
                
                
                if($count==1){
                    $_SESSION['login']=$login;
                    
                }else {
                    $fmsg="Ошибка";                    
                }
            }
            if (isset($_SESSION['login'])){
                //Условие при входе в систему
                $login=$_SESSION['login'];
                echo "<div class='row'> 
                        <div class='col'> 
                            <h3> Привет ".$login." </h3>
                        </div>
                        <div class='col'> 
                            <a href='new_qu.php' class='btn btn-success btn-primary btn-lg btn-block'>Создать запрос </a>
                        </div>
                        <div class='col col-lg-2'> 
                            <a href='logout.php' class='btn btn-success btn-primary btn-lg btn-block'>Выход </a>
                        </div>
                    </div>";

                while($user= mysqli_fetch_assoc($result)){
                    //$ii=$ii+1;
                    //$sums=$sums+$prod['sum_prod'];
                    if ($user['manager']==0){
                        //echo"Не манагер";
                        
                        //условие для пользователей
                        $query_qu="SELECT * FROM questions WHERE id_user='$user[id_user]'"; 
                        $result_qu=mysqli_query($connection, $query_qu) or die(mysqli_error($connection));   
                        $count_qu=mysqli_num_rows($result_qu);



                        echo "  <table class='table'>
                                    <thead class='thead-dark'>
                                        <tr>
                                        <th scope='col'>№</th>
                                        <th scope='col'>Тема</th>
                                        <th scope='col'>Дата</th>
                                        <th scope='col'>статус</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        ";
                                        while ($questions=mysqli_fetch_assoc($result_qu)){
                                            //вывод таблицы
                                            
                                        }

                                   echo"<tr>                                        
                                        <th scope='row'>1</th>
                                        <td>Mark</td>
                                        <td>Otto</td>
                                        <td>@mdo</td>
                                        </tr>

                                        <tr>
                                        <th scope='row'>2</th>
                                        <td>Jacob</td>
                                        <td>Thornton</td>
                                        <td>@fat</td>
                                        </tr>

                                        <tr>
                                        <th scope='row'>3</th>
                                        <td>Larry</td>
                                        <td>the Bird</td>
                                        <td>@twitter</td>
                                        </tr>

                                    </tbody>
                                </table>                              

                                ";


                    }else{
                        echo"Манагер есть";
                    }
                }


            } 
            //иначе авторизация
            else echo "<h1>Вход в систему</h1>
            <form method='POST'> 
            <input type='text' class='form-control' name='login' id='login' placeholder='Введите логин'> <br>
            <input type='password' class='form-control' name='pass' id='pass' placeholder='Введите пароль'><br>
                <button class='btn btn-success btn-primary btn-lg btn-block' type='submit'>Вход</button>
            </form>
            <br>
            ";
            ?>        
        
    </div>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>