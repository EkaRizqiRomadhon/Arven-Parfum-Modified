@extends('layouts.admin')
@section('title', 'Pelanggan - ARVEN PARFUME')
@section('header-title', 'Management Pelanggan')

@section('content')
    @if(session('success'))
        <script>document.addEventListener('DOMContentLoaded', () => showToast('{{ session('success') }}', 'success'));</script>
    @endif

    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR PELANGGAN</h2>
            <span style="color:var(--mute); font-size:14px;">{{ $customers->total() }} total pelanggan</span>
        </div>
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; text-align:left;">
                <thead>
                    <tr>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">ID</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Nama</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Email</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Status</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase;">Bergabung</th>
                        <th style="padding:16px 0; border-bottom:1px solid var(--hairline); color:var(--mute); font-size:12px; font-weight:600; text-transform:uppercase; text-align:right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; font-weight:500;">#{{ $customer->id }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; font-weight:500;">{{ $customer->full_name }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px;">{{ $customer->email }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft);">
                                @if($customer->is_active)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-sale">Nonaktif</span>
                                @endif
                            </td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); font-size:14px; color:var(--mute);">{{ $customer->created_at->format('d M Y') }}</td>
                            <td style="padding:16px 0; border-bottom:1px solid var(--hairline-soft); text-align:right;">
                                <a href="{{ route('admin.customers.show', $customer->id) }}" style="font-size:14px; color:var(--ink); text-decoration:underline; font-weight:500;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" style="padding:32px 0; color:var(--mute); font-size:14px;">Belum ada pelanggan.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($customers->hasPages())
            <div style="margin-top:24px;">{{ $customers->links() }}</div>
        @endif
    </div>
@endsection
