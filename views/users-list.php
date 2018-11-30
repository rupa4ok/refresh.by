<body>

<header>
    <img src="/template/img/logo.png"/>
</header>

<?php include_once ROOT . '/views/top-menu.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <h1>Личный кабинет</h1>
        </div>
        <div class="row">
            <?php
            if ($_SESSION['role'] == 'admin') {
                $uri = 'admin2';
                include_once ROOT . '/views/left-menu.php';
            } else {
                $uri = 'user2';
                include_once ROOT . '/views/left-menu1.php';
            }
            ?>
            <div class="col-md-9 content-block">
                
                <div class="col-md-9 content-block">

                    <?php
                    $id = $_SESSION['id'];
                    if ($_SESSION['role'] == 'admin') {
                        $result = $admin->GetUserList();
                    } else {
                        $result = $admin->GetUserListById($id);
                        echo $id;
                    }


                    echo '<table id="user" class="table table-bordered  table-striped results">
                            <tbody>';

                    foreach ($peoples as $people) {

                        echo '<tr>
                            <td class = "">
                                    Имя
                            </td>
                            
                            <td class = "">
                                    01
                            </td>
                            <td class = "">
                                    07
                            </td> 
                            <td class = "">
                                    14
                            </td>
                            </tr>
                            
                            <tr>
                            
                            <td class = "">
                                    Имя
                            </td>
                            
                            <td class = "">
                                    11
                            </td>
                            <td class = "">
                                    11
                            </td> 
                            <td class = "">
                                    11
                            </td>
                            </tr>
                            
                            <tr>
                            
                            <td class = "">
                                    Имя
                            </td>
                            
                            <td class = "">
                                    11
                            </td>
                            <td class = "">
                                    11
                            </td> 
                            <td class = "">
                                    11
                            </td>
                            
                            ';

                    }

                    echo '</tr>';
                    echo '</tbody>
                        </table>';

                    ?>
                </div>
            </div>
