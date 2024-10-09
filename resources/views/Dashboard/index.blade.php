@extends('layoutadmin.main')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="alert alert-primary" role="alert" style="background-color: #3C91E6; color: #fff">

            @if (auth()->user()->akses == 'Admin')
            <center>
                <strong>Selamat Datang {{ ucwords(Auth::user()->name) }} Kamu Login Sebagai
                    {{ Auth::user()->akses }}
                </strong>
            </center>
            @else
            <center>
                <strong>Selamat Datang {{ ucwords(Auth::user()->name) }} Anda Login Sebagai
                    {{ Auth::user()->akses }}
                    {{ Auth::user()->sekolah->nama ?? '' }}</strong>
            </center>
            @endif

        </div>
        @if (auth()->user()->akses == 'Admin')

        @endif


        </h5>
    </div>
</div>
@endsection

@push('after-style')

<style>
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
        --white: #fffffff0;
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
        background: var(--light-yellow);
        color: var(--yellow);
    }

    .box-info li:nth-child(3) .bx {
        background: var(--light-orange);
        color: var(--orange);
    }

    .box-info li:nth-child(4) .bx {
        background: var(--grey);
        color: var(--dark-grey);
    }

    .box-info li:nth-child(5) .bx {
        background: var(--light-green);
        color: var(--green);
    }

    .box-info li:nth-child(6) .bx {
        background: var(--red);
        color: var(--light-red);
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