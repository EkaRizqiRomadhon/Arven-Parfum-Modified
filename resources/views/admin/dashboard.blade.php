@extends('layouts.admin')

@section('title', 'Admin Dashboard - ARVEN PARFUME')
@section('header-title', 'Overview Dashboard')

@section('content')
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 24px; margin-bottom: 30px;">
        <!-- Stat Card 1 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--admin-text-muted); font-size: 14px; margin-bottom: 8px;">Pesanan Baru</p>
                    <h3 style="font-size: 32px; font-weight: 700; color: #fff;">12</h3>
                </div>
                <div style="background: rgba(212, 175, 55, 0.1); color: var(--admin-primary); padding: 12px; border-radius: 8px; font-size: 20px;">
                    🛒
                </div>
            </div>
            <div style="margin-top: 15px; font-size: 13px; color: #4ade80;">
                ↑ 2 pesanan hari ini
            </div>
        </div>

        <!-- Stat Card 2 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--admin-text-muted); font-size: 14px; margin-bottom: 8px;">Total Pendapatan</p>
                    <h3 style="font-size: 28px; font-weight: 700; color: #fff;">Rp 4.5M</h3>
                </div>
                <div style="background: rgba(212, 175, 55, 0.1); color: var(--admin-primary); padding: 12px; border-radius: 8px; font-size: 20px;">
                    💰
                </div>
            </div>
            <div style="margin-top: 15px; font-size: 13px; color: var(--admin-text-muted);">
                Bulan ini
            </div>
        </div>

        <!-- Stat Card 3 -->
        <div class="admin-card" style="margin-bottom: 0;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <p style="color: var(--admin-text-muted); font-size: 14px; margin-bottom: 8px;">Pelanggan Aktif</p>
                    <h3 style="font-size: 32px; font-weight: 700; color: #fff;">128</h3>
                </div>
                <div style="background: rgba(212, 175, 55, 0.1); color: var(--admin-primary); padding: 12px; border-radius: 8px; font-size: 20px;">
                    👥
                </div>
            </div>
            <div style="margin-top: 15px; font-size: 13px; color: #4ade80;">
                ↑ 5 pelanggan baru
            </div>
        </div>
    </div>

    <!-- Recent Orders Table Area -->
    <div class="admin-card">
        <div class="card-header">
            <h2 class="card-title">Pesanan Terbaru</h2>
            <a href="#" style="color: var(--admin-primary); text-decoration: none; font-size: 14px;">Lihat Semua</a>
        </div>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--admin-border);">
                        <th style="padding: 15px; color: var(--admin-text-muted); font-weight: 500; font-size: 14px;">ID Pesanan</th>
                        <th style="padding: 15px; color: var(--admin-text-muted); font-weight: 500; font-size: 14px;">Pelanggan</th>
                        <th style="padding: 15px; color: var(--admin-text-muted); font-weight: 500; font-size: 14px;">Total</th>
                        <th style="padding: 15px; color: var(--admin-text-muted); font-weight: 500; font-size: 14px;">Status</th>
                        <th style="padding: 15px; color: var(--admin-text-muted); font-weight: 500; font-size: 14px;">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Dummy Data -->
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.02);">
                        <td style="padding: 15px; font-size: 14px;">#INV-001</td>
                        <td style="padding: 15px; font-size: 14px;">Budi Santoso</td>
                        <td style="padding: 15px; font-size: 14px;">Rp 850.000</td>
                        <td style="padding: 15px;">
                            <span style="background: rgba(212, 175, 55, 0.2); color: var(--admin-primary); padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">Pending</span>
                        </td>
                        <td style="padding: 15px; font-size: 14px; color: var(--admin-text-muted);">Hari ini, 10:45</td>
                    </tr>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.02);">
                        <td style="padding: 15px; font-size: 14px;">#INV-002</td>
                        <td style="padding: 15px; font-size: 14px;">Siti Aminah</td>
                        <td style="padding: 15px; font-size: 14px;">Rp 1.200.000</td>
                        <td style="padding: 15px;">
                            <span style="background: rgba(74, 222, 128, 0.1); color: #4ade80; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">Selesai</span>
                        </td>
                        <td style="padding: 15px; font-size: 14px; color: var(--admin-text-muted);">Kemarin, 14:30</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
