<html>

<head>
    {{-- bootstarp --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    {{-- font --}}
    <link href="https://fonts.googleapis.com/css2?family=Bai+Jamjuree:wght@500&display=swap" rel="stylesheet">
</head>
{{-- <style>
    body,
    header {
        font-family: 'Bai Jamjuree', sans-serif;

    }

</style> --}}

<body>
    <div class="container">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                Upload Validation Error<br><br>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ url('/certificate') }}" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="row" align="center">
                <img src="/image/KMUTNB-LOGO.jpg" width="100" height="100" />
                <h1> KING MONGKUT'S UNIVERSITY OF TECHNOLOGY NORTH BANGKOK.</h1>
                <br>
                <h3>CERTIFICATE OF ACHIVEMENT</h3>
                <p>This is to certify that</p>
                <h1>{{ $user->name }}</h1>
                <p>achieved the digital literacy skills through the successful completion of the examinations</p>
            </div>

            <div class="row" >
                <img align="left" src="/image/Capture.jpg" /><br>

                    <left>Prof. Dr. Suchart Suengchin</left>
                    <right>JUNE 18. 2020</right><br>

                    <left>President of KMUTNB</left>
                    <right>DATE ISSUED</right>

            </div>


        </form>
    </div>
</body>

</html>
