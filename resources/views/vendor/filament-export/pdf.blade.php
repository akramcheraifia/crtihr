<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $fileName }}</title>
    <style type="text/css" media="all">
        * {
            font-family: DejaVu Sans, sans-serif !important;
        }

        html{
            width:100%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            border-radius: 10px 10px 10px 10px;
        }

        table td,
        th {
            border-color: #000000;
            border-style: solid;
            border-width: 1px;
            font-size: 14px;
            overflow: hidden;
            padding: 10px 5px;
            word-break: normal;

        }

        table th {
            font-weight: normal;
            background-color: #04AA6D;
            color: white;
        }

    </style>
</head>
<body>
    @if (count($rows) == 1)
    <center> <h2>informations de l'employé</center>
        @foreach ($columns as $column)
            <p><strong>{{ $column->getLabel() }}:</strong> {{ $rows[0][$column->getName()] }}</p>
        @endforeach
    @elseif (count($rows) > 1)
        <table>
            <tr>
                @foreach ($columns as $column)
                    <th>
                        {{ $column->getLabel() }}
                    </th>
                @endforeach
            </tr>
            @foreach ($rows as $row)
                <tr>
                    @foreach ($columns as $column)
                        <td>
                            {{ $row[$column->getName()] }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </table>
    @else
        <p>No employee data found.</p>
    @endif
</body>
</html>
