@extends('admin.layout')
@section('title')
Dashboard | {{Auth::user()->name}}
@endsection
@section('content')
@section('bread')
Dashbord
@endsection
@php
$dues = $actives->where('return_date', '<', $now );

@endphp


<div class="row">
<div class="col-md-3">
<div class="card p-30">
<div class="media">
    <div class="media-left meida media-middle">
        <span><i class="fa fa-money f-s-40 color-primary"></i></span>
    </div>
    <div class="media-body media-text-right">
        <h2>@money($all)</h2>
        <p class="m-b-0">Total Invested</p>
    </div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="card p-30">
<div class="media">
    <div class="media-left meida media-middle">
        <span><i class="fa fa-money f-s-40 color-success"></i></span>
    </div>
    <div class="media-body media-text-right">
        <h2>@money($paids->sum('return_amount'))</h2>
        <p class="m-b-0">Total Paid Return</p>
    </div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="card p-30">
<div class="media">
    <div class="media-left meida media-middle">
        <span><i class="fa fa-money f-s-40 color-warning"></i></span>
    </div>
    <div class="media-body media-text-right">
        <h2>@money($actives->sum('return_amount'))</h2>
        <p class="m-b-0">Total Expected Return</p>
    </div>
</div>
</div>
</div>
<div class="col-md-3">
<div class="card p-30">
<div class="media">
<div class="media-left meida media-middle">
        <h6>Total Customers</h6>
        <h6>Total Mentors</h6>
        <h6>Total Admins</h6>
    </div>
    <div class="media-body media-text-right">
        <h6>{{$cus->count()}}</h6>
        <h6>{{$mentor->count()}}</h6>
        <h6>{{$admin->count()}}</h6>
    </div>
    {{-- <div class="media-left meida media-middle">
        <span><i class="fa fa-user f-s-40 color-danger"></i></span>
    </div>
    <div class="media-body media-text-right">
        <h2>847</h2>
        <p class="m-b-0">Customer</p>
    </div> --}}
</div>
</div>
</div>
</div>



<div class="row bg-white m-l-0 m-r-0 box-shadow ">

{{-- <div class="col-lg-12 p-20">

@if (session('success'))
<div class="alert alert-success p-20">
{{ session('success') }}
</div>
@endif


@if (session('failed'))
<div class="alert alert-danger p-20">
{{ session('failed') }}
</div>
@endif
</div> --}}

<!-- column -->
<div class="col-lg-12">

<div class="col-lg-12 p-20">

@if (session('success'))
<div class="alert alert-success p-20">
{{ session('success') }}
</div>
@endif


