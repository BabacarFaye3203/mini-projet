<?php
session_start();
  include 'insPatientAction.php';
?>

<?php
include 'configuration/headindex.php'; 
?>
<h3>Inscription du patient</h3>

<div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    connexion
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="connPatient.php">Me Connecter</a></li>
  </ul>
</div>

 <section class="notrecouleur text-secondary px-4 py-5 text-center">
 <div >
    <div class="py-5" id="darkness">
      <h1 class="display-5 fw-bold text-white" >Votre CSN</h1>
      <div class="col-lg-6 mx-auto">
        <p class="fs-5 mb-4" id="textDark">CSN est une plateforme innovante conçue pour centraliser,
           organiser et sécuriser toutes vos informations médicales.
           Que vous soyez patient ou professionnel de santé,<br>
           Prenez le contrôle de votre santé dès aujourd’hui avec CSN, <br>votre compagnon numérique pour un bien-être optimal.

Accédez à vos données en toute simplicité, où que vous soyez !</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <button type="button" class="btn btn-outline-info btn-lg px-4 me-sm-3 fw-bold"></button>
          <button type="button" class="btn btn-outline-light btn-lg px-4"></button>
        </div>
      </div>
    </div>
  </div>


 </section id="insPatient">
    <br><br>
    <div class="container">
      <form action="" method="POST">
        <div class="mb-3">
          <label for="ecin" class="form-label">cin</label>
          <input type="text" class="form-control" name="cin" id="ecin" required>
        </div>
        <div class="mb-3">
          <label for="nom" class="form-label">nom</label>
          <input type="text" class="form-control" name="nom" id="nom" required>
        </div>
        <div class="mb-3">
          <label for="prenom" class="form-label">prenom</label>
          <input type="text" class="form-control"  name="prenom" id="prenom" required>
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">adresse</label>
          <input type="text" class="form-control"  name="adresse" id="adresse" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">email</label>
          <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
        </div>
        <div class="mb-3">
          <label for="pays" class="form-label">pays</label>
          <select name="country">
            <option value="AF">Afghanistan </option>
            <option value="AO">Angola </option>
            <option value="AL">Albania </option>
            <option value="AD">Andorra </option>
            <option value="AE">United Arab Emirates </option>
            <option value="AR">Argentina </option>
            <option value="AM">Armenia </option>
            <option value="AG">Antigua and Barbuda 🇦🇬</option>
            <option value="AU">Australia 🇦🇺</option>
            <option value="AT">Austria 🇦🇹</option>
            <option value="AZ">Azerbaijan 🇦🇿</option>
            <option value="BI">Burundi 🇧🇮</option>
            <option value="BE">Belgium 🇧🇪</option>
            <option value="BJ">Benin 🇧🇯</option>
            <option value="BF">Burkina Faso 🇧🇫</option>
            <option value="BD">Bangladesh 🇧🇩</option>
            <option value="BG">Bulgaria 🇧🇬</option>
            <option value="BH">Bahrain 🇧🇭</option>
            <option value="BS">Bahamas 🇧🇸</option>
            <option value="BA">Bosnia and Herzegovina 🇧🇦</option>
            <option value="BY">Belarus 🇧🇾</option>
            <option value="BZ">Belize 🇧🇿</option>
            <option value="BO">Bolivia 🇧🇴</option>
            <option value="BR">Brazil 🇧🇷</option>
            <option value="BB">Barbados 🇧🇧</option>
            <option value="BN">Brunei 🇧🇳</option>
            <option value="BT">Bhutan 🇧🇹</option>
            <option value="BW">Botswana 🇧🇼</option>
            <option value="CF">Central African Republic 🇨🇫</option>
            <option value="CA">Canada 🇨🇦</option>
            <option value="CH">Switzerland 🇨🇭</option>
            <option value="CL">Chile 🇨🇱</option>
            <option value="CN">China 🇨🇳</option>
            <option value="CI">Ivory Coast 🇨🇮</option>
            <option value="CM">Cameroon 🇨🇲</option>
            <option value="CD">DR Congo 🇨🇩</option>
            <option value="CG">Republic of the Congo 🇨🇬</option>
            <option value="CO">Colombia 🇨🇴</option>
            <option value="KM">Comoros 🇰🇲</option>
            <option value="CV">Cape Verde 🇨🇻</option>
            <option value="CR">Costa Rica 🇨🇷</option>
            <option value="CU">Cuba 🇨🇺</option>
            <option value="CY">Cyprus 🇨🇾</option>
            <option value="CZ">Czechia 🇨🇿</option>
            <option value="DE">Germany 🇩🇪</option>
            <option value="DJ">Djibouti 🇩🇯</option>
            <option value="DM">Dominica 🇩🇲</option>
            <option value="DK">Denmark 🇩🇰</option>
            <option value="DO">Dominican Republic 🇩🇴</option>
            <option value="DZ">Algeria 🇩🇿</option>
            <option value="EC">Ecuador 🇪🇨</option>
            <option value="EG">Egypt 🇪🇬</option>
            <option value="ER">Eritrea 🇪🇷</option>
            <option value="ES">Spain 🇪🇸</option>
            <option value="EE">Estonia 🇪🇪</option>
            <option value="ET">Ethiopia 🇪🇹</option>
            <option value="FI">Finland 🇫🇮</option>
            <option value="FJ">Fiji 🇫🇯</option>
            <option value="FR">France 🇫🇷</option>
            <option value="FM">Micronesia 🇫🇲</option>
            <option value="GA">Gabon 🇬🇦</option>
            <option value="GB">United Kingdom 🇬🇧</option>
            <option value="GE">Georgia 🇬🇪</option>
            <option value="GH">Ghana 🇬🇭</option>
            <option value="GN">Guinea 🇬🇳</option>
            <option value="GM">Gambia 🇬🇲</option>
            <option value="GW">Guinea-Bissau 🇬🇼</option>
            <option value="GQ">Equatorial Guinea 🇬🇶</option>
            <option value="GR">Greece 🇬🇷</option>
            <option value="GD">Grenada 🇬🇩</option>
            <option value="GT">Guatemala 🇬🇹</option>
            <option value="GY">Guyana 🇬🇾</option>
            <option value="HN">Honduras 🇭🇳</option>
            <option value="HR">Croatia 🇭🇷</option>
            <option value="HT">Haiti 🇭🇹</option>
            <option value="HU">Hungary 🇭🇺</option>
            <option value="ID">Indonesia 🇮🇩</option>
            <option value="IN">India 🇮🇳</option>
            <option value="IE">Ireland 🇮🇪</option>
            <option value="IR">Iran 🇮🇷</option>
            <option value="IQ">Iraq 🇮🇶</option>
            <option value="IS">Iceland 🇮🇸</option>
            <option value="IL">Israel 🇮🇱</option>
            <option value="IT">Italy 🇮🇹</option>
            <option value="JM">Jamaica 🇯🇲</option>
            <option value="JO">Jordan 🇯🇴</option>
            <option value="JP">Japan 🇯🇵</option>
            <option value="KZ">Kazakhstan 🇰🇿</option>
            <option value="KE">Kenya 🇰🇪</option>
            <option value="KG">Kyrgyzstan 🇰🇬</option>
            <option value="KH">Cambodia 🇰🇭</option>
            <option value="KI">Kiribati 🇰🇮</option>
            <option value="KN">Saint Kitts and Nevis 🇰🇳</option>
            <option value="KR">South Korea 🇰🇷</option>
            <option value="KW">Kuwait 🇰🇼</option>
            <option value="LA">Laos 🇱🇦</option>
            <option value="LB">Lebanon 🇱🇧</option>
            <option value="LR">Liberia 🇱🇷</option>
            <option value="LY">Libya 🇱🇾</option>
            <option value="LC">Saint Lucia 🇱🇨</option>
            <option value="LI">Liechtenstein 🇱🇮</option>
            <option value="LK">Sri Lanka 🇱🇰</option>
            <option value="LS">Lesotho 🇱🇸</option>
            <option value="LT">Lithuania 🇱🇹</option>
            <option value="LU">Luxembourg 🇱🇺</option>
            <option value="LV">Latvia 🇱🇻</option>
            <option value="MA">Morocco 🇲🇦</option>
            <option value="MC">Monaco 🇲🇨</option>
            <option value="MD">Moldova 🇲🇩</option>
            <option value="MG">Madagascar 🇲🇬</option>
            <option value="MV">Maldives 🇲🇻</option>
            <option value="MX">Mexico 🇲🇽</option>
            <option value="MH">Marshall Islands 🇲🇭</option>
            <option value="MK">Macedonia 🇲🇰</option>
            <option value="ML">Mali 🇲🇱</option>
            <option value="MT">Malta 🇲🇹</option>
            <option value="MM">Myanmar 🇲🇲</option>
            <option value="ME">Montenegro 🇲🇪</option>
            <option value="MN">Mongolia 🇲🇳</option>
            <option value="MZ">Mozambique 🇲🇿</option>
            <option value="MR">Mauritania 🇲🇷</option>
            <option value="MU">Mauritius 🇲🇺</option>
            <option value="MW">Malawi 🇲🇼</option>
            <option value="MY">Malaysia 🇲🇾</option>
            <option value="NA">Namibia 🇳🇦</option>
            <option value="NE">Niger 🇳🇪</option>
            <option value="NG">Nigeria 🇳🇬</option>
            <option value="NI">Nicaragua 🇳🇮</option>
            <option value="NL">Netherlands 🇳🇱</option>
            <option value="NO">Norway 🇳🇴</option>
            <option value="NP">Nepal 🇳🇵</option>
            <option value="NR">Nauru 🇳🇷</option>
            <option value="NZ">New Zealand 🇳🇿</option>
            <option value="OM">Oman 🇴🇲</option>
            <option value="PK">Pakistan 🇵🇰</option>
            <option value="PA">Panama 🇵🇦</option>
            <option value="PE">Peru 🇵🇪</option>
            <option value="PH">Philippines 🇵🇭</option>
            <option value="PW">Palau 🇵🇼</option>
            <option value="PG">Papua New Guinea 🇵🇬</option>
            <option value="PL">Poland 🇵🇱</option>
            <option value="KP">North Korea 🇰🇵</option>
            <option value="PT">Portugal 🇵🇹</option>
            <option value="PY">Paraguay 🇵🇾</option>
            <option value="QA">Qatar 🇶🇦</option>
            <option value="RO">Romania 🇷🇴</option>
            <option value="RU">Russia 🇷🇺</option>
            <option value="RW">Rwanda 🇷🇼</option>
            <option value="SA">Saudi Arabia 🇸🇦</option>
            <option value="SD">Sudan 🇸🇩</option>
            <option value="SN">Senegal 🇸🇳</option>
            <option value="SG">Singapore 🇸🇬</option>
            <option value="SB">Solomon Islands 🇸🇧</option>
            <option value="SL">Sierra Leone 🇸🇱</option>
            <option value="SV">El Salvador 🇸🇻</option>
            <option value="SM">San Marino 🇸🇲</option>
            <option value="SO">Somalia 🇸🇴</option>
            <option value="RS">Serbia 🇷🇸</option>
            <option value="SS">South Sudan 🇸🇸</option>
            <option value="ST">São Tomé and Príncipe 🇸🇹</option>
            <option value="SR">Suriname 🇸🇷</option>
            <option value="SK">Slovakia 🇸🇰</option>
            <option value="SI">Slovenia 🇸🇮</option>
            <option value="SE">Sweden 🇸🇪</option>
            <option value="SZ">Swaziland 🇸🇿</option>
            <option value="SC">Seychelles 🇸🇨</option>
            <option value="SY">Syria 🇸🇾</option>
            <option value="TD">Chad 🇹🇩</option>
            <option value="TG">Togo 🇹🇬</option>
            <option value="TH">Thailand 🇹🇭</option>
            <option value="TJ">Tajikistan 🇹🇯</option>
            <option value="TM">Turkmenistan 🇹🇲</option>
            <option value="TL">Timor-Leste 🇹🇱</option>
            <option value="TO">Tonga 🇹🇴</option>
            <option value="TT">Trinidad and Tobago 🇹🇹</option>
            <option value="TN">Tunisia 🇹🇳</option>
            <option value="TR">Turkey 🇹🇷</option>
            <option value="TV">Tuvalu 🇹🇻</option>
            <option value="TZ">Tanzania 🇹🇿</option>
            <option value="UG">Uganda 🇺🇬</option>
            <option value="UA">Ukraine 🇺🇦</option>
            <option value="UY">Uruguay 🇺🇾</option>
            <option value="US">United States 🇺🇸</option>
            <option value="UZ">Uzbekistan 🇺🇿</option>
            <option value="VA">Vatican City 🇻🇦</option>
            <option value="VC">Saint Vincent and the Grenadines 🇻🇨</option>
            <option value="VE">Venezuela 🇻🇪</option>
            <option value="VN">Vietnam 🇻🇳</option>
            <option value="VU">Vanuatu 🇻🇺</option>
            <option value="WS">Samoa 🇼🇸</option>
            <option value="YE">Yemen 🇾🇪</option>
            <option value="ZA">South Africa 🇿🇦</option>
            <option value="ZM">Zambia 🇿🇲</option>
            <option value="ZW">Zimbabwe 🇿🇼</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="ville" class="form-label">ville</label>
          <input type="text" class="form-control" name="ville" id="ville" required>
        </div>
        <div class="mb-3">
          <label for="gsang" class="form-label">gsang</label>
          <input type="text" class="form-control" name="gsang" id="gsang" required>
        </div>
        <div class="mb-3">
          <label for="matrimonialle" class="form-label">situation matrimoniale</label>
          <input type="text" class="form-control" name="matri" id="matrimonialle" required>
        </div>
        <div class="mb-3">
          <label for="profession" class="form-label">profession</label>
          <input type="text" class="form-control"  name="profession" id="profession" required>
        </div>
        <div class="mb-3">
          <label for="statut" class="form-label">statut</label>
          <input type="text" class="form-control"  name="statut" id="statut" required>
        </div>
        <div class="mb-3">
          <label for="age" class="form-label">age</label>
          <input type="number" class="form-control"  name="age" id="age" required>
        </div>
        <div class="mb-3">
          <label for="sexe" class="form-label">sexe</label>
          <input type="text" class="form-control"  name="sexe" id="sexe" required>
        </div>
        <div class="mb-3">
          <label for="poids" class="form-label">poids</label>
          <input type="text" class="form-control" name="poids" id="poids" required>
        </div>
        <div class="mb-3">
          <label for="taille" class="form-label">taille</label>
          <input type="text" class="form-control"  name="taille" id="taille" required>
        </div>
        <div class="mb-3">
          <label for="contact" class="form-label">contact</label>
          <input type="tel" class="form-control"  name="contact" id="contacts" required>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="pwd" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Confirmez votre Password</label>
          <input type="password" class="form-control" id="exampleInputPassword1" name="cpwd" required>
        </div>
        <input type="submit" class="btn btn-primary" value="je m'inscris" name="ok">
        <?php if(!empty($erreur)){ echo $erreur;}?>
      </form>
    </div>
<?php
include 'configuration/footer.php';
include 'configuration/pied.php';
?>