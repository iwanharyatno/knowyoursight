<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detection Print</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif
        }

        table {
            width: 100%;
            border: 1px solid gray;
            border-collapse: collapse;
        }
        .column {
            width: 12rem;
        }
        td {
            border: 1px solid gray;
            padding: 0.8rem;
        }
    </style>
</head>
<body>
    <h1>Detection Report</h1>
    <hr>
    <br>
    <table>
        <tr>
            <td class="column"><strong>Name</strong></td>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <td><strong>Email</strong></td>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td><strong>Date Time</strong></td>
            <td>{{ $detection->created_at }}</td>
        </tr>
        <tr>
            <td><strong>Result</strong></td>
            <td>{{ $detection->result }}</td>
        </tr>
        <tr>
            <td><strong>Recommendation</strong></td>
            <td>{!! $detection->recommendation !!}</td>
        </tr>
    </table>
</body>
</html>