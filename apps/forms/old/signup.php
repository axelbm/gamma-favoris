<?php
namespace Apps\Form\Old;

class form_signup extends \Gamma\Old\Form{
	var $formfields = array('username', 'email', 'pwd', 'pwd_conf', 'country', 'birtdate', 'aggre');

	function init(){

	}

	function check_username($username){
		if(isset($username) & !empty($username)){
			if(strlen($username) >= 1 & strlen($username) <= 32){
				return true;
			}else{
				$this->error('Le nom doit être entre 1 et 32 lettres');
				return false;
			}
		}else{
			$this->error('Vous devez entrer un nom.');
			return false;
		}
	}

	function check_email($email){
		if(isset($email) & !empty($email)){
			if(preg_match('/^[\w\.\-]*@\w*\.[\w\.]*$/', $email)){
				$data = $this->Member->GetByEmail($email);

				if(!isset($data) | empty($data)){
					return true;
				}else{
					$this->error('L\'email est déja utilisé.');
					return false;
				}
			}else{
				$this->error('L\'email n\'est pas valide.');
				return false;
			}
		}else{
			$this->error('L\'email est obligatoir.');
			return false;
		}
	}

	function check_pwd($password){
		if(isset($password) & !empty($password)){
			if(strlen($password) >= 6 & strlen($password) <= 16){
				return true;
			}else{
				$this->error('Le mot de passe doit contenir entre 6 et 16 lettres.');
				return false;
			}
		}else{
			$this->error('Le mot de passe est obligatoir.');
			return false;
		}
	}

	function check_pwd_conf($passwordconf){
		if(isset($passwordconf) & !empty($passwordconf)){
			if($passwordconf == $this->value('pwd')){
				return true;
			}else{
				$this->error('Les mots de passe ne correspondent pas.');
				return false;
			}
		}else{
			$this->error('Vous devez confirmer votre mot de passse.');
			return false;
		}
	}

