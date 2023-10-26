<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Model\Setting\InstalltionSetting;
use Exception;
use Illuminate\Http\Request;

class ShopkeeperController extends Controller
{
    //

    public function enterCode()
    {
        // return url('/');
        return view('front.setting.verify');
    }

    public function verifyShopId(Request $request)
    {
        $request->validate(
            ['code' => 'required|min:25'],
            [
                'code.required' => 'Purchase Code Is Required',
                'code.min'      => 'Invalid Code',
            ]
        );

        $install = new InstalltionSetting;

        $install->purchase_code = $request->code;
        $install->status        = 1;
        $install->save();

        return response()->json(['status' => 'success', 'message' => 'Verified']);

    }

    public function sendShopId()
    {
        try {
            verShopkeepify();
            return response()->json(['status' => 'success']);
        } catch (Exception $e) {
            return $e;
        }

    }
}
