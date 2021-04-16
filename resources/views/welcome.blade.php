<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Merit-Trac</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #242224;
                color: #e8e1e9;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
                overflow: hidden;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                width: 100%;
                background-color: white;
                /* right: 10px; */
                /* top: 18px; */
                top: 0px;
                height: 50px;
                /* box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19); */
                -moz-box-shadow: inset 0 0 10px #000000;
                -webkit-box-shadow: inset 0 0 2px #000000;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links, p {
                color: #e8e1e9;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .float-right {
                padding: 15px 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                float: right;
                color: #413e41;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}" class="float-right">Home</a>
                    @else
                        <a href="{{ route('login') }}" class="float-right">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="float-right">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
               
                <div class="title m-b-md">
                    <img src="/images/1C.png" alt="Merit-Trac" style="width: 290px; height: 200px">
                </div>

                <div class="links">
                    <p>Knowledge is Power. Test It.</p>
                </div>
            </div>
        </div>
    </body>
</html>
