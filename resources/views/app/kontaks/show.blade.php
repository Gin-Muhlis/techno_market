@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('kontaks.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.kontak.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.kontak.inputs.nama')</h5>
                    <span>{{ $kontak->nama ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.kontak.inputs.pesan')</h5>
                    <span>{{ $kontak->pesan ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.kontak.inputs.tanggal')</h5>
                    <span>{{ $kontak->tanggal ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('kontaks.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

                @can('create', App\Models\Kontak::class)
                <a href="{{ route('kontaks.create') }}" class="btn btn-light">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>
</div>
@endsection
