<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice as Convocatoria;
use Response;
use Illuminate\Support\Facades\File;
class Notice extends Controller
{
	public function show($uuid)
	{
		$notice = Convocatoria::where("uuid", $uuid)->first();

		$path = storage_path("app/public/convocatorias/" . $notice->file);
		return Response::make(file_get_contents($path), 200, [
			"Content-Type" => mime_content_type($path),
			"Content-Disposition" => "inline; filename=" . $notice->file,
		]);
	}

	public function download($uuid)
	{
		$notice = Convocatoria::where("uuid", $uuid)->first();
		$path = storage_path("app/public/convocatorias/" . $notice->file);
		return response()->download($path);
	}
}
