<?php

namespace App\Http\Controllers;

class ApiTesterController extends Controller
{
    public function index()
    {
        $baseUrl = url('/api');

        $apiGroups = [
            [
                'group' => 'Autentikasi Mobile',
                'description' => 'API untuk login, register, logout, dan reset password aplikasi mobile.',
                'items' => [
                    [
                        'name' => 'Mobile Login',
                        'method' => 'POST',
                        'endpoint' => '/mobile/login',
                        'auth' => false,
                        'description' => 'Login pengguna mobile. Gunakan akun role pengguna, bukan admin.',
                        'body' => [
                            'username' => 'elisaaa',
                            'password' => 'password123',
                        ],
                    ],
                    [
                        'name' => 'Register',
                        'method' => 'POST',
                        'endpoint' => '/register',
                        'auth' => false,
                        'description' => 'Registrasi akun pengguna baru.',
                        'body' => [
                            'username' => 'userdemo2',
                            'email' => 'userdemo2@gmail.com',
                            'password' => 'password123',
                            'full_name' => 'User Demo',
                            'gender' => 'L',
                            'phone' => '081234567890',
                        ],
                    ],
                    [
                        'name' => 'Mobile Logout',
                        'method' => 'POST',
                        'endpoint' => '/mobile/logout',
                        'auth' => true,
                        'description' => 'Logout pengguna mobile menggunakan token.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Forgot Password - Send OTP',
                        'method' => 'POST',
                        'endpoint' => '/mobile/forgot-password/send-otp',
                        'auth' => false,
                        'description' => 'Mengirim OTP ke email pengguna.',
                        'body' => [
                            'email' => 'userdemo@gmail.com',
                        ],
                    ],
                    [
                        'name' => 'Forgot Password - Verify OTP',
                        'method' => 'POST',
                        'endpoint' => '/mobile/forgot-password/verify-otp',
                        'auth' => false,
                        'description' => 'Verifikasi kode OTP.',
                        'body' => [
                            'email' => 'userdemo@gmail.com',
                            'otp' => '123456',
                        ],
                    ],
                    [
                        'name' => 'Forgot Password - Reset',
                        'method' => 'POST',
                        'endpoint' => '/mobile/forgot-password/reset',
                        'auth' => false,
                        'description' => 'Reset password setelah OTP valid.',
                        'body' => [
                            'email' => 'userdemo@gmail.com',
                            'otp' => '123456',
                            'password' => 'passwordbaru123',
                            'password_confirmation' => 'passwordbaru123',
                        ],
                    ],
                ],
            ],

            [
                'group' => 'Profile',
                'description' => 'API profil pengguna mobile. Endpoint ini membutuhkan token login.',
                'items' => [
                    [
                        'name' => 'Lihat Profile',
                        'method' => 'GET',
                        'endpoint' => '/profile',
                        'auth' => true,
                        'description' => 'Mengambil data profil pengguna yang sedang login.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Update Profile',
                        'method' => 'PUT',
                        'endpoint' => '/profile',
                        'auth' => true,
                        'description' => 'Mengubah data profil pengguna.',
                        'body' => [
                            'full_name' => 'User Demo Update',
                            'gender' => 'L',
                            'phone' => '081234567890',
                        ],
                    ],
                    [
                        'name' => 'Update Password',
                        'method' => 'PUT',
                        'endpoint' => '/profile/password',
                        'auth' => true,
                        'description' => 'Mengubah kata sandi pengguna.',
                        'body' => [
                            'current_password' => 'password123',
                            'new_password' => 'passwordbaru123',
                            'new_password_confirmation' => 'passwordbaru123',
                        ],
                    ],
                    [
                        'name' => 'Update Email',
                        'method' => 'PUT',
                        'endpoint' => '/profile/email',
                        'auth' => true,
                        'description' => 'Mengubah email pengguna.',
                        'body' => [
                            'email' => 'userdemo@gmail.com',
                        ],
                    ],
                    [
                        'name' => 'Update Sleep Goal',
                        'method' => 'PUT',
                        'endpoint' => '/profile/sleep-goal',
                        'auth' => true,
                        'description' => 'Mengubah target tidur pengguna.',
                        'body' => [
                            'sleep_goal' => 8,
                        ],
                    ],
                    [
                        'name' => 'Update Preferences',
                        'method' => 'PUT',
                        'endpoint' => '/profile/preferences',
                        'auth' => true,
                        'description' => 'Mengubah preferensi pengguna.',
                        'body' => [
                            'theme' => 'light',
                            'notification' => true,
                        ],
                    ],
                ],
            ],

            [
                'group' => 'Prediksi Gangguan Tidur',
                'description' => 'API inti untuk melakukan prediksi, melihat riwayat, dan menghasilkan solusi.',
                'items' => [
                    [
                        'name' => 'Prediksi Tidur',
                        'method' => 'POST',
                        'endpoint' => '/v1/predictions',
                        'auth' => true,
                        'description' => 'Mengirim data tidur pengguna untuk diprediksi.',
                        'body' => [
                            'gender' => 'Male',
                            'age' => 22,
                            'occupation' => 'Student',
                            'sleep_duration' => 6.5,
                            'quality_of_sleep' => 6,
                            'physical_activity_level' => 40,
                            'stress_level' => 7,
                            'bmi_category' => 'Normal',
                            'blood_pressure' => '120/80',
                            'heart_rate' => 75,
                            'daily_steps' => 5000,
                        ],
                    ],
                    [
                        'name' => 'Riwayat Prediksi',
                        'method' => 'GET',
                        'endpoint' => '/v1/predictions/history',
                        'auth' => true,
                        'description' => 'Melihat riwayat prediksi pengguna.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Ringkasan Riwayat Prediksi',
                        'method' => 'GET',
                        'endpoint' => '/v1/predictions/history/summary',
                        'auth' => true,
                        'description' => 'Melihat ringkasan riwayat prediksi pengguna.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Detail Prediksi',
                        'method' => 'GET',
                        'endpoint' => '/v1/predictions/{id}',
                        'auth' => true,
                        'description' => 'Melihat detail prediksi berdasarkan ID. Ganti {id} dengan ID prediksi asli.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Generate Solusi Prediksi',
                        'method' => 'POST',
                        'endpoint' => '/v1/predictions/{id}/solution',
                        'auth' => true,
                        'description' => 'Membuat solusi berdasarkan hasil prediksi. Ganti {id} dengan ID prediksi asli.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Hapus Riwayat Prediksi',
                        'method' => 'DELETE',
                        'endpoint' => '/v1/predictions/history/{id}',
                        'auth' => true,
                        'description' => 'Menghapus riwayat prediksi berdasarkan ID.',
                        'body' => [],
                        'danger' => true,
                    ],
                ],
            ],

            [
                'group' => 'Sleep Logs',
                'description' => 'API catatan tidur harian pengguna.',
                'items' => [
                    [
                        'name' => 'List Sleep Logs',
                        'method' => 'GET',
                        'endpoint' => '/sleep-logs',
                        'auth' => true,
                        'description' => 'Melihat semua catatan tidur pengguna.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Sleep Log Terbaru',
                        'method' => 'GET',
                        'endpoint' => '/sleep-logs/latest',
                        'auth' => true,
                        'description' => 'Melihat catatan tidur terbaru.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Ringkasan Sleep Logs',
                        'method' => 'GET',
                        'endpoint' => '/sleep-logs/summary',
                        'auth' => true,
                        'description' => 'Melihat ringkasan catatan tidur.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Tambah Sleep Log',
                        'method' => 'POST',
                        'endpoint' => '/sleep-logs',
                        'auth' => true,
                        'description' => 'Menambahkan catatan tidur baru.',
                        'body' => [
                            'sleep_date' => date('Y-m-d'),
                            'bed_time' => '22:30',
                            'wake_time' => '06:00',
                            'sleep_duration' => 7.5,
                            'sleep_quality' => 8,
                            'notes' => 'Tidur cukup nyenyak',
                        ],
                    ],
                    [
                        'name' => 'Update Sleep Log',
                        'method' => 'PUT',
                        'endpoint' => '/sleep-logs/{id}',
                        'auth' => true,
                        'description' => 'Mengubah sleep log berdasarkan ID.',
                        'body' => [
                            'sleep_date' => date('Y-m-d'),
                            'bed_time' => '23:00',
                            'wake_time' => '06:30',
                            'sleep_duration' => 7.5,
                            'sleep_quality' => 7,
                            'notes' => 'Update catatan tidur',
                        ],
                    ],
                    [
                        'name' => 'Hapus Sleep Log',
                        'method' => 'DELETE',
                        'endpoint' => '/sleep-logs/{id}',
                        'auth' => true,
                        'description' => 'Menghapus sleep log berdasarkan ID.',
                        'body' => [],
                        'danger' => true,
                    ],
                ],
            ],

            [
                'group' => 'Edukasi',
                'description' => 'API artikel edukasi untuk aplikasi mobile.',
                'items' => [
                    [
                        'name' => 'Artikel Published',
                        'method' => 'GET',
                        'endpoint' => '/edukasi/published',
                        'auth' => false,
                        'description' => 'Mengambil semua artikel edukasi yang sudah publish.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Artikel Berdasarkan Kategori',
                        'method' => 'GET',
                        'endpoint' => '/edukasi/kategori/insomnia',
                        'auth' => false,
                        'description' => 'Mengambil artikel berdasarkan kategori. Contoh kategori: healthy, insomnia, sleep_apnea.',
                        'body' => [],
                    ],
                    [
                        'name' => 'List Edukasi',
                        'method' => 'GET',
                        'endpoint' => '/edukasi',
                        'auth' => false,
                        'description' => 'Mengambil semua data edukasi.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Detail Edukasi',
                        'method' => 'GET',
                        'endpoint' => '/edukasi/{id}',
                        'auth' => false,
                        'description' => 'Mengambil detail edukasi berdasarkan ID. Ganti {id} dengan ID edukasi asli.',
                        'body' => [],
                    ],
                ],
            ],

            [
                'group' => 'Visualisasi & Insight',
                'description' => 'API grafik dan insight mobile.',
                'items' => [
                    [
                        'name' => 'Mobile Chart Data',
                        'method' => 'GET',
                        'endpoint' => '/mobile-chart-data',
                        'auth' => true,
                        'description' => 'Mengambil data grafik untuk aplikasi mobile.',
                        'body' => [],
                    ],
                    [
                        'name' => 'Insight',
                        'method' => 'GET',
                        'endpoint' => '/insight',
                        'auth' => true,
                        'description' => 'Mengambil insight pengguna berdasarkan data yang tersedia.',
                        'body' => [],
                    ],
                ],
            ],
        ];

        return view('api_tester.index', compact('apiGroups', 'baseUrl'));
    }
}
