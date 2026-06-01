@extends('layouts.dashboard')

@section('content')
<link rel="stylesheet" href="{{ asset('css/api-tester.css') }}?v={{ time() }}">

<div class="api-page">
    <h1 class="page-title">API <span>Tester</span></h1>

    <div class="api-token-card">
        <div>
            <div class="token-title">Token API</div>
            {{-- <div class="token-desc">
                Token akan otomatis tersimpan setelah endpoint login berhasil. Endpoint yang membutuhkan autentikasi akan menggunakan token ini.
            </div> --}}
        </div>

        <div class="token-actions">
            <input type="text" id="apiTokenInput" placeholder="Token akan muncul setelah login berhasil">
            <button type="button" id="clearTokenBtn">Hapus Token</button>
        </div>
    </div>

    <div class="api-layout">
        <aside class="api-sidebar" id="apiSidebar">
            <div class="api-sidebar-title">Daftar Fitur API</div>

            @foreach ($apiGroups as $groupIndex => $group)
                <a href="#group-{{ $groupIndex }}" class="api-side-link">
                    {{ $group['group'] }}
                </a>
            @endforeach
        </aside>

        <section class="api-content">
            @foreach ($apiGroups as $groupIndex => $group)
                <div class="api-group" id="group-{{ $groupIndex }}">
                    <div class="group-head">
                        <div>
                            <h2>{{ $group['group'] }}</h2>
                            <p>{{ $group['description'] }}</p>
                        </div>
                    </div>

                    <div class="api-list">
                        @foreach ($group['items'] as $apiIndex => $api)
                            @php
                                $uid = 'api-' . $groupIndex . '-' . $apiIndex;
                                $methodClass = strtolower($api['method']);
                                $bodyJson = json_encode($api['body'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
                            @endphp

                            <div class="api-card"
                                 data-method="{{ $api['method'] }}"
                                 data-endpoint="{{ $api['endpoint'] }}"
                                 data-auth="{{ $api['auth'] ? '1' : '0' }}"
                                 data-danger="{{ $api['danger'] ?? false ? '1' : '0' }}"
                                 data-target="{{ $uid }}">

                                <div class="api-card-head">
                                    <div>
                                        <div class="api-name">
                                            <span class="method-badge {{ $methodClass }}">{{ $api['method'] }}</span>
                                            {{ $api['name'] }}

                                            @if ($api['auth'])
                                                <span class="auth-badge">Butuh Token</span>
                                            @else
                                                <span class="public-badge">Public</span>
                                            @endif
                                        </div>

                                        <div class="api-url">
                                            <span>{{ $baseUrl }}</span>{{ $api['endpoint'] }}
                                        </div>

                                        <p class="api-desc">{{ $api['description'] }}</p>
                                    </div>

                                    <button type="button" class="toggle-api-btn" data-target="{{ $uid }}">
                                        Detail
                                    </button>
                                </div>

                                <div class="api-detail" id="{{ $uid }}">
                                    <div class="endpoint-editor">
                                        <label>Endpoint</label>
                                        <input type="text" class="endpoint-input" value="{{ $api['endpoint'] }}">
                                        <small>
                                            Kalau endpoint memakai <b>{id}</b>, ganti dengan ID data asli sebelum test.
                                        </small>
                                    </div>

                                    <div class="body-editor">
                                        <label>Request Body</label>
                                        <textarea class="body-input" rows="8">{{ $bodyJson }}</textarea>
                                    </div>

                                    <div class="api-actions">
                                        <button type="button" class="prefill-btn">Reset</button>
                                        <button type="button" class="test-btn">Test API</button>
                                    </div>

                                    <div class="response-box">
                                        <div class="response-head">
                                            <span>Response</span>
                                            <span class="response-status">Belum dites</span>
                                        </div>
                                        <pre class="response-output">Klik "Test API" untuk melihat response.</pre>
                                    </div>
                                </div>

                                <script type="application/json" class="default-body-json">
{!! $bodyJson !!}
                                </script>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </section>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const BASE_URL = @json($baseUrl);
    const tokenInput = document.getElementById('apiTokenInput');
    const savedToken = localStorage.getItem('noctura_api_token') || '';

    tokenInput.value = savedToken;

    tokenInput.addEventListener('input', () => {
        localStorage.setItem('noctura_api_token', tokenInput.value.trim());
    });

    document.getElementById('clearTokenBtn')?.addEventListener('click', () => {
        localStorage.removeItem('noctura_api_token');
        tokenInput.value = '';
    });

    document.querySelectorAll('.toggle-api-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.target;
            const detail = document.getElementById(id);

            if (!detail) return;

            detail.classList.toggle('open');
            btn.textContent = detail.classList.contains('open') ? 'Tutup' : 'Detail';
        });
    });

    document.querySelectorAll('.api-card').forEach(card => {
        const prefillBtn = card.querySelector('.prefill-btn');
        const testBtn = card.querySelector('.test-btn');
        const bodyInput = card.querySelector('.body-input');
        const endpointInput = card.querySelector('.endpoint-input');
        const defaultBodyScript = card.querySelector('.default-body-json');
        const responseOutput = card.querySelector('.response-output');
        const responseStatus = card.querySelector('.response-status');

        const defaultEndpoint = card.dataset.endpoint;
        const defaultBody = defaultBodyScript.textContent.trim();

        prefillBtn?.addEventListener('click', () => {
            endpointInput.value = defaultEndpoint;
            bodyInput.value = defaultBody;

            const oldText = prefillBtn.textContent;
            prefillBtn.textContent = 'Contoh Direset ✓';
            prefillBtn.classList.add('prefill-success');

            setTimeout(() => {
                prefillBtn.textContent = oldText;
                prefillBtn.classList.remove('prefill-success');
            }, 1200);
        });

        testBtn?.addEventListener('click', async () => {
            const method = card.dataset.method;
            const needAuth = card.dataset.auth === '1';
            const danger = card.dataset.danger === '1';
            const endpoint = endpointInput.value.trim();

            if (!endpoint) {
                showResponse(responseOutput, responseStatus, 'Endpoint tidak boleh kosong.', 'warning');
                return;
            }

            if (endpoint.includes('{id}')) {
                showResponse(responseOutput, responseStatus, 'Endpoint masih mengandung {id}. Ganti dengan ID data asli dulu.', 'warning');
                return;
            }

            if (danger && !confirm('Endpoint ini dapat menghapus data. Lanjutkan test?')) {
                return;
            }

            let bodyData = null;

            if (!['GET', 'DELETE'].includes(method)) {
                try {
                    bodyData = bodyInput.value.trim() ? JSON.parse(bodyInput.value) : {};
                } catch (error) {
                    showResponse(responseOutput, responseStatus, 'Format JSON body tidak valid. Periksa tanda koma, kurung kurawal, atau tanda kutip.', 'error');
                    return;
                }
            }

            const headers = {
                'Accept': 'application/json',
                'Content-Type': 'application/json',
            };

            if (needAuth) {
                const token = tokenInput.value.trim();

                if (!token) {
                    showResponse(responseOutput, responseStatus, 'Endpoint ini butuh token. Jalankan Mobile Login dulu atau isi token manual.', 'warning');
                    return;
                }

                headers['Authorization'] = `Bearer ${token}`;
            }

            const url = BASE_URL + endpoint;

            responseStatus.textContent = 'Loading...';
            responseStatus.className = 'response-status loading';
            responseOutput.textContent = 'Mengirim request...';

            testBtn.disabled = true;
            testBtn.textContent = 'Testing...';

            try {
                const options = {
                    method,
                    headers,
                };

                if (!['GET', 'DELETE'].includes(method)) {
                    options.body = JSON.stringify(bodyData);
                }

                const response = await fetch(url, options);
                const contentType = response.headers.get('content-type') || '';

                let result;

                if (contentType.includes('application/json')) {
                    result = await response.json();
                } else {
                    result = await response.text();
                }

                const formatted = typeof result === 'string'
                    ? result
                    : JSON.stringify(result, null, 2);

                responseOutput.textContent = formatted;
                responseStatus.textContent = `${response.status} ${response.statusText}`;
                responseStatus.className = response.ok
                    ? 'response-status success'
                    : 'response-status error';

                const token = findToken(result);

                if (token) {
                    localStorage.setItem('noctura_api_token', token);
                    tokenInput.value = token;
                }
            } catch (error) {
                showResponse(responseOutput, responseStatus, error.message || 'Request gagal.', 'error');
            } finally {
                testBtn.disabled = false;
                testBtn.textContent = 'Test API';
            }
        });
    });

    function showResponse(output, status, message, type) {
        output.textContent = message;
        status.textContent = type === 'warning' ? 'Peringatan' : 'Error';
        status.className = `response-status ${type}`;
    }

    function findToken(data) {
        if (!data || typeof data !== 'object') return null;

        const possibleKeys = [
            'token',
            'access_token',
            'api_token',
            'plainTextToken',
        ];

        for (const key of possibleKeys) {
            if (typeof data[key] === 'string') {
                return data[key];
            }
        }

        if (data.data && typeof data.data === 'object') {
            return findToken(data.data);
        }

        if (data.user && typeof data.user === 'object') {
            return findToken(data.user);
        }

        return null;
    }
});
</script>
@endsection