<?php
namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\I18n\Time;
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
</head>
<body>

<div class="msg">
    <h1>Olá, seja bem vindo ao nosso site!!</h1>
</div>


<div class="logout">
    <button id="logoutButton">Sair</button>
</div>
    
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>


<script>
    $(document).ready(function(){
        $('#logoutButton').click(function(){
            $.ajax({
                url: '<?=site_url('logout')?>',
                type: 'POST',
                dataType: 'JSON',
                success: function(response) {
                    if(response.status === 'success') {
                        window.location.href = '<?=site_url('login')?>';
                    }
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })
    })
</script>

</body>
</html>