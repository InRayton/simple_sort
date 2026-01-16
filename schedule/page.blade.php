<!DOCTYPE html>
<html>
<head>
    <title>Рабочий график на 7 дней начиная с {{$start_date}}</title>
    <style>
        table {border-collapse: collapse;}
        th, td {border: 1px solid black; padding: 10px; text-align: left;}
        th {background-color: #f2f2f2; }
    </style>
</head>
<body>
<h1>Рабочий график на 7 дней начиная с {{$start_date}}</h1>
<table>
    <thead>
    <tr>
        <th>Работа</th>
        @foreach ($days as $dayStr => $dayName)
            <th>{{$dayName}} ({{$dayStr}})</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach ($works as $work)
        <tr>
            <td>{{ $work->name }}</td>
            @foreach ($days as $dayStr => $dayName)
                <td>
                    @php
                        $names = $schedule[$dayStr][$work->id]['assigned_names'] ?? [];
                        echo implode(', ', $names);
                    @endphp
                </td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
