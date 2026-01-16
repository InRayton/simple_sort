<?php

namespace App\Services;

use App\Models\Work;
use App\Models\Employee;

class ScheduleService{
    public function generate_schedule($startDate){
        $employees = Employee::all();
        $works = Work::all();
        $schedule = [];
        $empID = $employees->pluck('id')->toArray();
        $empNames = $employees->pluck('name', 'id')->toArray();
        $empCount = $employees->count();
        $empIndex = 0;
        $start = new \DateTime($startDate);
        $days = [];
        $regDays = [1 =>'Понедельник', 2 =>'Вторник',3 =>'Среда',4 =>'Четверг',5 =>'Пятница',6 =>'Суббота',7 =>'Воскресене'];

        //дни недели
        for ($i = 0; $i < 7; $i++) {
            $day = clone $start;
            $day->add(new \DateInterval("P{$i}D"));
            $dayS = $day->format('Y-m-d');
            $dayNum = (int)$day->format('N');
            $dayName = $regDays[$dayNum] ?? 'No name';
            $days[$dayS] = $dayName;
            $schedule[$dayS] = [];
        }

        //заполнение расписания сотрудниками
        foreach ($days as $dayStr => $dayName) {
            foreach ($works as $work) {
                $slotsN = $work->slots_per_day;
                $assignedN = [];
                for ($j = 0; $j < $slotsN; $j++) {
                    $empId = $empID[$empIndex];
                    $assignedN[] = $empNames[$empId];
                    $empIndex = ($empIndex + 1) % $empCount;
                }
                $schedule[$dayStr][$work->id] = [
                    'work_name' => $work->name,
                    'assigned_names' => $assignedN,
                ];
            }
        }

        return [
            'start_date' => $startDate,
            'days' => $days,
            'schedule' => $schedule,
            'works' => $works
        ];
    }
}
