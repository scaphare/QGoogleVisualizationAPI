<?php

/**
 * Google_Config_IntensityMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/intensitymap.html
 * @desc configuration object for intensity maps
 * {@example test_google_vis_data_source.php}
 */
/**
 * Google_Config_IntensityMap
 * @package Google
 * @subpackage Google_Config
 * @author Thomas Schaefer
 * @copyright Thomas Schaefer
 * @since 2009-05-20

 * @see http://code.google.com/apis/visualization/documentation/gallery/intensitymap.html
 * @desc configuration object for intensity maps
 */
class Google_Config_IntensityMap extends Google_Config_Base {

	protected $configuration = array(
			"colors" => array("datatype" => "string", "description" => "The colors to use for each tab. An array of strings. Each element is a string in the format #rrggbb. For example '#00cc00'."),
			"height" => array("datatype" => "array", "description" => "Height of the map in pixels."),
			"width" => array("datatype" => "array", "description" => "Width of the map in pixels."),
			"showOneTab" => array("datatype" => "bool", "description" => "The intensity map can display one or more numeric columns. Each column is displayed as a separate map, and tabs on top enable selection of which map to show. When the data table contains only one numeric column, the tabs are not displayed. To display tabs even for a single numeric column, set this option to true."),
			"region" => array(
				"values" => array("world", "africa", "asia", "europe", "middle_east", "south_america", "usa"),
				"datatype" => "string",
				"description" => "The required region. Possible values are: world, africa, asia, europe, middle_east, south_america, and usa.",

				"usa" => array(
					"AL" => "Alabama" , "LA" => "Louisiana", "OH" => "Ohio",
					"AK" => "Alaska" , "ME" => "Maine", "OK" => "Oklahoma",
					"AZ" => "Arizona" , "MD" => "Maryland", "OR" => "Oregon",
					"AR" => "Arkansas" , "MA" => "Massachusetts", "PA" => "Pennsylvania",
					"CA" => "California" , "MI" => "Michigan", "RI" => "Rhode Island",
					"CO" => "Colorado" , "MN" => "Minnesota", "SC" => "S Carolina",
					"CT" => "Connecticut" , "MS" => "Mississippi", "SD" => "S Dakota",
					"DE" => "Delaware", "MO" => "Missouri", "TN" => "Tennessee",
					"FL" => "Florida", "MT" => "Montana", "TX" => "Texas",
					"GA" => "Georgia", "NE" => "Nebraska", "UT" => "Utah",
					"HI" => "Hawaii", "NV" => "Nevada", "VT" => "Vermont",
					"ID" => "Idaho", "NH" => "New Hampshire", "VA" => "Virginia",
					"IL" => "Illinois", "NJ" => "New Jersey", "WA" => "Washington",
					"IN" => "Indiana", "NM" => "New Mexico", "WV" => "W Virginia",
					"IA" => "Iowa", "NY" => "New York", "WI" => "Wisconsin",
					"KS" => "Kansas", "NC" => "N Carolina", "WY" => "Wyoming",
					"KY" => "Kentucky", "ND" => "N Dakota"
				),
				"iso" => array(
					"AFGHANISTAN" => "AF",
					"Ã…LAND ISLANDS" => "AX",
					"ALBANIA" => "AL",
					"ALGERIA" => "DZ",
					"AMERICAN SAMOA" => "AS",
					"ANDORRA" => "AD",
					"ANGOLA" => "AO",
					"ANGUILLA" => "AI",
					"ANTARCTICA" => "AQ",
					"ANTIGUA AND BARBUDA" => "AG",
					"ARGENTINA" => "AR",
					"ARMENIA" => "AM",
					"ARUBA" => "AW",
					"AUSTRALIA" => "AU",
					"AUSTRIA" => "AT",
					"AZERBAIJAN" => "AZ",
					"BAHAMAS" => "BS",
					"BAHRAIN" => "BH",
					"BANGLADESH" => "BD",
					"BARBADOS" => "BB",
					"BELARUS" => "BY",
					"BELGIUM" => "BE",
					"BELIZE" => "BZ",
					"BENIN" => "BJ",
					"BERMUDA" => "BM",
					"BHUTAN" => "BT",
					"BOLIVIA" => "BO",
					"BOSNIA AND HERZEGOVINA" => "BA",
					"BOTSWANA" => "BW",
					"BOUVET ISLAND" => "BV",
					"BRAZIL" => "BR",
					"BRITISH INDIAN OCEAN TERRITORY" => "IO",
					"BRUNEI DARUSSALAM" => "BN",
					"BULGARIA" => "BG",
					"BURKINA FASO" => "BF",
					"BURUNDI" => "BI",
					"CAMBODIA" => "KH",
					"CAMEROON" => "CM",
					"CANADA" => "CA",
					"CAPE VERDE" => "CV",
					"CAYMAN ISLANDS" => "KY",
					"CENTRAL AFRICAN REPUBLIC" => "CF",
					"CHAD" => "TD",
					"CHILE" => "CL",
					"CHINA" => "CN",
					"CHRISTMAS ISLAND" => "CX",
					"COCOS (KEELING) ISLANDS" => "CC",
					"COLOMBIA" => "CO",
					"COMOROS" => "KM",
					"CONGO" => "CG",
					"CONGO, THE DEMOCRATIC REPUBLIC OF THE" => "CD",
					"COOK ISLANDS" => "CK",
					"COSTA RICA" => "CR",
					"CÃ”TE D'IVOIRE" => "CI",
					"CROATIA" => "HR",
					"CUBA" => "CU",
					"CYPRUS" => "CY",
					"CZECH REPUBLIC" => "CZ",
					"DENMARK" => "DK",
					"DJIBOUTI" => "DJ",
					"DOMINICA" => "DM",
					"DOMINICAN REPUBLIC" => "DO",
					"ECUADOR" => "EC",
					"EGYPT" => "EG",
					"EL SALVADOR" => "SV",
					"EQUATORIAL GUINEA" => "GQ",
					"ERITREA" => "ER",
					"ESTONIA" => "EE",
					"ETHIOPIA" => "ET",
					"FALKLAND ISLANDS (MALVINAS)" => "FK",
					"FAROE ISLANDS" => "FO",
					"FIJI" => "FJ",
					"FINLAND" => "FI",
					"FRANCE" => "FR",
					"FRENCH GUIANA" => "GF",
					"FRENCH POLYNESIA" => "PF",
					"FRENCH SOUTHERN TERRITORIES" => "TF",
					"GABON" => "GA",
					"GAMBIA" => "GM",
					"GEORGIA" => "GE",
					"GERMANY" => "DE",
					"GHANA" => "GH",
					"GIBRALTAR" => "GI",
					"GREECE" => "GR",
					"GREENLAND" => "GL",
					"GRENADA" => "GD",
					"GUADELOUPE" => "GP",
					"GUAM" => "GU",
					"GUATEMALA" => "GT",
					"GUERNSEY" => "GG",
					"GUINEA" => "GN",
					"GUINEA-BISSAU" => "GW",
					"GUYANA" => "GY",
					"HAITI" => "HT",
					"HEARD ISLAND AND MCDONALD ISLANDS" => "HM",
					"HOLY SEE (VATICAN CITY STATE)" => "VA",
					"HONDURAS" => "HN",
					"HONG KONG" => "HK",
					"HUNGARY" => "HU",
					"ICELAND" => "IS",
					"INDIA" => "IN",
					"INDONESIA" => "ID",
					"IRAN, ISLAMIC REPUBLIC OF" => "IR",
					"IRAQ" => "IQ",
					"IRELAND" => "IE",
					"ISLE OF MAN" => "IM",
					"ISRAEL" => "IL",
					"ITALY" => "IT",
					"JAMAICA" => "JM",
					"JAPAN" => "JP",
					"JERSEY" => "JE",
					"JORDAN" => "JO",
					"KAZAKHSTAN" => "KZ",
					"KENYA" => "KE",
					"KIRIBATI" => "KI",
					"KOREA, DEMOCRATIC PEOPLE'S REPUBLIC OF" => "KP",
					"KOREA, REPUBLIC OF" => "KR",
					"KUWAIT" => "KW",
					"KYRGYZSTAN" => "KG",
					"LAO PEOPLE'S DEMOCRATIC REPUBLIC" => "LA",
					"LATVIA" => "LV",
					"LEBANON" => "LB",
					"LESOTHO" => "LS",
					"LIBERIA" => "LR",
					"LIBYAN ARAB JAMAHIRIYA" => "LY",
					"LIECHTENSTEIN" => "LI",
					"LITHUANIA" => "LT",
					"LUXEMBOURG" => "LU",
					"MACAO" => "MO",
					"MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF" => "MK",
					"MADAGASCAR" => "MG",
					"MALAWI" => "MW",
					"MALAYSIA" => "MY",
					"MALDIVES" => "MV",
					"MALI" => "ML",
					"MALTA" => "MT",
					"MARSHALL ISLANDS" => "MH",
					"MARTINIQUE" => "MQ",
					"MAURITANIA" => "MR",
					"MAURITIUS" => "MU",
					"MAYOTTE" => "YT",
					"MEXICO" => "MX",
					"MICRONESIA, FEDERATED STATES OF" => "FM",
					"MOLDOVA, REPUBLIC OF" => "MD",
					"MONACO" => "MC",
					"MONGOLIA" => "MN",
					"MONTENEGRO" => "ME",
					"MONTSERRAT" => "MS",
					"MOROCCO" => "MA",
					"MOZAMBIQUE" => "MZ",
					"MYANMAR" => "MM",
					"NAMIBIA" => "NA",
					"NAURU" => "NR",
					"NEPAL" => "NP",
					"NETHERLANDS" => "NL",
					"NETHERLANDS ANTILLES" => "AN",
					"NEW CALEDONIA" => "NC",
					"NEW ZEALAND" => "NZ",
					"NICARAGUA" => "NI",
					"NIGER" => "NE",
					"NIGERIA" => "NG",
					"NIUE" => "NU",
					"NORFOLK ISLAND" => "NF",
					"NORTHERN MARIANA ISLANDS" => "MP",
					"NORWAY" => "NO",
					"OMAN" => "OM",
					"PAKISTAN" => "PK",
					"PALAU" => "PW",
					"PALESTINIAN TERRITORY, OCCUPIED" => "PS",
					"PANAMA" => "PA",
					"PAPUA NEW GUINEA" => "PG",
					"PARAGUAY" => "PY",
					"PERU" => "PE",
					"PHILIPPINES" => "PH",
					"PITCAIRN" => "PN",
					"POLAND" => "PL",
					"PORTUGAL" => "PT",
					"PUERTO RICO" => "PR",
					"QATAR" => "QA",
					"RÃ‰UNION" => "RE",
					"ROMANIA" => "RO",
					"RUSSIAN FEDERATION" => "RU",
					"RWANDA" => "RW",
					"SAINT BARTHÃ‰LEMY" => "BL",
					"SAINT HELENA" => "SH",
					"SAINT KITTS AND NEVIS" => "KN",
					"SAINT LUCIA" => "LC",
					"SAINT MARTIN" => "MF",
					"SAINT PIERRE AND MIQUELON" => "PM",
					"SAINT VINCENT AND THE GRENADINES" => "VC",
					"SAMOA" => "WS",
					"SAN MARINO" => "SM",
					"SAO TOME AND PRINCIPE" => "ST",
					"SAUDI ARABIA" => "SA",
					"SENEGAL" => "SN",
					"SERBIA" => "RS",
					"SEYCHELLES" => "SC",
					"SIERRA LEONE" => "SL",
					"SINGAPORE" => "SG",
					"SLOVAKIA" => "SK",
					"SLOVENIA" => "SI",
					"SOLOMON ISLANDS" => "SB",
					"SOMALIA" => "SO",
					"SOUTH AFRICA" => "ZA",
					"SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS" => "GS",
					"SPAIN" => "ES",
					"SRI LANKA" => "LK",
					"SUDAN" => "SD",
					"SURINAME" => "SR",
					"SVALBARD AND JAN MAYEN" => "SJ",
					"SWAZILAND" => "SZ",
					"SWEDEN" => "SE",
					"SWITZERLAND" => "CH",
					"SYRIAN ARAB REPUBLIC" => "SY",
					"TAIWAN, PROVINCE OF CHINA" => "TW",
					"TAJIKISTAN" => "TJ",
					"TANZANIA, UNITED REPUBLIC OF" => "TZ",
					"THAILAND" => "TH",
					"TIMOR-LESTE" => "TL",
					"TOGO" => "TG",
					"TOKELAU" => "TK",
					"TONGA" => "TO",
					"TRINIDAD AND TOBAGO" => "TT",
					"TUNISIA" => "TN",
					"TURKEY" => "TR",
					"TURKMENISTAN" => "TM",
					"TURKS AND CAICOS ISLANDS" => "TC",
					"TUVALU" => "TV",
					"UGANDA" => "UG",
					"UKRAINE" => "UA",
					"UNITED ARAB EMIRATES" => "AE",
					"UNITED KINGDOM" => "GB",
					"UNITED STATES" => "US",
					"UNITED STATES MINOR OUTLYING ISLANDS" => "UM",
					"URUGUAY" => "UY",
					"UZBEKISTAN" => "UZ",
					"VANUATU" => "VU",
					"VATICAN CITY STATE" => "see HOLY SEE",
					"VENEZUELA" => "VE",
					"VIET NAM" => "VN",
					"VIRGIN ISLANDS, BRITISH" => "VG",
					"VIRGIN ISLANDS, U.S." => "VI",
					"WALLIS AND FUTUNA" => "WF",
					"WESTERN SAHARA" => "EH",
					"YEMEN" => "YE",
					"ZAMBIA" => "ZM",
					"ZIMBABWE" => "ZW"
				)
			),
		);
}