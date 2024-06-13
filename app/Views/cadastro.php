<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>

<div class="msg">

</div>

<div class="cadastro">
    <form action="" method="post" id="formCadastro">
        <div class="email">
            <label for="email">Digite seu email</label>
            <input type="email" name="email" id="email">
        </div>
        <div class="senha">
            <label for="senha">Digite sua senha</label>
            <input type="password" name="senha" id="senha">
        </div>
        <button type="submit">Cadastrar</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>

    $("#formCadastro").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url:$(this).attr("action"),
            data: $(this).serialize(),
            success: function(response){
                if(response.status === 'success'){
                    $('#result').html('<p>{response.message}</p>');
                    console.log(response);

                    window.location.href = response.route
                }
            }
        })
    })
</script>
    
</body>
</html>