	function check_country($country){
		if(isset($country) & !empty($country)){
			$country_list = array('AF'=>'Afghanistan','ZA'=>'Afrique du Sud','AL'=>'Albanie','DZ'=>'Algérie','DE'=>'Allemagne','AD'=>'Andorre','AO'=>'Angola','AI'=>'Anguilla','AQ'=>'Antarctique','AG'=>'Antigua-et-Barbuda','SA'=>'Arabie saoudite','AR'=>'Argentine','AM'=>'Arménie','AW'=>'Aruba','AU'=>'Australie','AT'=>'Autriche','AZ'=>'Azerbaïdjan','BS'=>'Bahamas','BH'=>'Bahreïn','BD'=>'Bangladesh','BB'=>'Barbade','BY'=>'Bélarus','BE'=>'Belgique','BZ'=>'Belize','BJ'=>'Bénin','BM'=>'Bermudes','BT'=>'Bhoutan','BO'=>'Bolivie','BA'=>'Bosnie-Herzégovine','BW'=>'Botswana','BR'=>'Brésil','BN'=>'Brunéi Darussalam','BG'=>'Bulgarie','BF'=>'Burkina Faso','BI'=>'Burundi','KH'=>'Cambodge','CM'=>'Cameroun','CA'=>'Canada','CV'=>'Cap-Vert','EA'=>'Ceuta et Melilla','CL'=>'Chili','CN'=>'Chine','CY'=>'Chypre','CO'=>'Colombie','KM'=>'Comores','CG'=>'Congo-Brazzaville','CD'=>'Congo-Kinshasa','KP'=>'Corée du Nord','KR'=>'Corée du Sud','CR'=>'Costa Rica','CI'=>'Côte d’Ivoire','HR'=>'Croatie','CU'=>'Cuba','CW'=>'Curaçao','DK'=>'Danemark','DG'=>'Diego Garcia','DJ'=>'Djibouti','DM'=>'Dominique','EG'=>'Égypte','AE'=>'Émirats arabes unis','EC'=>'Équateur','ER'=>'Érythrée','ES'=>'Espagne','EE'=>'Estonie','VA'=>'État de la Cité du Vatican','US'=>'États-Unis','ET'=>'Éthiopie','FJ'=>'Fidji','FI'=>'Finlande','FR'=>'France','GA'=>'Gabon','GM'=>'Gambie','GE'=>'Géorgie','GS'=>'Géorgie du Sud et les îles Sandwich du Sud','GH'=>'Ghana','GI'=>'Gibraltar','GR'=>'Grèce','GD'=>'Grenade','GL'=>'Groenland','GP'=>'Guadeloupe','GU'=>'Guam','GT'=>'Guatemala','GG'=>'Guernesey','GN'=>'Guinée','GQ'=>'Guinée équatoriale','GW'=>'Guinée-Bissau','GY'=>'Guyana','GF'=>'Guyane française','HT'=>'Haïti','HN'=>'Honduras','HU'=>'Hongrie','CX'=>'Île Christmas','AC'=>'Île de l’Ascension','IM'=>'Île de Man','NF'=>'Île Norfolk','AX'=>'Îles Åland','KY'=>'Îles Caïmans','IC'=>'Îles Canaries','CC'=>'Îles Cocos (Keeling)','CK'=>'Îles Cook','FO'=>'Îles Féroé','FK'=>'Îles Malouines','MP'=>'Îles Mariannes du Nord','MH'=>'Îles Marshall','UM'=>'Îles mineures éloignées des États-Unis','SB'=>'Îles Salomon','TC'=>'Îles Turques-et-Caïques','VG'=>'Îles Vierges britanniques','VI'=>'Îles Vierges des États-Unis','IN'=>'Inde','ID'=>'Indonésie','IQ'=>'Irak','IR'=>'Iran','IE'=>'Irlande','IS'=>'Islande','IL'=>'Israël','IT'=>'Italie','JM'=>'Jamaïque','JP'=>'Japon','JE'=>'Jersey','JO'=>'Jordanie','KZ'=>'Kazakhstan','KE'=>'Kenya','KG'=>'Kirghizistan','KI'=>'Kiribati','XK'=>'Kosovo','KW'=>'Koweït','RE'=>'La Réunion','LA'=>'Laos','LS'=>'Lesotho','LV'=>'Lettonie','LB'=>'Liban','LR'=>'Libéria','LY'=>'Libye','LI'=>'Liechtenstein','LT'=>'Lituanie','LU'=>'Luxembourg','MK'=>'Macédoine','MG'=>'Madagascar','MY'=>'Malaisie','MW'=>'Malawi','MV'=>'Maldives','ML'=>'Mali','MT'=>'Malte','MA'=>'Maroc','MQ'=>'Martinique','MU'=>'Maurice','MR'=>'Mauritanie','YT'=>'Mayotte','MX'=>'Mexique','FM'=>'Micronésie','MD'=>'Moldavie','MC'=>'Monaco','MN'=>'Mongolie','ME'=>'Monténégro','MS'=>'Montserrat','MZ'=>'Mozambique','MM'=>'Myanmar','NA'=>'Namibie','NR'=>'Nauru','NP'=>'Népal','NI'=>'Nicaragua','NE'=>'Niger','NG'=>'Nigéria','NU'=>'Niue','NO'=>'Norvège','NC'=>'Nouvelle-Calédonie','NZ'=>'Nouvelle-Zélande','OM'=>'Oman','UG'=>'Ouganda','UZ'=>'Ouzbékistan','PK'=>'Pakistan','PW'=>'Palaos','PA'=>'Panama','PG'=>'Papouasie-Nouvelle-Guinée','PY'=>'Paraguay','NL'=>'Pays-Bas','BQ'=>'Pays-Bas caribéens','PE'=>'Pérou','PH'=>'Philippines','PN'=>'Pitcairn','PL'=>'Pologne','PF'=>'Polynésie française','PR'=>'Porto Rico','PT'=>'Portugal','QA'=>'Qatar','HK'=>'R.A.S. chinoise de Hong Kong','MO'=>'R.A.S. chinoise de Macao','CF'=>'République centrafricaine','DO'=>'République dominicaine','CZ'=>'République tchèque','RO'=>'Roumanie','GB'=>'Royaume-Uni','RU'=>'Russie','RW'=>'Rwanda','EH'=>'Sahara occidental','BL'=>'Saint-Barthélemy','KN'=>'Saint-Christophe-et-Niévès','SM'=>'Saint-Marin','MF'=>'Saint-Martin (France)','SX'=>'Saint-Martin (Pays-Bas)','PM'=>'Saint-Pierre-et-Miquelon','VC'=>'Saint-Vincent-et-les Grenadines','SH'=>'Sainte-Hélène','LC'=>'Sainte-Lucie','SV'=>'Salvador','WS'=>'Samoa','AS'=>'Samoa américaines','ST'=>'Sao Tomé-et-Principe','SN'=>'Sénégal','RS'=>'Serbie','SC'=>'Seychelles','SL'=>'Sierra Leone','SG'=>'Singapour','SK'=>'Slovaquie','SI'=>'Slovénie','SO'=>'Somalie','SD'=>'Soudan','SS'=>'Soudan du Sud','LK'=>'Sri Lanka','SE'=>'Suède','CH'=>'Suisse','SR'=>'Suriname','SJ'=>'Svalbard et Jan Mayen','SZ'=>'Swaziland','SY'=>'Syrie','TJ'=>'Tadjikistan','TW'=>'Taïwan','TZ'=>'Tanzanie','TD'=>'Tchad','TF'=>'Terres australes françaises','IO'=>'Territoire britannique de l’océan Indien','PS'=>'Territoires palestiniens','TH'=>'Thaïlande','TL'=>'Timor oriental','TG'=>'Togo','TK'=>'Tokelau','TO'=>'Tonga','TT'=>'Trinité-et-Tobago','TA'=>'Tristan da Cunha','TN'=>'Tunisie','TM'=>'Turkménistan','TR'=>'Turquie','TV'=>'Tuvalu','UA'=>'Ukraine','UY'=>'Uruguay','VU'=>'Vanuatu','VE'=>'Venezuela','VN'=>'Vietnam','WF'=>'Wallis-et-Futuna','YE'=>'Yémen','ZM'=>'Zambie','ZW'=>'Zimbabwe');

			if(isset($country_list[$country])){
				return true;
			}else{
				$this->error('Il y a une érreur dans la sélection du pays.');
				return false;
			}
		}else{
			$this->error('Vous devez sélectionner votre pays.');
			return false;
		}
	}

	function check_birtdate($birtdate){
		if(isset($birtdate) & !empty($birtdate)){
			if(preg_match('/^[\d]{4}-[\d]{2}-[\d]{2}$/', $birtdate)){
				return true;
			}else{
				$this->error('La date est invalide. (aaaa-mm-jj)');
				return false;
			}
		}else{
			$this->error('Vous devez sélectionner votre pays.');
			return false;
		}
	}

	function check_aggre($aggre){
		if(isset($aggre) & !empty($aggre)){
			return true;
		}else{
			$this->formerror('Vous devez accepter les condition d\'utilisateur.');
			$this->error('Vous acceptez.');
			return false;
		}
	}

	function success(){
		$account = array();

		$account['email']   	= $this->value('email');
		$account['username']	= htmlspecialchars($this->value('username'));
		$account['password']	= $this->value('pwd');
		$account['country'] 	= $this->value('country');
		$account['birtdate']	= $this->value('birtdate');

		$id = $this->Member->CreateAccout($account);

		if(isset($id) & !empty($id)){
			$this->success = true;

			$_SESSION['success_userid'] = $id;

			header('Location: '.WEBROOT.'user/success');
			exit;
		}else{
			$this->success = false;
		}
	}
}
?>