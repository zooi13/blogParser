<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <h1 style="margin: 10px; margin-bottom: 30px">Поиск:</h1>
    <form id="search" method="post">
        <div style="margin: 10px">
            <input type="text" name="str" id="str" placeholder="Введите строку">
        </div>
        <div style="margin: 10px">
            <button type="submit">Поиск</button>
        </div>
    </form>

    <div id="posts">
        <hr>
    </div>
    <script>
        $('#search').submit(function (e){
            e.preventDefault();
            let str = $('#str').val()
            if (str.length < 3){
                alert('Длина строки должна быть минимум 3')
            }else {
                $.ajax({
                    url: 'search',
                    method: 'POST',
                    data: {
                        str: str,
                    },
                    success: function(data) {
                        $('#posts').empty();
                        $('#posts').append('<hr>');
                        if ($.parseJSON(data).length === 0){
                            $('#posts').append('<div style="margin: 10px; margin-bottom: 30px"><h3>Ничего не найдено</h3></div>');
                        }else {
                            $.parseJSON(data).forEach(function(elem) {
                                let result = ('<div style="margin: 10px; margin-bottom: 30px"><h3>'+ elem.title +'</h3><p>'+ elem.body +'</p></div>');
                                $('#posts').append(result);
                            });
                        }
                    }
                });
            }
        })
    </script>
</body>
</html>

