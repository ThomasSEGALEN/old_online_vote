<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vote électronique</title>
</head>
<body>
    <h1>Résultats du vote : {{ $vote->title }}</h1>
    <table>
        @foreach ($answers as $key => $answer)
        <tr>
            <th>Réponse</th>
            <th>Montant</th>
        </tr>
        <tr>
            <td>{{ $answer->name }}</td>
            <td>{{ $results[$key]->amount }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>