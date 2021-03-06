@extends('cus.layout')
@section('title')
{{Auth::user()->name}} | Apply Refund
@endsection
@section('content')
@section('bread')
Refund
@endsection    


<div class="card col-md-8 mx-auto">
    <div class="card-body">
            <div class="row">
            {{-- <div class="alert alert-danger alert-dismissible fade show col-lg-12 p-20">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>You will get a reply in your email soon</strong>
                </div> --}}

                <div class="col-lg-12 p-20">

                @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif


                    @if (session('failed'))
                        <div class="alert alert-danger">
                            {{ session('failed') }}
                        </div>
                    @endif
                    </div>

                <div class="col-md-6 mx-auto">
                        <form method="POST" action="/cus/refund">
                        @csrf
                                <div class="form-group">
                                    <label>Active Transactions</label>
                                    <select name="trans" class="form-control" required>
                                    @foreach($actives as $active)
                                    @php
                                    $refund = $active->refund;
                                    if ($refund) {
                                        $disable = 1;
                                        $status = $refund->status ? 'Active' : 'Pending';
                                    }else{
                                        $disable = 0;
                                        $status = '';
                                    }
                                    @endphp
                                    <option value="{{$active->id}}" {{$disable ? 'disabled':''}}>@money($active->invest_amount) - @money($active->return_amount) {{$status}} {{$active->tran_id}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="form-group {{$errors->has('message') ? 'invalid-feedback' : ''}}">
                                    <label>Message</label>
                                    <textarea class="form-control message" name="message" required>{{ old('message') }}</textarea>
                                    @if ($errors->has('message'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('message') }}</strong>
                                </span>
                                @endif
                                </div>
                                    
                                    <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Submit</button>
                                    
                                </form>
                </div>
            </div>
    </div>
</div>

@endsection
