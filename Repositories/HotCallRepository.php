<?php

namespace App\Http\Applications\Admin\Repositories;

use App\Models\HotCall\HotCall;
use App\Repositories\EloquentRepository;
use Illuminate\Pagination\LengthAwarePaginator;

class HotCallRepository extends EloquentRepository
{
    /*
     * records per page
     */
    public const PER_PAGE = 30;

    /**
     * @var string
     */
    protected $entity = HotCall::class;

    /**
     * @param  string  $uuid
     * @return \App\Models\HotCall\HotCall|null
     */
    public function findByUuid(string $uuid):? HotCall
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * @param $request
     * @return LengthAwarePaginator
     */
    public function getFiltered($request): LengthAwarePaginator
    {
        return $this->model
            ->with([
                'department',
                'operator',
                'client',
                'client.location',
                'request'
            ])
            ->filter($request)
            ->paginate(self::PER_PAGE);
    }

    /**
     * @param $hotCallId
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
    public function findWithRelations($hotCallId)
    {
        return $this->model
            ->with([
                'department',
                'operator',
                'client',
                'request'
            ])
            ->where('id', $hotCallId)
            ->first();
    }

    /**
     * @param $hotCallUuids
     * @param $operatorId
     * @return bool|int
     */
    public function assign($hotCallUuids, $operatorId):? int
    {
        return $this->model
            ->whereIn('uuid', $hotCallUuids)
            ->update([
                'operator_id' => $operatorId,
                'processed_at' => null,
                'date' => now()
            ]);
    }
}
