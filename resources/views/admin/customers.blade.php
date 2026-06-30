@extends('layouts.admin')

@section('title', 'Kelola Pelanggan - ARVEN PARFUME')
@section('header-title', 'Management Pelanggan')

@section('content')
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">DAFTAR PELANGGAN</h2>
            <button class="btn-primary" onclick="alert('Export fitur belum tersedia')">Export Data</button>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">ID</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Nama Pelanggan</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Email</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase;">Bergabung Sejak</th>
                        <th style="padding: 16px 0; border-bottom: 1px solid var(--hairline); color: var(--mute); font-weight: 600; font-size: 12px; text-transform: uppercase; text-align: right;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($customers as $customer)
                        <tr>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; font-weight: 500;">#{{ $customer->id }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; font-weight: 500; color: var(--ink);">{{ $customer->full_name }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px;">{{ $customer->email }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); font-size: 14px; color: var(--mute);">{{ $customer->created_at->format('d M Y') }}</td>
                            <td style="padding: 16px 0; border-bottom: 1px solid var(--hairline-soft); text-align: right;">
                                <a href="#" style="font-size: 14px; color: var(--ink); text-decoration: underline; font-weight: 500;">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="padding: 32px 0; text-align: center; color: var(--mute); font-size: 14px;">
                                Belum ada data pelanggan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($customers->hasPages())
            <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
                {{ $customers->links() }}
            </div>
        @endif
    </div>
@endsection
