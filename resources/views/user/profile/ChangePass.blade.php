<div class="wrapper">
    <div class="container-fluid">




        <div class="row">

            <div class="col-xl-6">
                <div class="card card-statistics">

                    <!-- /.box-header -->
                    <div class="card-body">

                        <h3 class="card-title">Personal details</h3>

                        <form action="{{ route('user.update-profile') }}" method="POST">
                            {{ csrf_field() }}

                            <div id="ctl00_ContentPlaceHolder1_Panel1">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Account Name</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" type="text" name="name"
                                        value="{{ $profile_data ? $profile_data->name : '' }}" placeholder="Name"
                                        required>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Email Adress</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" type="email" name="email"
                                        value="{{ $profile_data ? $profile_data->email : '' }}"
                                        placeholder="Enter Email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Mobile</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" type="number"
                                        value="{{ $profile_data ? $profile_data->phone : '' }}" placeholder="Mobile No"
                                        name="phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Country</label>
                                    <div class="col-sm-10">
                                        <select name="country" id="" class="form-control">
                                            <option>
                                            {{ $profile_data ? $profile_data->country : '' }}
                                        </option>
                                            <option value="Afghanistan">Afghanistan</option>
                                            <option value="Aland Islands">Aland Islands</option>
                                            <option value="Albania">Albania</option>
                                            <option value="Algeria">Algeria</option>
                                            <option value="American Samoa">American Samoa</option>
                                            <option value="Andorra">Andorra</option>
                                            <option value="Angola">Angola</option>
                                            <option value="Anguilla">Anguilla</option>
                                            <option value="Antarctica">Antarctica</option>
                                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                            <option value="Argentina">Argentina</option>
                                            <option value="Armenia">Armenia</option>
                                            <option value="Aruba">Aruba</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Austria">Austria</option>
                                            <option value="Azerbaijan">Azerbaijan</option>
                                            <option value="Bahamas">Bahamas</option>
                                            <option value="Bahrain">Bahrain</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                            <option value="Barbados">Barbados</option>
                                            <option value="Belarus">Belarus</option>
                                            <option value="Belgium">Belgium</option>
                                            <option value="Belize">Belize</option>
                                            <option value="Benin">Benin</option>
                                            <option value="Bermuda">Bermuda</option>
                                            <option value="Bhutan">Bhutan</option>
                                            <option value="Bolivia">Bolivia</option>
                                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                            <option value="Botswana">Botswana</option>
                                            <option value="Bouvet Island">Bouvet Island</option>
                                            <option value="Brazil">Brazil</option>
                                            <option value="British Indian Ocean Territory">British Indian Ocean
                                                Territory</option>
                                            <option value="British Virgin Islands">British Virgin Islands</option>
                                            <option value="Brunei">Brunei</option>
                                            <option value="Bulgaria">Bulgaria</option>
                                            <option value="Burkina Faso">Burkina Faso</option>
                                            <option value="Burundi">Burundi</option>
                                            <option value="Cambodia">Cambodia</option>
                                            <option value="Cameroon">Cameroon</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Cape Verde">Cape Verde</option>
                                            <option value="Cayman Islands">Cayman Islands</option>
                                            <option value="Central African Republic">Central African Republic</option>
                                            <option value="Chad">Chad</option>
                                            <option value="Chile">Chile</option>
                                            <option value="China">China</option>
                                            <option value="Christmas Island">Christmas Island</option>
                                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                            <option value="Colombia">Colombia</option>
                                            <option value="Congo">Congo</option>
                                            <option value="Cook Islands">Cook Islands</option>
                                            <option value="Costa Rica">Costa Rica</option>
                                            <option value="Croatia">Croatia</option>
                                            <option value="Cuba">Cuba</option>
                                            <option value="Cyprus">Cyprus</option>
                                            <option value="Czech Republic">Czech Republic</option>
                                            <option value="Democratic Republic of Congo">Democratic Republic of Congo
                                            </option>
                                            <option value="Denmark">Denmark</option>
                                            <option value="Disputed Territory">Disputed Territory</option>
                                            <option value="Djibouti">Djibouti</option>
                                            <option value="Dominica">Dominica</option>
                                            <option value="Dominican Republic">Dominican Republic</option>
                                            <option value="East Timor">East Timor</option>
                                            <option value="Ecuador">Ecuador</option>
                                            <option value="Egypt">Egypt</option>
                                            <option value="El Salvador">El Salvador</option>
                                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                                            <option value="Eritrea">Eritrea</option>
                                            <option value="Estonia">Estonia</option>
                                            <option value="Ethiopia">Ethiopia</option>
                                            <option value="Falkland Islands">Falkland Islands</option>
                                            <option value="Faroe Islands">Faroe Islands</option>
                                            <option value="Federated States of Micronesia">Federated States of
                                                Micronesia</option>
                                            <option value="Fiji">Fiji</option>
                                            <option value="Finland">Finland</option>
                                            <option value="France">France</option>
                                            <option value="French Guyana">French Guyana</option>
                                            <option value="French Polynesia">French Polynesia</option>
                                            <option value="French Southern Territories">French Southern Territories
                                            </option>
                                            <option value="Gabon">Gabon</option>
                                            <option value="Gambia">Gambia</option>
                                            <option value="Georgia">Georgia</option>
                                            <option value="Germany">Germany</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Gibraltar">Gibraltar</option>
                                            <option value="Greece">Greece</option>
                                            <option value="Greenland">Greenland</option>
                                            <option value="Grenada">Grenada</option>
                                            <option value="Guadeloupe">Guadeloupe</option>
                                            <option value="Guam">Guam</option>
                                            <option value="Guatemala">Guatemala</option>
                                            <option value="Guinea">Guinea</option>
                                            <option value="Guinea-Bissau">Guinea-Bissau</option>
                                            <option value="Guyana">Guyana</option>
                                            <option value="Haiti">Haiti</option>
                                            <option value="Heard Island and McDonald Islands">Heard Island and McDonald
                                                Islands</option>
                                            <option value="Honduras">Honduras</option>
                                            <option value="Hong Kong">Hong Kong</option>
                                            <option value="Hungary">Hungary</option>
                                            <option value="Iceland">Iceland</option>
                                            <option selected="selected" value="India">India</option>
                                            <option value="Indonesia">Indonesia</option>
                                            <option value="Iran">Iran</option>
                                            <option value="Iraq">Iraq</option>
                                            <option value="Iraq-Saudi Arabia Neutral Zone">Iraq-Saudi Arabia Neutral
                                                Zone</option>
                                            <option value="Ireland">Ireland</option>
                                            <option value="Israel">Israel</option>
                                            <option value="Italy">Italy</option>
                                            <option value="Ivory Coast">Ivory Coast</option>
                                            <option value="Jamaica">Jamaica</option>
                                            <option value="Japan">Japan</option>
                                            <option value="Jordan">Jordan</option>
                                            <option value="Kazakhstan">Kazakhstan</option>
                                            <option value="Kenya">Kenya</option>
                                            <option value="Kiribati">Kiribati</option>
                                            <option value="Kuwait">Kuwait</option>
                                            <option value="Kyrgyz Republic">Kyrgyz Republic</option>
                                            <option value="Laos">Laos</option>
                                            <option value="Latvia">Latvia</option>
                                            <option value="Lebanon">Lebanon</option>
                                            <option value="Lesotho">Lesotho</option>
                                            <option value="Liberia">Liberia</option>
                                            <option value="Libya">Libya</option>
                                            <option value="Liechtenstein">Liechtenstein</option>
                                            <option value="Lithuania">Lithuania</option>
                                            <option value="Luxembourg">Luxembourg</option>
                                            <option value="Macau">Macau</option>
                                            <option value="Macedonia">Macedonia</option>
                                            <option value="Madagascar">Madagascar</option>
                                            <option value="Malawi">Malawi</option>
                                            <option value="Malaysia">Malaysia</option>
                                            <option value="Maldives">Maldives</option>
                                            <option value="Mali">Mali</option>
                                            <option value="Malta">Malta</option>
                                            <option value="Marshall Islands">Marshall Islands</option>
                                            <option value="Martinique">Martinique</option>
                                            <option value="Mauritania">Mauritania</option>
                                            <option value="Mauritius">Mauritius</option>
                                            <option value="Mayotte">Mayotte</option>
                                            <option value="Mexico">Mexico</option>
                                            <option value="Moldova">Moldova</option>
                                            <option value="Monaco">Monaco</option>
                                            <option value="Mongolia">Mongolia</option>
                                            <option value="Montenegro">Montenegro</option>
                                            <option value="Montserrat">Montserrat</option>
                                            <option value="Morocco">Morocco</option>
                                            <option value="Mozambique">Mozambique</option>
                                            <option value="Myanmar">Myanmar</option>
                                            <option value="Namibia">Namibia</option>
                                            <option value="Nauru">Nauru</option>
                                            <option value="Nepal">Nepal</option>
                                            <option value="Netherlands">Netherlands</option>
                                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                                            <option value="New Caledonia">New Caledonia</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Nicaragua">Nicaragua</option>
                                            <option value="Niger">Niger</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Niue">Niue</option>
                                            <option value="Norfolk Island">Norfolk Island</option>
                                            <option value="North Korea">North Korea</option>
                                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                            <option value="Norway">Norway</option>
                                            <option value="Occupied Palestinian Territories">Occupied Palestinian
                                                Territories</option>
                                            <option value="Oman">Oman</option>
                                            <option value="Pakistan">Pakistan</option>
                                            <option value="Palau">Palau</option>
                                            <option value="Panama">Panama</option>
                                            <option value="Papua New Guinea">Papua New Guinea</option>
                                            <option value="Paraguay">Paraguay</option>
                                            <option value="Peru">Peru</option>
                                            <option value="Philippines">Philippines</option>
                                            <option value="Pitcairn Islands">Pitcairn Islands</option>
                                            <option value="Poland">Poland</option>
                                            <option value="Portugal">Portugal</option>
                                            <option value="Puerto Rico">Puerto Rico</option>
                                            <option value="Qatar">Qatar</option>
                                            <option value="Reunion">Reunion</option>
                                            <option value="Romania">Romania</option>
                                            <option value="Russia">Russia</option>
                                            <option value="Rwanda">Rwanda</option>
                                            <option value="Saint Helena and Dependencies">Saint Helena and Dependencies
                                            </option>
                                            <option value="Saint Kitts &amp; Nevis">Saint Kitts &amp; Nevis</option>
                                            <option value="Saint Lucia">Saint Lucia</option>
                                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                            <option value="Saint Vincent and the Grenadines">Saint Vincent and the
                                                Grenadines</option>
                                            <option value="Samoa">Samoa</option>
                                            <option value="San Marino">San Marino</option>
                                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                            <option value="Saudi Arabia">Saudi Arabia</option>
                                            <option value="Senegal">Senegal</option>
                                            <option value="Serbia">Serbia</option>
                                            <option value="Seychelles">Seychelles</option>
                                            <option value="Sierra Leone">Sierra Leone</option>
                                            <option value="Singapore">Singapore</option>
                                            <option value="Slovakia">Slovakia</option>
                                            <option value="Slovenia">Slovenia</option>
                                            <option value="Solomon Islands">Solomon Islands</option>
                                            <option value="Somalia">Somalia</option>
                                            <option value="South Africa">South Africa</option>
                                            <option value="South Georgia and the South Sandwich Islands">South Georgia
                                                and the South Sandwich Islands</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="Spain">Spain</option>
                                            <option value="Spratly Islands">Spratly Islands</option>
                                            <option value="Sri Lanka">Sri Lanka</option>
                                            <option value="Sudan">Sudan</option>
                                            <option value="Suriname">Suriname</option>
                                            <option value="Svalbard and Jan Mayen Islands">Svalbard and Jan Mayen
                                                Islands</option>
                                            <option value="Swaziland">Swaziland</option>
                                            <option value="Sweden">Sweden</option>
                                            <option value="Switzerland">Switzerland</option>
                                            <option value="Syria">Syria</option>
                                            <option value="Taiwan">Taiwan</option>
                                            <option value="Tajikistan">Tajikistan</option>
                                            <option value="Tanzania">Tanzania</option>
                                            <option value="Thailand">Thailand</option>
                                            <option value="Togo">Togo</option>
                                            <option value="Tokelau">Tokelau</option>
                                            <option value="Tonga">Tonga</option>
                                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                            <option value="Tunisia">Tunisia</option>
                                            <option value="Turkey">Turkey</option>
                                            <option value="Turkmenistan">Turkmenistan</option>
                                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                            <option value="Tuvalu">Tuvalu</option>
                                            <option value="Uganda">Uganda</option>
                                            <option value="Ukraine">Ukraine</option>
                                            <option value="Union of the Comoros">Union of the Comoros</option>
                                            <option value="United Arab Emirates">United Arab Emirates</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="United Nations Neutral Zone">United Nations Neutral Zone
                                            </option>
                                            <option value="United States">United States</option>
                                            <option value="United States Minor Outlying Islands">United States Minor
                                                Outlying Islands</option>
                                            <option value="Uruguay">Uruguay</option>
                                            <option value="US Virgin Islands">US Virgin Islands</option>
                                            <option value="Uzbekistan">Uzbekistan</option>
                                            <option value="Vanuatu">Vanuatu</option>
                                            <option value="Vatican City">Vatican City</option>
                                            <option value="Venezuela">Venezuela</option>
                                            <option value="Vietnam">Vietnam</option>
                                            <option value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>
                                            <option value="Western Sahara">Western Sahara</option>
                                            <option value="Yemen">Yemen</option>
                                            <option value="Zambia">Zambia</option>
                                            <option value="Zimbabwe">Zimbabwe</option>

                                        </select>
                                    </div>
                                    <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator2"
                                        style="color:Red;visibility:hidden;">Please Select Country</span>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">BUSD (BEP20)ADDRESS</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" type="text" name="trx_addres"
                                        value="{{ $profile_data ? $profile_data->trx_addres : '' }}" placeholder="BUSD ADDRESS"
                                        required>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <input type="submit" name="ctl00$ContentPlaceHolder1$btnsubmit" value="Submit"  class="btn btn-primary pull-right" />

                                    </div>
                                </div>

                            </div>


                            <!-- /.row -->
                        </form>
                    </div>

                    <!-- /.box-body -->
                </div>
            </div>
            <div class="col-xl-6">
                <!-- /.box -->
                <div class="card card-statistics">

                    <!-- /.box-header -->
                    <div class="card-body">
                        <div class="card-header with-border">
                            <h3 class="card-title">Change Password</h3>
                        </div>
                        <form action="{{ route('user.edit-password') }}" method="POST">
                                     {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail3" placeholder="Old password" type="password" name="old_password">

                                      
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail3" placeholder="New password" type="password" name="password">

                                        <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator3"
                                            style="color:Red;display:none;">field can`t be empty.</span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail3" placeholder="Retype New password" type="password" name="password_confirmation">


                                        <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator4"
                                            style="color:Red;display:none;">field can`t be empty.</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                    <input type="submit" name="ctl00$ContentPlaceHolder1$btnsubmit" value="Submit"  class="btn btn-primary pull-right" />
                                            
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                            </form>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <div class="row">
            <!-- /.box -->
            <div class="col-xl-6">
                <div class="card card-statistics">

                    <!-- /.box-header -->
                    <div class="card-body">
                        <div class="card-header with-border">
                            <h3 class="card-title">Change Wallet Password</h3>
                        </div>
                        <form action="{{ route('user.change-trxpasswword') }}" method="POST">
                                     {{ csrf_field() }}
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Old Password</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail3" placeholder="Old password" type="password" name="old_password">

                                        <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator5"
                                            style="color:Red;display:none;">field can`t be empty.</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">New Password</label>
                                    <div class="col-sm-10">
                                         <input class="form-control" id="inputEmail3" placeholder="New password" type="password" name="password">


                                        <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator6"
                                            style="color:Red;display:none;">field can`t be empty.</span>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                    <input class="form-control" id="inputEmail3" placeholder="confirm password" type="password" name="password_confirmation">



                                        <span id="ctl00_ContentPlaceHolder1_RequiredFieldValidator8"
                                            style="color:Red;display:none;">field can`t be empty.</span>

                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                    <input type="submit" name="ctl00$ContentPlaceHolder1$btnsubmit" value="Submit"  class="btn btn-primary pull-right" />
                                    </div>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        </form>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
</div>