@if (session('failed'))
<div class="alert alert-danger p-20">
{{ session('failed') }}
</div>
@endif
</div>
<div class="card">
<div class="card-body">
    <h4 class="card-title">History</h4>
     <!-- Nav tabs -->
    <ul class="nav nav-tabs customtab" role="tablist">
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#due" role="tab"><span style="color: #26dad2">{{$dues->count()}} Due </span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#active" role="tab"><span style="color: blue">{{$actives->count()}} Active</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#paid" role="tab"><span style="color: green">{{$paids->count()}} Paid</span></a> </li>
        <li class="nav-item"> <a class="nav-link  active" data-toggle="tab" href="#pending" role="tab"><span style="color: yellow">{{$pendings->count()}} Pending</span></a> </li>
		<li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#reject" role="tab"><span style="color: red">{{$rejecteds->count()}} Rejected</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#roll" role="tab"><span style="color: blue">{{$rolls->count()}} Rollovers</span></a> </li>
         <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#refund_paid" role="tab"><span style="color: green">{{$refund_paids->count()}} Refunds Paid</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#refund_due" role="tab"><span style="color: green">{{$refund_dues->count()}} Refund Dues</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#a_refund" role="tab"><span style="color: green">{{$a_refunds->count()}} Approved Refunds</span></a> </li>
        <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#p_refund" role="tab"><span style="color: blue">{{$p_refunds->count()}} Pending Refunds</span></a> </li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">

        <div class="tab-pane" id="due" role="tabpanel">
            
                <div class="table-responsive m-t-40">
        <table id="due" class="data nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Maturity Date</th>
                    <th>Invest Date</th>
                    <th>Customer Email</th>
                    <th>Transaction Id</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Approved Date</th>
                    <th>Expected Return</th>
                    <th>Reciept</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($dues)>0)
                @foreach($dues as $due)
                @php
                $due_user = $users->where('id','=', $due->user_id)->first();
                @endphp
                
                <tr>
                    <td>{{$due->return_date->format('d/m/Y H:i')}}</td>
                    <td>{{$due->invest_date->format('d/m/Y H:i')}}</td>
                    <td>{{$due_user->email}}</td>
                    <td>{{$due->tran_id}}</td>
                    <td>@money($due->invest_amount)</td>
                    <td>{{$due->tenure}}</td>
                    <td>{{$due->approved_date->format('d/m/Y H:i')}}</td>
                    <td>@money($due->return_amount)</td>
                    <td>
                        @component('component.receipt')
                            @slot('id')
                                {{$due->id}}
                            @endslot
                        @endcomponent
                    </td>
                    <td><a href="{{asset($due->proof)}}"><button class="btn btn-primary">View Proof</button></a>

                    <a href="/admin/cus/{{$due_user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="/admin/approvepaid/{{$due->id}}"><button class="btn btn-primary">Verify Payment</button></a>
                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
                </div>

            
        </div>

        <div class="tab-pane" id="active" role="tabpanel">
            
                <div class="table-responsive m-t-40">
        <table id="active" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Approved Date</th>
                    <th>Invest Date</th>
                    <th>Customer Email</th>
                    <th>Transaction Id</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Maturity Date</th>
                    <th>Expected Return</th>
                    <th>Reciept</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($actives)>0)
                @foreach($actives as $active)
                @php
                $active_user = $users->where('id','=', $active->user_id)->first();
                @endphp
                <tr>
                    <td>{{$active->approved_date->format('d/m/Y H:i')}}</td>
                    <td>{{$active->invest_date->format('d/m/Y H:i')}}</td>
                    <td>{{$active_user->email}}</td>
                    <td>{{$active->tran_id}}</td>
                    <td>@money($active->invest_amount)</td>
                    <td>{{$active->tenure}}</td>
                    <td>{{$active->return_date}}</td>
                    <td>@money($active->return_amount)</td>
                    <td>
                        @component('component.receipt')
                            @slot('id')
                                {{$active->id}}
                            @endslot
                        @endcomponent
                    </td>
                    <td><a href="{{asset($active->proof)}}"><button class="btn btn-primary">View Proof</button></a>

                    <a href="/admin/cus/{{$active_user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="#delete" aria-expanded="false"  data-toggle="modal"><button class="btn btn-danger" onclick="getid('{{$active->id}}')">Delete</button></a>
                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        
                </div>

            
        </div>
        <div class="tab-pane" id="paid" role="tabpanel">
		  
                <div class="table-responsive m-t-40">
        <table id="paid" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Paid Date</th>
                    <th>Approved Date</th>
                    <th>Invest Date</th>
                    <th>Customer Email</th>
                    <th>Transaction Id</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Maturity Date</th>
                    <th>Amount Returned</th>
                    <th>Reciept</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($paids)>0)
                @foreach($paids as $paid)
                @php
                $paid_user = $users->where('id','=', $paid->user_id)->first();
                @endphp
                <tr>
                    <td>{{$paid->paid_date->format('d/m/Y H:i')}}</td>
                    <td>{{$paid->approved_date->format('d/m/Y H:i')}}</td>
                    <td>{{$paid->invest_date->format('d/m/Y H:i')}}</td>
                    <td>{{$paid_user->email}}</td>
                    <td>{{$paid->tran_id}}</td>
                    <td>@money($paid->invest_amount)</td>
                    <td>{{$paid->tenure}}</td>
                    <td>{{$paid->return_date->format('d/m/Y H:i')}}</td>
                    <td>@money($paid->return_amount)</td>
                    <td>
                        @component('component.receipt')
                            @slot('id')
                                {{$paid->id}}
                            @endslot
                        @endcomponent
                    </td>
                    <td><a href="{{asset($paid->proof)}}"><button class="btn btn-primary">View Proof</button></a>

                    <a href="/admin/cus/{{$paid_user->id}}"><button class="btn btn-primary">View Customer</button></a>
                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        
                

            </div>
		</div>
        <div class="tab-pane  active" id="pending" role="tabpanel">
		   
                <div class="table-responsive m-t-40">
        <table id="pending" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Invest Date</th>
                    <th>Customer Email</th>
                    <th>Transaction Id</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Expected Return</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($pendings)>0)
                @foreach($pendings as $pending)
                @php
                $pending_user = $users->where('id','=', $pending->user_id)->first();
                @endphp
                <tr>
                    <td>{{$pending->invest_date->format('d/m/Y H:i')}}</td>
                    <td>{{$pending_user->email}}</td>
                    <td>{{$pending->tran_id}}</td>
                    <td>@money($pending->invest_amount)</td>
                    <td>{{$pending->tenure}}</td>
                    <td>@money($pending->return_amount)</td>
                    <td><a href="{{asset($pending->proof)}}"><button class="btn btn-primary">View Proof</button></a>

                    <a href="/admin/invest/approve/{{$pending->id}}"><button class="btn btn-success">Approve</button></a>

                    <a href="/admin/invest/reject/{{$pending->id}}"><button class="btn btn-danger">Reject</button></a>

                    <a href="/admin/cus/{{$pending_user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="#delete" aria-expanded="false"  data-toggle="modal"><button class="btn btn-danger" onclick="getid('{{$pending->id}}')">Delete</button></a>
                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        
                </div>

            
		</div>
		<div class="tab-pane" id="reject" role="tabpanel">
		   
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Rejected Date</th>
                    <th>Invest Date</th>
                    <th>Customer Email</th>
                    <th>Transaction Id</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Expected Return</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($rejecteds)>0)
                @foreach($rejecteds as $rejected)
                @php
                $rejected_user = $users->where('id','=', $rejected->user_id)->first();
                @endphp
                <tr>
                    <td>{{$rejected->approved_date->format('d/m/Y H:i')}}</td>
                    <td>{{$rejected->invest_date->format('d/m/Y H:i')}}</td>
                    <td>{{$rejected_user->email}}</td>
                    <td>{{$rejected->tran_id}}</td>
                    <td>@money($rejected->invest_amount)</td>
                    <td>{{$rejected->tenure}}</td>
                    <td>@money($rejected->return_amount)</td>
                    <td><a href="{{asset($rejected->proof)}}"><button class="btn btn-primary">View Proof</button></a>

                    <a href="/admin/cus/{{$rejected_user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="#delete" aria-expanded="false"  data-toggle="modal"><button class="btn btn-danger" onclick="getid('{{$rejected->id}}')">Delete</button></a>
                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
       
                </div>

            
		</div>
        <div class="tab-pane" id="roll" role="tabpanel">
           
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Apply Date</th>
                    <th>Investment Id</th>
                    <th>Customer Email</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Type</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($rolls)>0)
                @foreach($rolls as $roll)
                @php
               
                @endphp
                <tr>
                    <td>{{$roll->created_at->format('d/m/Y H:i')}}</td>
                    <td>{{$roll->history->tran_id}}</td>
                    <td>{{$roll->user->email}}</td>
                    <td>@money($roll->history->return_amount)</td>
                    <td>{{$roll->tenure}}</td>
                    <td>{{$roll->type ? 'one time' : 'six times'}}</td>
                    <td>
                    <a href="roll/approve/{{$roll->id}}"><button class="btn btn-success">Approve</button></a>

                    <a href="/admin/cus/{{$roll->user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="roll/delete/{{$roll->id}}"><button class="btn btn-danger">Delete</button></a>

                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
       
                </div>

            
        </div>
        <div class="tab-pane" id="refund_paid" role="tabpanel">
           
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Approved Date</th>
                    <th>Transaction Id</th>
                    <th>Customer Email</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Due</th>
                   
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($refund_paids)>0)
                @foreach($refund_paids as $refund_paid)
                @php
               
                @endphp
                <tr>
                    <td>{{$refund_paid->updated_at}}</td>
                    <td>{{$refund_paid->history->tran_id}}</td>
                    <td>{{$refund_paid->user->email}}</td>
                    <td>@money($refund_paid->history->invest_amount)</td>
                    <td>{{$refund_paid->history->tenure}}</td>
                    <td>{{$refund_paid->due}}</td>
                    
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        
                </div>

            
        </div>
        <div class="tab-pane" id="refund_due" role="tabpanel">
           
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Approved Date</th>
                    <th>Transaction Id</th>
                    <th>Customer Email</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Due</th>
                    <th>Action</th>
                   
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($refund_dues)>0)
                @foreach($refund_dues as $refund_due)
                @php
               
                @endphp
                <tr>
                    <td>{{$refund_due->updated_at}}</td>
                    <td>{{$refund_due->history->tran_id}}</td>
                    <td>{{$refund_due->user->email}}</td>
                    <td>@money($refund_due->history->invest_amount)</td>
                    <td>{{$refund_due->history->tenure}}</td>
                    <td>{{$refund_due->due}}</td>
                    <td><a href="/refund/pay/{{$refund_due->id}}"><button class="btn btn-success">Verify Pay</button></a></td>
                    
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        
                </div>

            
        </div>
        <div class="tab-pane" id="a_refund" role="tabpanel">
           
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Approved Date</th>
                    <th>Transaction Id</th>
                    <th>Customer Email</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Due</th>
                    <th>Action</th>
                   
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($a_refunds)>0)
                @foreach($a_refunds as $a_refund)
                @php
               
                @endphp
                <tr>
                    <td>{{$a_refund->updated_at}}</td>
                    <td>{{$a_refund->history->tran_id}}</td>
                    <td>{{$a_refund->user->email}}</td>
                    <td>@money($a_refund->history->invest_amount)</td>
                    <td>{{$a_refund->history->tenure}}</td>
                    <td>{{$a_refund->due}}</td>
                    <td><a href="/refund/pay/{{$a_refund->id}}"><button class="btn btn-success">Verify Pay</button></a></td>
                    
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
       
                </div>

            
        </div>
        <div class="tab-pane" id="p_refund" role="tabpanel">
           
                <div class="table-responsive m-t-40">
        <table id="reject" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>Apply Date</th>
                    <th>Transaction Id</th>
                    <th>Customer Email</th>
                    <th>Invest Amount</th>
                    <th>Tenure</th>
                    <th>Message</th>
                    <th>Actioins</th>
                    
                </tr>
            </thead>
            
            <tbody>
                @if (count($p_refunds)>0)
                @foreach($p_refunds as $p_refund)
                @php
               
                @endphp
                <tr>
                    <td>{{$p_refund->created_at}}</td>
                    <td>{{$p_refund->history->tran_id}}</td>
                    <td>{{$p_refund->user->email}}</td>
                    <td>@money($p_refund->history->invest_amount)</td>
                    <td>{{$p_refund->history->tenure}}</td>
                    <td>{{$p_refund->message}}</td>
                    <td>
                    <a href="/refund/approve/{{$p_refund->id}}"><button class="btn btn-success">Approve</button></a>

                    <a href="/admin/cus/{{$p_refund->user->id}}"><button class="btn btn-primary">View Customer</button></a>

                    <a href="/refund/delete/{{$p_refund->id}}"><button class="btn btn-danger">Delete</button></a>

                    </td>
                    
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
       
                </div>

            
        </div>
    </div>
</div>
</div>
</div>
</div>

    {{-- <!-- The Modal Delete -->
<div class="modal" id="delete">
  <div class="modal-dialog modal-confirm">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
            <div class="icon-box">
                    <i class="material-icons fa fa-trash"></i>
                </div>
        <h4 class="modal-title">Are you sure?</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
            <p>Do you really want to delete this transaction? This process cannot be undone.</p>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
        <a href="#" id="link"><button type="button" class="btn btn-danger">Delete</button></a>
      </div>

    </div>
  </div>
</div> --}}



@endsection
@section('data')
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js') }}"></script>
@endsection