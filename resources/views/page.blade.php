<html>
<head>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/page.css') }}" >
    <title>Registration Page</title>
</head>
<body>
<div class="form-1">

<form  method="POST" action="{{ route('generateNewLink') }}">
    @csrf
    <p class="submit">
        <button type="submit"
                name="submit"
                value="generateNewLink">Generate new link
        </button>
        <input name="token" type="hidden" value="{{ $token }}">
    </p>
</form>

<form  method="POST" action="{{ route('deactivateLink') }}">
    @csrf
    <p class="submit">
        <button type="submit"
                name="submit"
                value="deactivateLink">Deactivate current link
        </button>
        <input name="token" type="hidden" value="{{ $token }}">
    </p>
</form>

<form method="POST" action="{{ route('lottery') }}">
    @csrf
    <p class="submit">
        <button type="submit"
                name="submit"
                value="Imfeelinglucky">Imfeelinglucky
        </button>
        <input name="token" type="hidden" value="{{ $token }}">
    </p>
</form>
    @if(isset($result) && !empty($result))
        <div class="lottery">
            <span>Result: <strong><span id="lottery_result">{{$result->lottery_result}}</span></strong></span>
            <span>Number: <strong><span id="Number">{{$result->number}}</span></strong></span>
            <span>Win Amount: <strong><span id="WinAmount">{{$result->amount}}</span></strong></span>
        </div>
    @endif

<form method="POST" action="{{ route('history') }}">
    @csrf
    <p class="submit">
        <button type="submit"
                name="submit"
                value="History">History
        </button>
        <input name="token" type="hidden" value="{{ $token }}">
    </p>
    @if(isset($history) && !empty($history))
        @foreach($history as $data)
            <div class="lottery">
                <span>Result: <strong><span id="lottery_result">{{$data->lottery_result}}</span></strong></span>
                <span>Number: <strong><span id="Number">{{$data->number}}</span></strong></span>
                <span>Win Amount: <strong><span id="WinAmount">{{$data->amount}}</span></strong></span>
            </div>
        @endforeach
    @endif
</form>
</div>
</body>
</html>

<style>

</style>


