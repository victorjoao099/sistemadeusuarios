<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
</head>
<body>

<div class="msg">

</div>

<div class="login">
    <form action="" method="POST" id="formEntrar">
        <?php echo csrf_field()  ?>
    <div class="mb-3">    
        <div class="email">
            <label for="email" class="form-label">Digite seu email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
    </div>
    <div class="mb-3">
        <div class="senha">
            <label for="senha" class="form-label">Digite sua senha</label>
            <input type="password" name="senha" id="senha" class="form-control">
        </div>
    </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

<script>
    $("#formEntrar").submit(function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: $(this).attr("action"),
            data: $(this).serialize(),
            success: function(response){
                if(response.status === 'success'){


                    window.location.href = response.route
                };
            }
        })
    })
</script>
    
</body>
</html>