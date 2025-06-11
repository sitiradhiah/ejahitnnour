<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class EmailSettingController extends Controller
{
    public function index()
    {
        // Display values from .env
        return view('admin.maklumatsistem.tetapan.email', [
            'mail_host' => env('MAIL_HOST'),
            'mail_port' => env('MAIL_PORT'),
            'mail_username' => env('MAIL_USERNAME'),
            'mail_password' => env('MAIL_PASSWORD'),
            'mail_encryption' => env('MAIL_ENCRYPTION'),
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'MAIL_HOST' => 'required|string',
            'MAIL_PORT' => 'required|numeric',
            'MAIL_USERNAME' => 'required|string',
            'MAIL_PASSWORD' => 'required|string',
            'MAIL_ENCRYPTION' => 'required|string',
        ]);

        $this->setEnv([
            'MAIL_HOST' => $request->MAIL_HOST,
            'MAIL_PORT' => $request->MAIL_PORT,
            'MAIL_USERNAME' => $request->MAIL_USERNAME,
            'MAIL_PASSWORD' => $request->MAIL_PASSWORD,
            'MAIL_ENCRYPTION' => $request->MAIL_ENCRYPTION,
        ]);

        if ($request->has('test_email')) {
            // Set config runtime dari input user
            config([
                'mail.mailers.smtp.host' => $request->MAIL_HOST,
                'mail.mailers.smtp.port' => $request->MAIL_PORT,
                'mail.mailers.smtp.username' => $request->MAIL_USERNAME,
                'mail.mailers.smtp.password' => $request->MAIL_PASSWORD,
                'mail.mailers.smtp.encryption' => $request->MAIL_ENCRYPTION,
                'mail.default' => 'smtp',
                'mail.from.address' => $request->MAIL_USERNAME,
                'mail.from.name' => 'Ujian Emel Sistem',
            ]);

            try {
                \Mail::raw('Ini adalah emel ujian dari sistem.', function ($message) use ($request) {
                    $message->to($request->MAIL_USERNAME)
                            ->subject('Ujian Penghantar Emel ');
                });

                return redirect()->back()->with([
                    'success' => 'Emel ujian berjaya dihantar ke ' . $request->MAIL_USERNAME,
                    'active_tab' => 'email'
                ]);
            } catch (\Exception $e) {
                return redirect()->back()->with([
                    'error' => 'Gagal menghantar emel ujian: ' . $e->getMessage(),
                    'active_tab' => 'email'
                ]);
            }
        }

        Artisan::call('config:clear');

        if (file_exists(base_path('.env'))) {
            return redirect()->back()->with('success', 'Tetapan Emel telah berjaya di kemasini')->with('active_tab', $request->input('active_tab'));
        } else {
            return redirect()->back()->with('error', 'Tetapan Emel tidak berjaya dikemaskini')->with('active_tab', $request->input('active_tab'));
        }
    }

    protected function setEnv($values = [])
    {
        $envPath = base_path('.env');
        $content = file_get_contents($envPath);

        foreach ($values as $key => $value) {
            $pattern = "/^{$key}=.*/m";
            $replacement = "{$key}=\"{$value}\"";
            if (preg_match($pattern, $content)) {
                $content = preg_replace($pattern, $replacement, $content);
            } else {
                $content .= "\n{$replacement}";
            }
        }

        file_put_contents($envPath, $content);
    }
}

