<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Schedule;
use App\Models\Role;
use App\Models\Group;
use App\Models\Day;
use App\Models\Grade;
use App\Models\Score;
class PorHorarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ///get all users who are teachers
        $teachers = Role::where('slug', '=', 'docente')->first()->users; //actually 3 teachers
        // $tichers = $teachers[rand(0, count($teachers) - 1)];
        $days = Day::all();
        $groups = Group::all();
        $grades = Grade::all();
        $timeStart = '07:00:00'; // start time
        foreach ($teachers as $keyMaster => $teacher) {
            foreach ($days as $key => $day) {
                $timeEnd = date('H:i:s', strtotime($timeStart . '+1 hour'));
                $schedule = Schedule::factory()->create([
                    'teacher_id' => $teacher->id,
                    'day_id' => $day->id,
                    'group_id' => $groups[0]->id,
                    'grade_id' => $grades[0]->id,
                    'begin' => $timeStart,
                    'end' => $timeEnd
                ]);
                 $this->alumnosSubcripToSchedule($schedule, 1);
                $timeStart = $timeEnd;

            }
        break;
        }
       
    }
     /**
     * inscribe a n estudiantes al horario 
     * que se acaba de generar 
     * mediante la entidad Score
     * @param array $schedule
     * @param integer $bimester
     * @param integer $numberStudents
     * @return void
     */
    public function alumnosSubcripToSchedule($schedule, $bimester, $numberStudents = 10)
    {
        // $students = Role::where('slug', '=', 'alumno')->first()->users;
        for ($i = 0; $i < $numberStudents; $i++) {
            Score::factory()->create([
            "bimester_id" => $bimester,
            "schedule_id" => $schedule->id,
            "student_id" => $i + 1
        ]);   
        }
    }
}
