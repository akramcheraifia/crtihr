<!DOCTYPE html>
<html lang="{{ App::getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $fileName ?? date()->format('d') }}</title>
    <style>
        table {
            background: white;
            color: black;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            font-family: sans-serif;
        }

        td,
        th {
            border-color: #000000;
            border-style: solid;
            border-width: 1px;
            font-size: 13px;
            line-height: 2;
            overflow: hidden;
            padding-left: 6px;
            word-break: normal;
        }

        th {
            font-weight: normal;
        }

        table {
            page-break-after: auto
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto
        }

        td {
            page-break-inside: avoid;
            page-break-after: auto
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
