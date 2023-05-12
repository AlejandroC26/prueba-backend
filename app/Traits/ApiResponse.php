<?php

namespace App\Traits;

trait ApiResponse{

	protected function successResponse($data, $code = 200)
	{
		return response()->json([
			'meta'=> [ 
				"success" => true, 
				'errors' => [],
			],
			"data" => $data	
		], $code);
	}

	protected function errorResponse($errors = [], $code = 404)
	{
		return response()->json([
			'meta'=> [ 
				"success" => false, 
				'errors' => $errors,
			],			
		], $code);
	}

}
