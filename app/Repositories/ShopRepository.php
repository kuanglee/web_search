<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
use App\Http\Controllers\Auth;
use App\Models\Shop;
use Illuminate\Support\Facades\DB;


//use Your Model

/**
 * Class ShopRepository.
 */
class ShopRepository extends BaseRepository
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function getShops($sort, $direction, $startDate, $endDate, $searchKey, $userShop, $limit)
    {
//        $a = DB::select(DB::raw("SELECT * FROM users WHERE id = ?"), [1]);
//        dd($a);
        $user_id = \Illuminate\Support\Facades\Auth::user()->id;
        return Shop::select('shops.id', 'shops.shop_name', 'shops.address', 'shops.description', 'shops.created_at')
            ->LeftJoin('user_shops', 'user_shops.shop_id', 'shops.id')
            ->when(!empty($startDate), function ($query) use ($startDate) {
                return $query->where('shops.created_at', '>=', $startDate);
            })->when(!empty($endDate), function ($query) use ($endDate) {
                return $query->where('shops.created_at', '<=', $endDate);
            })
            ->when(!empty($searchKey), function ($query) use ($searchKey) {
                return $query->where('shops.shop_name', 'like', '%' . $searchKey . '%');
            })->when(!empty($sort), function ($query) use ($sort, $direction) {
                return $query->orderBy($sort, $direction);
            })
//            ->when(!empty($userShop), function ($query) use ($userShop) {
//                return $query->whereIn('user_shops.shop_id', $userShop);
//            })
            ->orderBy('shops.created_at', 'desc')
            ->where('user_shops.user_id', $user_id)
            ->paginate($limit);
    }

    public function model()
    {
        //return YourModel::class;
    }

}
