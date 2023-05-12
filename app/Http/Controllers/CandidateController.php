<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCandidateRequest;
use App\Http\Resources\CandidateResource;
use App\Models\Candidate;
use App\Services\CandidateCacheService;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    use ApiResponse;

    public function index() 
    {
        $authUser = auth()->user();
        $candidates = cache()->remember('candidates:'.$authUser->role.':'.$authUser->id, 180, function () use ($authUser) {
            if($authUser->role == 'agent') {
                return Candidate::where('owner', $authUser->id)->get();
            } else {
                return Candidate::all();
            }
        });

        return $this->successResponse(CandidateResource::collection($candidates));
    }

    public function store(StoreCandidateRequest $request)
    {
        $candidate = Candidate::create(array_merge($request->validated(), ['created_by' => auth()->user()->id]));
        return $this->successResponse(CandidateResource::make($candidate));
    }

    public function show($id, CandidateCacheService $cache)
    {
        $authUser = auth()->user();
        $candidate = $cache->getCandidate($id, $authUser);
        
        if(!$candidate) return $this->errorResponse(['No lead found'], 404);
        return $this->successResponse(CandidateResource::make($candidate));
    }
}
