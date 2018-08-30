<?php

namespace App\Http\Controllers;

use App\Models\Money;
use App\Models\Products;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Main page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $money = Money::with('owner')->get();
        $products = Products::all();
        $user = $this->getOwner($money, 'user');
        $vm = $this->getOwner($money, 'vm');

        return view('main.index', compact('user', 'vm', 'products'));
    }

    /**
     * Get money of owner
     *
     * @param $money
     * @param $owner
     * @return mixed
     */
    private function getOwner($money, $owner)
    {
        return $money->filter(function ($value, $key) use($owner) {
            return $value->owner->name === $owner;
        });
    }
}
