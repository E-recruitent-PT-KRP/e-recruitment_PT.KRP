@extends('layoutadmin.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="alert alert-primary" role="alert" style="background-color: #3C91E6; color: #fff;">
            <center>
                <strong>Selamat Datang {{ ucwords(Auth::user()->name) }}!</strong>
            </center>
        </div>
    </div>

    <!-- Card Info Section -->
    <div class="col-md-12">
        <ul class="box-info">
            <!-- Card Pendaftar -->
            <li>
                <div class="bx">
                    <i class="bx bx-user"></i>
                </div>
                <div class="text">
                    <h3>{{ $totalPendaftar }}</h3>
                    <p>Total Pendaftar</p>
                </div>
            </li>

            <!-- Card Diterima -->
            <li>
                <div class="bx">
                    <i class="bx bx-check-circle"></i>
                </div>
                <div class="text">
                    <h3>{{ $totalDiterima }}</h3>
                    <p>Pendaftar Diterima</p>
                </div>
            </li>

            <!-- Card Ditolak -->
            <li>
                <div class="bx">
                    <i class="bx bx-x-circle"></i>
                </div>
                <div class="text">
                    <h3>{{ $totalDitolak }}</h3>
                    <p>Pendaftar Ditolak</p>
                </div>
            </li>
        </ul>
    </div>
</div>
@endsection

@push('after-style')
<style>
    /* Styles tetap sama dengan yang sudah ada sebelumnya */
    :root {
        --poppins: 'Poppins', sans-serif;
        --lato: 'Lato', sans-serif;

        --light: #F9F9F9;
        --blue: #3C91E6;
        --light-blue: #CFE8FF;
        --grey: #eee;
        --dark-grey: #AAAAAA;
        --dark: #342E37;
        --red: #fa0800;
        --light-red: #ffffffe6;
        --yellow: #FFCE26;
        --light-yellow: #FFF2C6;
        --orange: #FD7238;
        --light-orange: #FFE0D3;
        --light-green: #D1F2EB;
        --green: #2ECC71;
    }

    .box-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        grid-gap: 24px;
        margin-top: 36px;
    }

    .box-info li {
        padding: 24px;
        background: #fff;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-direction: column;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .box-info li:hover {
        transform: translateY(-5px);
    }

    .box-info li .bx {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        font-size: 36px;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 16px;
    }

    .box-info li:nth-child(1) .bx {
        background: var(--light-blue);
        color: var(--blue);
    }

    .box-info li:nth-child(2) .bx {
        background: var(--light-green);
        color: var(--green);
    }

    .box-info li:nth-child(3) .bx {
        background: var(--light-red);
        color: var(--red);
    }

    .box-info li .text {
        text-align: center;
    }

    .box-info li .text h3 {
        font-size: 24px;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 8px;
    }

    .box-info li .text p {
        color: var(--dark-grey);
    }
</style>
@endpush