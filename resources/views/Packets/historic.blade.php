@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

@section('title', 'Histórico de entregas - Gerenciamento completo de registros.')

@section('content')
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-md-6 col-12 text-center text-lg-start fine-tunning">
                            <h5 class="mb-0">Histórico de entregas</h5>
                            <p class="text-sm mb-0">
                                <span class="font-weight-bold">Gestão completa</span> de entregas
                            </p>
                        </div>
                    </div>
                </div>
                <div class="card-body pb-2">
                    @livewire('packets')
                </div>
            </div>
        </div>
    </div>

    @if(session('msg-success'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .success({
                    message: '{{ session('msg-success') }}',
                    dismissible: true,
                    duration: 5000
                });
        </script>
    @endif

    @if(session('msg-error'))
        <script>
            const notyf = new Notyf({
                position: {
                    x: 'right',
                    y: 'top',
                }
            });

            notyf
                .error({
                    message: '{{ session('msg-error') }}',
                    dismissible: true,
                    duration: 5000
                })
        </script>
    @endif

    <link rel="stylesheet" href="{{ asset('assets/css/responsivity.css') }}">
@endsection
