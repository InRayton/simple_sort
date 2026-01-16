<!DOCTYPE html>
<html>
<head>
    <title>Генератор Графика</title>
</head>
<body>
<h1>Введите дату начала графика</h1>
<p>График будет построен на 7 дней, начиная с выбранной даты.</p>
<form method="POST" action="{{ route('schedule.generate') }}">
    @csrf
    <label for="start_date">Дата начала:</label>
    <input type="date" name="start_date" required>
    <button type="submit">Сгенерировать</button>
</form>
</body>
</html>
