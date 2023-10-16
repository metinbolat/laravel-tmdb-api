<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
//use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SettingsController extends Controller
{
    public function view()
    {
        $settings = Setting::find(1);
        return view ('admin.settings', compact('settings'));
    }

    public function updateGeneralSettings(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required',
            'site_email' => 'required|email',
            'site_description' => 'required'

        ]);
        $updateSettings = Setting::find(1)->update([
            'site_name' => $request->site_name,
            'site_email' => $request->site_email,
            'site_description' => $request->site_description,
            'site_separator' => $request->site_separator,
            'site_footertext' => $request->site_footertext,
            'comment_approval' => $request->comment_approval,
        ]);
        if ($updateSettings) {
            return redirect()->back()->with('status', 'Ayarlar Güncellendi!');
        } else {
            return redirect()->back()->with('error', 'Ayarlar Güncellenemedi');
        }

    }

    public function changeSiteLogo (Request $request)
    {
        $settings = Setting::find(1);
        $logo_path = 'assets/admin/images/logo-favicon/';
        $old_logo = $settings->getAttributes()['site_logo'];
        $file = $request->file('site_logo');
        $filename = time().'-'.rand(1, 100000).'_site_logo.png';
        //dd($file);
        if ($request->hasFile('site_logo')) {

            if ($old_logo != null && File::exists(public_path($logo_path.$old_logo))){
                File::delete(public_path($logo_path.$old_logo));
            }
            $upload = $file->move(public_path($logo_path), $filename);
            if ($upload){
                $settings->update([
                    'site_logo' => $filename
                ]);
                return redirect()->back()->with('status', 'Site logosu güncellendi!');
            } else {
                return redirect()->back()->with('status', 'Site logosu güncellenemedi!');
            }
        }
    }

    public function changeSiteFavicon (Request $request)
    {
        $settings = Setting::find(1);
        $favicon_path = 'assets/admin/images/logo-favicon/';
        $old_favicon = $settings->getAttributes()['site_favicon'];
        $file = $request->file('site_favicon');
        $filename = time().'-'.rand(1, 100000).'_site_favicon.ico';
        //dd($file);
        if ($request->hasFile('site_favicon')) {

            if ($old_favicon != null && File::exists(public_path($favicon_path.$old_favicon))){
                File::delete(public_path($favicon_path.$old_favicon));
            }
            $upload = $file->move(public_path($favicon_path), $filename);
            if ($upload){
                $settings->update([
                    'site_favicon' => $filename
                ]);
                return redirect()->back()->with('status', 'Site favicon güncellendi!');
            } else {
                return redirect()->back()->with('status', 'Site favicon güncellenemedi!');
            }
        }
    }
}
