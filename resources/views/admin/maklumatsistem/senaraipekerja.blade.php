@extends('layouts.admin-main')

@section('css')

<style>
    .card {
        margin-bottom: 20px;
    }

    .btn-add {
        background-color: #28a745;
        color: white;
        font-weight: bold;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-add:hover {
        background-color: #218838;
    }

    .btn-info, .btn-edit, .btn-delete {
        font-weight: bold;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
    }

    .btn-info {
        background-color: #17a2b8;
        color: white;
    }

    .btn-edit {
        background-color: #007bff;
        color: white;
    }

    .btn-delete {
        background-color: #dc3545;
        color: white;
    }

    .btn-info:hover {
        background-color: #138496;
    }

    .btn-edit:hover {
        background-color: #0056b3;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f8f9fa;
    }
</style>
@endsection

@section('content')
<div class="page-heading">
    <h3>Senarai Pekerja dan Pentadbir</h3>
</div>
<div class="container">
    <div class="card shadow p-3">
        <div class="card-header pb-0">
            <div class="row align-items-center mb-2">
                <div class="col-md-9" style="font-size: 0.85rem; color: #555;">
                    <label class="me-2 fw-bold text-dark text-decoration-underline">NOTA:</label>
                    <em>
                        <ul style="font-size: 0.95em; color: #555; padding-left: 18px;" class="mb-0">
                            <li>Pekerja yang <strong>tidak disahkan dan tidak aktif</strong> tidak boleh log masuk ke sistem</li>
                            <li>Anda tidak boleh memadam maklumat anda sendiri sebagai pentadbir (admin) </li>
                            <li>Anda tidak boleh mengubah status atau pengesahan anda sendiri</li>
                            <li>Anda boleh menukar peranan pentadbir lain kepada pekerja biasa atau pelanggan tetapi perlu memastikan sekurang-kurangnya seorang pentadbir disahkan wujud dalam sistem.</li>
                            <li>Dengan <strong>membuang pengesahan</strong> pekerja, status mereka juga akan bertukar secara automatik kepada tidak aktif.</li>
                        </ul>
                    </em>
                </div>
                <div class="col-md-3 text-end align-self-end">
                    <a href="{{ route('senarai-pekerja.create') }}" class="btn btn-sm btn-success">
                        <i class="fa fa-plus"></i> Tambah Pengguna Baru
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-scrollable-table>
                <table class="table table-bordered table-striped" style="min-width: 1000px;">
                    <thead style="background-color: #343a40; color: #fff;">
                        <tr>
                        <!-- <tr class="tindakan-bg"> -->
                            <th>No</th>
                            <th width="10%">Tindakan</th>
                            <th width="10%">Pengesahan Admin?</th>
                            <th width="10%">Status Pengguna</th>
                            <th>Nama Pengguna</th>
                            <th>Jawatan</th>
                            <th>No Telefon</th>
                            <th>Email</th>
                            <!-- <th class="sticky-col sticky-right tindakan-bg">Tindakan</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($workers as $worker)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                            <!-- <td class="sticky-col sticky-right tindakan-bg"> -->
                                <a href="{{ route('senarai-pekerja.edit', $worker->id) }}" class="btn btn-sm btn-primary">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                @if(auth()->user()->id !== $worker->id)
                                    <form action="{{ route('senarai-pekerja.destroy', $worker->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda pasti untuk memadam pekerja ini?')">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('toggleDisahkan', $worker->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-sm {{ $worker->disahkan ? 'btn-add' : 'btn-danger' }} py-0 px-1" style="font-size: 0.85rem;">
                                        {{ $worker->disahkan ? '✓ Disahkan' : '✗ Belum' }}
                                    </button>
                                </form>
                            </td>
                            <td>{{ $worker->status }}</td>
                            <td>{{ $worker->name }}</td>
                            <td>
                                @php
                                    $role = ucfirst(strtolower($worker->peranan));
                                @endphp
                                @if(strtolower($worker->peranan) === 'pentadbir')
                                    <strong>{{ $role }}</strong>
                                @else
                                    {{ $role }}
                                @endif
                            </td>
                            <td>{{ $worker->phone }}</td>
                            <td>{{ $worker->email }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </x-scrollable-table>
        </div>
    </div>
</div>
@endsection
