<?php

namespace App\Services;

use Illuminate\Cache\CacheManager;
use App\Models\Candidate;

class CandidateCacheService
{
    private $cache;
    public function __construct(CacheManager $cache)
    {
        $this->cache = $cache;
    }

    public function getCandidate($id, $authUser)
    {
        return $this->cache->remember('candidate:' . $id . $authUser->role, 180, function () use ($id, $authUser) {
            if($authUser->role === 'agent') {
                return Candidate::where([
                    'id' => $id, 
                    'owner' => $authUser->id
                ])->first();
            } else {
                return Candidate::find($id);
            }
        });
    }
}