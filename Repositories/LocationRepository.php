<?php

namespace App\Repositories;

use App\Helpers\BuilderFilter\RequestFilter;
use App\Models\Location\Location;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Orkhanahmadov\EloquentRepository\Repository\Contracts\Cacheable;

class LocationRepository extends EloquentRepository implements Cacheable
{
    protected const PER_PAGE = 50;

    /**
     * @var string
     */
    protected $entity = Location::class;

    /**
     * @param string $uuid
     *
     * @return mixed
     */
    public function getByUuid(string $uuid)
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * @param  RequestFilter  $filter
     *
     * @return LengthAwarePaginator
     */
    public function getFiltered(RequestFilter $filter): LengthAwarePaginator
    {
        return $this->model
            ->filter($filter)
            ->orderBy('iso', 'ASC')
            ->orderBy('code', 'ASC')
            ->paginate(self::PER_PAGE);
    }

    /**
     * @param $request
     * @param String $input
     * @param array|string[] $columns
     * @return Collection
     */
    public function getLikeForSearch($request, String $input, array $columns = ['*']): Collection
    {
        return $this->model
            ->where('locations.name', 'LIKE', "$input%")
            ->filter($request)
            ->take(10)->get($columns);
    }

    /**
     * @return array
     */
    public function getNamesWithDoubles(): array
    {
        return DB::select('select name
                                    from locations
                                    group by name
                                    having count(*) > 1');
    }

    /**
     * @param int $level
     * @param string $input
     * @param array|string[] $columns
     * @return Collection
     */
    public function getLikeByLevelForSearch(int $level, string $input, array $columns = ['*']): Collection
    {
        return $this->model
            ->where([
                ['name', 'LIKE', "%$input%"],
                ['level', $level]
            ])
            ->take(10)->get($columns);
    }

    /**
     * @param string $uuid
     * @return Location|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function findByUuid(string $uuid): Location
    {
        return $this->model
            ->where('uuid', $uuid)
            ->first();
    }

    /**
     * @param string $value
     * @return array
     */
    public function isoCodeList(string $value = 'id'): array
    {
        return $this
            ->model
            ->newQueryWithoutScopes()
            ->select(DB::raw('CONCAT(iso, ":", LEFT(code, 2)) as value, '. $value))
            ->where('level', '1')
            ->get()
            ->pluck($value, 'value')
            ->toArray();
    }

    /**
     * @param string $iso
     * @param string $code
     * @return Location|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object
     */
    public function findByIsoCode(string $iso, string $code): ?Location
    {
        return $this->model
            ->where('iso', $iso)
            ->where('code', $code)
            ->first();
    }
}
