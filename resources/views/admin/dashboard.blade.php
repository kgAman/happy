@extends('layouts.admin')

@section('title', 'Admin Dashboard - HappilyWeds')

@push('page-styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@0,600;0,700;1,600&display=swap');

    /* Typography Overrides */
    .font-sans { font-family: 'Plus Jakarta Sans', sans-serif; }
    .font-serif { font-family: 'Playfair Display', serif; }

    /* The Signature Black-to-Pink Gradient */
    .bg-gradient-signature {
        background: linear-gradient(90deg, #0a0a0a 0%, #e75480 100%);
    }
    
    .text-gradient {
        background: linear-gradient(90deg, #111111 0%, #e75480 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Welcome Banner */
    .welcome-banner {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        box-shadow: 0 20px 40px rgba(231, 84, 128, 0.15);
    }
    
    .welcome-banner::after {
        content: '';
        position: absolute;
        top: 0; right: 0; bottom: 0; left: 0;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.1;
        pointer-events: none;
    }

    /* Premium Stat Cards */
    .admin-stat-card {
        border: none;
        border-radius: 20px;
        background: #ffffff;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .admin-stat-card::before {
        content: '';
        position: absolute;
        bottom: 0; left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, #0a0a0a 0%, #e75480 100%);
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
        z-index: -1;
    }

    .admin-stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
    }

    .admin-stat-card:hover::before {
        transform: scaleX(1);
    }

    /* Icon Boxes */
    .icon-box {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 16px;
        font-size: 1.5rem;
        transition: all 0.5s ease;
        background: #f8f9fa;
        color: #111;
    }

    .admin-stat-card:hover .icon-box {
        background: linear-gradient(135deg, #0a0a0a 0%, #e75480 100%);
        color: white;
        transform: rotate(10deg) scale(1.05);
        box-shadow: 0 10px 20px rgba(231, 84, 128, 0.3);
    }

    /* Elegant Table */
    .premium-table-card {
        border-radius: 24px;
        border: 1px solid rgba(0,0,0,0.04);
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }

    .premium-table th {
        font-family: 'Plus Jakarta Sans', sans-serif;
        text-transform: uppercase;
        font-size: 0.75rem;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: #718096;
        border-bottom: 2px solid #edf2f7;
        padding: 1.2rem 1.5rem;
    }

    .premium-table td {
        vertical-align: middle;
        border-bottom: 1px solid #f7fafc;
        padding: 1.2rem 1.5rem;
        color: #2d3748;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 500;
    }

    .premium-table tbody tr {
        transition: all 0.2s ease;
    }

    .premium-table tbody tr:hover {
        background-color: #fdf2f5;
        transform: scale(1.01);
        box-shadow: 0 4px 10px rgba(0,0,0,0.02);
    }

    /* Action Pills */
    .action-pill {
        display: flex;
        align-items: center;
        padding: 16px 20px;
        border-radius: 16px;
        background: #ffffff;
        color: #1a202c;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-weight: 600;
        text-decoration: none;
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .action-pill:hover {
        background: #111;
        color: #ffffff;
        border-color: #111;
        transform: translateX(8px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .action-pill i {
        font-size: 1.4rem;
        margin-right: 15px;
        color: #e75480;
        transition: transform 0.3s ease;
    }

    .action-pill:hover i {
        transform: scale(1.2);
    }
</style>
@endpush

@section('content')
<div class="container-fluid px-4 py-5 font-sans">
    
    <div class="welcome-banner bg-gradient-signature p-5 mb-5 text-white d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
            <h2 class="font-serif fw-bold mb-2 text-white">Welcome back, Admin.</h2>
            <p class="mb-0 fw-medium" style="opacity: 0.9;">Here is what's happening in your HappilyWeds community today.</p>
        </div>
        <div class="mt-4 mt-md-0">
            <div class="d-flex align-items-center bg-white bg-opacity-10 px-4 py-3 rounded-pill" style="backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.2);">
                <i class="bi bi-calendar2-heart-fill me-3 fs-5 text-white"></i> 
                <span class="fw-bold text-white tracking-wide">{{ now()->format('l, F j, Y') }}</span>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-5">
        
        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Total Profiles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['total_profiles'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-heart-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Registered Users</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['total_users'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-people-fill"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">New Today</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">+{{ $stats['new_profiles_today'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-stars"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="admin-stat-card h-100 p-2">
                <div class="card-body p-4 d-flex align-items-center justify-content-between">
                    <div>
                        <p class="text-muted fw-bold mb-1" style="font-size: 0.75rem; letter-spacing: 1px; text-transform: uppercase;">Active Roles</p>
                        <h3 class="font-serif fw-bold mb-0 text-dark" style="font-size: 2rem;">{{ $stats['active_roles'] ?? 0 }}</h3>
                    </div>
                    <div class="icon-box">
                        <i class="bi bi-shield-check"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white" style="border-radius: 24px !important;">
                <div class="card-header bg-transparent border-bottom-0 pt-4 pb-0 px-4">
                    <h5 class="font-serif fw-bold m-0 text-gradient">Quick Actions</h5>
                </div>
                <div class="card-body p-4">
                    <div class="d-flex flex-column gap-3">
                        <a href="{{ route('admin.profiles.index') }}" class="action-pill">
                            <i class="bi bi-person-plus-fill"></i>
                            <span>Review New Profiles</span>
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="action-pill">
                            <i class="bi bi-person-gear"></i>
                            <span>Manage User Access</span>
                        </a>
                        <a href="{{ route('admin.areas.index') }}" class="action-pill">
                            <i class="bi bi-geo-alt-fill"></i>
                            <span>Update Area Masters</span>
                        </a>
                        <a href="{{ route('admin.educations.index') }}" class="action-pill">
                            <i class="bi bi-mortarboard-fill"></i>
                            <span>Update Qualifications</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card premium-table-card bg-white h-100 overflow-hidden">
                <div class="card-header bg-transparent border-bottom pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="font-serif fw-bold mb-0 text-dark">Recent Registrations</h5>
                    <a href="{{ route('admin.profiles.index') }}" class="btn btn-sm rounded-pill px-4 fw-bold shadow-sm" style="background: #111; color: white;">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table premium-table mb-0 border-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Candidate Profile</th>
                                    <th>Location</th>
                                    <th>Status</th>
                                    <th class="pe-4 text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white bg-gradient-signature" style="width: 45px; height: 45px;">R</div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark font-sans">Rahul Sharma</h6>
                                                <small class="text-muted fw-semibold">Software Engineer</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted"><i class="bi bi-geo-alt-fill text-dark me-2"></i>Mumbai</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 6px 14px; font-weight: 700;">Active</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; color: #111; transition: all 0.3s ease;" onmouseover="this.style.background='#e75480'; this.style.color='white'" onmouseout="this.style.background='#f8f9fa'; this.style.color='#111'">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white" style="width: 45px; height: 45px; background: #111;">P</div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark font-sans">Priya Patel</h6>
                                                <small class="text-muted fw-semibold">Doctor</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="text-muted"><i class="bi bi-geo-alt-fill text-dark me-2"></i>Delhi</span>
                                    </td>
                                    <td>
                                        <span class="badge rounded-pill" style="background: rgba(217, 119, 6, 0.1); color: #d97706; padding: 6px 14px; font-weight: 700;">Pending</span>
                                    </td>
                                    <td class="pe-4 text-end">
                                        <button class="btn btn-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; color: #111; transition: all 0.3s ease;" onmouseover="this.style.background='#e75480'; this.style.color='white'" onmouseout="this.style.background='#f8f9fa'; this.style.color='#111'">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td class="ps-4 border-bottom-0">
                                        <div class="d-flex align-items-center">
                                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold me-3 shadow-sm text-white bg-gradient-signature" style="width: 45px; height: 45px;">A</div>
                                            <div>
                                                <h6 class="mb-0 fw-bold text-dark font-sans">Aditya Varma</h6>
                                                <small class="text-muted fw-semibold">Architect</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="text-muted"><i class="bi bi-geo-alt-fill text-dark me-2"></i>Bangalore</span>
                                    </td>
                                    <td class="border-bottom-0">
                                        <span class="badge rounded-pill" style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 6px 14px; font-weight: 700;">Active</span>
                                    </td>
                                    <td class="pe-4 text-end border-bottom-0">
                                        <button class="btn btn-light rounded-circle shadow-sm d-inline-flex align-items-center justify-content-center" style="width: 38px; height: 38px; color: #111; transition: all 0.3s ease;" onmouseover="this.style.background='#e75480'; this.style.color='white'" onmouseout="this.style.background='#f8f9fa'; this.style.color='#111'">
                                            <i class="bi bi-arrow-right"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection