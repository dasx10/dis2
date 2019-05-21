@extends('layout.user')
@section('head')
@include('template.head_user_template')
@endsection
@section('content')
@include('user.header')
<div class="app-body">
  @include('user.sidebar')
  <main class="main">
    <div class="main_container_fluid">
      <div class="row">
        <div class="col-md-12 col-lg-6 align-items-stretch">
          <div class="row">
            <div class="col-md-12">
              <div class="card ">
                <form class="edit_personal_info">
                    <p class="edit" type="hidden" name="client_id" style="display: none">{{$users_id}}</p>
                    <p class="edit" type="hidden" name="token" style="display: none">{{$token}}</p>
                  <div class="card-header border-bottom-0 text-center text-uppercase"><p style="font-size: 1.25rem;font-weight: 500;" class="m-0 d-inline-block"> {{$data->company_name}} </p><img class="float-right cursor-p btm_submit edit_company d-inline-block" src="/public/img/edit.png" alt=""></div>
                  <div style="font-family:RalewayLight;height: 56rem;overflow-x: hidden;overflow-y: auto;" class="card-body">

                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block">Business Scope:</label></div>
                          <div class="col-lg-8">
                              {{--<p style="font-family:RalewaySemiBold;" class=" edit-dark moredark m-0 " contenteditable="false">Industrial</p>--}}
                              <select name="" class="form-control-edit  moredark underlining bg-transparent fixed-padding border-none special_color MyBold p-0" disabled>
                                  <option selected value=" End user / Manufacturer"> End user / Manufacturer</option>
                                  <option value="Importer / distributor">Importer / Distributor</option>
                                  <option value="Trader">Trader</option>
                                  <option value="Agent / professional service provider">Agent / Professional service provider</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-lg-4">
                              <label class="d-inline-block ">Country:</label>
                          </div>
                          <div class="col-lg-8">
                              <select style="padding: 0px 4px;" required name="country" class="form-control-edit  moredark underlining bg-transparent fixed-padding border-none special_color MyBold p-0 country " contenteditable="false" disabled>
                                  <option  value="{{$data->country}}"><u>{{$data->country}}</u> </option>
                                  <option value="Afghanistan">Afghanistan</option>
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
                                  <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                  <option value="Brunei Darussalam">Brunei Darussalam</option>
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
                                  <option value="Comoros">Comoros</option>
                                  <option value="Congo">Congo</option>
                                  <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                  <option value="Cook Islands">Cook Islands</option>
                                  <option value="Costa Rica">Costa Rica</option>
                                  <option value="Cote D'ivoire">Cote D'ivoire</option>
                                  <option value="Croatia">Croatia</option>
                                  <option value="Cuba">Cuba</option>
                                  <option value="Cyprus">Cyprus</option>
                                  <option value="Czech Republic">Czech Republic</option>
                                  <option value="Denmark">Denmark</option>
                                  <option value="Djibouti">Djibouti</option>
                                  <option value="Dominica">Dominica</option>
                                  <option value="Dominican Republic">Dominican Republic</option>
                                  <option value="Ecuador">Ecuador</option>
                                  <option value="Egypt">Egypt</option>
                                  <option value="El Salvador">El Salvador</option>
                                  <option value="Equatorial Guinea">Equatorial Guinea</option>
                                  <option value="Eritrea">Eritrea</option>
                                  <option value="Estonia">Estonia</option>
                                  <option value="Ethiopia">Ethiopia</option>
                                  <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                  <option value="Faroe Islands">Faroe Islands</option>
                                  <option value="Fiji">Fiji</option>
                                  <option value="Finland">Finland</option>
                                  <option value="France">France</option>
                                  <option value="French Guiana">French Guiana</option>
                                  <option value="French Polynesia">French Polynesia</option>
                                  <option value="French Southern Territories">French Southern Territories</option>
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
                                  <option value="Guinea-bissau">Guinea-bissau</option>
                                  <option value="Guyana">Guyana</option>
                                  <option value="Haiti">Haiti</option>
                                  <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                  <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                  <option value="Honduras">Honduras</option>
                                  <option value="Hong Kong">Hong Kong</option>
                                  <option value="Hungary">Hungary</option>
                                  <option value="Iceland">Iceland</option>
                                  <option value="India">India</option>
                                  <option value="Indonesia">Indonesia</option>
                                  <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                  <option value="Iraq">Iraq</option>
                                  <option value="Ireland">Ireland</option>
                                  <option value="Israel">Israel</option>
                                  <option value="Italy">Italy</option>
                                  <option value="Jamaica">Jamaica</option>
                                  <option value="Japan">Japan</option>
                                  <option value="Jordan">Jordan</option>
                                  <option value="Kazakhstan">Kazakhstan</option>
                                  <option value="Kenya">Kenya</option>
                                  <option value="Kiribati">Kiribati</option>
                                  <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                  <option value="Korea, Republic of">Korea, Republic of</option>
                                  <option value="Kuwait">Kuwait</option>
                                  <option value="Kyrgyzstan">Kyrgyzstan</option>
                                  <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                  <option value="Latvia">Latvia</option>
                                  <option value="Lebanon">Lebanon</option>
                                  <option value="Lesotho">Lesotho</option>
                                  <option value="Liberia">Liberia</option>
                                  <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                  <option value="Liechtenstein">Liechtenstein</option>
                                  <option value="Lithuania">Lithuania</option>
                                  <option value="Luxembourg">Luxembourg</option>
                                  <option value="Macao">Macao</option>
                                  <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
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
                                  <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                  <option value="Moldova, Republic of">Moldova, Republic of</option>
                                  <option value="Monaco">Monaco</option>
                                  <option value="Mongolia">Mongolia</option>
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
                                  <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                  <option value="Norway">Norway</option>
                                  <option value="Oman">Oman</option>
                                  <option value="Pakistan">Pakistan</option>
                                  <option value="Palau">Palau</option>
                                  <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                  <option value="Panama">Panama</option>
                                  <option value="Papua New Guinea">Papua New Guinea</option>
                                  <option value="Paraguay">Paraguay</option>
                                  <option value="Peru">Peru</option>
                                  <option value="Philippines">Philippines</option>
                                  <option value="Pitcairn">Pitcairn</option>
                                  <option value="Poland">Poland</option>
                                  <option value="Portugal">Portugal</option>
                                  <option value="Puerto Rico">Puerto Rico</option>
                                  <option value="Qatar">Qatar</option>
                                  <option value="Reunion">Reunion</option>
                                  <option value="Romania">Romania</option>
                                  <option value="Russian Federation">Russian Federation</option>
                                  <option value="Rwanda">Rwanda</option>
                                  <option value="Saint Helena">Saint Helena</option>
                                  <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                  <option value="Saint Lucia">Saint Lucia</option>
                                  <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                  <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                  <option value="Samoa">Samoa</option>
                                  <option value="San Marino">San Marino</option>
                                  <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                  <option value="Saudi Arabia">Saudi Arabia</option>
                                  <option value="Senegal">Senegal</option>
                                  <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                  <option value="Seychelles">Seychelles</option>
                                  <option value="Sierra Leone">Sierra Leone</option>
                                  <option value="Singapore">Singapore</option>
                                  <option value="Slovakia">Slovakia</option>
                                  <option value="Slovenia">Slovenia</option>
                                  <option value="Solomon Islands">Solomon Islands</option>
                                  <option value="Somalia">Somalia</option>
                                  <option value="South Africa">South Africa</option>
                                  <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                  <option value="Spain">Spain</option>
                                  <option value="Sri Lanka">Sri Lanka</option>
                                  <option value="Sudan">Sudan</option>
                                  <option value="Suriname">Suriname</option>
                                  <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                  <option value="Swaziland">Swaziland</option>
                                  <option value="Sweden">Sweden</option>
                                  <option value="Switzerland">Switzerland</option>
                                  <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                  <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                  <option value="Tajikistan">Tajikistan</option>
                                  <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                  <option value="Thailand">Thailand</option>
                                  <option value="Timor-leste">Timor-leste</option>
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
                                  <option value="United Arab Emirates">United Arab Emirates</option>
                                  <option value="United Kingdom">United Kingdom</option>
                                  <option value="United States">United States</option>
                                  <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                  <option value="Uruguay">Uruguay</option>
                                  <option value="Uzbekistan">Uzbekistan</option>
                                  <option value="Vanuatu">Vanuatu</option>
                                  <option value="Venezuela">Venezuela</option>
                                  <option value="Viet Nam">Viet Nam</option>
                                  <option value="Virgin Islands, British">Virgin Islands, British</option>
                                  <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                  <option value="Wallis and Futuna">Wallis and Futuna</option>
                                  <option value="Western Sahara">Western Sahara</option>
                                  <option value="Yemen">Yemen</option>
                                  <option value="Zambia">Zambia</option>
                                  <option value="Zimbabwe">Zimbabwe</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4">
                              <label class="d-inline-block ">Region:</label>
                          </div>
                          <div class="col-lg-8">
                              <select style="padding: 0px 4px;" required name="regione" class="form-control-edit bg-transparent  moredark underlining fixed-padding border-none special_color MyBold p-0  region" contenteditable="false" disabled>
                                  <option value="ANY">ANY</option>
                                  <option value="MENA">MENA</option>
                                  <option value="Asia">Asia</option>
                                  <option value="Europe">Europe</option>
                                  <option value="South America">South America</option>
                                  <option value="North America">North America</option>
                                  <option value="Australia">Australia</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block">NIF:</label>
                          </div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" name="nif" class="underlining fixed-padding  edit edit-dark moredark form-control-edit check_number" contenteditable="false" disabled>{{$data->nif}}</p>
                              {{--<p style="font-family:RalewaySemiBold;" required  name="nif" class="input-element form-control p-0 border-none bg-transparent" disabled value="{{$data->nif}}"></p>--}}
                          </div>
                      </div>

                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Bank Account / IBAN:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" required  name="iban" class="edit fixed-padding  edit-dark moredark form-control-edit check_number" contenteditable="false">{{$data->iban}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Contact Person 1:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" required name="contact_name" class="edit fixed-padding  edit-dark moredark form-control-edit check_letter" contenteditable="false">{{$data->contact_name}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Contact Person 2:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;"  name="contact_name2" class="edit fixed-padding  edit-dark moredark form-control-edit check_letter" contenteditable="false">{{$data->contact_name2}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Email 1:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" required  name="email" class="edit fixed-padding  edit-dark moredark form-control-edit special_color" contenteditable="false">{{$data->email}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Email 2:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;"  name="email2" class="edit fixed-padding  edit-dark moredark form-control-edit" contenteditable="false">{{$data->email2}}</p>
                          </div>
                      </div>
                      {{--<div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block m-0">Password:</label></div>
                          <div class="col-lg-8">
                              <p name="password" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false"></p>
                          </div>
                      </div>--}}
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Cell phone:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" required name="phone_number" class="edit fixed-padding  edit-dark moredark form-control-edit check_number" contenteditable="false">{{$data->phone_number}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Office phone:</label></div>
                          <div class="col-lg-8">
                                  <p style="font-family:RalewaySemiBold;" name="office_phone" class="edit edit-dark fixed-padding  moredark form-control-edit check_number" contenteditable="false">{{$data->office_phone}}</p>
                          </div>
                      </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Skype:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" name="skype" class="edit edit-dark moredark fixed-padding  form-control-edit" contenteditable="false">{{$data->skype}}</p>
                          </div>
                      </div>
                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">1<sup>st</sup> joined E-desk:</label></div>
                        <div class="col-lg-8">
                            <p style="font-family:RalewaySemiBold;" class=" edit-dark moredark m-0 " contenteditable="false">{{$reg_data}}</p>
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">Last visit:</label></div>
                        <div class="col-lg-8">
                            <p style="font-family:RalewaySemiBold;" class=" edit-dark moredark m-0" contenteditable="false">{{$last_visit}}</p>
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">Language:</label></div>
                        <div class="col-lg-8">
                                <p style="font-family:RalewaySemiBold;"  name="language" class="edit m-0 edit-dark moredark" contenteditable="false">{{$data->language}}</p>
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">Potential Products:</label></div>
                        <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" name="potential_products" class="edit edit-dark moredark fixed-padding  form-control-edit" contenteditable="false">{{$data->potential_products}}</p>
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">Preferred destination Port:</label></div>
                        <div class="col-lg-8">
                            <p style="font-family:RalewaySemiBold;" name="preferred_destination_port" class="edit edit-dark moredark fixed-padding  form-control-edit" contenteditable="false">{{$data->preferred_destination_port}}</p>
                        </div>
                      </div>

                    <div class="form-group row">
                        <div class="col-lg-4"> <label class="d-inline-block ">Preferred Packaging Style:</label></div>
                        <div class="col-lg-8">
                          <p style="font-family:RalewaySemiBold;" name="preferred_packaging_style" class="edit edit-dark moredark fixed-padding  form-control-edit" contenteditable="false" >{{$data->preferred_packaging_style}}</p>
                        </div>
                    </div>
                      <div class="form-group row">
                          <div class="col-lg-4"> <label class="d-inline-block ">Client code:</label></div>
                          <div class="col-lg-8">
                              <p style="font-family:RalewaySemiBold;" class=" edit-dark moredark m-0" contenteditable="false">
                                  <?php
                                  $c_n_expl = explode(' ',$data->company_name);
                                  $code = '';
                                  foreach ($c_n_expl as $item) {
                                      $code.= ucfirst($item[0]);
                                  }

                                  ?>
                                  {{$code}}
                              </p>
                          </div>
                      </div>
                    <div class="row">
                      <div class="col-lg-12 text-center">
                        <button onclick="close_edit();" type="submit" class="btn btn-success save save_company btn_submit"> Save </button>
                      </div>
                    </div>
                  </div>
                    {{--<input type="submit" style="display: none" class="save_client_data1">--}}
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-12" style="margin-top:15px;margin-bottom:15px; ">
              <div class="card ">
                <div class="card-header border-bottom-0 text-center"><p style="font-family:RalewaySemiBold;" class="d-inline-block weight-400 m-b-0"> Billing Address </p> <img class="float-right cursor-p edit_address d-inline-block" src="/public/img/edit.png" alt=""></div>
                <div class="card-body ">
                  <form class="billing_address_edit">
                        <p class="edit" type="hidden" name="client_id" style="display: none">{{$users_id}}</p>
                        <p class="edit" type="hidden" name="token" style="display: none">{{$token}}</p>
                        <p style="font-family:RalewaySemiBold; color:#505050;" name="dop_bank1" class="edit edit-address-name form-control-edit" contenteditable="false" >{{$data->dop_bank1}}</p>
                        <p name="billing_address" required style="font-family:RalewayRegular;" class="edit edit-address form-control-edit" contenteditable="false" >{{$data->billing_address}}</p>
                        <div class="row">
                          <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success save save_address mt-3"> Save </button>
                          </div>
                        </div>
                  </form>
                </div>

              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-12" style="margin-top:15px;margin-bottom:15px; ">
              <div class="card " style="height:100%;">
                <div class="card-header border-bottom-0 text-center"><p style="font-family:RalewaySemiBold;" class="d-inline-block weight-400 m-b-0"> Banks Details </p><img class="float-right cursor-p edit_bank d-inline-block" src="/public/img/edit.png" alt=""></div>
                <div class="card-body">
                  <form class="banks_details_edit">
                        <p class="edit" type="hidden" name="client_id" style="display: none">{{$users_id}}</p>
                        <p class="edit" type="hidden" name="token" style="display: none">{{$token}}</p>
                        <p style="font-family:RalewaySemiBold;color:#505050;" name="dop_bank2" class=" edit edit-bank-name form-control-edit " contenteditable="false" >{{$data->dop_bank2}}</p>
                        <p name="banks_details" required style="font-family:RalewayRegular;" class="edit edit-bank form-control-edit" contenteditable="false" >{{$data->banks_details}}</p>
                    <!-- <p class="card-text">Visa MasterCard: 1234-5676-8901-2345</p> -->
                        <div class="row">
                          <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success save save-bank mt-3"> Save </button>
                          </div>
                        </div>
                          {{--<input type="submit" style="display: none" class="save_client_data2" >--}}
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 col-lg-6 align-items-stretch">
          <div class="row">
            <div class="col-md-12">
              <div class="card"  >
                <h5 style="font-family:RalewaySemiBold;color:#505050;" class="card-header text-center p-t-b-10 border-bottom-0">My Orders</h5>
                  <div class="d-flex  flex-column" style="height: 24.2rem;overflow-y: auto;">
                      @if(empty($orders_data))
                        <p class="d-flex w-100 justify-content-center" style="font-size: 1rem;margin: auto 0;color: rgba(0, 0, 0, 0.5);">Nothing to show here yet.</p>
                      @endif
                <table style="font-family:RalewayRegular;" class="table table-responsive-md table-responsive-sm table-responsive-lg text-center">
                  <tbody>
                  @foreach($orders_data as $key=>$order)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td class="special_color text-left"><u onclick="window.location='/panel/user/current-orders/{{$order->id}}'">Ref {{$order->dis_ref}}</u></td>
                      <th scope="row"><span class="special_color">$</span>
                          @if($order->pay_with_points!=0 && $order->pay_with_points>0)
                              {{$order->total_amount-$order->pay_with_points*200}} <br>( {{$order->pay_with_points}} points )
                          @else
                              {{$order->total_amount}}
                          @endif
                      </th>
                      <td>{{$order->status}}</td>
                      <td class="special_color"> <u><a class="special_color" href="/panel/user/track-your-orders/{{$order->dis_ref}}">Track</u></td>
                    </tr>
                    @endforeach

                  </tbody>
                </table>
                  </div>
              </div>
            </div>
          </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card mt-4">
                        <h5 class="card-header text-center p-t-b-10 border-bottom-0">My referral link</h5>
                        <div class="card-body" >
                            <p style="font-family:RalewayRegular;">Redeem DIS Company Ltd.  to new customers and get DIS points <a  href="mailto:?subject=Invitation for registration on DIS Company LTD&body=Please follow link {{asset('/sign-up/'.$data->ref_id)}}" class="btn btn-success text-right ml-2">Referral link</a></p>

                            {{--<input style="cursor: pointer;" class="form-control" disabled value="{{asset('/sign-up/'.$data->ref_id)}}" type="text">--}}
                        </div>
                    </div>
                </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card" style="margin-top:15px; ">
                <h5 class="card-header border-bottom-0 text-center">Products you might like</h5>
                <div class="card-body text-center" style="height:16rem;overflow-y: auto;overflow-x: hidden;">
                  <div class="row" style="font-size:1.2rem;font-family:RalewayRegular;">
                        @foreach($products_data as $key=>$product)
                          <div class="col-lg-6 col-md-6 col-12 palka3">
                            <p><u onclick="window.location='/panel/user/products/overview/{{$product->id}}'">{{$product->product_name}}</u></p>
                          </div>
                        @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6 col-md-12 adaptive-block" style="margin-top:15px; ">
              <div class="card ">
                <h5 class="card-header border-bottom-0 text-center p-t-b-10">My DIS Points</h5>
                <div class="card-body">
                  <h6 class="m-b-0">You have <span class="color-orange">
{{--                          {{$points_count}}--}}
                          {{$data->dis_points}}
                    </span> DIS points*</h6>
                  <p style="font-family:RalewayLight;color:#c2c2c2;" class="card-text"><small>*Each 200USD is 1 DIS Point<br>*They are only valid 3 years from the first purchase</small></p>
                  <div class="row m-0">
                    @foreach($prizes as $key=>$prize)
                      <div style="padding: 0 5px!important;" class="col-md-4 col-4 p-0 text-center">
                          <div class="dis-img">
                            <img class="img-fluid bug-img"  src="{{$prize->src}}" alt="">
                              @if($data->dis_points>=$prize->points)
                                <span onclick="set_cost('{{$prize->points}}','{{$prize->id}}','{{$prize->end_date}}')" class="dis-point-2">{{$prize->points}}</span>
                              @else
                                  <span  class="dis-point-2-disabled">{{$prize->points}}</span>
                              @endif
                          </div>
                          <p style="font-family:RalewayLight" class="text-center m-t-5 m-0 fs-14"><b>{{$prize->points}}</b> {{$prize->descr}}</p>
                      </div>
                    @endforeach
                  </div>

                  <div class="row m-0" >
                      @foreach($points_data as $key=>$point)
                        <div class="col-md-6 col-6 m-t-10" style="font-size:14px; padding: 0 5px!important;">
                          <p class="m-b-0"><span style="font-family:RalewayLight" class="special_color">Ref {{$point->orders_name}}</span> - <b>{{$point->count}} DIS points</b></p>
                        </div>
                      @endforeach
                    {{--<div class="col-md-6 col-6 m-t-10" style="font-size:14px; padding: 0 5px!important;">--}}
                      {{--<p class="m-b-0"><span style="font-family:RalewayLight" class="special_color">Ref 12341</span> - <b>10 Dis points</b></p>--}}
                      {{--<p class="m-b-0"><span style="font-family:RalewayLight" class="special_color">Ref 12341</span> - <b>10 Dis points</b></p>--}}
                      {{--<p class="m-b-0"><span style="font-family:RalewayLight" class="special_color">Ref 12341</span> - <b>10 Dis points</b></p>--}}
                    {{--</div>--}}

                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-md-12 adaptive-block" style="margin-top:15px; ">
              <div class="card " style="height:100%;">
                <h5 class="card-header border-bottom-0 text-center p-t-b-10">Pending Orders</h5>
                <div class="card-body d-flex  flex-column">
                    @if(empty($basket_data))
                        <p class="d-flex w-100 justify-content-center" style="font-size: 1rem;margin: auto 0;color: rgba(0, 0, 0, 0.5);">Nothing to show here yet.</p>
                    @endif
                  <table style="font-family:RalewayMedium" class="table  text-center">
                    <tbody>
                      @foreach($basket_data as $key=>$basket_datum)
                        <tr data-id="{{$basket_datum->id}}">
                          <td style="padding: 1rem 0rem!important;"><img class="cursor-p " src="/public/img/deleted.png" alt="" onclick="delete_prod_from_cart('{{$basket_datum->id}}')"></td>
                          <td class="special_color"><a class="special_color" href="/panel/user/purchase-orders" >Ref {{$basket_datum->id}}</a></td>
{{--                          <th scope="row"><span class="dolar">$</span>{{$prod_sum[$key]}}</th>--}}
                          <td style="padding: 1rem 0rem!important;" class="special_color"><u><a class="special_color" href="/panel/user/purchase-orders">View</a></u></td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">DIS Points</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <p>Are you sure you want to spend <b>300</b> points?</p>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                      <button type="button" class="btn btn-primary">Yes</button>
                  </div>
              </div>
          </div>
      </div>
  </main>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">DIS Points</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to spend <b class="costs">300</b> points?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary">Yes</button>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
@section('script')
@include('template.script_user_template')
{{--<script src="/public/js/jquery-3.3.1.js" type="text/javascript"></script>--}}
<script type="text/javascript">
    var token = '{{$token}}';

    $('select[name="country"]').val('{{$data['country']}}');
    $('select[name="regione"]').val('{{$data['regione']}}');


    function copy_referal_link(div) {
        var str = $(div).find('input').attr('value');
        // Create new element
        var el = document.createElement('textarea');
        // Set value (string to be copied)
        el.value = str;
        // Set non-editable to avoid focus and move outside of view
        el.setAttribute('readonly', '');
        el.style = {position: 'absolute', left: '-9999px'};
        document.body.appendChild(el);
        // Select text inside element
        el.select();
        // Copy text to clipboard
        document.execCommand('copy');
        // Remove temporary element
        document.body.removeChild(el);
        alert('Copy to clipboard');
    }

    function set_cost(cost,id,end_date) {
        $.sweetModal.confirm('DIS Points','Are you sure you want to spend '+cost+' points?', function() {
            $.ajax({
                url:"/api/user/prize/buy",
                type:"POST",
                data:{
                    prize_id : id,
                    cost : cost,
                    token : '{{$token}}',
                    end_date : end_date,
                    token:token
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token' : '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
                        sweet_modal('Success','success',1000);
                        setTimeout(function () {
                            window.location = '/panel/user';
                        },1000);
                    }else{
                        sweet_modal(data.message,'error',1000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',1000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })
        });
        $('.costs').html(cost);
    }

  function delete_prod_from_cart(id) {
      $.ajax({
          url:"/api/user/product/delete_from_cart",
          type:"POST",
          data:{
              cart_id:id,
              token:token
          },
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              '_token' : '{{ csrf_token() }}'
          },
          dataType: 'JSON',
          success:function (data) {
              console.log(data);
              if(data.success==true){
                  sweet_modal('Success','success',1000);
                  setTimeout(function () {
                      window.location = '/panel/user';
                  },1000);
              }else{
                  sweet_modal(data.message,'error',1000);
              }
              $(".btn_submit").removeAttr('disabled');
          },error:function (data) {
              console.log(data);
              sweet_modal('Something went wrong','error',1000);
              $(".btn_submit").removeAttr('disabled');
          }
      })
  }

  // $('.edit').click(function(){
  //   $('.input-element').removeAttr('disabled');
  //   $('.select-element').removeAttr('disabled');
  //   $('.save').css("display", "initial");
  // });
  // $('.edit-billing').click(function(){
  //   $('.input-element-billing').removeAttr('disabled');
  //   $('.select-element-billing').removeAttr('disabled');
  //   $('.save-billing').css("display", "initial");
  // });
  // $('.edit-bank').click(function(){
  //   $('.input-element-bank').removeAttr('disabled');
  //   $('.select-element-bank').removeAttr('disabled');
  //   $('.save-bank').css("display", "initial");
  // });

    $(document)
        .one('focus.autoExpand', 'textarea.autoExpand', function(){
            var savedValue = this.value;
            this.value = '';
            this.baseScrollHeight = this.scrollHeight;
            this.value = savedValue;
        })
        .on('input.autoExpand', 'textarea.autoExpand', function(){
            var minRows = this.getAttribute('data-min-rows')|0, rows;
            this.rows = minRows;
            rows = Math.ceil((this.scrollHeight - this.baseScrollHeight) / 16);
            this.rows = minRows + rows;
        });

    $('.edit_company').click(function(){
        $('.edit_personal_info .form-control-edit').css("border", "0.125rem solid #aab4bc");
        $('.save_company').css("display", "initial");
        $('.underlining').removeAttr('disabled');
    });
    $('.edit_bank').click(function(){
        $('.banks_details_edit .form-control-edit').css("border", "0.125rem solid #aab4bc");
        // $('.edit-bank-name').removeAttr('disabled');
        $('.save-bank').css("display", "initial");
    });
    $('.edit_address').click(function(){
        $('.billing_address_edit .form-control-edit').css("border", "0.125rem solid #aab4bc");
        // $('.edit-address-name').removeAttr('disabled');
        $('.save_address').css("display", "initial");
    });


// edit company //
  $( ".edit_company" ).click(function() {
        $('.edit_personal_info .edit').each(function () {
            $(this).attr('contenteditable','true');
        });
    });
    $( ".btn_submit" ).click(function() {
        $('.edit_personal_info .edit').each(function () {
            $(this).attr('contenteditable','false');
        });
    });
    // end edit company //

    // edit bank //
    $( ".edit_bank" ).click(function() {
        $('.banks_details_edit .edit').each(function () {
            $(this).attr('contenteditable','true');
        });
    });
    $( ".save_bank" ).click(function() {
        $('.banks_details_edit .edit').each(function () {
            $(this).attr('contenteditable','false');
        });
    });
    // end edit bank  //

    // edit billing address //
    $( ".edit_address" ).click(function() {
        $('.billing_address_edit .edit').each(function () {
            $(this).attr('contenteditable','true');
        });
    });
    $( ".save_address" ).click(function() {
        $('.billing_address_edit .edit').each(function () {
            $(this).attr('contenteditable','false');
        });
    });

    function close_edit(){
        $('.save_client_data1').click();
    }

    function close_edit_bank(){
        $('.edit-bank').attr('disabled','disabled');
        $('.save_bank').css("display", "none");
    }

    function close_edit_address(){
        $('.edit-address').attr('disabled','disabled');
        $('.edit-address-name').attr('disabled');
        $('.save_address').css("display", "none");
    }

  $('form.edit_personal_info').on('submit',function(e){
      e.preventDefault();
      var fd = new FormData();
      $('.edit_personal_info .edit').each(function () {
          if($(this).attr('name')){
              fd.append($(this).attr('name'),$(this).html());
          }
      });
      fd.append('country',$('select[name="country"]').val());
      fd.append('regione',$('select[name="regione"]').val());
      $(".btn_submit").attr('disabled','disabled');
      $.ajax({
          url:"/api/admin/clients/base/edit",
          type:"POST",
          data:fd,
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              '_token': '{{ csrf_token() }}'
          },
          dataType: 'JSON',
          success:function (data) {
              console.log(data);
              if(data.success==true){
                  sweet_modal('Success','success',1000);
                  $('.edit_personal_info .form-control-edit').css("border", "none");
                  $('.underlining').attr('disabled','disabled');
                  $('.save_company').css("display", "none");
                  $('p[name="password"]').html('');
                  setTimeout(function () {
                      window.location = '/panel/user'
                  },1000);
  //                        window.location = '/panel/admin/clients';
              }else{
                  $('.edit_personal_info .form-control-edit').css("border", "none");
                  $('.underlining').attr('disabled','disabled');
                  $('.save_company').css("display", "none");
                  sweet_modal(data.message,'error',1000);
              }
              $(".btn_submit").removeAttr('disabled');
          },error:function (data) {
              console.log(data);
              sweet_modal('Something went wrong','error',1000);
              $(".btn_submit").removeAttr('disabled');
          }
      })

  });

  $('form.billing_address_edit').on('submit',function(e){
      e.preventDefault();
      var fd = new FormData();
      $('.billing_address_edit .edit').each(function () {
          if($(this).attr('name')){
              fd.append($(this).attr('name'),$(this).html());
          }
      });
      $(".btn_submit").attr('disabled','disabled');
      $.ajax({
          url:"/api/admin/clients/base/edit",
          type:"POST",
          data:fd,
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              '_token': '{{ csrf_token() }}'
          },
          dataType: 'JSON',
          success:function (data) {
              console.log(data);
              if(data.success==true){
                  sweet_modal('Success','success',1000);
                  // $('.edit-address').attr('disabled','disabled');
                  $('.billing_address_edit .form-control-edit').css("border", "none");
                  // $('.edit-address-name').attr('disabled','disabled');
                  $('.save_address').css("display", "none");
                  setTimeout(function () {
                      window.location = '/panel/user'
                  },1000);
  //                        window.location = '/panel/admin/clients';
              }else{
                  sweet_modal(data.message,'error',1000);
              }
              $(".btn_submit").removeAttr('disabled');
          },error:function (data) {
              console.log(data);
              sweet_modal('Something went wrong','error',1000);
              $(".btn_submit").removeAttr('disabled');
          }
      })

  });

  $('form.banks_details_edit').on('submit',function(e){
      e.preventDefault();
      var fd = new FormData();
      $('.banks_details_edit .edit').each(function () {
          if($(this).attr('name')){
              fd.append($(this).attr('name'),$(this).html());
          }
      });
      $(".btn_submit").attr('disabled','disabled');
      $.ajax({
          url:"/api/admin/clients/base/edit",
          type:"POST",
          data:fd,
          contentType: false,
          processData: false,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}',
              '_token': '{{ csrf_token() }}'
          },
          dataType: 'JSON',
          success:function (data) {
              console.log(data);
              if(data.success==true){
                  sweet_modal('Success','success',1000);
                  $('.banks_details_edit .form-control-edit').css("border", "none");
                  // $('.edit-bank').attr('disabled','disabled');
                  // $('.edit-bank-name').attr('disabled','disabled');
                  $('.save-bank').css("display", "none");
                  setTimeout(function () {
                      window.location = '/panel/user'
                  },1000);
  //                        window.location = '/panel/admin/clients';
              }else{
                  sweet_modal(data.message,'error',1000);
              }
              $(".btn_submit").removeAttr('disabled');
          },error:function (data) {
              console.log(data);
              sweet_modal('Something went wrong','error',1000);
              $(".btn_submit").removeAttr('disabled');
          }
      })

  });
    $(document).ready(function(){
        $('.check_number').keypress(validateNumber);
    });

    function validateNumber(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 8 || event.keyCode === 32) {
            return true;
        } else if ( key < 48 || key > 57 ) {
            return false;
        } else {
            return true;
        }
    };
    $(document).ready(function(){
        $('.check_letter').keypress(validateLeter);
    });
    function validateLeter(event) {
        var key = window.event ? event.keyCode : event.which;
        if (event.keyCode === 8 || event.keyCode === 32) {
            return true;
        } else if ( (key >= 65 && key <= 90) || (key >= 97 && key <= 122) ){
            return true;
        } else {
            return false;
        }
    };
</script>

@endsection
