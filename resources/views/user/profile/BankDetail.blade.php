   <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
          <div class="container-fluid">
              <div class="row page-titles">
                  <ol class="breadcrumb">
                      <li class="breadcrumb-item active"><a href="javascript:void(0)">Settings</a></li>
                      <li class="breadcrumb-item"><a href="javascript:void(0)">Bank Detail</a></li>
                  </ol>
              </div>
              <!-- row -->
              <div class="row">
                <style>
                  .form-group {
                      padding: 6px;
                  }
                </style>
   
   
                  <div class="col-xl-6 col-lg-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title">Bank Detail</h4>
                          </div>
                          <div class="card-body">
                            <form action="{{ route('user.bank-update') }}" method="POST">
                              @csrf
                              <div class="box-body">
                                <div class="row ">
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Bank Name <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" <?=(@$bank_value->bank_name)?"readonly":""?>  onkeyup="this.value=this.value.toUpperCase()"  name="bank_name" value="{{ @$bank_value->bank_name }}"
                                        placeholder="Enter Bank Name">
                                    </div>
                                  </div>
          
                                  <div class="col-lg-6">
                                      <div class="form-group">
                                        <label class="form-control-label">Branch Name <span class="tx-danger">*</span></label>
                                        <input class="form-control" type="text" name="branch_name" onkeyup="this.value=this.value.toUpperCase()" <?=(@$bank_value->branch_name)?"readonly":""?>   value="{{ @$bank_value->branch_name }}"
                                          placeholder="Enter Branch Name">
                                      </div>
                                    </div>
          
                                  <div class="col-lg-6">
                       
                                    <div class="form-group">
                                      <label class="form-control-label">A/C Holder First Name <span
                                          class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" <?=(@$bank_value->account_holder)?"readonly":""?>  name="account_holder" value="{{ @$bank_value->account_holder }}"
                                        placeholder="Enter a/c holder first name">
                                    </div>
                                  </div>
                                
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Bank IFSC <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" <?=(@$bank_value->ifsc_code)?"readonly":""?> onkeyup="this.value=this.value.toUpperCase()"  name="ifsc_code" value="{{ @$bank_value->ifsc_code }}"
                                        placeholder="Enter IFS Code " required>
                                    </div>
                                  </div>
          
          
                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Bank A/c Number <span class="tx-danger">*</span></label>
                                      <input class="form-control" type="text" onkeyup="this.value=this.value.toUpperCase()"  <?=(@$bank_value->account_no)?"readonly":""?>  name="account_number" value="{{ @$bank_value->account_no }}"
                                        placeholder="Enter Account Number" required>
                                    </div>
                                  </div>

                                  <div class="col-lg-6">
                                    <div class="form-group">
                                      <label class="form-control-label">Pancard No <span class="tx-danger">*</span></label>
                                      <input type="text" value="{{@$bank_value->pancard_no}}" name="pancard_no" <?=(@$bank_value->pancard_no)?"readonly":""?>  onkeyup="this.value=this.value.toUpperCase()" class="form-control" >
                                    </div>
                                  </div>

                                </div>
                                <br>
                                <div class="">
                                  <a href="{{route('user.BankDetail')}}" class="btn btn-primary " type="button">CANCEL</a>
                                  <button class="btn btn-success " type="submit" name="Bank89655656">UPDATE</button>
                                </div>
                              </div>
                            </form>
                          </div>
                      </div>
                  </div>

                
   
   
   
              </div>
          </div>
      </div>
      <!--**********************************
               Content body end
           ***********************************-->
   