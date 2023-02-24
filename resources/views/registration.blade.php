<html>
    <head>
        <link rel="stylesheet" type="text/css" href="{{ asset('css/registration.css') }}" >
        <title>Registration Page</title>
    </head>
    <body>
        <form class="form-1" method="POST" action="{{ route('registration') }}">
            @csrf
            <p class="field">
                <input type="text"
                       name="userName"
                       placeholder="username"
                       required="required">
            </p>
            <p class="field">
                <input type="number"
                       name="phoneNumber"
                       maxlength="11"
                       minlength="8"
                       placeholder="phonenumber"
                       required="required">
            </p>
            <p class="submit">
                <button type="submit"
                        name="submit"
                        value="Register">Register
                </button>
            </p>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </form>
    </body>
</html>

