<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
        foreach ($this->grupos() as $subject) {
            Subject::create($subject);
        }	
    }
    public function grupos(){

        $subjects = [
			[
				"name" => "Lengua Materna (español)",
				"key" => 'DGIQ5B70YO',
				"grade_id" => 1
			],
			[
				"name" => "Matemáticas",
				"key" => 'RBVHGUZOKN',
				"grade_id" => 1
			],
			[
				"name" => "Lengua extranjera (Inglés)",
				"key" => 'VBFXR9LKGZ',
				"grade_id" => 1
			],
			[
				"name" => "Biología",
				"key" => 'O8XNPFKZJ2',
				"grade_id" => 1
			],
			[
				"name" => "Geografía",
				"key" => 'M7ODHBWX30',
				"grade_id" => 1
			],
			[
				"name" => "Formación cívica y ética",
				"key" => 'QIXSZ9NFWV',
				"grade_id" => 1
			],
			[
				"name" => "Tecnología",
				"key" => 'PSXQ0LZ1AT',
				"grade_id" => 1
			],
			[
				"name" => "Educación física",
				"key" => 'WJ4S6LH0PV',
				"grade_id" => 1
			],
			[
				"name" => "Artes (Música)",
				"key" => '0XLUGHMA8F',
				"grade_id" => 1
			],
			[
				"name" => "Receso",
				"key" => "receso",
				"grade_id" => 1
			],
			[
				"name" => "Lengua materna (español) 2",
				"key" => 'DFVH73TQKX',
				"grade_id" => 2
			],
			[
				"name" => "Matemáticas 2",
				"key" => 'R8V5G6LXSI',
				"grade_id" => 2
			],
			[
				"name" => "Lengua extranjera (Inglés) 2",
				"key" => 'EJA208KHIW',
				"grade_id" => 2
			],
			[
				"name" => "Ciencias (Física)",
				"key" => 'AFLTZS57CQ',
				"grade_id" => 2
			],
			[
				"name" => "Historía 1",
				"key" => 'J72AEBQZ3S',
				"grade_id" => 2
			],
			[
				"name" => "Formación cívica y ética 2 ",
				"key" => 'YH4PL7CZT6',
				"grade_id" => 2
			],
			[
				"name" => "Tecnologías 2",
				"key" => 'HBIQ03KYW1',
				"grade_id" => 2
			],
			[
				"name" => "Educación Física 2",
				"key" => '9MGZI8RSXH',
				"grade_id" => 2
			],
			[
				"name" => "Receso",
				"key" => "receso",
				"grade_id" => 2
			],
			[
				"name" => "Lengua materna (español) 3",
				"key" => '9OFPYCD1RA',
				"grade_id" => 3
			],
			[
				"name" => "Matemáticas 3",
				"key" => 'ZT8VG4OXP0',
				"grade_id" => 3
			],
			[
				"name" => "Lengua extranjera (Inglés)3",
				"key" => 'ZB89KETHAQ',
				"grade_id" => 3
			],
			[
				"name" => "Química",
				"key" => 'LVWUYJE1H6',
				"grade_id" => 3
			],
			[
				"name" => "Historía 2",
				"key" => 'A0J8KU3YTZ',
				"grade_id" => 3
			],
			[
				"name" => "Formación cívica y ética 3",
				"key" => 'HSEMVIT39N',
				"grade_id" => 3
			],
			[
				"name" => "Tecnología 3",
				"key" => 'D2NGLBPSHC',
				"grade_id" => 3
			],
			[
				"name" => "Educación física 3",
				"key" => '4ISL6YXD3M',
				"grade_id" => 3
			],
			[
				"name" => "Artes música 3",
				"key" => '7Y425ONT8K',
				"grade_id" => 3
			],
			[
				"name" => "Receso",
				"key" => "receso",
				"grade_id" => 3
			],
        ];
        return $subjects;
    }
	public function generateRandomString($length = 10)
	{
		return substr(
			str_shuffle(
				str_repeat(
					$x = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",
					ceil($length / strlen($x))
				)
			),
			1,
			$length
		);
	}
}
