<?php

namespace App\Http\Controllers\Backend;

use App\Faq;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function index()
    {
        $data['faqs'] = Faq::orderBy('order')->get();
        $settings = Setting::all();
        $data['terms'] = $settings->where('name', 'terms')->first();
        return view('backend.settings.index', $data);
    }

    public function save(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);
        unset($input['files']);

        $settings = Setting::all();
        $update = '';

        if ($input['terms'] != '') {
            $terms = $settings->where('name', 'terms');
            if ($input['terms'] != $terms) {
                $update = Setting::updateOrCreate(
                    ['name' => 'terms', 'body' => $input['terms']]
                );
            }
        }

        if ($update) {
            return redirect()->back()->with('info', 'Update Success');
        } else {
            return redirect()->back()->with('error', 'Update Failed');
        }
    }

    public function createFaq()
    {
        $data['url'] = url('admin/settings/faq');
        return view('backend.settings.formFaq', $data);
    }

    public function insertFaq(Request $request)
    {
        $input = $request->all();
        unset($input['_token']);

        Faq::create($input);

        return redirect('admin/settings')->with('info', 'Add FAQ success!');
    }

    public function editFaq($id)
    {
        $data['faq'] = Faq::find($id);
        $data['url'] = url('admin/settings/faq/'.$id);
        $data['edit'] = true;
        return view('backend.settings.formFaq', $data);
    }

    public function updateFaq(Request $request, $id)
    {
        $input = $request->all();
        unset($input['_token']);

        $faq = Faq::find($id);

        $update = $faq->update($input);

        return redirect('admin/settings')->with('info', 'Update FAQ success!');
    }

    public function deleteFaq($id)
    {
        $faq = Faq::find($id);
        $faq->delete();

        return redirect('admin/settings')->with('info', 'Delete FAQ Success.');
    }
}
