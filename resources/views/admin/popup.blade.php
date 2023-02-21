@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="modal d-block" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Import Members</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Success! Users Imported!</p>
                        </div>
                        <div class="modal-footer">
                            <a href="https://pcr-smc.porth365.com/admin/members/approved" class="btn btn-success">DONE</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
