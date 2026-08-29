<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateSettingsRequest;
use App\Services\Settings;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SettingController extends Controller
{
    public function edit(Settings $settings): View
    {
        return view('admin.settings.edit', ['settings' => $settings]);
    }

    public function update(UpdateSettingsRequest $request, Settings $settings): RedirectResponse
    {
        foreach ($request->validated() as $group => $values) {
            foreach ($values as $key => $value) {
                $settings->put($group, $key, $value);
            }
        }

        return back()->with('status', 'Settings updated.');
    }
}
