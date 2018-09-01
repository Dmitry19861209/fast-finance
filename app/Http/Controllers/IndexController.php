<?php

namespace App\Http\Controllers;

use App\Models\Display;
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
        $display = Display::first();
        $money = Money::with('owner')->get();
        $products = Products::all();
        $user = $this->getOwner($money, 'user');
        $vm = $this->getOwner($money, 'vm');

        return view('main.index', compact('user',
            'vm', 'products', 'display'));
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

    /**
     * Make payment
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makePayment(Request $request)
    {
        $id = $request->input('moneyId');
        $display = false;
        $money = Money::find($id);
        if($money) {
            $money = $money->updateCount();
            $display = Display::updatePaySum(isset($money->value) ? $money->value : 0, true);
        }

        return response()->json([
            'money' => $money,
            'display' => $display,
        ]);
    }

    /**
     * Make purchase
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function makePurchase(Request $request)
    {
        $id = $request->input('productId');
        $display = false; $monies = false;
        $product = Products::find($id);

        if($product) {
            $display = Display::updatePaySum(isset($product->price) ? $product->price : 0);
            if($display) {
                $product = $product->updateCount();
                $monies = Money::updateAllCount($product->price, 'buy');
            }
        }

        return response()->json([
            'product' => $product,
            'display' => $display,
            'monies' => $monies,
        ]);
    }

    /**
     * Money back
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function moneyBack(Request $request)
    {
        $paySum = $request->input('paySum');
        $display = false; $monies = false;
        if ($paySum > 0) {
            $monies = Money::updateAllCount($paySum, 'moneyBack');
            $display = Display::defaultPaySum();
        }

        return response()->json([
            'monies' => $monies,
            'display' => $display,
        ]);
    }
}
