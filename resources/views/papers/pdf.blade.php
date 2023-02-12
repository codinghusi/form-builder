@props([
    'paper'
])

<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <title> {{ $paper->title }}</title>
        <style>
            body {
                font-family: Helvetica;
            }
            .text {
                text-decoration: underline;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            table, th, td {
                border: 1px solid black;
                text-align: left;
            }

            td {
                padding: 15px;
            }

            th {
                padding: 5px 15px;
            }

        </style>
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        @vite(['resources/css/app.css'])
    </head>
    <body class="font-sans antialiased m-4">
        <h1> {{ $paper->title }}</h1>

        <hr />

        @include('papers.paper', isset($paper) ? [ 'parsed' => $paper->parsed, 'values' => $paper->values ] : [])

        <br />

        <a href="{{route('paper.view', ['id' => $paper->id])}}">
            Online ansehen
        </a>
    </body>
</html>


