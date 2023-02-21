@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Import PCR Members Excel</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                   <form action="/api/admin/import" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="file" />

                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                   </form>
                </button>
            </div>
        </div>
        <div class="card d-none">
            <div class="card-header">Import Lifetime PCR Members Excel</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

               <form action="/api/admin/lifetime/import" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <input type="file" name="file" />

                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
               </form>
            </button>
            </div>
        </div>
    </div>
</div>
@endsection
