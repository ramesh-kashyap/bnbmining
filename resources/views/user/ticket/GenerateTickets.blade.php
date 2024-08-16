<div class="wrapper">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Help</a></li>
                            <li class="breadcrumb-item active">Open Ticket</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Create Support Ticket</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-md-8 m-auto">
                <div class="card-box">

                    <div class="row">
                        <div class="col-12">
                            <h4 class="header-title mb-3">Help Details</h4>
                            <form action="{{ route('user.SubmitTicket') }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="row">
                                <div class="col-xl-6">
                                    <img src="{{ asset('') }}user/images/77096-service.gif" class="img-fluid" />
                                </div>
                                <div class="col-xl-6">

                                    <div class="form-group">
                                        <label>Support Department</label>
                                        <div class="col-md-12 col-xs-12">
                                            <select name="category" id="ctl00_ContentPlaceHolder1_ddldept"
                                                class="form-control select">
                                                <option value="">--Select--</option>
                                                <option value="Activation">ID Activation</option>
                                                <option value="Payout Regarding">Payout Regarding</option>
                                                <option value="Technical Issues">Technical Issues</option>

                                            </select>


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Upload Proof</label>
                                        <div class="col-md-12 col-xs-12">
                                            <input name="icon_image" placeholder="" type="file"
                                                id="ctl00_ContentPlaceHolder1_txtsubject" class="form-control" />


                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Describe Issue/ Transaction Hash</label>
                                        <div class="col-md-12 col-xs-12">
                                            <textarea name="message" rows="2" cols="20" id="ctl00_ContentPlaceHolder1_txtdescription"
                                                class="form-control"></textarea>

                                        </div>
                                    </div>

                                    <div class="form-buttons-w">


                                        <input type="submit" name="ctl00$ContentPlaceHolder1$btnopen"
                                            value="Create Ticket" id="ctl00_ContentPlaceHolder1_btnopen"
                                            class="btn btn-primary pull-right" />
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            </form>
        </div>
    </div>


    <!-- end wrapper -->
    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <!-- Footer Start -->
