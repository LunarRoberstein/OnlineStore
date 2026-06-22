<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] = "List of products";
        $viewData["products"] = Product::all();

        return view('product.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];

        $product = Product::findOrFail($id);

        $viewData["title"] =
            $product->getName() . " - Online Store";

        $viewData["subtitle"] =
            $product->getName() . " - Product information";

        $viewData["product"] = $product;

        return view('product.show')
            ->with("viewData", $viewData);
    }

    public function purchase(Request $request)
    {
        $productsInSession =
            $request->session()->get("products");

        if (!$productsInSession) {
            return redirect()->route('cart.index');
        }

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $productsInCart = Product::findMany(
            array_keys($productsInSession)
        );

        $total = 0;

        foreach ($productsInCart as $product) {
            $quantity =
                $productsInSession[$product->getId()];

            $total +=
                $product->getPrice() * $quantity;
        }

        if ($user->getBalance() < $total) {
            return redirect()
                ->route('cart.index')
                ->with(
                    'error',
                    'Your balance is not enough to complete the purchase.'
                );
        }

        $order = new Order();
        $order->setUserId($user->getId());
        $order->setTotal(0);
        $order->save();

        foreach ($productsInCart as $product) {

            $quantity =
                $productsInSession[$product->getId()];

            $item = new Item();
            $item->setQuantity($quantity);
            $item->setPrice($product->getPrice());
            $item->setProductId($product->getId());
            $item->setOrderId($order->getId());
            $item->save();
        }

        $order->setTotal($total);
        $order->save();

        $newBalance =
            $user->getBalance() - $total;

        $user->setBalance($newBalance);
        $user->save();

        $request->session()->forget('products');

        $viewData = [];
        $viewData["title"] =
            "Purchase - Online Store";
        $viewData["subtitle"] =
            "Purchase Status";
        $viewData["order"] = $order;

        return view('cart.purchase')
            ->with("viewData", $viewData);
    }
}