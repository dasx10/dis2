@extends('layout.admin')
@section('head')
    @include('template.head_admin_template')
    <link rel="stylesheet" href="/public/css/admin/magnific-popup.css">
@endsection
@section('content')
    @include('admin.header')
    <div class="app-body">
        @include('admin.sidebar')
        <main class="main">
            <div class="container-fluid main_container_fluid client-tabs">
                <div class="card-header box-shadow"
                     style="padding-top: 0.9375rem;padding-bottom: 0.9375rem;border-radius: 0; background: white;margin-bottom:1.25rem;">
                    <h5  class="d-flex align-items-center" style="margin-bottom: 0;font-size: 1.125rem;"><button onclick='location.href="/panel/admin/clients"' class="btn_back d-flex align-items-center"><img src="/public/img/admin/ico_back.png" alt="" style="width:0.5rem;height:0.8125rem;vertical-align: -1px;"></button><a
                                href="/panel/admin/clients" style="color:#4c6897;">Clients</a>  <span style="padding-right:5px;padding-left:5px;">|</span>  <span>{{$data['company_name']}}</span></h5>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-5 fixed-content-right" style="font-size:1rem;">
                        <div class="card box-shadow" style="height:auto;margin-bottom:1.25rem;">
                            <div class="card-header text-center">
                                <h5 class="d-flex align-items-center justify-content-center" style="color:#505050;font-size: 1.125rem;text-transform:uppercase;margin:0;">
                                    {{$data['company_name']}}
                                    @if(in_array($admin_role,['super_admin','customer_service']))
                                        <button class="btn_orange edit_company d-flex align-items-center" style="line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;padding: 0.5rem 0.6rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                    @endif
                                </h5>
                            </div>

                            <div class="card-block" style="font-family: RalewayLight;">
                                <div class="row" style="margin-bottom:1.25rem;">
                                    <div class="col-12">
                                        <div class="row">
                                            <form class="edit_personal_info" style="display: inherit;width: 100%;">
                                                <p style="display:none;" class="edit" type="hidden" name="client_id" value="{{$users_id}}">{{$users_id}}</p>
                                                <p style="display:none;" class="edit" type="hidden" name="token" value="{{$token}}">{{$token}}</p>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Business Scope:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<p class="m-0 edit-dark moredark">Industrial</p>--}}
                                                                    <select name="" class="edit-dark moredark underlining  form-control-edit fixed-padding" disabled>
                                                                        <option selected value=" End user / Manufacturer"> End user / Manufacturer</option>
                                                                        <option value="Importer / Distributor">Importer / Distributor</option>
                                                                        <option value="Trader">Trader</option>
                                                                        <option value="Agent / Professional service provider">Agent / Professional service provider</option>
                                                                    </select>
                                                                    {{--<input type="text" class="edit edit-dark moredark" disabled  value="Industrial">--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Country:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="country" class="edit-dark moredark underlining form-control-edit fixed-padding" disabled>
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
                                                                    <label class="d-inline-block m-0">Region:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <select name="regione" class="edit-dark moredark underlining  form-control-edit fixed-padding" disabled>
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
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">NIF:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input required name="nif" type="text" class="edit edit-dark  form-control-edit" value="{{$data['nif']}}" disabled>--}}
                                                                    <p name="nif" class="edit edit-dark moredark form-control-edit fixed-padding check_number" contenteditable="false">{{$data['nif']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Bank Account / IBAN:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="iban" required type="text" class="edit edit-dark edit-company form-control-edit" value="{{$data['iban']}}" disabled>--}}
                                                                    {{--<textarea name="iban" required class='edit edit-dark edit-company form-control-edit autoExpand' rows='1' data-min-rows='1' disabled>{{$data['iban']}}</textarea>--}}
                                                                    <p name="iban" class="edit edit-dark moredark form-control-edit fixed-padding check_number" contenteditable="false">{{$data['iban']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Contact person 1:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="contact_name" type="text" class="edit edit-dark  form-control-edit"  value="{{$data['contact_name']}}" disabled>--}}
                                                                    <p name="contact_name" style="text-transform: capitalize" class="edit edit-dark moredark form-control-edit fixed-padding check_letter" contenteditable="false">{{$data['contact_name']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Contact person 2:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="contact_name2" type="text" class="edit edit-dark  form-control-edit"  value="{{$data['contact_name2']}}" disabled>--}}
                                                                    <p name="contact_name2" style="text-transform: capitalize" class="edit edit-dark moredark form-control-edit fixed-padding check_letter" contenteditable="false">{{$data['contact_name2']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4 ">
                                                                    <label class="d-inline-block m-0">Email:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="email" type="text" required class="edit edit-dark underlining  form-control-edit"  value="{{$data['email']}}" disabled>--}}
                                                                    <p name="email" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false">{{$data['email']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Email 2:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="email2" type="text" class="edit edit-dark underlining  form-control-edit" value="{{$data['email2']}}" disabled>--}}
                                                                    <p name="email2" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false">{{$data['email2']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Password:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="password" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false"></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Cell phone:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input name="phone_number" required type="text" class="edit edit-dark moredark  form-control-edit" value="{{$data['phone_number']}}" disabled>--}}
                                                                    <p name="phone_number" class="edit edit-dark moredark form-control-edit fixed-padding check_number" contenteditable="false">{{$data['phone_number']}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Office phone:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="office_phone" class="edit edit-dark moredark form-control-edit fixed-padding check_number" contenteditable="false">{{$data['office_phone']}}</p>
                                                                    {{--<input name="office_phone" type="text" class="edit edit-dark moredark  form-control-edit" value="{{$data['office_phone']}}" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Skype:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="skype" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false">{{$data['skype']}}</p>
                                                                    {{--<input name="skype" type="text" class="edit edit-dark moredark  form-control-edit" value="{{$data['skype']}}" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">1<sup>st</sup> joined E-desk:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p class=" edit-dark moredark m-0">{{$reg_data}}</p>
                                                                    {{--<input type="text" class="edit edit-dark moredark"  value="{{$reg_data}}" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Last visit:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input type="text" class="edit edit-dark moredark"  value="{{$last_visit}}" disabled>--}}
                                                                    <p class="edit-dark moredark m-0">{{$last_visit}}</p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Language:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="language" class="m-0 edit-dark moredark">{{$data['language']}}</p>
                                                                    {{--<input name="language" type="text" class="edit edit-dark moredark  form-control-edit"  value="{{$data['language']}}" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Potential Products:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="potential_products" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false" >{{$data['potential_products']}}</p>
                                                                    {{--<input type="text" class="edit edit-dark moredark" value="-" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Preferred destination Port:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="preferred_destination_port" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false">{{$data['preferred_destination_port']}}</p>
                                                                    {{--<input type="text" class="edit edit-dark moredark " value="-" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Preferred Packaging Style:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p name="preferred_packaging_style" class="edit edit-dark moredark form-control-edit fixed-padding" contenteditable="false">{{$data['preferred_packaging_style']}}</p>
                                                                    {{--<input type="text" class="edit edit-dark moredark" value="No Pallets" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Earned <b>DIS Points:</b></label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    <p class="edit edit-orange orange form-control-edit fixed-padding" contenteditable="false">{{$dis_points}}</p>
                                                                    {{--<input type="text"  class="edit edit-orange orange form-control-edit" value="{{$dis_points}}" disabled>--}}
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-lg-4">
                                                                    <label class="d-inline-block m-0">Client code:</label>
                                                                </div>
                                                                <div class="col-lg-8">
                                                                    {{--<input type="text" class="edit edit-dark moredark"  value="{{$last_visit}}" disabled>--}}
                                                                    <p class="edit-dark moredark m-0">
                                                                        <?php
                                                                        $c_n_expl = explode(' ',$data['company_name']);
                                                                        $code = '';
                                                                        foreach ($c_n_expl as $item) {
                                                                            $code.= ucfirst($item[0]);
                                                                        }

                                                                        ?>
                                                                        {{$code}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="submit" style="display: none" class="save_client_data">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 text-center">
                                        <button onclick="close_edit();" class="btn btn-success save save_company btn_submit"> Save </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:1.25rem;">
                            <div class="col-12">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 class="d-flex align-items-center justify-content-center" style="color:#505050;font-size: 1.125rem;margin:0;">Billing Address
                                            @if(in_array($admin_role,['super_admin','customer_service']))
                                                <button class="btn_orange edit_address d-flex align-items-center" style="padding: 0.5rem 0.6rem;line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button></h5>
                                        @endif
                                    </div>
                                    <div class="card-block">
                                        <form class="billing_address_edit">
                                            <p class="edit" type="hidden" name="client_id" style="display: none">{{$users_id}}</p>
                                            <p class="edit" type="hidden" name="token" style="display: none">{{$token}}</p>
                                            {{--<p style="margin-bottom:0;font-family: RalewaySemiBold;"><b style="text-transform: uppercase;">North--}}
                                            {{--America Headquarters:</b></p>--}}
                                            {{--<input name="billing_address_name" id="address_name" class="edit edit-dark edit-address-name moredark-up form-control-edit" disabled type="text" value="North America Headquarters:">--}}
                                            <p name="dop_bank2" id="address_name" class="edit moredark-up edit-address-name form-control-edit" contenteditable="false" style="font-family: RalewaySemiBold;outline:none;">{{$data['dop_bank2']}}</p>
                                            <p style="margin-bottom:7.5px;" name="billing_address" id="address" class="edit edit-dark form-control-edit edit-address" contenteditable="false">{{$data['billing_address']}}</p>
                                            {{--<input required name="billing_address" type="text" id="address" class="edit edit-dark edit-address form-control-edit" disabled value="{{$data['billing_address']}}">--}}
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn btn-success save save_address"> Save </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom: 1.25rem;">
                            <div class="col-12">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 class="d-flex align-items-center justify-content-center" style="color:#505050;font-size: 1.125rem;margin:0;">Banks Details
                                            @if(in_array($admin_role,['super_admin','customer_service']))
                                                <button class="btn_orange edit_bank d-flex align-items-center" style="padding: 0.5rem 0.6rem;line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button></h5>
                                        @endif
                                    </div>
                                    <div class="card-block">
                                        <form class="banks_details_edit">
                                            <p class="edit" type="hidden" name="client_id" style="display: none">{{$users_id}}</p>
                                            <p class="edit" type="hidden" name="token" style="display: none">{{$token}}</p>
                                            {{--<p style="margin-bottom:0;font-family: RalewaySemiBold;"><b style="text-transform: uppercase;">BANK of--}}
                                            {{--CANADA</b></p>--}}
                                            <p name="dop_bank1" class="edit edit-bank-name moredark-up form-control-edit" contenteditable="false" style="font-family: RalewaySemiBold;outline:none;">{{$data['dop_bank1']}}</p>
                                            {{--<input type="text" name="banks_details_name" class="edit edit-dark edit-bank-name moredark-up form-control-edit" id="bank-name" disabled value="BANK of CANADA">--}}
                                            <p name="banks_details" class="edit edit-bank form-control-edit" style="margin-bottom:7.5px;outline:none;" contenteditable="false">{{$data['banks_details']}}</p>
                                            {{--<input required name="banks_details" type="text" id="bank" class="edit edit-dark edit-bank form-control-edit" disabled value="{{$data['banks_details']}}">--}}
                                            <div class="row">
                                                <div class="col-lg-12 text-center">
                                                    <button class="btn btn-success save save_bank"> Save </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-12 col-xl-7 fixed-content-left">
                        <div class="row" style="margin-bottom:1.25rem;">
                            <div class="col-xs-12 col-sm-6 col-md-6 fixed-content-right-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 style="color:#505050;font-size: 1.125rem;margin:0;">Products in a cart</h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="new-scroll" style="overflow-y:auto;overflow-x: hidden;height:9.4375rem;font-size: 0.875rem;">
                                            <div class="fix-scroll notes_list" style="padding-right:1.25rem;">
                                        <table class="table mb-0 client-table" style="font-size: 1rem;">
                                            <tbody>
                                            @foreach($products as $product)
                                                <tr>
                                                    <td><a href="#" onclick="delete_prod_from_cart('{{$product->cart_id}}')" style="color:black;"><i class="fas fa-times"></i></a>
                                                    </td>
                                                    <td class="RalewayRegular" style="text-decoration:underline;color: #4c6897;">{{$product->product_name}}</td>
                                                    <td style="font-family: RalewayLight;">{{$product->quantity}}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 fixed-content-left-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 class="d-flex align-items-center justify-content-center" style="color:#505050;font-size: 1.125rem;margin:0;">Brand
                                            Accessibility
                                            {{--<button class="btn_orange d-flex align-items-center" style="line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;"></button>--}}
                                        </h5>
                                    </div>
                                    <div class="card-block">
                                        <div class="new-scroll" style="overflow-y:auto;overflow-x: hidden;height:9.4375rem;font-size: 0.875rem;">
                                            <div class="fix-scroll notes_list" style="padding-right:1.25rem;">
                                        <div class="row" style="margin-bottom:1.25rem;font-size: 1.125rem;">
                                            <div class="col-6 col-sm-6 col-md-6" style="font-family: RalewayRegular;">
                                                <?php
                                                //                                                $brands = array_unique($brands);
                                                $brands
                                                ?>
                                                @foreach($brands as $key=>$brand)
                                                    <div class="checkbox">
                                                        <label class="custom-control custom-checkbox">
                                                            @if($brand->is_check==0)
                                                                <input type="checkbox" hidden data-brand-id="{{$brand->id}}" onchange="access_brand(this)">
                                                            @else
                                                                <input checked type="checkbox" hidden  data-brand-id="{{$brand->id}}" onchange="access_brand(this)">
                                                            @endif
                                                            <span class='brand-check'></span>
                                                            <span class="custom-control-description">{{$brand->title}}</span>
                                                        </label>
                                                    </div>
                                                    @if($key%2)
                                                        </div>
                                                        <div class="col-6 col-sm-6 col-md-6" style="font-family: RalewayRegular;">
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:1.25rem;">
                            <div class="col-12 col-sm-6 col-md-6 fixed-content-right-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 class="d-flex align-items-center justify-content-center" style="color:#505050;font-size: 1.125rem;margin:0;">Private Notes
                                            @if(in_array($admin_role,['super_admin','customer_service']))
                                                <button class="btn_orange d-flex align-items-center cancel_notes" data-toggle="modal" data-target="#myModal_notes" style="padding: 0.5rem 0.6rem;line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                            @endif
                                        </h5>
                                    </div>
                                    <div class="card-block" style="padding:0.625rem;">
                                        <div class="new-scroll" style="overflow-y:auto;overflow-x: hidden;height:9.4375rem;font-size: 0.875rem;">
                                            <div class="fix-scroll notes_list" style="padding-right:1.25rem;">
                                                @foreach($notes as $note)
                                                    <div class="row note_item" data-id="{{$note->id}}">
                                                        <div class="col RalewayLight"
                                                             style="font-size: 0.875rem;">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <span class="time_note" data-id="{{$note->id}}" style="color:#aab4bc;">{{$note->last_time}}</span>
                                                                </div>
                                                                <div class="col-12">
                                                                    <p class="notes" data-id="{{$note->id}}">{{$note->text}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 fixed-content-left-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center" style="padding-left:0.625rem;">
                                        <h5  style="color:#505050;font-size: 1.125rem;margin:0;">Claims
                                        </h5>
                                    </div>
                                    <div class="card-block RalewayLight" style="padding:0.625rem;">
                                        <div class="new-scroll" style="overflow-y:auto;overflow-x: hidden;height:9.4375rem;font-size: 0.875rem;">
                                            <div class="fix-scroll" style="padding-right:1.25rem;">
                                                @foreach($claims as $key=>$claim)
                                                    <div class="row">
                                                        <div class="col-7 d-flex justify-content-start">
                                                            <span class="RalewayMedium claim_unique_id_{{$claim->id}}" style="background:#f0f0f0;">{{$claim->operation}}</span>
                                                            <a style="margin-left: 0.3125rem;background: #56be60;color: white;border-radius: 50%;padding-left: 0.1875rem;padding-right: 0.1875rem;" class="show_claims_{{$key}}" data-current="{{$key}}" data-count="{{count($claims)-1}}" href="#" data-text="{{$claim->text}}" data-imagesvideos="{{$claim->imagesvideos}}" data-images="{{$claim->images}}" data-id="{{$claim->id}}" data-unique-id="{{$claim->unique_id}}" data-date="{{date('j-M-o g:i a',strtotime($claim->created_at))}}" onclick="claim_modal(this)"><i class="fas fa-eye"></i></a>
                                                        </div>
                                                        <div class="col-5 d-flex justify-content-end" style="padding-left:0px;">
                                                            <span style="color:#aab4bc;font-family: RalewayLight;" class="claim_date_{{$claim->id}}">{{date('j-M-o g:i a',strtotime($claim->created_at))}}</span>
                                                        </div>
                                                        <div class="col-12" style="font-family: RalewayLight;">
                                                            <p class="claim_text_{{$claim->id}}">{{$claim->text}}</p>
                                                        </div>
                                                    </div>
                                                @endforeach
                                                <button class="modal_claim" data-toggle="modal" data-target="#myModal_claim" style="display: none;"></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="margin-bottom:1.25rem;">
                            <div class="col-12 col-sm-6 col-md-6 fixed-content-right-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5 style="color:#505050;font-size: 1.125rem;margin:0;">
                                            Operations</h5>
                                    </div>
                                    <div class="card-block">
                                        <ul class="nav nav-tabs" style="font-size:1rem;font-family: RalewayRegular;" role="tablist">
                                            <?php $i=0; ?>
                                            @foreach($order_oper_response as $key=>$item)
                                                @if($i==0)
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#Operations_year{{$key}}" role="tab"
                                                           data-toggle="tab">{{$key}}</a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#Operations_year{{$key}}" role="tab"
                                                           data-toggle="tab">{{$key}}</a>
                                                    </li>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </ul>
                                        <?php $i=0; ?>
                                        <div class="tab-content">
                                            @foreach($order_oper_response as $key=>$item)
                                                @if($i==0)
                                                    <div role="tabpanel" class="tab-pane in active new-scroll" style="height: 80px;overflow: auto" id="Operations_year{{$key}}">
                                                        @foreach($item as $stat)
                                                            <div class="col d-flex justify-content-center" style="font-family:RalewayItalic;color:#bbbbbb;margin-top: 0.5rem;font-size: 1.25rem;">
                                                                {{$stat}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @else
                                                    <div role="tabpanel" class="tab-pane new-scroll" style="height: 80px;overflow: auto" id="Operations_year{{$key}}">
                                                        @foreach($item as $stat)
                                                            <div class="col d-flex justify-content-center" style="font-family:RalewayItalic;color:#bbbbbb;margin-top: 0.5rem;font-size: 1.25rem;">
                                                                {{$stat}}
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-6 fixed-content-left-mobile">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5  style="color:#505050;font-size: 1.125rem;margin:0;">Quick
                                            Stats</h5>
                                    </div>
                                    <div class="card-block">
                                        <ul class="nav nav-tabs" style="font-size:1rem;font-family: RalewayRegular;" role="tablist">
                                            <?php $i=0; ?>
                                            @foreach($o_r as $key=>$item)
                                                @if($i==0)
                                                    <li class="nav-item">
                                                        <a class="nav-link active" href="#Stats_year{{$key}}" role="tab"
                                                           data-toggle="tab">{{$key}}</a>
                                                    </li>
                                                @else
                                                    <li class="nav-item">
                                                        <a class="nav-link" href="#Stats_year{{$key}}" role="tab" data-toggle="tab">{{$key}}</a>
                                                    </li>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            <?php $i=0; ?>
                                            @foreach($o_r as $key=>$item)
                                                @if($i==0)
                                                    <div role="tabpanel" class="tab-pane in active" style="font-size:1rem;" id="Stats_year{{$key}}">
                                                        <div class="row">
                                                            <div class="col-5 d-flex justify-content-end pr-0" style="font-family: RalewayMedium;">
                                                                <b>{{$item['total']}}</b>
                                                            </div>
                                                            <div class="col" style="font-family: RalewayLight;">
                                                                orders in total
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-5 d-flex justify-content-end pr-0" style="font-family: RalewayMedium;">
                                                                <b>${{$item['sum']}}</b>
                                                            </div>
                                                            <div class="col" style="font-family: RalewayLight;">
                                                                order sum
                                                            </div>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div role="tabpanel" class="tab-pane" id="Stats_year{{$key}}"></div>
                                                @endif
                                                <?php $i++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card box-shadow">
                                    <div class="card-header text-center">
                                        <h5  style="color:#505050;font-size: 1.125rem;margin:0;">Payment
                                            Terms & Limitations
                                        </h5>
                                        @if($admin_role=='super_admin' || $admin_role=='customer_service')
                                            <button class="btn_orange edit-info d-flex align-items-center" style="line-height: normal;position:absolute;right: 0.6875rem;top: 0.375rem;padding: 0.5rem 0.6rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                        @endif
                                    </div>
                                    <div class="card-block">
                                        <form class="edit_info_form">
                                            <p class="edit" type="hidden" name="client_id" style="display: none;">{{$users_id}}</p>
                                            <p class="edit" type="hidden" name="token" style="display: none;">{{$token}}</p>
                                            <h5 style="font-family: RalewaySemiBold;font-size:1rem;text-transform: uppercase;">Accepted/Authorized Payment Types:</h5>
                                            <div class="row">
                                                <div class="col form-group nowrap">
                                                    <label class="d-inline-block mb-0" style="margin-right:0.625rem;font-family: RalewayLight;">Default:</label>
                                                    <select name="payment_type_default" class="edit-dark moredark underlining-terms  form-control-edit fixed-padding" disabled>
                                                        <option value="TT in Advance">TT in Advance</option>
                                                        <option value="TT on Arival">TT on Arival</option>
                                                        <option value="TT60">TT60</option>
                                                        <option value="TT120">TT120</option>
                                                        <option value="D/P">D/P</option>
                                                        <option value="D/A59">D/A59</option>
                                                        <option value="L/C at Sight">L/C at Sight</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col form-group nowrap">
                                                    <label class="d-inline-block mb-0" style="margin-right:0.625rem;white-space: nowrap;font-family: RalewayLight;">Other Acepted Payment Terms:</label>
                                                    <select name="payment_type_other" class="edit-dark moredark  underlining-terms  form-control-edit fixed-padding" disabled>
                                                        <option value="TT in Advance">TT in Advance</option>
                                                        <option value="TT on Arival">TT on Arival</option>
                                                        <option value="TT60">TT60</option>
                                                        <option value="TT120">TT120</option>
                                                        <option value="D/P">D/P</option>
                                                        <option value="D/A59">D/A59</option>
                                                        <option value="L/C at Sight">L/C at Sight</option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{--<input required name="terms" type="text" class="edit edit-dark edit_info" value="{{$data['terms']}}" disabled>--}}
                                            {{--<textarea required  name="terms"  cols="30" class="edit edit-dark edit_info form-control-edit" rows="3" disabled style="resize:none;">{{$data['terms']}} </textarea>--}}
                                            <h5 style="font-family: RalewaySemiBold;font-size:1rem;text-transform: uppercase;">Limitations:</h5>
                                            <p name="limitations" style="font-size:0.875rem;font-family:RalewayLight;outline:none;margin-bottom:1rem;" class="edit form-control-edit">{{$data->limitations}}</p>
                                            <h5 style="font-family: RalewaySemiBold;font-size:1rem;text-transform: uppercase;">Notes:</h5>
                                            <p name="notes" style="font-size:0.875rem;font-family:RalewayLight;outline:none;margin-bottom:1rem;" class="edit form-control-edit">
                                                {{$data->notes}}
                                            </p>
                                            <div class="row" style="margin-top: 20px">
                                                <div class="col-lg-12 text-center">
                                                    <button type="submit" class="btn btn-success save save_info"> Save </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal_notes" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header RalewaySemiBold">
                            <h4 class="modal-title" id="myModalLabel_notes">Edit Private Notes</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="block-notes" style="border-bottom:1px solid #e5e5e5;">
                            @foreach($notes as $note)
                                <div data-id="{{$note->id}}" class="row block-notes-items note_item" style="margin:0 0;padding: 10px 0;">
                                    <div class="col-10" style="font-size:0.875rem;">
                                        <span data-id="{{$note->id}}" class="time_note" style="color: #aab4bc;">{{$note->last_time}}</span>
                                        <p data-id="{{$note->id}}" class="mb-0 notes">{{$note->text}}</p>
                                    </div>
                                    <div class="col-2 d-flex align-items-center justify-content-center">
                                        <button data-id="{{$note->id}}" onclick="edit_note(this)" type="button" class="btn_orange edit_notes d-flex align-items-center"  style="line-height: normal;margin-right: 0.625rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>
                                        <button data-id="{{$note->id}}" onclick="delete_note(this)" type="button" class="btn_gray delete_notes d-flex align-items-center" style="line-height: normal;"><img src="/public/img/admin/ico_delete.png" alt="" style="width:0.8125rem;height:0.8125rem;"></button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <form class="notes_edit">
                            <input type="hidden" value="{{$users_id}}" name="client_id">
                            <input type="hidden" name="token" value="{{$token}}">
                            <div class="col card-block">
                                <textarea required class="form-control text-notes note_text" name="text"  style="height:10.9375rem;resize:none;"></textarea>
                            </div>
                            <div class="modal-footer justify-content-end" style="padding-bottom:1.875rem;">
                                <button type="button" class="btn_page_orange" data-dismiss="modal" style="background-color:#ffb74d;margin: 0;width: 16.25rem;">Cancel</button>
                                <input type="submit" class="btn_page add_notes" style="width: 16.25rem;margin-left:1.25rem;" value="Add New Note">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal_claim" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header RalewaySemiBold">
                            <h4 class="modal-title" id="myModalLabel_claim">View Claim</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Cancel">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="card-block">
                            <div class="row form-group" style="font-size:1.125rem;">
                                <div class="col-6 d-flex justify-content-start">
                                    <span class="RalewayMedium modal_claim_unique" style="background:#f0f0f0;">241117AA-F215</span>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <span style="color:#aab4bc;" class="modal_claim_date"></span>
                                </div>
                            </div>
                            <div class="row form-group">
                                <div class="col-12 form-group">
                                    <a class="image-popup-fit-width modal_claim_images_link" href="">
                                        <img src="/public/img/admin/product_1.png" class="modal_claim_images" alt="" style="width: 8.375rem;object-fit: cover;height: 8.375rem;border: 0.0625rem solid #cacaca;margin-right:0.3125rem;">
                                    </a>
                                </div>
                                <div class="col-12 form-group video_block_content">
                                    <video class="video_block modal_claim_imagesvideos_link" src="" controls>
                                    </video>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col RalewayLight">
                                    <p style="font-size:0.875rem;" class="modal_claim_text"></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <img src="/public/img/admin/picture.png" alt="" style="height:2.625rem;margin-right:0.8125rem;">
                                    <a href="" class="modal_claim_imagesvideos" download="" style="color: #4c6897;">Download Claim Reference</a>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer flex-sm-row flex-column justify-content-between " style="padding-bottom:1.875rem;">
                            <button type="button" onclick="set_claim(this)" class="btn_page prev_claim" style="border-bottom: none!important;background-color:#dcdcdc;margin:0;width: 16.25rem;">< Prev Claim</button>
                            <button type="button" class="btn_page claim_close" data-dismiss="modal" style="background-color:#2f466d;border-bottom: 0.2em solid #293d60;margin:0;width: 16.25rem;">Close</button>
                            <button type="button" onclick="set_claim(this)" class="btn_page next_claim" style="border-bottom: none!important;width: 16.25rem;margin:0;" >Next Claim  ></button>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
@endsection
@section('script')
    @include('template.script_admin_template')
    <script src="/public/js/jquery.auto-grow-input.js"></script>
    <script src="/public/js/jquery.magnific-popup.js"></script>
    <script>
        
        $(document).ready(function() {


            $('.image-popup-fit-width').magnificPopup({
                type: 'image',
                closeOnContentClick: true,
                image: {
                    verticalFit: false
                }
            });


        });

        $('select[name="country"]').val('{{$data->country}}');
        $('select[name="regione"]').val('{{$data->regione}}');
        $('select[name="payment_type_default"]').val('{{$data->payment_type_default}}');
        $('select[name="payment_type_other"]').val('{{$data->payment_type_other}}');

        function set_claim(btn) {
            var id = $(btn).attr('data-claim-id');
//            alert(id);
            $('.claim_close').click();
            setTimeout(function () {
                $('.show_claims_'+id).click();
            },500);
        }

        function claim_modal(a) {
            var text = $(a).attr('data-text');
            var id = $(a).attr('data-id');
            var unique_id = $(a).attr('data-unique-id');
            var date = $(a).attr('data-date');
            var imagesvideos = $(a).attr('data-imagesvideos');
            var images = $(a).attr('data-images');
            var count = parseInt($(a).attr('data-count'),10);
            var current = parseInt($(a).attr('data-current'),10);

            if(current==0){
                $('.prev_claim').attr('disabled','disabled');
                $('.prev_claim').css('background-color','#dcdcdc');
            }else{
                $('.prev_claim').attr('data-claim-id',current-1);
                $('.prev_claim').css('background-color','#56be60');
                $('.prev_claim').removeAttr('disabled');
            }

            //dcdcdc
            if(current==count){
                $('.next_claim').attr('disabled','disabled');
                $('.next_claim').css('background-color','#dcdcdc');
            }else{
                $('.next_claim').css('background-color','#56be60');
                $('.next_claim').removeAttr('disabled');
                $('.next_claim').attr('data-claim-id',current+1);
            }


            $('.modal_claim_imagesvideos').attr('href',imagesvideos);
            $('.modal_claim_imagesvideos_link').attr('src',imagesvideos);
            $('.modal_claim_images').attr('src',images);
            $('.modal_claim_images_link').attr('href',images);
            $('.modal_claim_text').html(text);
            $('.modal_claim_date').html(date);
            $('.modal_claim_unique').html(unique_id);
            if($('.modal_claim_imagesvideos_link').attr('src')){
                $('.video_block_content').removeClass('d-none');
            }
            else{
                $('.video_block_content').addClass('d-none');
            }

            $('.modal_claim').click();
        }

        function delete_prod_from_cart(id) {
            $.ajax({
                url:"/api/user/product/delete_from_cart",
                type:"POST",
                data:{cart_id:id},
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
                            window.location = '/panel/admin/clients/view/{{$users_id}}';
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

        // $('.edit').autoGrowInput({ minWidth: 200, maxWidth: 2000, comfortZone: 10 });
        $(document).ready(function () {
            $(".header_text").html('Clients');
        });
        $(function (){
            $(".edit_notes").click(function(){
                var html = $('.notes').text();
                $(".text-notes").append(html);
                var parent = $(this).parent().parent();
                $(parent).addClass('block-notes-active');
                $(".edit_notes").attr('disabled','disabled');
                $(".add_notes").val("Update Note");

            });
        });
        $(function (){
            $(".add_notes").click(function(){
                $(".block-notes-items").removeClass('block-notes-active')
                $(".edit_notes").removeAttr('disabled');
                $(".add_notes").val("Add New Note");
            });
        });

        $(function (){
            $(".cancel_notes").click(function(){
                $(".block-notes-items").removeClass('block-notes-active')
                $(".edit_notes").removeAttr('disabled');
                $(".add_notes").val("Add New Note");
                $(".note_text").val("");
            });
        });


        $('.edit-info').click(function(){
            $('.edit_info_form .form-control-edit').css("border", "0.125rem solid #aab4bc");
            $('.save_info').css("display", "initial");
            $('.underlining-terms').removeAttr('disabled');
        });

        $('.edit_company').click(function(){
            $('.edit_personal_info .form-control-edit').css("border", "0.125rem solid #aab4bc");
            $('.save_company').css("display", "initial");
            $('.underlining').removeAttr('disabled');
        });
        $('.edit_bank').click(function(){
            $('.banks_details_edit .form-control-edit').css("border", "0.125rem solid #aab4bc");
            // $('.edit-bank-name').removeAttr('disabled');
            $('.save_bank').css("display", "initial");
        });


        $('.edit_address').click(function(){
            $('.billing_address_edit .form-control-edit').css("border", "0.125rem solid #aab4bc");
            // $('.edit-address-name').removeAttr('disabled');
            $('.save_address').css("display", "initial");
        });



        function close_edit(){
            $('.save_client_data').click();
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
                        setTimeout(function () {
                            window.location = '/panel/admin/clients/view/{{$users_id}}';
                        },1000);
                    }else{
                        $('.edit_personal_info .form-control-edit').css("border", "none");
                        $('.underlining').attr('disabled','disabled');
                        $('.save_company').css("display", "none");
                        sweet_modal(data.message,'error',2000);
                    }
                    $(".btn_submit").removeAttr('disabled');
                },error:function (data) {
                    console.log(data);
                    sweet_modal('Something went wrong','error',2000);
                    $(".btn_submit").removeAttr('disabled');
                }
            })

        });

        //edit_info_form

        $('form.edit_info_form').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');

            var fd = new FormData();
            $('.edit_info_form .edit').each(function () {
                if($(this).attr('name')){
                    fd.append($(this).attr('name'),$(this).html());
                }
            });

            fd.append('payment_type_other',$('select[name="payment_type_other"]').val());
            fd.append('payment_type_default',$('select[name="payment_type_default"]').val());
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
                        $('.edit_info_form .form-control-edit').css("border", "none");
                        // $('.edit_info').attr('disabled','disabled');
                        $('.save_info').css("display", "none");
//                        window.location = '/panel/admin/clients';
                        setTimeout(function () {
                            window.location = '/panel/admin/clients/view/{{$users_id}}';
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

        $('form.billing_address_edit').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var fd = new FormData();
            $('.billing_address_edit .edit').each(function () {
                if($(this).attr('name')){
                    fd.append($(this).attr('name'),$(this).html());
                }
            });
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
                            window.location = '/panel/admin/clients/view/{{$users_id}}';
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

        $('form.banks_details_edit').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            var fd = new FormData();
            $('.banks_details_edit .edit').each(function () {
                if($(this).attr('name')){
                    fd.append($(this).attr('name'),$(this).html());
                }
            });
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
                        $('.save_bank').css("display", "none");
                        setTimeout(function () {
                            window.location = '/panel/admin/clients/view/{{$users_id}}';
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


        $('form.notes_edit').on('submit',function(e){
            e.preventDefault();
            $(".btn_submit").attr('disabled','disabled');
            $.ajax({
                url:"/api/admin/notes/edit",
                type:"POST",
                data:$(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
                        if(data.type=='new'){
                            $('.block-notes').prepend('<div data-id="'+data.id+'" class="row note_item" style="margin:0 0;padding:10px 0;">\n' +
                                '                                    <div class="col-10" style="font-size:0.875rem;">\n' +
                                '                                        <span data-id="'+data.id+'" style="color: #aab4bc;">'+data.time+'</span>\n' +
                                '                                        <p data-id="'+data.id+'" class="mb-0 notes">'+data.text+'</p>\n' +
                                '                                    </div>\n' +
                                '                                    <div class="col-2 d-flex align-items-center justify-content-center">\n' +
                                '                                        <button type="button" data-id="'+data.id+'" onclick="edit_note(this)" class="btn_orange edit_notes d-flex align-items-center"  style="line-height: normal;margin-right: 0.625rem;"><img src="/public/img/admin/ico_edit.png" alt="" style="width:0.8125rem;height:0.875rem;vertical-align: -1px;"></button>\n' +
                                '                                        <button type="button" data-id="'+data.id+'" onclick="delete_note(this)" class="btn_gray d-flex align-items-center" style="line-height: normal;"><img src="/public/img/admin/ico_delete.png" alt="" style="width:0.8125rem;height:0.8125rem;"></button>\n' +
                                '                                    </div>\n' +
                                '                                </div>');

                            $('.notes_list').prepend('<div class="row note_item" data-id="'+data.id+'">\n' +
                                '                                                        <div class="col RalewayLight"\n' +
                                '                                                             style="font-size: 0.875rem;">\n' +
                                '                                                            <div class="row">\n' +
                                '                                                                <div class="col-12">\n' +
                                '                                                                    <span class="time_note" data-id="'+data.id+'" style="color:#aab4bc;">'+data.time+'</span>\n' +
                                '                                                                </div>\n' +
                                '                                                                <div class="col-12">\n' +
                                '                                                                    <p class="notes" data-id="'+data.id+'">'+data.text+'</p>\n' +
                                '                                                                </div>\n' +
                                '                                                            </div>\n' +
                                '                                                        </div>\n' +
                                '                                                    </div>');
                        }else{
                            $('.notes[data-id="'+data.id+'"]').html(data.text);
                            $('.time_note[data-id="'+data.id+'"]').html(data.time);
                        }
                        $('.note_text').val('');
                        $('form.notes_edit').find('input[name="note_id"]').remove();
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


        function delete_note(btn) {
            var id = $(btn).attr('data-id');
            var client_id = '{{$users_id}}';
            var token = '{{$token}}';
            $.ajax({
                url:"/api/admin/notes/delete",
                type:"POST",
                data:{note_id:id,token:token,client_id:client_id},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
                        $('.note_item[data-id="'+id+'"]').remove();
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

        function edit_note(btn) {
            var id = $(btn).attr('data-id');
            $('form.notes_edit').append('<input type="hidden" name="note_id" value="'+id+'">');
            $('.note_text').val($('.notes[data-id="'+id+'"]').html());
        }


        function access_brand(input) {
            var brand_id = $(input).attr('data-brand-id');
            var client_id = '{{$users_id}}';
            var token = '{{$token}}';
            var value = 0;
            if($(input).prop('checked')){
                value = 1;
            }

            $.ajax({
                url:"/api/admin/brand/set_access",
                type:"POST",
                data:{brand_id:brand_id,token:token,client_id:client_id,value:value},
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'JSON',
                success:function (data) {
                    console.log(data);
                    if(data.success==true){
//                        sweet_modal('Success','success',1000);
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

        $( ".edit-info" ).click(function() {
            $('.edit_info_form .edit').each(function () {
                $(this).attr('contenteditable','true');
            });
        });
        // $( ".edit-info" ).click(function() {
        //     var $p = $('.form-control-edit')
        //     $p.toggleClass('height-20px', $p.html() == '');
        // });

        $( ".save_info" ).click(function() {
            $('.edit_info_form .edit').each(function () {
                $(this).attr('contenteditable','false');
            });
        });
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