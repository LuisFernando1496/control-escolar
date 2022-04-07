<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admins = [
            //admins
            [
                "name"=>"Alta a Docentes",
                "slug"=>"user.teacher.create",
                "description"=>"Crear a un docente y agregarlo a la institucion",
                "active"=>true,
                "id"=>1
            ],
            [
                "name"=>"Alta a Alumnos",
                "slug"=>"user.student.create",
                "description"=>"Crear a un alumno y agregarlo a la institucion",
                "active"=>true,
                "id"=>2
            ],
            [
                "name"=>"Generar Boleta de Calificación",
                "slug"=>"final.score",
                "description"=>"Generar la consulta para obtener la boleta de calificación",
                "active"=>true,
                "id"=>3
            ],
            [
                "name"=>"Generar Cartas de Conducta",
                "slug"=>"letter.create",
                "description"=>"Generar cartas de conducata automáticamente",
                "active"=>true,
                "id"=>4
            ],
            [
                "name"=>"Subir Convocatorias y Avisos",
                "slug"=>"notices.create",
                "description"=>"Subir información, documentos y anotaciones al sistemas",
                "active"=>true,
                "id"=>5
            ],
            [
                "name"=>"Crear Horario Académicos",
                "slug"=>"schedule.create",
                "description"=>"Generar un horario académico",
                "active"=>true,
                "id"=>6
            ],
            [
                "name"=>"Crear Etapas de inscripción",
                "slug"=>"stage.create",
                "description"=>"Generar una etapa en el sistema",
                "active"=>true,
                "id"=>7
            ],
            [
                "name"=>"Generar Reportes de Conducta",
                "slug"=>"report.create",
                "description"=>"Generar reportes por mala conducta a alumnos",
                "active"=>true,
                "id"=>8
            ],
            [
                "name"=>"Ver Todas las Calificaciones",
                "slug"=>"scores.all",
                "description"=>"Permite ver las calificaciones de todos los alumnos",
                "active"=>true,
                "id"=>9
            ],
            [
                "name"=>"Ver Todos Horarios",
                "slug"=>"schedules.all",
                "description"=>"Permite ver todos los horarios",
                "active"=>true,
                "id"=>10
            ]
        ];
        $teachers = [
            // Docente
            [
                "name"=>"Subir sus Propias Calificaciones",
                "slug"=>"score.own.create",
                "description"=>"Permite a los docentes subir sus propias califiaciones a sus horarios de clase",
                "active"=>true,
                "id"=>11
            ],
            [
                "name"=>"Ver Horarios Propios",
                "slug"=>"schedules.own",
                "description"=>"Permite los horarios asignados al docente",
                "active"=>true,
                "id"=>12
            ],
            [
                "name"=>"Ver Lista de Asistencia",
                "slug"=>"list.own",
                "description"=>"Permite al docente ver las listas de asisitencia propias",
                "active"=>true,
                "id"=>13
            ],
            [
                "name"=>"Imprimir PDF de Asistencias",
                "slug"=>"list.own.pdf",
                "description"=>"Permite al docente descargar la lista de asistecia en formato pdf",
                "active"=>true,
                "id"=>14
            ],
            [
                "name"=>"Subir material didactico",
                "slug"=>"assets.create",
                "description"=>"Permite al docente subir el material didactico a su materia",
                "active"=>true,
                "id"=>15
            ],
            [
                "name"=>"Ver Calificaciones de sus Propios Alunmos",
                "slug"=>"score.teacher.own",
                "description"=>"Permite al docente ver las calificaciones de los alumnos registrados en sus materias",
                "active"=>true,
                "id"=>16
            ],
        ];
        $student = [
            [
                "name"  => "Ver su horario de clases ",
                "slug"  => "schedule.own",
                "description" => "puede ver su horario de clases",
                "active" => true,
                "id"=>17
            ],
            [
                "name"  => "Ver descargar su horario de clases ",
                "slug"  => "schedule.own.download",
                "description" => "puede descargar su clases",
                "active" => true,
                "id"=>18
            ],
            [
                "name"  => "Ver calificaciones bimestrales",
                "slug"  => "score.student.own",
                "description" => "puede ver las calificaciones bimestrales",
                "active" => true,
                "id"=>19
            ],
            [
                "name"  => "Ver calificaciones bimestrales (Kardex)",
                "slug"  => "score.kardex.own",
                "description" => "puede ver las calificaciones bimestrales en formato Kardex",
                "active" => true,
                "id"=>20
            ],
        ];
        collect(array_merge($admins, $teachers, $student))->each(function ($permiso) {
            Permission::create($permiso);
        });

    }
}
