<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
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
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
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
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <table border="1">
                    <tbody>
                        @for ($i = 0; $i < 5; $i++)
                            <tr>    
                                @for ($j = 0; $j < 5; $j++)
                                    <?php
                                        $index = $i * 5 + $j;
                                    ?>
                                    <td 
                                        style="color: {{ $array[$index]['color'] ? 'white' : 'black' }}; background: {{ $array[$index]['color'] ? $array[$index]['color'] : 'white' }};">
                                        {{ $array[$index]['value'] }}
                                    </td>
                                @endfor
                            </tr>
                        @endfor
                    </tbody>
                </table>

                <br/>
                <form action="/pick" method="POST">
                    {{ csrf_field() }}
                    <input name="page" type="hidden" value="{{ $page }}" />
                    <input name="value" type="number" required />
                    <button>Pick</button>
                </form>

                <form action="/swap" method="POST">
                    {{ csrf_field() }}
                    <input name="page" type="hidden" value="{{ $page }}" />
                    <input name="r" type="number" required />
                    <input name="c" type="number" required />
                    <button>Swap</bvutton>
                </form>
            </div>
        </div>
    </body>
</html>
