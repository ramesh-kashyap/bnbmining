<!--**********************************
            Content body start
        ***********************************-->
        
        <style>
            .dt-button {
         padding: 0.338rem 1rem;
         border-radius: 1.125rem;
         font-weight: 400;
         font-size: 1rem;
     
     }
             </style>
     <div class="content-body">
         <div class="container-fluid">
     
             <div class="row page-titles">
                 <ol class="breadcrumb">
                     <li class="breadcrumb-item active"><a href="javascript:void(0)">Withdrawal </a></li>
                     <li class="breadcrumb-item"><a href="javascript:void(0)">Pending Withdrawal</a></li>
                 </ol>
             </div>
             <!-- row -->
     
     
             <div class="row">
                 <div class="col-12">
                     <div class="card">
                         <div class="card-header">
                             <h4 class="card-title">Pending Withdrawal</h4>
                         </div>
                         <div class="card-body">
                            <form method="POST" action="{{route('admin.withdraw_request_done_multiple')}}">
                     
                                <?= csrf_field() ?>

                             <div class="table-responsive">
                                 <table id="example5" class="display" style="min-width: 845px">
                                     <thead>
                                         <tr>
                                            <th style=" width: 15.3203px;"> <input type="checkbox" class="form-check-input input-mini" id="checkAll"> </th>

                                             <th>S NO.</th>
     
     
                                             <th>Name</th>
                                             <th>User ID</th>
                                             <th>Request Amount</th>
     
     
                                        
                                             <th>Transaction Date.</th>
                                             <th>Payment Address</th>
                                       
                                             <!--<th>Payment Mode</th>-->
                                             <th>Action</th>
                                         </tr>
                                     </thead>
                                     <tbody>
                                         <?php if(is_array($withdraw_list) || is_object($withdraw_list)){ ?>
     
                                         <?php $cnt = $withdraw_list->perPage() * ($withdraw_list->currentPage() - 1); ?>
                                         @foreach ($withdraw_list as $value)
                                         <?php $bank= \DB::table('banks')->where('user_id',$value->user_id)->first();?>
                                             <tr>
                                                <td> <input type="checkbox" class="form-check-input input-mini" id="closeButton" name="checkedid[]" value="{{$value->id}}">&nbsp;&nbsp;</td>


                                                 <td><?= $cnt += 1 ?></td>
                                                 <td>{{ $value->user->name }}</td>
                                                 <td>{{ $value->user_id_fk }}</td>
     
                                                 <td> {{ $value->amount }}  <span
                                                    style="font-size: 12px">{{ currency() }}</span>  </td>
                                        
     
                                                 <td>{{ $value->created_at }}</td>
                                                 <td>{{ $value->account }}</td>
                                               
                                       
     
     
                                                 <td><a href="{{ route('admin.withdraw_request_done') }}?id={{ $value->id }}&withdraw_status=success"
                                                         class='btn btn-success'>Success</a> <a
                                                         href="{{ route('admin.withdraw_request_done') }}?id={{ $value->id }}&withdraw_status=blocked"
                                                         class='btn btn-danger'>Reject</a></td>
     
                                             </tr>
                                         @endforeach
     
                                         <?php }?>
                                     </tbody>
     
                                 </table>

                                 <div class="button-items">
                                    <button type="submit" class="btn btn-success btn-lg waves-effect waves-light">Approved</button>
                                    
                                    
                                     </form>

                             </div>
                         </div>
                     </div>
                 </div>
     
     
             </div>
         </div>
     </div>
     <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
     
     <script>
       
     $("#checkAll").click(function(){
         $('input:checkbox').not(this).prop('checked', this.checked);
     });
     
      $(".dt-button").addClass("btn btn-warning");
        $('#example5').DataTable({
           'dom'         : 'Bfrtip', 
           'paging'      : true,
           'lengthChange': true,
           'searching'   : true,
           'ordering'    : true,
           'info'        : true,
           "pageLength": 10,
           'autoWidth'   : true,
           'buttons'     : ['copy', 'csv', 'excel', 'pdf', 'print']
         })
     </script>
     <!--**********************************
                 Content body end
             ***********************************-->
     