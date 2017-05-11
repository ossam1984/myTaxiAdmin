<!DOCTYPE html>
<html>
    <head>
        <title>Not Ready Yet.</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #B0BEC5;
                display: table;
                font-weight: 100;
                font-family: 'Lato', sans-serif;
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .image
            {
                opacity: 0.5;
                max-width: 100px;
                height: auto;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">LIU Yemen Alumni</div>
                <img class="image" src="{{asset("storage/images/logo.jpg")}}">
                <h6>Under Maintenance</h6>
                <p>{{ json_decode(file_get_contents(storage_path('framework/down')), true)['message'] }}</p>
            </div>
        </div>
    </body>
</html>
