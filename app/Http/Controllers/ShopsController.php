<?php

namespace App\Http\Controllers;

use App\Repositories\ShopRepository;
use Illuminate\Http\Request;
use App\Models\Shop;
use App\Utils;


class ShopsController extends Controller
{
    protected $shopRepository;

    public function __construct(Shop $shop)
    {
        $this->shopRepository = new ShopRepository($shop);
    }

    public function index(Request $request)
    {
        $searchKey = $request->input('searchKey' , null);
        $limit =$request->input('limit' , 10);
        $startDate = Utils::formatStartMonth($request->startDate);
        $endDate = Utils::formatEndMonth($request->startDate);
        $sort = $request->input('sort' , null);
        $direction = $request->input('direction', null);
        $userShop = '';
        $shops = $this->shopRepository->getShops($sort, $direction, $startDate, $endDate, $searchKey, $userShop, $limit);
        return view('admin.shops.list' , compact('shops' , 'startDate' , 'endDate' , 'searchKey' , 'sort' , 'direction'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
