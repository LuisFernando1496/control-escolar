<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Asset;

use Response;

class AssetController extends Controller
{
	/**
	 * get the path via params 
	 * to be displayed in the 
	 * browser only pdf and imagens
	 *
	 * this params come from the database
	 * @param string $description
	 * @param string $subject
	 * @param string $title
	 * @return Response 
	 */
	public function show($description, $subject, $title)
	{
		$route = $this->pathToFile($description, $subject, $title);
		if (file_exists($route)) {
			return Response::make(file_get_contents($route), 200, [
				"Content-Type" => mime_content_type($route),
				"Content-Disposition" => "inline; filename=" . $title,
			]);
		} else {
			return response()->json(["message" => "get out of here, 😡"], 401);
		}
	}

	/**
	 * find the file to be downloaded
	 *
	 * this params come from the database
	 * @param string $description
	 * @param string $subject
	 * @param string $title
	 * @return Reponse 
	 */
	public function download($description, $subject, $title)
	{
		$path = $this->pathToFile($description, $subject, $title);
		return response()->download($path);
	}

	/**
	 * prepare the path to be used
	 * for view or download actions
	 * 
	 * @param [string] $description
	 * @param [string] $subject
	 * @param [string] $title
	 * @return string
	 */
	public function pathToFile($description, $subject, $title)
	{
		$path = $description . "/" . $subject . "/" . $title;
		return storage_path("app/public/instrumentacion/" . $path);
	}
}
