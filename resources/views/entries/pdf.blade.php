@props([
    'title',
    'description',
    'id'
])

<!DOCTYPE html>

<html lang="de">
    <head>
        <meta charset="utf-8" />
        <title> {{ $title }}</title>
        <style>
            body {
                font-family: Helvetica;
            }
        </style>
    </head>
    <body>
        <h1> {{ $title }}</h1>

        <h2> {{ __('entry.form.description') }} </h2>
        <p>
            {{ $description }}
        </p>

        <br />

        <a href="{{route('entry.view', ['id' => $id])}}">
            Online ansehen
        </a>
    </body>
</html>


