<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/link.css') }}" >
        <title>Link Page</title>
    </head>
    <body>
        <div class="form-1">

            <input type="text"
                   name="userName"
                   disabled="disabled"
                   placeholder="username"
                   required="required"
                   value=" Your link: {{ $link}}"
            >
        </div>
    </body>
</html>
