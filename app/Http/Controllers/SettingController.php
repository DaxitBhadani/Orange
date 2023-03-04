<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    public function settings()
    {
        $setting = Setting::first();
        return view('settings', [
            'settings' => $setting,
        ]);
    }

    public function updateSetting(Request $request)
    {
        $validator = Validator::make($request->all(), []);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages(),
            ]);
        }

        $setting = Setting::get()->first();
        if ($setting) {
            if ($request->has('currency')) {
                $setting->currency = $request->currency;
            }
            if ($request->has('redeem_thread')) {
                $setting->redeem_thread = $request->redeem_thread;
            }
            if ($request->has('coin_rate')) {
                $setting->coin_rate = $request->coin_rate;
            }
            if ($request->has('minimum_users_live')) {
                $setting->minimum_users_live = $request->minimum_users_live;
            }
            if ($request->has('maximum_min_users_live')) {
                $setting->maximum_min_users_live = $request->maximum_min_users_live;
            }
            if ($request->has('message_price')) {
                $setting->message_price = $request->message_price;
            }
            if ($request->has('reverse_swipe_price')) {
                $setting->reverse_swipe_price = $request->reverse_swipe_price;
            }
            if ($request->has('live_watching_price')) {
                $setting->live_watching_price = $request->live_watching_price;
            }
            if ($request->has('ad_banner_android')) {
                $setting->ad_banner_android = $request->ad_banner_android;
            }
            if ($request->has('ad_interstitial_android')) {
                $setting->ad_interstitial_android = $request->ad_interstitial_android;
            }
            if ($request->has('ad_banner_iOS')) {
                $setting->ad_banner_iOS = $request->ad_banner_iOS;
            }
            if ($request->has('ad_interstitial_iOS')) {
                $setting->ad_interstitial_iOS = $request->ad_interstitial_iOS;
            }
            if ($request->has('for_dating_app')) {
                $setting->for_dating_app = $request->for_dating_app;
            }
            $setting->save();

            return response()->json([
                'status' => 200,
                'message' => 'For Dating app',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Click Not Found',
            ]);
        }
        

    }
}
