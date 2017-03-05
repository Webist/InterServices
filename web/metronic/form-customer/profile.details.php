<?php
/** @var \Account\UserProfileData $data */
$data = $this->data;
?>
<div class="tab-pane" id="tab2">
<h3 class="block">Provide your profile details</h3>
    <div class="form-group">
        <label class="control-label col-md-3">Fullname
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="fullname" value="<?= $this->data->getFullName() ?>"/>
            <span class="help-block"> Provide your fullname </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Phone Number
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="phone" value="<?= $this->data->getPhone() ?>"/>
            <span class="help-block"> Provide your phone number </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Gender
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <div class="radio-list">
                <label>
                    <input type="radio" name="gender" value="M" data-title="Male" <?= ($this->data->getGender() == 'M') ? 'checked=checked' : null ?>/> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="F" data-title="Female" <?= ($this->data->getGender() == 'F') ? 'checked=checked' : null ?>/>
                    Female </label>
                <label>
                    <input type="radio" name="gender" value="T" data-title="Trans" <?= ($this->data->getGender() == 'T') ? 'checked=checked' : null ?>/>
                    Trans </label>
            </div>
            <div id="form_gender_error"></div>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Address
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="address" value="<?= $data->getAddress() ?>"/>
            <span class="help-block"> Provide your street address </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Zipcode
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="zipcode" value="<?= $data->getZipcode() ?>"/>
            <span class="help-block"> Provide your zipcode </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">City/Town
            <span class="required"> * </span>
        </label>
        <div class="col-md-4">
            <input type="text" class="form-control" name="city" value="<?= $data->getCity() ?>"/>
            <span class="help-block"> Provide your city or town </span>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Country</label>
        <div class="col-md-4">
            <select name="country" id="country_list" class="form-control">
                <option value=""></option>
                <option value="AF" <?= $data->getCountry() == 'AF' ? 'selected' : null ?>>Afghanistan</option>
                <option value="AL" <?= $data->getCountry() == 'AL' ? 'selected' : null ?>>Albania</option>
                <option value="DZ" <?= $data->getCountry() == 'DZ' ? 'selected' : null ?>>Algeria</option>
                <option value="AS" <?= $data->getCountry() == 'AS' ? 'selected' : null ?>>American Samoa</option>
                <option value="AD" <?= $data->getCountry() == 'AD' ? 'selected' : null ?>>Andorra</option>
                <option value="AO" <?= $data->getCountry() == 'AO' ? 'selected' : null ?>>Angola</option>
                <option value="AI" <?= $data->getCountry() == 'AI' ? 'selected' : null ?>>Anguilla</option>
                <option value="AR" <?= $data->getCountry() == 'AR' ? 'selected' : null ?>>Argentina</option>
                <option value="AM" <?= $data->getCountry() == 'AM' ? 'selected' : null ?>>Armenia</option>
                <option value="AW" <?= $data->getCountry() == 'AW' ? 'selected' : null ?>>Aruba</option>
                <option value="AU" <?= $data->getCountry() == 'AU' ? 'selected' : null ?>>Australia</option>
                <option value="AT" <?= $data->getCountry() == 'AT' ? 'selected' : null ?>>Austria</option>
                <option value="AZ" <?= $data->getCountry() == 'AZ' ? 'selected' : null ?>>Azerbaijan</option>
                <option value="BS" <?= $data->getCountry() == 'BS' ? 'selected' : null ?>>Bahamas</option>
                <option value="BH" <?= $data->getCountry() == 'BH' ? 'selected' : null ?>>Bahrain</option>
                <option value="BD" <?= $data->getCountry() == 'BD' ? 'selected' : null ?>>Bangladesh</option>
                <option value="BB" <?= $data->getCountry() == 'BB' ? 'selected' : null ?>>Barbados</option>
                <option value="BY" <?= $data->getCountry() == 'BY' ? 'selected' : null ?>>Belarus</option>
                <option value="BE" <?= $data->getCountry() == 'BE' ? 'selected' : null ?>>Belgium</option>
                <option value="BZ" <?= $data->getCountry() == 'BZ' ? 'selected' : null ?>>Belize</option>
                <option value="BJ" <?= $data->getCountry() == 'BJ' ? 'selected' : null ?>>Benin</option>
                <option value="BM" <?= $data->getCountry() == 'BM' ? 'selected' : null ?>>Bermuda</option>
                <option value="BT" <?= $data->getCountry() == 'BT' ? 'selected' : null ?>>Bhutan</option>
                <option value="BO" <?= $data->getCountry() == 'BO' ? 'selected' : null ?>>Bolivia</option>
                <option value="BA" <?= $data->getCountry() == 'BA' ? 'selected' : null ?>>Bosnia and Herzegowina</option>
                <option value="BW" <?= $data->getCountry() == 'BW' ? 'selected' : null ?>>Botswana</option>
                <option value="BV" <?= $data->getCountry() == 'BV' ? 'selected' : null ?>>Bouvet Island</option>
                <option value="BR" <?= $data->getCountry() == 'BR' ? 'selected' : null ?>>Brazil</option>
                <option value="IO" <?= $data->getCountry() == 'IO' ? 'selected' : null ?>>British Indian Ocean Territory</option>
                <option value="BN" <?= $data->getCountry() == 'BN' ? 'selected' : null ?>>Brunei Darussalam</option>
                <option value="BG" <?= $data->getCountry() == 'BG' ? 'selected' : null ?>>Bulgaria</option>
                <option value="BF" <?= $data->getCountry() == 'BF' ? 'selected' : null ?>>Burkina Faso</option>
                <option value="BI" <?= $data->getCountry() == 'BI' ? 'selected' : null ?>>Burundi</option>
                <option value="KH" <?= $data->getCountry() == 'KH' ? 'selected' : null ?>>Cambodia</option>
                <option value="CM" <?= $data->getCountry() == 'CM' ? 'selected' : null ?>>Cameroon</option>
                <option value="CA" <?= $data->getCountry() == 'CA' ? 'selected' : null ?>>Canada</option>
                <option value="CV" <?= $data->getCountry() == 'CV' ? 'selected' : null ?>>Cape Verde</option>
                <option value="KY" <?= $data->getCountry() == 'KY' ? 'selected' : null ?>>Cayman Islands</option>
                <option value="CF" <?= $data->getCountry() == 'CF' ? 'selected' : null ?>>Central African Republic</option>
                <option value="TD" <?= $data->getCountry() == 'TD' ? 'selected' : null ?>>Chad</option>
                <option value="CL" <?= $data->getCountry() == 'CL' ? 'selected' : null ?>>Chile</option>
                <option value="CN" <?= $data->getCountry() == 'CN' ? 'selected' : null ?>>China</option>
                <option value="CX" <?= $data->getCountry() == 'CX' ? 'selected' : null ?>>Christmas Island</option>
                <option value="CC" <?= $data->getCountry() == 'CC' ? 'selected' : null ?>>Cocos (Keeling) Islands</option>
                <option value="CO" <?= $data->getCountry() == 'CO' ? 'selected' : null ?>>Colombia</option>
                <option value="KM" <?= $data->getCountry() == 'KM' ? 'selected' : null ?>>Comoros</option>
                <option value="CG" <?= $data->getCountry() == 'CG' ? 'selected' : null ?>>Congo</option>
                <option value="CD" <?= $data->getCountry() == 'CD' ? 'selected' : null ?>>Congo, the Democratic Republic of the</option>
                <option value="CK" <?= $data->getCountry() == 'CK' ? 'selected' : null ?>>Cook Islands</option>
                <option value="CR" <?= $data->getCountry() == 'CR' ? 'selected' : null ?>>Costa Rica</option>
                <option value="CI" <?= $data->getCountry() == 'CI' ? 'selected' : null ?>>Cote d'Ivoire</option>
                <option value="HR" <?= $data->getCountry() == 'HR' ? 'selected' : null ?>>Croatia (Hrvatska)</option>
                <option value="CU" <?= $data->getCountry() == 'CU' ? 'selected' : null ?>>Cuba</option>
                <option value="CY" <?= $data->getCountry() == 'CY' ? 'selected' : null ?>>Cyprus</option>
                <option value="CZ" <?= $data->getCountry() == 'CZ' ? 'selected' : null ?>>Czech Republic</option>
                <option value="DK" <?= $data->getCountry() == 'DK' ? 'selected' : null ?>>Denmark</option>
                <option value="DJ" <?= $data->getCountry() == 'DJ' ? 'selected' : null ?>>Djibouti</option>
                <option value="DM" <?= $data->getCountry() == 'DM' ? 'selected' : null ?>>Dominica</option>
                <option value="DO" <?= $data->getCountry() == 'DO' ? 'selected' : null ?>>Dominican Republic</option>
                <option value="EC" <?= $data->getCountry() == 'EC' ? 'selected' : null ?>>Ecuador</option>
                <option value="EG" <?= $data->getCountry() == 'EG' ? 'selected' : null ?>>Egypt</option>
                <option value="SV" <?= $data->getCountry() == 'SV' ? 'selected' : null ?>>El Salvador</option>
                <option value="GQ" <?= $data->getCountry() == 'GQ' ? 'selected' : null ?>>Equatorial Guinea</option>
                <option value="ER" <?= $data->getCountry() == 'ER' ? 'selected' : null ?>>Eritrea</option>
                <option value="EE" <?= $data->getCountry() == 'EE' ? 'selected' : null ?>>Estonia</option>
                <option value="ET" <?= $data->getCountry() == 'ET' ? 'selected' : null ?>>Ethiopia</option>
                <option value="FK" <?= $data->getCountry() == 'FK' ? 'selected' : null ?>>Falkland Islands (Malvinas)</option>
                <option value="FO" <?= $data->getCountry() == 'FO' ? 'selected' : null ?>>Faroe Islands</option>
                <option value="FJ" <?= $data->getCountry() == 'FJ' ? 'selected' : null ?>>Fiji</option>
                <option value="FI" <?= $data->getCountry() == 'FI' ? 'selected' : null ?>>Finland</option>
                <option value="FR" <?= $data->getCountry() == 'FR' ? 'selected' : null ?>>France</option>
                <option value="GF" <?= $data->getCountry() == 'GF' ? 'selected' : null ?>>French Guiana</option>
                <option value="PF" <?= $data->getCountry() == 'PF' ? 'selected' : null ?>>French Polynesia</option>
                <option value="TF" <?= $data->getCountry() == 'TF' ? 'selected' : null ?>>French Southern Territories</option>
                <option value="GA" <?= $data->getCountry() == 'GA' ? 'selected' : null ?>>Gabon</option>
                <option value="GM" <?= $data->getCountry() == 'GM' ? 'selected' : null ?>>Gambia</option>
                <option value="GE" <?= $data->getCountry() == 'GE' ? 'selected' : null ?>>Georgia</option>
                <option value="DE" <?= $data->getCountry() == 'DE' ? 'selected' : null ?>>Germany</option>
                <option value="GH" <?= $data->getCountry() == 'GH' ? 'selected' : null ?>>Ghana</option>
                <option value="GI" <?= $data->getCountry() == 'GI' ? 'selected' : null ?>>Gibraltar</option>
                <option value="GR" <?= $data->getCountry() == 'GR' ? 'selected' : null ?>>Greece</option>
                <option value="GL" <?= $data->getCountry() == 'GL' ? 'selected' : null ?>>Greenland</option>
                <option value="GD" <?= $data->getCountry() == 'GD' ? 'selected' : null ?>>Grenada</option>
                <option value="GP" <?= $data->getCountry() == 'GP' ? 'selected' : null ?>>Guadeloupe</option>
                <option value="GU" <?= $data->getCountry() == 'GU' ? 'selected' : null ?>>Guam</option>
                <option value="GT" <?= $data->getCountry() == 'GT' ? 'selected' : null ?>>Guatemala</option>
                <option value="GN" <?= $data->getCountry() == 'GN' ? 'selected' : null ?>>Guinea</option>
                <option value="GW" <?= $data->getCountry() == 'GW' ? 'selected' : null ?>>Guinea-Bissau</option>
                <option value="GY" <?= $data->getCountry() == 'GY' ? 'selected' : null ?>>Guyana</option>
                <option value="HT" <?= $data->getCountry() == 'HT' ? 'selected' : null ?>>Haiti</option>
                <option value="HM" <?= $data->getCountry() == 'HM' ? 'selected' : null ?>>Heard and Mc Donald Islands</option>
                <option value="VA" <?= $data->getCountry() == 'VA' ? 'selected' : null ?>>Holy See (Vatican City State)</option>
                <option value="HN" <?= $data->getCountry() == 'HN' ? 'selected' : null ?>>Honduras</option>
                <option value="HK" <?= $data->getCountry() == 'HK' ? 'selected' : null ?>>Hong Kong</option>
                <option value="HU" <?= $data->getCountry() == 'HU' ? 'selected' : null ?>>Hungary</option>
                <option value="IS" <?= $data->getCountry() == 'IS' ? 'selected' : null ?>>Iceland</option>
                <option value="IN" <?= $data->getCountry() == 'IN' ? 'selected' : null ?>>India</option>
                <option value="ID" <?= $data->getCountry() == 'ID' ? 'selected' : null ?>>Indonesia</option>
                <option value="IR" <?= $data->getCountry() == 'IR' ? 'selected' : null ?>>Iran (Islamic Republic of)</option>
                <option value="IQ" <?= $data->getCountry() == 'IQ' ? 'selected' : null ?>>Iraq</option>
                <option value="IE" <?= $data->getCountry() == 'IE' ? 'selected' : null ?>>Ireland</option>
                <option value="IL" <?= $data->getCountry() == 'IL' ? 'selected' : null ?>>Israel</option>
                <option value="IT" <?= $data->getCountry() == 'IT' ? 'selected' : null ?>>Italy</option>
                <option value="JM" <?= $data->getCountry() == 'JM' ? 'selected' : null ?>>Jamaica</option>
                <option value="JP" <?= $data->getCountry() == 'JP' ? 'selected' : null ?>>Japan</option>
                <option value="JO" <?= $data->getCountry() == 'JO' ? 'selected' : null ?>>Jordan</option>
                <option value="KZ" <?= $data->getCountry() == 'KZ' ? 'selected' : null ?>>Kazakhstan</option>
                <option value="KE" <?= $data->getCountry() == 'KE' ? 'selected' : null ?>>Kenya</option>
                <option value="KI" <?= $data->getCountry() == 'KI' ? 'selected' : null ?>>Kiribati</option>
                <option value="KP" <?= $data->getCountry() == 'KP' ? 'selected' : null ?>>Korea, Democratic People's Republic of</option>
                <option value="KR" <?= $data->getCountry() == 'KR' ? 'selected' : null ?>>Korea, Republic of</option>
                <option value="KW" <?= $data->getCountry() == 'KW' ? 'selected' : null ?>>Kuwait</option>
                <option value="KG" <?= $data->getCountry() == 'KG' ? 'selected' : null ?>>Kyrgyzstan</option>
                <option value="LA" <?= $data->getCountry() == 'LA' ? 'selected' : null ?>>Lao People's Democratic Republic</option>
                <option value="LV" <?= $data->getCountry() == 'LV' ? 'selected' : null ?>>Latvia</option>
                <option value="LB" <?= $data->getCountry() == 'LB' ? 'selected' : null ?>>Lebanon</option>
                <option value="LS" <?= $data->getCountry() == 'LS' ? 'selected' : null ?>>Lesotho</option>
                <option value="LR" <?= $data->getCountry() == 'LR' ? 'selected' : null ?>>Liberia</option>
                <option value="LY" <?= $data->getCountry() == 'LY' ? 'selected' : null ?>>Libyan Arab Jamahiriya</option>
                <option value="LI" <?= $data->getCountry() == 'LI' ? 'selected' : null ?>>Liechtenstein</option>
                <option value="LT" <?= $data->getCountry() == 'LT' ? 'selected' : null ?>>Lithuania</option>
                <option value="LU" <?= $data->getCountry() == 'LU' ? 'selected' : null ?>>Luxembourg</option>
                <option value="MO" <?= $data->getCountry() == 'MO' ? 'selected' : null ?>>Macau</option>
                <option value="MK" <?= $data->getCountry() == 'MK' ? 'selected' : null ?>>Macedonia, The Former Yugoslav Republic of</option>
                <option value="MG" <?= $data->getCountry() == 'MG' ? 'selected' : null ?>>Madagascar</option>
                <option value="MW" <?= $data->getCountry() == 'MW' ? 'selected' : null ?>>Malawi</option>
                <option value="MY" <?= $data->getCountry() == 'MY' ? 'selected' : null ?>>Malaysia</option>
                <option value="MV" <?= $data->getCountry() == 'MV' ? 'selected' : null ?>>Maldives</option>
                <option value="ML" <?= $data->getCountry() == 'ML' ? 'selected' : null ?>>Mali</option>
                <option value="MT" <?= $data->getCountry() == 'MT' ? 'selected' : null ?>>Malta</option>
                <option value="MH" <?= $data->getCountry() == 'MH' ? 'selected' : null ?>>Marshall Islands</option>
                <option value="MQ" <?= $data->getCountry() == 'MQ' ? 'selected' : null ?>>Martinique</option>
                <option value="MR" <?= $data->getCountry() == 'MR' ? 'selected' : null ?>>Mauritania</option>
                <option value="MU" <?= $data->getCountry() == 'MU' ? 'selected' : null ?>>Mauritius</option>
                <option value="YT" <?= $data->getCountry() == 'YT' ? 'selected' : null ?>>Mayotte</option>
                <option value="MX" <?= $data->getCountry() == 'MX' ? 'selected' : null ?>>Mexico</option>
                <option value="FM" <?= $data->getCountry() == 'FM' ? 'selected' : null ?>>Micronesia, Federated States of</option>
                <option value="MD" <?= $data->getCountry() == 'MD' ? 'selected' : null ?>>Moldova, Republic of</option>
                <option value="MC" <?= $data->getCountry() == 'MC' ? 'selected' : null ?>>Monaco</option>
                <option value="MN" <?= $data->getCountry() == 'MN' ? 'selected' : null ?>>Mongolia</option>
                <option value="MS" <?= $data->getCountry() == 'MS' ? 'selected' : null ?>>Montserrat</option>
                <option value="MA" <?= $data->getCountry() == 'MA' ? 'selected' : null ?>>Morocco</option>
                <option value="MZ" <?= $data->getCountry() == 'MZ' ? 'selected' : null ?>>Mozambique</option>
                <option value="MM" <?= $data->getCountry() == 'MM' ? 'selected' : null ?>>Myanmar</option>
                <option value="NA" <?= $data->getCountry() == 'NA' ? 'selected' : null ?>>Namibia</option>
                <option value="NR" <?= $data->getCountry() == 'NR' ? 'selected' : null ?>>Nauru</option>
                <option value="NP" <?= $data->getCountry() == 'NP' ? 'selected' : null ?>>Nepal</option>
                <option value="NL" <?= $data->getCountry() == 'NL' ? 'selected' : null ?>>Netherlands</option>
                <option value="AN" <?= $data->getCountry() == 'AN' ? 'selected' : null ?>>Netherlands Antilles</option>
                <option value="NC" <?= $data->getCountry() == 'NC' ? 'selected' : null ?>>New Caledonia</option>
                <option value="NZ" <?= $data->getCountry() == 'NZ' ? 'selected' : null ?>>New Zealand</option>
                <option value="NI" <?= $data->getCountry() == 'NI' ? 'selected' : null ?>>Nicaragua</option>
                <option value="NE" <?= $data->getCountry() == 'NE' ? 'selected' : null ?>>Niger</option>
                <option value="NG" <?= $data->getCountry() == 'NG' ? 'selected' : null ?>>Nigeria</option>
                <option value="NU" <?= $data->getCountry() == 'NU' ? 'selected' : null ?>>Niue</option>
                <option value="NF" <?= $data->getCountry() == 'NF' ? 'selected' : null ?>>Norfolk Island</option>
                <option value="MP" <?= $data->getCountry() == 'MP' ? 'selected' : null ?>>Northern Mariana Islands</option>
                <option value="NO" <?= $data->getCountry() == 'NO' ? 'selected' : null ?>>Norway</option>
                <option value="OM" <?= $data->getCountry() == 'OM' ? 'selected' : null ?>>Oman</option>
                <option value="PK" <?= $data->getCountry() == 'PK' ? 'selected' : null ?>>Pakistan</option>
                <option value="PW" <?= $data->getCountry() == 'PW' ? 'selected' : null ?>>Palau</option>
                <option value="PA" <?= $data->getCountry() == 'PA' ? 'selected' : null ?>>Panama</option>
                <option value="PG" <?= $data->getCountry() == 'PG' ? 'selected' : null ?>>Papua New Guinea</option>
                <option value="PY" <?= $data->getCountry() == 'PY' ? 'selected' : null ?>>Paraguay</option>
                <option value="PE" <?= $data->getCountry() == 'PE' ? 'selected' : null ?>>Peru</option>
                <option value="PH" <?= $data->getCountry() == 'PH' ? 'selected' : null ?>>Philippines</option>
                <option value="PN" <?= $data->getCountry() == 'PN' ? 'selected' : null ?>>Pitcairn</option>
                <option value="PL" <?= $data->getCountry() == 'PL' ? 'selected' : null ?>>Poland</option>
                <option value="PT" <?= $data->getCountry() == 'PT' ? 'selected' : null ?>>Portugal</option>
                <option value="PR" <?= $data->getCountry() == 'PR' ? 'selected' : null ?>>Puerto Rico</option>
                <option value="QA" <?= $data->getCountry() == 'QA' ? 'selected' : null ?>>Qatar</option>
                <option value="RE" <?= $data->getCountry() == 'RE' ? 'selected' : null ?>>Reunion</option>
                <option value="RO" <?= $data->getCountry() == 'RO' ? 'selected' : null ?>>Romania</option>
                <option value="RU" <?= $data->getCountry() == 'RU' ? 'selected' : null ?>>Russian Federation</option>
                <option value="RW" <?= $data->getCountry() == 'RW' ? 'selected' : null ?>>Rwanda</option>
                <option value="KN" <?= $data->getCountry() == 'KN' ? 'selected' : null ?>>Saint Kitts and Nevis</option>
                <option value="LC" <?= $data->getCountry() == 'LC' ? 'selected' : null ?>>Saint LUCIA</option>
                <option value="VC" <?= $data->getCountry() == 'VC' ? 'selected' : null ?>>Saint Vincent and the Grenadines</option>
                <option value="WS" <?= $data->getCountry() == 'WS' ? 'selected' : null ?>>Samoa</option>
                <option value="SM" <?= $data->getCountry() == 'SM' ? 'selected' : null ?>>San Marino</option>
                <option value="ST" <?= $data->getCountry() == 'ST' ? 'selected' : null ?>>Sao Tome and Principe</option>
                <option value="SA" <?= $data->getCountry() == 'SA' ? 'selected' : null ?>>Saudi Arabia</option>
                <option value="SN" <?= $data->getCountry() == 'SN' ? 'selected' : null ?>>Senegal</option>
                <option value="SC" <?= $data->getCountry() == 'SC' ? 'selected' : null ?>>Seychelles</option>
                <option value="SL" <?= $data->getCountry() == 'SL' ? 'selected' : null ?>>Sierra Leone</option>
                <option value="SG" <?= $data->getCountry() == 'SG' ? 'selected' : null ?>>Singapore</option>
                <option value="SK" <?= $data->getCountry() == 'SK' ? 'selected' : null ?>>Slovakia (Slovak Republic)</option>
                <option value="SI" <?= $data->getCountry() == 'SI' ? 'selected' : null ?>>Slovenia</option>
                <option value="SB" <?= $data->getCountry() == 'SB' ? 'selected' : null ?>>Solomon Islands</option>
                <option value="SO" <?= $data->getCountry() == 'SO' ? 'selected' : null ?>>Somalia</option>
                <option value="ZA" <?= $data->getCountry() == 'ZA' ? 'selected' : null ?>>South Africa</option>
                <option value="GS" <?= $data->getCountry() == 'GS' ? 'selected' : null ?>>South Georgia and the South Sandwich Islands</option>
                <option value="ES" <?= $data->getCountry() == 'ES' ? 'selected' : null ?>>Spain</option>
                <option value="LK" <?= $data->getCountry() == 'LK' ? 'selected' : null ?>>Sri Lanka</option>
                <option value="SH" <?= $data->getCountry() == 'SH' ? 'selected' : null ?>>St. Helena</option>
                <option value="PM" <?= $data->getCountry() == 'PM' ? 'selected' : null ?>>St. Pierre and Miquelon</option>
                <option value="SD" <?= $data->getCountry() == 'SD' ? 'selected' : null ?>>Sudan</option>
                <option value="SR" <?= $data->getCountry() == 'SR' ? 'selected' : null ?>>Suriname</option>
                <option value="SJ" <?= $data->getCountry() == 'SJ' ? 'selected' : null ?>>Svalbard and Jan Mayen Islands</option>
                <option value="SZ" <?= $data->getCountry() == 'SZ' ? 'selected' : null ?>>Swaziland</option>
                <option value="SE" <?= $data->getCountry() == 'SE' ? 'selected' : null ?>>Sweden</option>
                <option value="CH" <?= $data->getCountry() == 'CH' ? 'selected' : null ?>>Switzerland</option>
                <option value="SY" <?= $data->getCountry() == 'SY' ? 'selected' : null ?>>Syrian Arab Republic</option>
                <option value="TW" <?= $data->getCountry() == 'TW' ? 'selected' : null ?>>Taiwan, Province of China</option>
                <option value="TJ" <?= $data->getCountry() == 'TJ' ? 'selected' : null ?>>Tajikistan</option>
                <option value="TZ" <?= $data->getCountry() == 'TZ' ? 'selected' : null ?>>Tanzania, United Republic of</option>
                <option value="TH" <?= $data->getCountry() == 'TH' ? 'selected' : null ?>>Thailand</option>
                <option value="TG" <?= $data->getCountry() == 'TG' ? 'selected' : null ?>>Togo</option>
                <option value="TK" <?= $data->getCountry() == 'TK' ? 'selected' : null ?>>Tokelau</option>
                <option value="TO" <?= $data->getCountry() == 'TO' ? 'selected' : null ?>>Tonga</option>
                <option value="TT" <?= $data->getCountry() == 'TT' ? 'selected' : null ?>>Trinidad and Tobago</option>
                <option value="TN" <?= $data->getCountry() == 'TN' ? 'selected' : null ?>>Tunisia</option>
                <option value="TR" <?= $data->getCountry() == 'TR' ? 'selected' : null ?>>Turkey</option>
                <option value="TM" <?= $data->getCountry() == 'TM' ? 'selected' : null ?>>Turkmenistan</option>
                <option value="TC" <?= $data->getCountry() == 'TC' ? 'selected' : null ?>>Turks and Caicos Islands</option>
                <option value="TV" <?= $data->getCountry() == 'TV' ? 'selected' : null ?>>Tuvalu</option>
                <option value="UG" <?= $data->getCountry() == 'UG' ? 'selected' : null ?>>Uganda</option>
                <option value="UA" <?= $data->getCountry() == 'UA' ? 'selected' : null ?>>Ukraine</option>
                <option value="AE" <?= $data->getCountry() == 'AE' ? 'selected' : null ?>>United Arab Emirates</option>
                <option value="GB" <?= $data->getCountry() == 'GB' ? 'selected' : null ?>>United Kingdom</option>
                <option value="US" <?= $data->getCountry() == 'US' ? 'selected' : null ?>>United States</option>
                <option value="UM" <?= $data->getCountry() == 'UM' ? 'selected' : null ?>>United States Minor Outlying Islands</option>
                <option value="UY" <?= $data->getCountry() == 'UY' ? 'selected' : null ?>>Uruguay</option>
                <option value="UZ" <?= $data->getCountry() == 'UZ' ? 'selected' : null ?>>Uzbekistan</option>
                <option value="VU" <?= $data->getCountry() == 'VU' ? 'selected' : null ?>>Vanuatu</option>
                <option value="VE" <?= $data->getCountry() == 'VE' ? 'selected' : null ?>>Venezuela</option>
                <option value="VN" <?= $data->getCountry() == 'VN' ? 'selected' : null ?>>Viet Nam</option>
                <option value="VG" <?= $data->getCountry() == 'VG' ? 'selected' : null ?>>Virgin Islands (British)</option>
                <option value="VI" <?= $data->getCountry() == 'VI' ? 'selected' : null ?>>Virgin Islands (U.S.)</option>
                <option value="WF" <?= $data->getCountry() == 'WF' ? 'selected' : null ?>>Wallis and Futuna Islands</option>
                <option value="EH" <?= $data->getCountry() == 'EH' ? 'selected' : null ?>>Western Sahara</option>
                <option value="YE" <?= $data->getCountry() == 'YE' ? 'selected' : null ?>>Yemen</option>
                <option value="ZM" <?= $data->getCountry() == 'ZM' ? 'selected' : null ?>>Zambia</option>
                <option value="ZW" <?= $data->getCountry() == 'ZW' ? 'selected' : null ?>>Zimbabwe</option>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3">Remarks</label>
        <div class="col-md-4">
            <textarea class="form-control" rows="3" name="remarks"><?= $data->getRemarks() ?></textarea>
        </div>
    </div>
</div>