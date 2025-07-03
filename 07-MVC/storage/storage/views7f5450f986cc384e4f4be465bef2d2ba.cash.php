<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body class="p-2">
    <div class="container">
        <div class="row">
            <div class="12">
                <h1>Data Page</h1>
                <form action="http://localhost/back_end/07-MVC/public/send/data" method="post" enctype="multipart/form-data">
                    <input type="text" name="name" value="test" class="form-control"/>
                    <input type="hidden" name="csrf_token" value="ffae653b4c848aecb45bc91941d45d7306155571bb678bebe90bcea1d8d78bcf" />                    <button type="submit" class="btn btn-success">Send</button>
            </form>
                </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
</body>

</html>