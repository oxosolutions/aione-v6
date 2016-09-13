<?php

add_action('init','of_options');

if( ! function_exists( 'of_options_array') )
{
	function of_options_array()
	{
		global $smof_data;

		// Aione edit
		//Register sidebar options for blog/portfolio/woocommerce category/archive pages
		global $wp_registered_sidebars;
		$sidebar_options[] = 'None';
		for($i=0;$i<1;$i++){
			$sidebars = $wp_registered_sidebars;// sidebar_generator::get_sidebars();
			//var_dump($sidebars);
			if(is_array($sidebars) && !empty($sidebars)){
				foreach($sidebars as $sidebar){
					$sidebar_options[] = $sidebar['name'];
				}
			}

			$sidebars = sidebar_generator::get_sidebars();
			if(is_array($sidebars) && !empty($sidebars)){
				foreach($sidebars as $key => $value){
					$sidebar_options[] = $value;
				}
			}
		}

		// End Aione edit


			// Begin Aione edit
			// Social Icon default order
			$of_options_social_links_ordering = array
			(
				  "default" => array (
						'facebook' => 'Facebook',
						'flickr' => 'Flickr',
						'rss' => 'RSS',
						'twitter' => 'Twitter',
						'vimeo' => 'Vimeo',
						'youtube' => 'Youtube',
						'instagram' => 'Instagram',
						'pinterest' => 'Pinerest',
						'tumblr' => 'Tumblr',
						'google' => 'Googleplus',
						'dribbble' => 'Dribble',
						'digg' => 'Digg',
						'linkedin' => 'LinkedIn',
						'blogger' => 'Blogger',
						'skype' => 'Skype',
						'forrst' => 'Forrst',
						'myspace' => 'Myspace',
						'deviantart' => 'Deviantart',
						'yahoo' => 'Yahoo',
						'reddit' => 'Reddit',
						'paypal' => 'Paypal',
						'dropbox' => 'Dropbox',
						'soundcloud' => 'Soundcloud',
						'vk' => 'VK',
				  ),
				  "custom" => array (
				  ),
			);
			// End Aione edit

			//More Options
			$body_repeat			= array(__("no-repeat", "Aione"),__("repeat-x", "Aione"),__("repeat-y", "Aione"),__("repeat", "Aione"));
			$body_pos			   = array(__("top left", "Aione"),__("top center", "Aione"),__("top right", "Aione"),__("center left", "Aione"),__("center center", "Aione"),__("center right", "Aione"),__("bottom left", "Aione"),__("bottom center", "Aione"),__("bottom right", "Aione"));


		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Set the Options Array
		$of_options = array();

		  // Aione Edit

		// Last updated: 2015/09/02
		$google_fonts = array (
			"None" => "None",
			"ABeeZee" => "ABeeZee",
			"Abel" => "Abel",
			"Abril Fatface" => "Abril Fatface",
			"Aclonica" => "Aclonica",
			"Acme" => "Acme",
			"Actor" => "Actor",
			"Adamina" => "Adamina",
			"Advent Pro" => "Advent Pro",
			"Aguafina Script" => "Aguafina Script",
			"Akronim" => "Akronim",
			"Aladin" => "Aladin",
			"Aldrich" => "Aldrich",
			"Alef" => "Alef",
			"Alegreya" => "Alegreya",
			"Alegreya SC" => "Alegreya SC",
			"Alegreya Sans" => "Alegreya Sans",
			"Alegreya Sans SC" => "Alegreya Sans SC",
			"Alex Brush" => "Alex Brush",
			"Alfa Slab One" => "Alfa Slab One",
			"Alice" => "Alice",
			"Alike" => "Alike",
			"Alike Angular" => "Alike Angular",
			"Allan" => "Allan",
			"Allerta" => "Allerta",
			"Allerta Stencil" => "Allerta Stencil",
			"Allura" => "Allura",
			"Almendra" => "Almendra",
			"Almendra Display" => "Almendra Display",
			"Almendra SC" => "Almendra SC",
			"Amarante" => "Amarante",
			"Amaranth" => "Amaranth",
			"Amatic SC" => "Amatic SC",
			"Amethysta" => "Amethysta",
			"Amiri" => "Amiri",
			"Amita" => "Amita",
			"Anaheim" => "Anaheim",
			"Andada" => "Andada",
			"Andika" => "Andika",
			"Angkor" => "Angkor",
			"Annie Use Your Telescope" => "Annie Use Your Telescope",
			"Anonymous Pro" => "Anonymous Pro",
			"Antic" => "Antic",
			"Antic Didone" => "Antic Didone",
			"Antic Slab" => "Antic Slab",
			"Anton" => "Anton",
			"Arapey" => "Arapey",
			"Arbutus" => "Arbutus",
			"Arbutus Slab" => "Arbutus Slab",
			"Architects Daughter" => "Architects Daughter",
			"Archivo Black" => "Archivo Black",
			"Archivo Narrow" => "Archivo Narrow",
			"Arimo" => "Arimo",
			"Arizonia" => "Arizonia",
			"Armata" => "Armata",
			"Artifika" => "Artifika",
			"Arvo" => "Arvo",
			"Arya" => "Arya",
			"Asap" => "Asap",
			"Asar" => "Asar",
			"Asset" => "Asset",
			"Astloch" => "Astloch",
			"Asul" => "Asul",
			"Atomic Age" => "Atomic Age",
			"Aubrey" => "Aubrey",
			"Audiowide" => "Audiowide",
			"Autour One" => "Autour One",
			"Average" => "Average",
			"Average Sans" => "Average Sans",
			"Averia Gruesa Libre" => "Averia Gruesa Libre",
			"Averia Libre" => "Averia Libre",
			"Averia Sans Libre" => "Averia Sans Libre",
			"Averia Serif Libre" => "Averia Serif Libre",
			"Bad Script" => "Bad Script",
			"Balthazar" => "Balthazar",
			"Bangers" => "Bangers",
			"Basic" => "Basic",
			"Battambang" => "Battambang",
			"Baumans" => "Baumans",
			"Bayon" => "Bayon",
			"Belgrano" => "Belgrano",
			"Belleza" => "Belleza",
			"BenchNine" => "BenchNine",
			"Bentham" => "Bentham",
			"Berkshire Swash" => "Berkshire Swash",
			"Bevan" => "Bevan",
			"Bigelow Rules" => "Bigelow Rules",
			"Bigshot One" => "Bigshot One",
			"Bilbo" => "Bilbo",
			"Bilbo Swash Caps" => "Bilbo Swash Caps",
			"Biryani" => "Biryani",
			"Bitter" => "Bitter",
			"Black Ops One" => "Black Ops One",
			"Bokor" => "Bokor",
			"Bonbon" => "Bonbon",
			"Boogaloo" => "Boogaloo",
			"Bowlby One" => "Bowlby One",
			"Bowlby One SC" => "Bowlby One SC",
			"Brawler" => "Brawler",
			"Bree Serif" => "Bree Serif",
			"Bubblegum Sans" => "Bubblegum Sans",
			"Bubbler One" => "Bubbler One",
			"Buda" => "Buda",
			"Buenard" => "Buenard",
			"Butcherman" => "Butcherman",
			"Butterfly Kids" => "Butterfly Kids",
			"Cabin" => "Cabin",
			"Cabin Condensed" => "Cabin Condensed",
			"Cabin Sketch" => "Cabin Sketch",
			"Caesar Dressing" => "Caesar Dressing",
			"Cagliostro" => "Cagliostro",
			"Calligraffitti" => "Calligraffitti",
			"Cambay" => "Cambay",
			"Cambo" => "Cambo",
			"Candal" => "Candal",
			"Cantarell" => "Cantarell",
			"Cantata One" => "Cantata One",
			"Cantora One" => "Cantora One",
			"Capriola" => "Capriola",
			"Cardo" => "Cardo",
			"Carme" => "Carme",
			"Carrois Gothic" => "Carrois Gothic",
			"Carrois Gothic SC" => "Carrois Gothic SC",
			"Carter One" => "Carter One",
			"Caudex" => "Caudex",
			"Cedarville Cursive" => "Cedarville Cursive",
			"Ceviche One" => "Ceviche One",
			"Changa One" => "Changa One",
			"Chango" => "Chango",
			"Chau Philomene One" => "Chau Philomene One",
			"Chela One" => "Chela One",
			"Chelsea Market" => "Chelsea Market",
			"Chenla" => "Chenla",
			"Cherry Cream Soda" => "Cherry Cream Soda",
			"Cherry Swash" => "Cherry Swash",
			"Chewy" => "Chewy",
			"Chicle" => "Chicle",
			"Chivo" => "Chivo",
			"Cinzel" => "Cinzel",
			"Cinzel Decorative" => "Cinzel Decorative",
			"Clicker Script" => "Clicker Script",
			"Coda" => "Coda",
			"Coda Caption" => "Coda Caption",
			"Codystar" => "Codystar",
			"Combo" => "Combo",
			"Comfortaa" => "Comfortaa",
			"Coming Soon" => "Coming Soon",
			"Concert One" => "Concert One",
			"Condiment" => "Condiment",
			"Content" => "Content",
			"Contrail One" => "Contrail One",
			"Convergence" => "Convergence",
			"Cookie" => "Cookie",
			"Copse" => "Copse",
			"Corben" => "Corben",
			"Courgette" => "Courgette",
			"Cousine" => "Cousine",
			"Coustard" => "Coustard",
			"Covered By Your Grace" => "Covered By Your Grace",
			"Crafty Girls" => "Crafty Girls",
			"Creepster" => "Creepster",
			"Crete Round" => "Crete Round",
			"Crimson Text" => "Crimson Text",
			"Croissant One" => "Croissant One",
			"Crushed" => "Crushed",
			"Cuprum" => "Cuprum",
			"Cutive" => "Cutive",
			"Cutive Mono" => "Cutive Mono",
			"Damion" => "Damion",
			"Dancing Script" => "Dancing Script",
			"Dangrek" => "Dangrek",
			"Dawning of a New Day" => "Dawning of a New Day",
			"Days One" => "Days One",
			"Dekko" => "Dekko",
			"Delius" => "Delius",
			"Delius Swash Caps" => "Delius Swash Caps",
			"Delius Unicase" => "Delius Unicase",
			"Della Respira" => "Della Respira",
			"Denk One" => "Denk One",
			"Devonshire" => "Devonshire",
			"Dhurjati" => "Dhurjati",
			"Didact Gothic" => "Didact Gothic",
			"Diplomata" => "Diplomata",
			"Diplomata SC" => "Diplomata SC",
			"Domine" => "Domine",
			"Donegal One" => "Donegal One",
			"Doppio One" => "Doppio One",
			"Dorsa" => "Dorsa",
			"Dosis" => "Dosis",
			"Dr Sugiyama" => "Dr Sugiyama",
			"Droid Sans" => "Droid Sans",
			"Droid Sans Mono" => "Droid Sans Mono",
			"Droid Serif" => "Droid Serif",
			"Duru Sans" => "Duru Sans",
			"Dynalight" => "Dynalight",
			"EB Garamond" => "EB Garamond",
			"Eagle Lake" => "Eagle Lake",
			"Eater" => "Eater",
			"Economica" => "Economica",
			"Eczar" => "Eczar",
			"Ek Mukta" => "Ek Mukta",
			"Electrolize" => "Electrolize",
			"Elsie" => "Elsie",
			"Elsie Swash Caps" => "Elsie Swash Caps",
			"Emblema One" => "Emblema One",
			"Emilys Candy" => "Emilys Candy",
			"Engagement" => "Engagement",
			"Englebert" => "Englebert",
			"Enriqueta" => "Enriqueta",
			"Erica One" => "Erica One",
			"Esteban" => "Esteban",
			"Euphoria Script" => "Euphoria Script",
			"Ewert" => "Ewert",
			"Exo" => "Exo",
			"Exo 2" => "Exo 2",
			"Expletus Sans" => "Expletus Sans",
			"Fanwood Text" => "Fanwood Text",
			"Fascinate" => "Fascinate",
			"Fascinate Inline" => "Fascinate Inline",
			"Faster One" => "Faster One",
			"Fasthand" => "Fasthand",
			"Fauna One" => "Fauna One",
			"Federant" => "Federant",
			"Federo" => "Federo",
			"Felipa" => "Felipa",
			"Fenix" => "Fenix",
			"Finger Paint" => "Finger Paint",
			"Fira Mono" => "Fira Mono",
			"Fira Sans" => "Fira Sans",
			"Fjalla One" => "Fjalla One",
			"Fjord One" => "Fjord One",
			"Flamenco" => "Flamenco",
			"Flavors" => "Flavors",
			"Fondamento" => "Fondamento",
			"Fontdiner Swanky" => "Fontdiner Swanky",
			"Forum" => "Forum",
			"Francois One" => "Francois One",
			"Freckle Face" => "Freckle Face",
			"Fredericka the Great" => "Fredericka the Great",
			"Fredoka One" => "Fredoka One",
			"Freehand" => "Freehand",
			"Fresca" => "Fresca",
			"Frijole" => "Frijole",
			"Fruktur" => "Fruktur",
			"Fugaz One" => "Fugaz One",
			"GFS Didot" => "GFS Didot",
			"GFS Neohellenic" => "GFS Neohellenic",
			"Gabriela" => "Gabriela",
			"Gafata" => "Gafata",
			"Galdeano" => "Galdeano",
			"Galindo" => "Galindo",
			"Gentium Basic" => "Gentium Basic",
			"Gentium Book Basic" => "Gentium Book Basic",
			"Geo" => "Geo",
			"Geostar" => "Geostar",
			"Geostar Fill" => "Geostar Fill",
			"Germania One" => "Germania One",
			"Gidugu" => "Gidugu",
			"Gilda Display" => "Gilda Display",
			"Give You Glory" => "Give You Glory",
			"Glass Antiqua" => "Glass Antiqua",
			"Glegoo" => "Glegoo",
			"Gloria Hallelujah" => "Gloria Hallelujah",
			"Goblin One" => "Goblin One",
			"Gochi Hand" => "Gochi Hand",
			"Gorditas" => "Gorditas",
			"Goudy Bookletter 1911" => "Goudy Bookletter 1911",
			"Graduate" => "Graduate",
			"Grand Hotel" => "Grand Hotel",
			"Gravitas One" => "Gravitas One",
			"Great Vibes" => "Great Vibes",
			"Griffy" => "Griffy",
			"Gruppo" => "Gruppo",
			"Gudea" => "Gudea",
			"Gurajada" => "Gurajada",
			"Habibi" => "Habibi",
			"Halant" => "Halant",
			"Hammersmith One" => "Hammersmith One",
			"Hanalei" => "Hanalei",
			"Hanalei Fill" => "Hanalei Fill",
			"Handlee" => "Handlee",
			"Hanuman" => "Hanuman",
			"Happy Monkey" => "Happy Monkey",
			"Headland One" => "Headland One",
			"Henny Penny" => "Henny Penny",
			"Herr Von Muellerhoff" => "Herr Von Muellerhoff",
			"Hind" => "Hind",
			"Holtwood One SC" => "Holtwood One SC",
			"Homemade Apple" => "Homemade Apple",
			"Homenaje" => "Homenaje",
			"IM Fell DW Pica" => "IM Fell DW Pica",
			"IM Fell DW Pica SC" => "IM Fell DW Pica SC",
			"IM Fell Double Pica" => "IM Fell Double Pica",
			"IM Fell Double Pica SC" => "IM Fell Double Pica SC",
			"IM Fell English" => "IM Fell English",
			"IM Fell English SC" => "IM Fell English SC",
			"IM Fell French Canon" => "IM Fell French Canon",
			"IM Fell French Canon SC" => "IM Fell French Canon SC",
			"IM Fell Great Primer" => "IM Fell Great Primer",
			"IM Fell Great Primer SC" => "IM Fell Great Primer SC",
			"Iceberg" => "Iceberg",
			"Iceland" => "Iceland",
			"Imprima" => "Imprima",
			"Inconsolata" => "Inconsolata",
			"Inder" => "Inder",
			"Indie Flower" => "Indie Flower",
			"Inika" => "Inika",
			"Inknut Antiqua" => "Inknut Antiqua",
			"Irish Grover" => "Irish Grover",
			"Istok Web" => "Istok Web",
			"Italiana" => "Italiana",
			"Italianno" => "Italianno",
			"Jacques Francois" => "Jacques Francois",
			"Jacques Francois Shadow" => "Jacques Francois Shadow",
			"Jaldi" => "Jaldi",
			"Jim Nightshade" => "Jim Nightshade",
			"Jockey One" => "Jockey One",
			"Jolly Lodger" => "Jolly Lodger",
			"Josefin Sans" => "Josefin Sans",
			"Josefin Slab" => "Josefin Slab",
			"Joti One" => "Joti One",
			"Judson" => "Judson",
			"Julee" => "Julee",
			"Julius Sans One" => "Julius Sans One",
			"Junge" => "Junge",
			"Jura" => "Jura",
			"Just Another Hand" => "Just Another Hand",
			"Just Me Again Down Here" => "Just Me Again Down Here",
			"Kadwa" => "Kadwa",
			"Kalam" => "Kalam",
			"Kameron" => "Kameron",
			"Kantumruy" => "Kantumruy",
			"Karla" => "Karla",
			"Karma" => "Karma",
			"Kaushan Script" => "Kaushan Script",
			"Kavoon" => "Kavoon",
			"Kdam Thmor" => "Kdam Thmor",
			"Keania One" => "Keania One",
			"Kelly Slab" => "Kelly Slab",
			"Kenia" => "Kenia",
			"Khand" => "Khand",
			"Khmer" => "Khmer",
			"Khula" => "Khula",
			"Kite One" => "Kite One",
			"Knewave" => "Knewave",
			"Kotta One" => "Kotta One",
			"Koulen" => "Koulen",
			"Kranky" => "Kranky",
			"Kreon" => "Kreon",
			"Kristi" => "Kristi",
			"Krona One" => "Krona One",
			"Kurale" => "Kurale",
			"La Belle Aurore" => "La Belle Aurore",
			"Laila" => "Laila",
			"Lakki Reddy" => "Lakki Reddy",
			"Lancelot" => "Lancelot",
			"Lateef" => "Lateef",
			"Lato" => "Lato",
			"League Script" => "League Script",
			"Leckerli One" => "Leckerli One",
			"Ledger" => "Ledger",
			"Lekton" => "Lekton",
			"Lemon" => "Lemon",
			"Libre Baskerville" => "Libre Baskerville",
			"Life Savers" => "Life Savers",
			"Lilita One" => "Lilita One",
			"Lily Script One" => "Lily Script One",
			"Limelight" => "Limelight",
			"Linden Hill" => "Linden Hill",
			"Lobster" => "Lobster",
			"Lobster Two" => "Lobster Two",
			"Londrina Outline" => "Londrina Outline",
			"Londrina Shadow" => "Londrina Shadow",
			"Londrina Sketch" => "Londrina Sketch",
			"Londrina Solid" => "Londrina Solid",
			"Lora" => "Lora",
			"Love Ya Like A Sister" => "Love Ya Like A Sister",
			"Loved by the King" => "Loved by the King",
			"Lovers Quarrel" => "Lovers Quarrel",
			"Luckiest Guy" => "Luckiest Guy",
			"Lusitana" => "Lusitana",
			"Lustria" => "Lustria",
			"Macondo" => "Macondo",
			"Macondo Swash Caps" => "Macondo Swash Caps",
			"Magra" => "Magra",
			"Maiden Orange" => "Maiden Orange",
			"Mako" => "Mako",
			"Mallanna" => "Mallanna",
			"Mandali" => "Mandali",
			"Marcellus" => "Marcellus",
			"Marcellus SC" => "Marcellus SC",
			"Marck Script" => "Marck Script",
			"Margarine" => "Margarine",
			"Marko One" => "Marko One",
			"Marmelad" => "Marmelad",
			"Martel" => "Martel",
			"Martel Sans" => "Martel Sans",
			"Marvel" => "Marvel",
			"Mate" => "Mate",
			"Mate SC" => "Mate SC",
			"Maven Pro" => "Maven Pro",
			"McLaren" => "McLaren",
			"Meddon" => "Meddon",
			"MedievalSharp" => "MedievalSharp",
			"Medula One" => "Medula One",
			"Megrim" => "Megrim",
			"Meie Script" => "Meie Script",
			"Merienda" => "Merienda",
			"Merienda One" => "Merienda One",
			"Merriweather" => "Merriweather",
			"Merriweather Sans" => "Merriweather Sans",
			"Metal" => "Metal",
			"Metal Mania" => "Metal Mania",
			"Metamorphous" => "Metamorphous",
			"Metrophobic" => "Metrophobic",
			"Michroma" => "Michroma",
			"Milonga" => "Milonga",
			"Miltonian" => "Miltonian",
			"Miltonian Tattoo" => "Miltonian Tattoo",
			"Miniver" => "Miniver",
			"Miss Fajardose" => "Miss Fajardose",
			"Modak" => "Modak",
			"Modern Antiqua" => "Modern Antiqua",
			"Molengo" => "Molengo",
			"Molle" => "Molle",
			"Monda" => "Monda",
			"Monofett" => "Monofett",
			"Monoton" => "Monoton",
			"Monsieur La Doulaise" => "Monsieur La Doulaise",
			"Montaga" => "Montaga",
			"Montez" => "Montez",
			"Montserrat" => "Montserrat",
			"Montserrat Alternates" => "Montserrat Alternates",
			"Montserrat Subrayada" => "Montserrat Subrayada",
			"Moul" => "Moul",
			"Moulpali" => "Moulpali",
			"Mountains of Christmas" => "Mountains of Christmas",
			"Mouse Memoirs" => "Mouse Memoirs",
			"Mr Bedfort" => "Mr Bedfort",
			"Mr Dafoe" => "Mr Dafoe",
			"Mr De Haviland" => "Mr De Haviland",
			"Mrs Saint Delafield" => "Mrs Saint Delafield",
			"Mrs Sheppards" => "Mrs Sheppards",
			"Muli" => "Muli",
			"Mystery Quest" => "Mystery Quest",
			"NTR" => "NTR",
			"Neucha" => "Neucha",
			"Neuton" => "Neuton",
			"New Rocker" => "New Rocker",
			"News Cycle" => "News Cycle",
			"Niconne" => "Niconne",
			"Nixie One" => "Nixie One",
			"Nobile" => "Nobile",
			"Nokora" => "Nokora",
			"Norican" => "Norican",
			"Nosifer" => "Nosifer",
			"Nothing You Could Do" => "Nothing You Could Do",
			"Noticia Text" => "Noticia Text",
			"Noto Sans" => "Noto Sans",
			"Noto Serif" => "Noto Serif",
			"Nova Cut" => "Nova Cut",
			"Nova Flat" => "Nova Flat",
			"Nova Mono" => "Nova Mono",
			"Nova Oval" => "Nova Oval",
			"Nova Round" => "Nova Round",
			"Nova Script" => "Nova Script",
			"Nova Slim" => "Nova Slim",
			"Nova Square" => "Nova Square",
			"Numans" => "Numans",
			"Nunito" => "Nunito",
			"Odor Mean Chey" => "Odor Mean Chey",
			"Offside" => "Offside",
			"Old Standard TT" => "Old Standard TT",
			"Oldenburg" => "Oldenburg",
			"Oleo Script" => "Oleo Script",
			"Oleo Script Swash Caps" => "Oleo Script Swash Caps",
			"Open Sans" => "Open Sans",
			"Open Sans Condensed" => "Open Sans Condensed",
			"Oranienbaum" => "Oranienbaum",
			"Orbitron" => "Orbitron",
			"Oregano" => "Oregano",
			"Orienta" => "Orienta",
			"Original Surfer" => "Original Surfer",
			"Oswald" => "Oswald",
			"Over the Rainbow" => "Over the Rainbow",
			"Overlock" => "Overlock",
			"Overlock SC" => "Overlock SC",
			"Ovo" => "Ovo",
			"Oxygen" => "Oxygen",
			"Oxygen Mono" => "Oxygen Mono",
			"PT Mono" => "PT Mono",
			"PT Sans" => "PT Sans",
			"PT Sans Caption" => "PT Sans Caption",
			"PT Sans Narrow" => "PT Sans Narrow",
			"PT Serif" => "PT Serif",
			"PT Serif Caption" => "PT Serif Caption",
			"Pacifico" => "Pacifico",
			"Palanquin" => "Palanquin",
			"Palanquin Dark" => "Palanquin Dark",
			"Paprika" => "Paprika",
			"Parisienne" => "Parisienne",
			"Passero One" => "Passero One",
			"Passion One" => "Passion One",
			"Pathway Gothic One" => "Pathway Gothic One",
			"Patrick Hand" => "Patrick Hand",
			"Patrick Hand SC" => "Patrick Hand SC",
			"Patua One" => "Patua One",
			"Paytone One" => "Paytone One",
			"Peddana" => "Peddana",
			"Peralta" => "Peralta",
			"Permanent Marker" => "Permanent Marker",
			"Petit Formal Script" => "Petit Formal Script",
			"Petrona" => "Petrona",
			"Philosopher" => "Philosopher",
			"Piedra" => "Piedra",
			"Pinyon Script" => "Pinyon Script",
			"Pirata One" => "Pirata One",
			"Plaster" => "Plaster",
			"Play" => "Play",
			"Playball" => "Playball",
			"Playfair Display" => "Playfair Display",
			"Playfair Display SC" => "Playfair Display SC",
			"Podkova" => "Podkova",
			"Poiret One" => "Poiret One",
			"Poller One" => "Poller One",
			"Poly" => "Poly",
			"Pompiere" => "Pompiere",
			"Pontano Sans" => "Pontano Sans",
			"Poppins" => "Poppins",
			"Port Lligat Sans" => "Port Lligat Sans",
			"Port Lligat Slab" => "Port Lligat Slab",
			"Pragati Narrow" => "Pragati Narrow",
			"Prata" => "Prata",
			"Preahvihear" => "Preahvihear",
			"Press Start 2P" => "Press Start 2P",
			"Princess Sofia" => "Princess Sofia",
			"Prociono" => "Prociono",
			"Prosto One" => "Prosto One",
			"Puritan" => "Puritan",
			"Purple Purse" => "Purple Purse",
			"Quando" => "Quando",
			"Quantico" => "Quantico",
			"Quattrocento" => "Quattrocento",
			"Quattrocento Sans" => "Quattrocento Sans",
			"Questrial" => "Questrial",
			"Quicksand" => "Quicksand",
			"Quintessential" => "Quintessential",
			"Qwigley" => "Qwigley",
			"Racing Sans One" => "Racing Sans One",
			"Radley" => "Radley",
			"Rajdhani" => "Rajdhani",
			"Raleway" => "Raleway",
			"Raleway Dots" => "Raleway Dots",
			"Ramabhadra" => "Ramabhadra",
			"Ramaraja" => "Ramaraja",
			"Rambla" => "Rambla",
			"Rammetto One" => "Rammetto One",
			"Ranchers" => "Ranchers",
			"Rancho" => "Rancho",
			"Ranga" => "Ranga",
			"Rationale" => "Rationale",
			"Ravi Prakash" => "Ravi Prakash",
			"Redressed" => "Redressed",
			"Reenie Beanie" => "Reenie Beanie",
			"Revalia" => "Revalia",
			"Rhodium Libre" => "Rhodium Libre",
			"Ribeye" => "Ribeye",
			"Ribeye Marrow" => "Ribeye Marrow",
			"Righteous" => "Righteous",
			"Risque" => "Risque",
			"Roboto" => "Roboto",
			"Roboto Condensed" => "Roboto Condensed",
			"Roboto Mono" => "Roboto Mono",
			"Roboto Slab" => "Roboto Slab",
			"Rochester" => "Rochester",
			"Rock Salt" => "Rock Salt",
			"Rokkitt" => "Rokkitt",
			"Romanesco" => "Romanesco",
			"Ropa Sans" => "Ropa Sans",
			"Rosario" => "Rosario",
			"Rosarivo" => "Rosarivo",
			"Rouge Script" => "Rouge Script",
			"Rozha One" => "Rozha One",
			"Rubik Mono One" => "Rubik Mono One",
			"Rubik One" => "Rubik One",
			"Ruda" => "Ruda",
			"Rufina" => "Rufina",
			"Ruge Boogie" => "Ruge Boogie",
			"Ruluko" => "Ruluko",
			"Rum Raisin" => "Rum Raisin",
			"Ruslan Display" => "Ruslan Display",
			"Russo One" => "Russo One",
			"Ruthie" => "Ruthie",
			"Rye" => "Rye",
			"Sacramento" => "Sacramento",
			"Sahitya" => "Sahitya",
			"Sail" => "Sail",
			"Salsa" => "Salsa",
			"Sanchez" => "Sanchez",
			"Sancreek" => "Sancreek",
			"Sansita One" => "Sansita One",
			"Sarala" => "Sarala",
			"Sarina" => "Sarina",
			"Sarpanch" => "Sarpanch",
			"Satisfy" => "Satisfy",
			"Scada" => "Scada",
			"Scheherazade" => "Scheherazade",
			"Schoolbell" => "Schoolbell",
			"Seaweed Script" => "Seaweed Script",
			"Sevillana" => "Sevillana",
			"Seymour One" => "Seymour One",
			"Shadows Into Light" => "Shadows Into Light",
			"Shadows Into Light Two" => "Shadows Into Light Two",
			"Shanti" => "Shanti",
			"Share" => "Share",
			"Share Tech" => "Share Tech",
			"Share Tech Mono" => "Share Tech Mono",
			"Shojumaru" => "Shojumaru",
			"Short Stack" => "Short Stack",
			"Siemreap" => "Siemreap",
			"Sigmar One" => "Sigmar One",
			"Signika" => "Signika",
			"Signika Negative" => "Signika Negative",
			"Simonetta" => "Simonetta",
			"Sintony" => "Sintony",
			"Sirin Stencil" => "Sirin Stencil",
			"Six Caps" => "Six Caps",
			"Skranji" => "Skranji",
			"Slabo 13px" => "Slabo 13px",
			"Slabo 27px" => "Slabo 27px",
			"Slackey" => "Slackey",
			"Smokum" => "Smokum",
			"Smythe" => "Smythe",
			"Sniglet" => "Sniglet",
			"Snippet" => "Snippet",
			"Snowburst One" => "Snowburst One",
			"Sofadi One" => "Sofadi One",
			"Sofia" => "Sofia",
			"Sonsie One" => "Sonsie One",
			"Sorts Mill Goudy" => "Sorts Mill Goudy",
			"Source Code Pro" => "Source Code Pro",
			"Source Sans Pro" => "Source Sans Pro",
			"Source Serif Pro" => "Source Serif Pro",
			"Special Elite" => "Special Elite",
			"Spicy Rice" => "Spicy Rice",
			"Spinnaker" => "Spinnaker",
			"Spirax" => "Spirax",
			"Squada One" => "Squada One",
			"Sree Krushnadevaraya" => "Sree Krushnadevaraya",
			"Stalemate" => "Stalemate",
			"Stalinist One" => "Stalinist One",
			"Stardos Stencil" => "Stardos Stencil",
			"Stint Ultra Condensed" => "Stint Ultra Condensed",
			"Stint Ultra Expanded" => "Stint Ultra Expanded",
			"Stoke" => "Stoke",
			"Strait" => "Strait",
			"Sue Ellen Francisco" => "Sue Ellen Francisco",
			"Sumana" => "Sumana",
			"Sunshiney" => "Sunshiney",
			"Supermercado One" => "Supermercado One",
			"Sura" => "Sura",
			"Suranna" => "Suranna",
			"Suravaram" => "Suravaram",
			"Suwannaphum" => "Suwannaphum",
			"Swanky and Moo Moo" => "Swanky and Moo Moo",
			"Syncopate" => "Syncopate",
			"Tangerine" => "Tangerine",
			"Taprom" => "Taprom",
			"Tauri" => "Tauri",
			"Teko" => "Teko",
			"Telex" => "Telex",
			"Tenali Ramakrishna" => "Tenali Ramakrishna",
			"Tenor Sans" => "Tenor Sans",
			"Text Me One" => "Text Me One",
			"The Girl Next Door" => "The Girl Next Door",
			"Tienne" => "Tienne",
			"Tillana" => "Tillana",
			"Timmana" => "Timmana",
			"Tinos" => "Tinos",
			"Titan One" => "Titan One",
			"Titillium Web" => "Titillium Web",
			"Trade Winds" => "Trade Winds",
			"Trocchi" => "Trocchi",
			"Trochut" => "Trochut",
			"Trykker" => "Trykker",
			"Tulpen One" => "Tulpen One",
			"Ubuntu" => "Ubuntu",
			"Ubuntu Condensed" => "Ubuntu Condensed",
			"Ubuntu Mono" => "Ubuntu Mono",
			"Ultra" => "Ultra",
			"Uncial Antiqua" => "Uncial Antiqua",
			"Underdog" => "Underdog",
			"Unica One" => "Unica One",
			"UnifrakturCook" => "UnifrakturCook",
			"UnifrakturMaguntia" => "UnifrakturMaguntia",
			"Unkempt" => "Unkempt",
			"Unlock" => "Unlock",
			"Unna" => "Unna",
			"VT323" => "VT323",
			"Vampiro One" => "Vampiro One",
			"Varela" => "Varela",
			"Varela Round" => "Varela Round",
			"Vast Shadow" => "Vast Shadow",
			"Vesper Libre" => "Vesper Libre",
			"Vibur" => "Vibur",
			"Vidaloka" => "Vidaloka",
			"Viga" => "Viga",
			"Voces" => "Voces",
			"Volkhov" => "Volkhov",
			"Vollkorn" => "Vollkorn",
			"Voltaire" => "Voltaire",
			"Waiting for the Sunrise" => "Waiting for the Sunrise",
			"Wallpoet" => "Wallpoet",
			"Walter Turncoat" => "Walter Turncoat",
			"Warnes" => "Warnes",
			"Wellfleet" => "Wellfleet",
			"Wendy One" => "Wendy One",
			"Wire One" => "Wire One",
			"Yanone Kaffeesatz" => "Yanone Kaffeesatz",
			"Yantramanav" => "Yantramanav",
			"Yellowtail" => "Yellowtail",
			"Yeseva One" => "Yeseva One",
			"Yesteryear" => "Yesteryear",
			"Zeyada" => "Zeyada"
		  );

		$standard_fonts = array(
			'0' => 'Select Font',
			'Arial, Helvetica, sans-serif' => 'Arial, Helvetica, sans-serif',
			"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
			"'Bookman Old Style', serif" => "'Bookman Old Style', serif",
			"'Comic Sans MS', cursive" => "'Comic Sans MS', cursive",
			"Courier, monospace" => "Courier, monospace",
			"Garamond, serif" => "Garamond, serif",
			"Georgia, serif" => "Georgia, serif",
			"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
			"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace",
			"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
			"'MS Sans Serif', Geneva, sans-serif" => "'MS Sans Serif', Geneva, sans-serif",
			"'MS Serif', 'New York', sans-serif" => "'MS Serif', 'New York', sans-serif",
			"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
			"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
			"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
			"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
			"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif"
		);

		$font_weights = array(
			"100"	=> "Thin (100)",
			"200"	=> "Extra Light (200)",
			"300"	=> "Light (300)",
			"400"	=> "Normal (400)",
			"500"	=> "Medium (500)",
			"600"	=> "Semi Bold (600)",
			"700"	=> "Bold (700)",
			"800"	=> "Bolder (800)",
			"900"	=> "Extra Bold (900)",
		);

		/*-----------------------------------------------------------------------------------*/
		/* The Options Array */
		/*-----------------------------------------------------------------------------------*/

		// Set the Options Array
		$of_options = array();

		$of_options[] = array( "name" => __("General", "Aione"),
			"id" => "heading_general",
			"type" => "heading");

		$of_options[] = array( "name" => __("Code", "Aione"),
			"desc" => "",
			"id" => "code",
			"std" => "<h3 style='margin: 0;'>" . __("Tracking / Space Before Head / Space Before Body Code", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Tracking Code", "Aione"),
			"desc" => __("Paste your Google Analytics (or other) tracking code here. This will be added into the header template of your theme. Please place code inside &lt;script&gt; tags.", "Aione"),
			"id" => "google_analytics",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Space before &lt;/head&gt;", "Aione"),
			"desc" => __("Add code before the &lt;/head&gt; tag. Only accepts javascript code wrapped with &lt;script&gt; tags and HTML markup that is valid inside the &lt;head&gt; tag. ", "Aione"),
			"id" => "space_head",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Space before &lt;/body&gt;", "Aione"),
			"desc" => __("Add code before the &lt;/body&gt; tag. Only accepts javascript code, wrapped with &lt;script&gt; tags and valid HTML markup.", "Aione"),
			"id" => "space_body",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Responsive", "Aione"),
			"id" => "heading_responsive",
			"type" => "heading");

		$of_options[] = array( "name" => __("Responsive Design", "Aione"),
			"desc" => __("Enable to use the responsive design features. If disabled then the fixed layout is used.", "Aione"),
			"id" => "responsive",
			"std" => 1,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Header Responsive Breakpoint", "Aione"),
			"desc" => __("Controls when the desktop header changes to the mobile header. In pixels, ex: 800px.", "Aione"),
			"id" => "side_header_break_point",
			"std" => "800px",
			"type" => "text");

		$of_options[] = array( "name" => __("Site Content Responsive Breakpoint", "Aione"),
			"desc" => __("Controls when the site content area changes to the mobile layout. This includes all content on the page except for the header area and blog/portfolio grid sections. If you are using a side header, the breakpoint value you enter will automatically include the side header width.  In pixels, ex: 800px.", "Aione"),
			"id" => "content_break_point",
			"std" => "800px",
			"type" => "text");


		$of_options[] = array( "name" => __("Grid Responsive Breakpoint", "Aione"),
			"desc" => __("Controls when blog/portfolio grid layouts start to break into smaller amounts of columns. Further breakpoints are auto calculated. In pixels, ex: 1000px.", "Aione"),
			"id" => "grid_main_break_point",
			"std" => "1099px",
			"type" => "text");

		$of_options[] = array( 	"name" 		=> __("Responsive Heading Typography", "Aione"),
			"desc" 		=> __("Check this box if you want site headings to change font size responsively.", "Aione"),
			"id" 		=> "typography_responsive",
			"std" 		=> 0,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Responsive Typography Sensitivity", "Aione"),
			"desc" => __("Values below 1 decrease resizing, values above 1 increase sizing. ex: .6", "Aione"),
			"id" => "typography_sensitivity",
			"std" => "0.6",
			"type" => "text");

		$of_options[] = array( "name" => __("Mininum Font Size Factor", "Aione"),
			"desc" => __("Minimum font factor is used to determine minimum distance between headings and body type by a multiplying value. ex: 1.5", "Aione"),
			"id" => "typography_factor",
			"std" => "1.5",
			"type" => "text");

		$of_options[] = array( "name" => __("Enable Zoom on mobile devices", "Aione"),
			"desc" => __("Enable to allow pinch to zoom on mobile devices.", "Aione"),
			"id" => "mobile_zoom",
			"std" => 1,
			"on" 		=> "Enable",
			"off" 		=> "Disable",
			"type" 		=> "switch"
		);

		$of_options[] = array( "name" => __("Site Width", "Aione"),
			"id" => "heading_site_width",
			"type" => "heading");

		$of_options[] = array( "name" => __("Layout", "Aione"),
			"desc" => __("Select boxed or wide layout.", "Aione"),
			"id" => "layout",
			"std" => "Wide",
			"type" => "select",
			"options" => array(
				'Boxed' => __('Boxed', 'Aione'),
				'Wide' => __('Wide', 'Aione'),
			));

		$of_options[] = array( "name" => __("Site Width", "Aione"),
			"desc" => __("Controls the overall site width. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "site_width",
			"std" => "1100px",
			"type" => "text");

	   $of_options[] = array( "name" => __("Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "content_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 1 sidebar.", "Aione") . "</p>",
			"type" => "info");

		$of_options[] = array( "name" => __("Sidebar Width", "Aione"),
			"desc" => __("Controls the width of the sidebar. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "sidebar_width",
			"std" => "23%",
			"type" => "text");

	   $of_options[] = array( "name" => __("Sidebar + Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "content_sidebar_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Sidebar + Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 2 sidebars.", "Aione") . "</p>",
			"type" => "info");

		$of_options[] = array( "name" => __("Sidebar 1 Width", "Aione"),
			"desc" => __("Controls the width of the sidebar 1. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "sidebar_2_1_width",
			"std" => "21%",
			"type" => "text");

		$of_options[] = array( "name" => __("Sidebar 2 Width", "Aione"),
			"desc" => __("Controls the width of the sidebar 2. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "sidebar_2_2_width",
			"std" => "21%",
			"type" => "text");

		$of_options[] = array( "name" => __("Header", "Aione"),
			"id" => "heading_header",
			"type" => "heading");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_1",
			"std" => "<h3 style='margin: 0;'>" . __("Header Content Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Header Position", "Aione"),
			"desc" => __("Select the position of header. Left/Right position will not display the header content options 1-3 on mobile devices, only on desktop.", "Aione"),
			"id" => "header_position",
			"std" => "Top",
			"type" => "select",
			"options" => array('Top' => __('Top', 'Aione'), 'Left' => __('Left', 'Aione'), 'Right' => __('Right', 'Aione')));

		$of_options[] = array( "name" => __("Select a Header Layout", "Aione"),
			"desc" => "",
			"id" => "header_layout",
			"std" => "v1",
			"type" => "images",
			"options" => array(
				"v1" => get_template_directory_uri()."/assets/images/patterns/header1.jpg",
				"v2" => get_template_directory_uri()."/assets/images/patterns/header2.jpg",
				"v3" => get_template_directory_uri()."/assets/images/patterns/header3.jpg",
				"v4" => get_template_directory_uri()."/assets/images/patterns/header4.jpg",
				"v5" => get_template_directory_uri()."/assets/images/patterns/header5.jpg"
			));

		$of_options[] = array( "name" => __("Header Width For Left/Right Position", "Aione"),
			"desc" => __("Controls width of the left or right side header. In pixels, ex: 170px.", "Aione"),
			"id" => "side_header_width",
			"std" => "280px",
			"type" => "text");

		$of_options[] = array( "name" => __("Header Shadow", "Aione"),
			"desc" => __("Check this box to show a header drop shadow. This option is incompatible with Internet Explorer versions older than IE11.", "Aione"),
			"id" => "header_shadow",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("100% Header Width", "Aione"),
			"desc" => __("Check this box to set the header to 100% of the browser width. Uncheck to follow site width. Only works with wide layout mode.", "Aione"),
			"id" => "header_100_width",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Slider Position", "Aione"),
			"desc" => __("Select if the slider shows below or above the header.", "Aione"),
			"id" => "slider_position",
			"std" => "Below",
			"type" => "select",
			"options" => array('Below' => 'Below', 'Above' => 'Above'));

		$of_options[] = array( "name" => __("Header Content 1", "Aione"),
			"desc" => __("Select which content displays in the first content area.", "Aione"),
			"id" => "header_left_content",
			"std" => "Contact Info",
			"type" => "select",
			"options" => array('Contact Info' => 'Contact Info', 'Social Links' => 'Social Links', 'Navigation' => 'Navigation', 'Leave Empty' => 'Leave Empty'));

		$of_options[] = array( "name" => __("Header Content 2", "Aione"),
			"desc" => __("Select which content displays in the second content area.", "Aione"),
			"id" => "header_right_content",
			"std" => "Navigation",
			"type" => "select",
			 "options" => array('Contact Info' => 'Contact Info', 'Social Links' => 'Social Links', 'Navigation' => 'Navigation', 'Leave Empty' => 'Leave Empty'));

		$of_options[] = array( "name" => __("Header Content 3", "Aione"),
			"desc" => __("Select which content displays in the third content area.", "Aione"),
			"id" => "header_v4_content",
			"std" => "Tagline And Search",
			"type" => "select",
			"options" => array('Tagline' => 'Tagline', 'Search' => 'Search', 'Tagline And Search' => 'Tagline And Search', 'Banner' => 'Banner', 'None' => 'Leave Empty'));

		$of_options[] = array( "name" => __("Phone Number For Contact Info", "Aione"),
			"desc" => __("Phone number will display in the Contact Info section of your top header.", "Aione"),
			"id" => "header_number",
			"std" => "Call Us Today! 1.555.555.555",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Email Address For Contact Info", "Aione"),
			"desc" => __("Email address will display in the Contact Info section of your top header.", "Aione"),
			"id" => "header_email",
			"std" => "info@yourdomain.com",
			"type" => "text");

		$of_options[] = array( "name" => __("Banner Code For Content 3", "Aione"),
			"desc" => __("Add HTML banner code for Header Content 3. Simple shortcodes, like buttons, can be used here too. The contents or image will display as long as you have Banner selected for the Header Content 3 option above.", "Aione"),
			"id" => "header_banner_code",
			"std" => '',
			"type" => "textarea");

		$of_options[] = array( "name" => __("Tagline For Content 3", "Aione"),
			"desc" => __("Tagline will display as long as you have Tagline selected for the Header Content 3 option above.", "Aione"),
			"id" => "header_tagline",
			"std" => "Insert Tagline Here",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_1",
			"std" => "<h3 style='margin: 0;'>" . __("Header Content Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_2",
			"std" => "<h3 style='margin: 0;'>" . __("Header Background", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Background Image For Header Area", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the header background.", "Aione"),
			"id" => "header_bg_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("100% Background Image", "Aione"),
			"desc" => __("Check this box to have the header background image display at 100% in width and height and scale according to the browser size.", "Aione"),
			"id" => "header_bg_full",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Parallax Background Image", "Aione"),
			"desc" => __("Check this box to enable parallax scrolling on the background image for header top positions.", "Aione"),
			"id" => "header_bg_parallax",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Background Repeat", "Aione"),
			"desc" => __("Select how the background image repeats.", "Aione"),
			"id" => "header_bg_repeat",
			"std" => "",
			"type" => "select",
			"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		// this is for padding, the id is wrong but there for legacy users
		$of_options[] = array( "name" => __("Header Top Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "margin_header_top",
			"std" => "0px",
			"type" => "text");

		// this is for padding, the id is wrong but there for legacy users
		$of_options[] = array( "name" => __("Header Bottom Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "margin_header_bottom",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Header Left Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "padding_header_left",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Header Right Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "padding_header_right",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_2",
			"std" => "<h3 style='margin: 0;'>" . __("Header Background", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_3",
			"std" => "<h3 style='margin: 0;'>" . __("Header Social Icons", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( 	"name" => __("Header Social Icons Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 16", "Aione"),
						"id" 		=> "header_social_links_font_size",
						"std" 		=> "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Header Social Icons Custom Color", "Aione"),
			"desc" => __("Select a custom social icon color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "header_social_links_icon_color",
			"std" => "#bebdbd",
			"type" => "color");

		$of_options[] = array( "name" => __("Header Social Icons Boxed", "Aione"),
			"desc" => __("Controls whether each icon is displayed in a small box.", "Aione"),
			"id" => "header_social_links_boxed",
			"std" => "No",
			"type" => "select",
			"options" => array('No' => 'No', 'Yes' => 'Yes'));

		$of_options[] = array( "name" => __("Header Social Icons Custom Box Color", "Aione"),
			"desc" => __("Select a custom social icon box color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "header_social_links_box_color",
			"std" => "#e8e8e8",
			"type" => "color");

		$of_options[] = array( "name" => __("Header Social Icons Boxed Radius", "Aione"),
			"desc" => __("Box radius for the social icons. In pixels, ex: 4px.", "Aione"),
			"id" => "header_social_links_boxed_radius",
			"std" => "4px",
			"type" => "text");

		$of_options[] = array( 	"name" => __("Header Social Icons Boxed Padding", "Aione"),
						"desc" 		=> __("In pixels, default is 8", "Aione"),
						"id" 		=> "header_social_links_boxed_padding",
						"std" 		=> "8",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Header Social Icons Tooltip Position", "Aione"),
			"desc" => __("Controls the tooltip position of the social icons in the header.", "Aione"),
			"id" => "header_social_links_tooltip_placement",
			"std" => "Bottom",
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info_3",
			"std" => "<h3 style='margin: 0;'>" . __("Header Social Icons", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Sticky Header", "Aione"),
			"id" => "heading_sticky_header",
			"type" => "heading");

		$of_options[] = array( "name" => __("Sticky Header Info", "Aione"),
			"desc" => "",
			"id" => "sticky_header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Sticky Header Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Enable Sticky Header", "Aione"),
			"desc" => __("Check to enable a fixed header when scrolling, uncheck to disable.", "Aione"),
			"id" => "header_sticky",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Sticky Header on Tablets", "Aione"),
			"desc" => __("Check to enable a fixed header when scrolling on tablets, uncheck to disable.", "Aione"),
			"id" => "header_sticky_tablet",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Sticky Header on Mobiles", "Aione"),
			"desc" => __("Check to enable a fixed header when scrolling on mobiles, uncheck to disable.", "Aione"),
			"id" => "header_sticky_mobile",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Sticky Header Animation", "Aione"),
			"desc" => __("Enable the sticky header to animate to a smaller height. This will shrink the sticky header height, logo and menu. Only applies to header v1 - v3.", "Aione"),
			"id" => "header_sticky_shrinkage",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Headers 4-5 Sticky Header Display", "Aione"),
			"desc" => __("Select if your sticky header shows the menu or menu + logo area.", "Aione"),
			"id" => "header_sticky_type2_layout",
			"std" => "Menu Only",
			"type" => "select",
			"options" => array( 'menu_only' => 'Menu Only', 'menu_and_logo' => 'Menu + Logo Area' ));

		$of_options[] = array( "name" => __("Sticky Header Menu Item Padding", "Aione"),
			"desc" => __("Controls the space between each menu item in the sticky header. Use a number without 'px', default is 35. ex: 35", "Aione"),
			"id" => "header_sticky_nav_padding",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Sticky Header Navigation Font Size", "Aione"),
			"desc" => __("Controls the font size of the menu items in the sticky header. Use a number without 'px', default is 14. ex: 14", "Aione"),
			"id" => "header_sticky_nav_font_size",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Logo", "Aione"),
			"id" => "heading_logo",
			"type" => "heading");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Default Logo", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Default Logo", "Aione"),
			"desc" => __("Select an image file for your logo.", "Aione"),
			"id" => "logo",
			"std" => get_template_directory_uri()."/assets/images/logo.png",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Default Logo (Retina Version @2x)", "Aione"),
			"desc" => __("Select an image file for the retina version of the logo. It should be exactly 2x the size of main logo.", "Aione"),
			"id" => "logo_retina",
			"std" => "",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Default Logo Width", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. Use a number without 'px', ex: 40", "Aione"),
			"id" => "retina_logo_width",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Default Logo Height", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. Use a number without 'px', ex: 40", "Aione"),
			"id" => "retina_logo_height",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Sticky Header Logo", "Aione"),
			"desc" => "",
			"id" => "sticky_logo_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Sticky Header Logo", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Sticky Header Logo", "Aione"),
			"desc" => __("Select an image file for your sticky header logo.", "Aione"),
			"id" => "sticky_header_logo",
			"std" => "",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Sticky Header Logo (Retina Version @2x)", "Aione"),
			"desc" => __("Select an image file for the retina version of the sticky header logo. It should be exactly 2x the size of sticky header main logo.", "Aione"),
			"id" => "sticky_header_logo_retina",
			"std" => "",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Sticky Header Logo Width", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the sticky header logo (1x) version width, do not enter the retina logo width. Use a number without 'px', ex: 40", "Aione"),
			"id" => "sticky_retina_logo_width",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Sticky Header Logo Height", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the sticky header logo (1x) version height, do not enter the retina logo height. Use a number without 'px', ex: 40 ", "Aione"),
			"id" => "sticky_retina_logo_height",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Sticky Header Logo", "Aione"),
			"desc" => "",
			"id" => "sticky_logo_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Sticky Header Logo", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");


		$of_options[] = array( "name" => __("Mobile Logo", "Aione"),
			"desc" => "",
			"id" => "mobile_logo_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Logo", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Mobile Logo", "Aione"),
			"desc" => __("Select an image file for your mobile logo.", "Aione"),
			"id" => "mobile_logo",
			"std" => "",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Mobile Logo (Retina Version @2x)", "Aione"),
			"desc" => __("Select an image file for the retina version of the mobile logo. It should be exactly 2x the size of Mobile main logo.", "Aione"),
			"id" => "mobile_logo_retina",
			"std" => "",
			"mod" => "min",
			"type" => "media");

		$of_options[] = array( "name" => __("Mobile Logo Width", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the mobile logo (1x) version width, do not enter the retina logo width. Use a number without 'px', ex: 40", "Aione"),
			"id" => "mobile_retina_logo_width",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Mobile Logo Height", "Aione"),
			"desc" => __("If retina logo is uploaded, enter the mobile logo (1x) version height, do not enter the retina logo height. Use a number without 'px', ex: 40", "Aione"),
			"id" => "mobile_retina_logo_height",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Mobile Logo", "Aione"),
			"desc" => "",
			"id" => "mobile_logo_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Logo", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Logo Settings", "Aione"),
			"desc" => "",
			"id" => "logo_settings_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Logo Settings", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Logo Alignment", "Aione"),
			"desc" => __("'Center' only works on Top Header 5 and on Side Headers.", "Aione"),
			"id" => "logo_alignment",
			"std" => "Left",
			"type" => "select",
			"options" => array('Left' => 'Left', 'Center' => 'Center', 'Right' => 'Right',));

		$of_options[] = array( "name" => __("Logo Left Margin", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "margin_logo_left",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Logo Right Margin", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "margin_logo_right",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Logo Top Margin", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "margin_logo_top",
			"std" => "31px",
			"type" => "text");

		$of_options[] = array( "name" => __("Logo Bottom Margin", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "margin_logo_bottom",
			"std" => "31px",
			"type" => "text");

		$of_options[] = array( "name" => __("Logo Settings", "Aione"),
			"desc" => "",
			"id" => "logo_settings_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Logo Settings", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Favicon Options", "Aione"),
			"desc" => "",
			"id" => "favicons",
			"std" => "<h3 style='margin: 0;'>" . __("Favicon Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Favicon", "Aione"),
			"desc" => __("Favicon for your website (16px x 16px).", "Aione"),
			"id" => "favicon",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Apple iPhone Icon Upload", "Aione"),
			"desc" => __("Favicon for Apple iPhone (57px x 57px).", "Aione"),
			"id" => "iphone_icon",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Apple iPhone Retina Icon Upload", "Aione"),
			"desc" => __("Favicon for Apple iPhone Retina Version (114px x 114px).", "Aione"),
			"id" => "iphone_icon_retina",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Apple iPad Icon Upload", "Aione"),
			"desc" => __("Favicon for Apple iPad (72px x 72px).", "Aione"),
			"id" => "ipad_icon",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Apple iPad Retina Icon Upload", "Aione"),
			"desc" => __("Favicon for Apple iPad Retina Version (144px x 144px).", "Aione"),
			"id" => "ipad_icon_retina",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Favicon Options", "Aione"),
			"desc" => "",
			"id" => "favicons",
			"std" => "<h3 style='margin: 0;'>" . __("Favicon Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Menu", "Aione"),
			"id" => "heading_menu",
			"type" => "heading");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Menu Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Menu Text Align", "Aione"),
			"desc" => __("Controls the alignment of the text in the menu for top headers 4-5 and side headers", "Aione"),
			"id" => "menu_text_align",
			"std" => "center",
			"options" => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
			"type" => "select");

		$of_options[] = array( "name" => __("Main Nav Height", "Aione"),
			"desc" => __("Controls menu height. Use a number without 'px', default is 83. ex: 83", "Aione"),
			"id" => "nav_height",
			"std" => "83",
			"type" => "text");

		$of_options[] = array( "name" => __("Main Menu Highlight Bar Size", "Aione"),
			"desc" => __("Controls the border size of the menu highlight bar. Use a number without 'px', default is 3, enter 0 to hide it. ex: 3.", "Aione"),
			"id" => "nav_highlight_border",
			"std" => "3",
			"type" => "text");

		$of_options[] = array( "name" => __("Main Menu Item Padding", "Aione"),
			"desc" => __("Controls right (left on RTL) menu padding. Use a number without 'px', default is 45. ex: 45", "Aione"),
			"id" => "nav_padding",
			"std" => "45",
			"type" => "text");

		$of_options[] = array( "name" => __("Main Menu Dropdown Width", "Aione"),
			"desc" => __("In pixels, ex: 170px", "Aione"),
			"id" => "dropdown_menu_width",
			"std" => "180px",
			"type" => "text");

		$of_options[] = array( "name" => __("Main Menu Dropdown Item Top/Bottom Padding", "Aione"),
			"desc" => __("In pixels, ex: 7px", "Aione"),
			"id" => "mainmenu_dropdown_vertical_padding",
			"std" => "7px",
			"type" => "text");

		$of_options[] = array( "name" => __("Main Menu Dropdown Item Divider", "Aione"),
			"desc" => __("Check to display a divider on the menu dropdown items.", "Aione"),
			"id" => "mainmenu_dropdown_display_divider",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Top Menu Dropdown Width", "Aione"),
			"desc" => __("In pixels, ex: 100px", "Aione"),
			"id" => "topmenu_dropwdown_width",
			"std" => "180px",
			"type" => "text");

		$of_options[] = array( "name" => __("Mega Menu Max-Width", "Aione"),
			"desc" => __('Controls the the max width of the mega menu. In pixels, ex: 1100px.', 'Aione'),
			"id" => "megamenu_max_width",
			"std" => "1100px",
			"type" => "text");

		$of_options[] = array( "name" => __("Mega Menu Column Title Size", "Aione"),
			"desc" => __("Set the font size for mega menu column titles (menu 2nd level labels). In pixels, ex: 18px", "Aione"),
			"id" => "megamenu_title_size",
			"std" => "18px",
			"type" => "text");

		$of_options[] = array( "name" => __("Mega Menu Item Top/Bottom Padding", "Aione"),
			"desc" => __("In pixels, ex: 5px", "Aione"),
			"id" => "megamenu_item_vertical_padding",
			"std" => "5px",
			"type" => "text");

		$of_options[] = array( "name" => __("Mega Menu Item Divider", "Aione"),
			"desc" => __("Check to display a divider on the mega menu submenu items.", "Aione"),
			"id" => "megamenu_item_display_divider",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Dropdown Menu Indicator", "Aione"),
			"desc" => __("Check the box to enable arrow indicators next to parent level menu items.", "Aione"),
			"id" => "menu_display_dropdown_indicator",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Menu Drop Shadow", "Aione"),
			"desc" => __("Check to enable the dropshadow for menu dropdowns, uncheck to disable.", "Aione"),
			"id" => "megamenu_shadow",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Display Search Icon in Main Nav", "Aione"),
			"desc" => __("Check to display the search icon in the main menu.", "Aione"),
			"id" => "main_nav_search_icon",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Circle Border On Menu Icons", "Aione"),
			"desc" => __("Check to enable a circle border on the main menu cart and search icons.", "Aione"),
			"id" => "main_nav_icon_circle",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Menu Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "mobile_menu_options",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Menu Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Mobile Menu Design Style", "Aione"),
			"desc" => __("Select between classic or modern mobile design.", "Aione"),
			"id" => "mobile_menu_design",
			"std" => "modern",
			"options" => array('classic' => 'Classic', 'modern' => 'Modern'),
			"type" => "select");

		$of_options[] = array( "name" => __("Mobile Menu Item Padding", "Aione"),
			"desc" => __("Controls right (left on RTL) menu padding on mobile devices when the normal menu is used. Use a number without 'px', default is 25. ex: 25", "Aione"),
			"id" => "mobile_nav_padding",
			"std" => "25",
			"type" => "text");

		$of_options[] = array( "name" => __("Mobile Menu Text Align", "Aione"),
			"desc" => __("Controls the alignment of menu text on mobile menu.", "Aione"),
			"id" => "mobile_menu_text_align",
			"std" => "left",
			"options" => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
			"type" => "select");

		$of_options[] = array( "name" => __("Mobile Menu Icons Top Margin", "Aione"),
			"desc" => __("Controls the top margin for the icons in the modern mobile menu sticky header. In pixels, ex: 100px", "Aione"),
			"id" => "mobile_menu_icons_top_margin",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Mobile Menu Navigation Height", "Aione"),
			"desc" => __("Controls the menu height of each menu item. Use a number without 'px', default is 35.", "Aione"),
			"id" => "mobile_menu_nav_height",
			"std" => "35",
			"type" => "text");

		$of_options[] = array( "name" => __("Mobile Menu Submenu Slide Outs", "Aione"),
			"desc" => __("Check to group submenu to slideout elements on mobile menu.", "Aione"),
			"id" => "mobile_nav_submenu_slideout",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "mobile_menu_options",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Menu Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Page Title Bar", "Aione"),
			"id" => "heading_page_title_bar",
			"type" => "heading");

			$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Page Title Bar Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Page Title Bar", "Aione"),
			"desc" => __("Check the box to show the page title bar. This is a global option for every page or post, and this can be overridden by individual page/post options.", "Aione"),
			"id" => "page_title_bar",
			"std" => "bar_and_content",
			"options" => array('bar_and_content' => 'Show Bar and Content', 'content_only' => 'Show Content Only', 'hide' => 'Hide'),
			"type" => "select");

		$of_options[] = array( "name" => __("Page Title Bar Text", "Aione"),
			"desc" => __("Choose to show or hide the page title bar text.", "Aione"),
			"id" => "page_title_bar_text",
			"std" => "yes",
			"options" => array('yes' => __('Show', 'Aione'), 'no' => __('Hide', 'Aione')),
			"type" => "select");

		$of_options[] = array( "name" => __("100% Page Title Width", "Aione"),
			"desc" => __("Check this box to set the page title content to 100% of the browser width. Uncheck to follow site width. Only works with wide layout mode.", "Aione"),
			"id" => "page_title_100_width",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Page Title Bar Height", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "page_title_height",
			"std" => "87px",
			"type" => "text");

		$of_options[] = array( "name" => __("Page Title Bar Mobile Height", "Aione"),
			"desc" => __("In pixels, ex: 10px", "Aione"),
			"id" => "page_title_mobile_height",
			"std" => "70px",
			"type" => "text");

		$of_options[] = array( "name" => __("Page Title Bar Text Alignment", "Aione"),
			"desc" => __("Choose the title and subhead text alignment", "Aione"),
			"id" => "page_title_alignment",
			"std" => "left",
			"options" => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'),
			"type" => "select");

		$of_options[] = array( "name" => __("Page Title Bar Background", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the page title bar background.", "Aione"),
			"id" => "page_title_bg",
			"std" => get_template_directory_uri()."/assets/images/page_title_bg.png",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("Page Title Bar Background (Retina Version @2x)", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the retina page title bar background.", "Aione"),
			"id" => "page_title_bg_retina",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("100% Background Image", "Aione"),
			"desc" => __("Check this box to have the page title bar background image display at 100% in width and height and scale according to the browser size.", "Aione"),
			"id" => "page_title_bg_full",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Parallax Background Image", "Aione"),
			"desc" => __("Check to enable parallax background image when scrolling.", "Aione"),
			"id" => "page_title_bg_parallax",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Fading Animation", "Aione"),
			"desc" => __("Choose to have the page title text fade on scroll.", "Aione"),
			"id" => "page_title_fading",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Header Info", "Aione"),
			"desc" => "",
			"id" => "header_info",
			"std" => "<h3 style='margin: 0;'>" . __("Breadcrumb Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Breadcrumbs/Search Box", "Aione"),
			"desc" => __("Choose to display breadcrumbs, search box or none in the page title bar.", "Aione"),
			"id" => "page_title_bar_bs",
			"std" => "Breadcrumbs",
			"options" => array('none' => 'None', 'Breadcrumbs' => 'Breadcrumbs', 'Search Box' => 'Search Box'),
			"type" => "select");

		$of_options[] = array( "name" => __("Breadcrumbs on Mobile Devices", "Aione"),
			"desc" => __("Check to display breadcrumbs on mobile devices.", "Aione"),
			"id" => "breadcrumb_mobile",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Breadcrumb Menu Prefix", "Aione"),
			"desc" => __("The text before the breadcrumb menu.", "Aione"),
			"id" => "breacrumb_prefix",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Breadcrumb Menu Separator", "Aione"),
			"desc" => __("Choose a separator between the single breadcrumbs.", "Aione"),
			"id" => "breadcrumb_separator",
			"std" => "/",
			"type" => "text");

		$of_options[] = array( "name" => __("Show Custom Post Type Archives on Breadcrumbs", "Aione"),
			"desc" => __("Check to display custom post type archives in the breadcrumb path.", "Aione"),
			"id" => "breadcrumb_show_post_type_archive",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Post Categories on Breadcrumbs", "Aione"),
			"desc" => __("Check to display the post categories in the breadcrumb path.", "Aione"),
			"id" => "breadcrumb_show_categories",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Sliding Bar", "Aione"),
			"id" => "heading_sliding_bar",
			"type" => "heading");

		$of_options[] = array( "name" => __("Sliding Bar", "Aione"),
			"desc" => "",
			"id" => "sliding_bar",
			"std" => "<h3 style='margin: 0;'>" . __("Sliding Bar Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Enable Sliding Bar", "Aione"),
			"desc" => __("Check to enable the top Sliding Bar.", "Aione"),
			"id" => "slidingbar_widgets",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Sliding Bar On Mobile", "Aione"),
			"desc" => __("Check to disable the top Sliding Bar on mobile devices.", "Aione"),
			"id" => "mobile_slidingbar_widgets",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Top Border on Sliding Bar", "Aione"),
			"desc" => __("Check to enable a top border on the Sliding Bar.", "Aione"),
			"id" => "slidingbar_top_border",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Sliding Bar Open On Page Load", "Aione"),
			"desc" => __("Check the box to have the sliding bar open when the page loads.", "Aione"),
			"id" => "slidingbar_open_on_load",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Number of Sliding Bar Columns", "Aione"),
			"desc" => __("Select the number of columns to display in the Sliding Bar.", "Aione"),
			"id" => "slidingbar_widgets_columns",
			"std" => "2",
			"options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'),
			"type" => "select");

		$of_options[] = array( "name" => __("Footer", "Aione"),
			"id" => "heading_footer",
			"type" => "heading");

		$of_options[] = array( "name" => __("General Footer Options", "Aione"),
			"desc" => "",
			"id" => "footer_widgets_area_title",
			"std" => "<h3 style='margin: 0;'>" . __("General Footer Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("100% Footer Width", "Aione"),
			"desc" => __("Check this box to set footer width to 100% of the browser width. Uncheck to follow site width. Only works with wide layout mode.", "Aione"),
			"id" => "footer_100_width",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => "Footer Special Effects",
			"desc" 		=> "Select your preferred footer special effect.",
			"id" 		=> "footer_special_effects",
			"std" 		=> "none",
			"type" 		=> "radio",
			"options" 	=> array("none" => __( "None", "Aione" ), "footer_parallax_effect" => __( "Footer Parallax Effect", "Aione" ), "footer_area_bg_parallax" => __( "Parallax Background Image", "Aione" ), "footer_sticky" => __("Sticky Footer", "Aione" ), "footer_sticky_with_parallax_bg_image" => __("Sticky Footer and Parallax Background Image", "Aione" ) )
		);

		$of_options[] = array( "name" => __( "Footer Parallax Effect Info", "Aione"),
			"desc" => "",
			"id" => "footer_parallax_effect_info",
			"std" => __("This enables a fixed footer with parallax scrolling effect.", "Aione" ),
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __( "Parallax Background Image Info", "Aione"),
			"desc" => "",
			"id" => "footer_area_bg_parallax_info",
			"std" => __("This enables a parallax effect on the background image selected in 'Background Image For Footer Widget Area' field.", "Aione" ),
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Sticky Footer Info", "Aione"),
			"desc" => "",
			"id" => "footer_sticky_info",
			"std" => __("This enables a sticky footer. The entire footer area will always be 'below the fold'. On very short pages, it makes sure that the footer sticks at the bottom, just above the fold.<br />IMPORTANT: 'Sticky Footer Height' field must be filled in.", "Aione" ),
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Sticky Footer and Parallax Background Image Info", "Aione"),
			"desc" => "",
			"id" => "footer_sticky_with_parallax_bg_image_info",
			"std" => __("This enables a sticky footer together with a parallax effect on the background image. The entire footer area will always be 'below the fold'. IMPORTANT: 'Sticky Footer Height' field must be filled in.", "Aione" ),
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Sticky Footer Height", "Aione"),
			"desc" => __("The entire height of the footer area (widgets + copyright). <a href='https://oxosolutions.com/aione-doc/footer-special-effects/' target='_blank'>View tutorial here</a>. Set a static height in px to enable sticky footer effect. ex: 200px..", "Aione"),
			"id" => "footer_sticky_height",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Footer Widgets Area", "Aione"),
			"desc" => "",
			"id" => "footer_widgets_area_title",
			"std" => "<h3 style='margin: 0;'>" . __("Footer Widgets Area Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Footer Widgets", "Aione"),
			"desc" => __("Check the box to display footer widgets.", "Aione"),
			"id" => "footer_widgets",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Footer Widgets Center Content", "Aione"),
			"desc" => __("Check the box to display the footer widget area contents centered.", "Aione"),
			"id" => "footer_widgets_center_content",
			"std" => 0,
			"type" => "checkbox");


		$of_options[] = array( "name" => __("Number of Footer Columns", "Aione"),
			"desc" => __("Select the number of columns to display in the footer.", "Aione"),
			"id" => "footer_widgets_columns",
			"std" => "4",
			"options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'),
			"type" => "select");

		$of_options[] = array( "name" => __("Background Image For Footer Widget Area", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the footer widget area backgroud.", "Aione"),
			"id" => "footerw_bg_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("100% Background Image", "Aione"),
			"desc" => __("Check this box to have the footer background image display at 100% in width and height and scale according to the browser size.", "Aione"),
			"id" => "footerw_bg_full",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Background Repeat", "Aione"),
			"desc" => __("Select how the background image repeats.", "Aione"),
			"id" => "footerw_bg_repeat",
			"std" => "",
			"type" => "select",
			"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$of_options[] = array( "name" => __("Background Position", "Aione"),
			"desc" => __("Select the position from where background image starts.", "Aione"),
			"id" => "footerw_bg_pos",
			"std" => "center center",
			"type" => "select",
			"options" => $body_pos);

		$of_options[] = array( "name" => __("Footer Top Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "footer_area_top_padding",
			"std" => "43px",
			"type" => "text");

		$of_options[] = array( "name" => __("Footer Bottom Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "footer_area_bottom_padding",
			"std" => "40px",
			"type" => "text");


		$of_options[] = array( "name" => __("Footer Left Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "footer_area_left_padding",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Footer Right Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "footer_area_right_padding",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Copyright Area / Social Icon Options", "Aione"),
			"desc" => "",
			"id" => "copyright_area_title",
			"std" => "<h3 style='margin: 0;'>". __("Footer Copyright Area Options", "Aione"). "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Copyright Bar", "Aione"),
			"desc" => __("Check the box to display the copyright bar.", "Aione"),
			"id" => "footer_copyright",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Copyright Center Content", "Aione"),
			"desc" => __("Check the box to display the copyright bar contents centered.", "Aione"),
			"id" => "footer_copyright_center_content",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Copyright Text", "Aione"),
			"desc" => __("Enter the text that displays in the copyright bar. HTML markup can be used.", "Aione"),
			"id" => "footer_text",
			"std" => 'Copyright 2012 Aione | All Rights Reserved | Powered by <a href="http://wordpress.org">WordPress</a>  |  <a href="http://oxosolutions.com">OXO Solutions</a>',
			"type" => "textarea");

		$of_options[] = array( "name" => __("Copyright Top Padding", "Aione"),
			"desc" => __("In pixels, ex: 18px", "Aione"),
			"id" => "copyright_top_padding",
			"std" => "18px",
			"type" => "text");

		$of_options[] = array( "name" => __("Copyright Bottom Padding", "Aione"),
			"desc" => __("In pixels, ex: 18px", "Aione"),
			"id" => "copyright_bottom_padding",
			"std" => "16px",
			"type" => "text");

		$of_options[] = array( "name" => __("Social Icon Options", "Aione"),
			"desc" => "",
			"id" => "footer_social_icon_title",
			"std" => "<h3 style='margin: 0;'>" . __("Social Icon Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Display Social Icons on Footer of the Page", "Aione"),
			"desc" => __("Select the checkbox to show social media icons on the footer of the page.", "Aione"),
			"id" => "icons_footer",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( 	"name" => __("Footer Social Icons Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 16", "Aione"),
						"id" 		=> "footer_social_links_font_size",
						"std" 		=> "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Footer Social Icons Custom Color", "Aione"),
			"desc" => __("Select a custom social icon color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "footer_social_links_icon_color",
			"std" => "#46494a",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Social Icons Boxed", "Aione"),
			"desc" => __("Controls whether each icon is displayed in a small box.", "Aione"),
			"id" => "footer_social_links_boxed",
			"std" => "No",
			"type" => "select",
			"options" => array('No' => 'No', 'Yes' => 'Yes'));

		$of_options[] = array( "name" => __("Footer Social Icons Custom Box Color", "Aione"),
			"desc" => __("Select a custom social icon box color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "footer_social_links_box_color",
			"std" => "#222222",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Social Icons Boxed Radius", "Aione"),
			"desc" => __("Box radius for the social icons. In pixels, ex: 4px.", "Aione"),
			"id" => "footer_social_links_boxed_radius",
			"std" => "4px",
			"type" => "text");


		$of_options[] = array( 	"name" => __("Footer Social Icons Boxed Padding", "Aione"),
						"desc" 		=> __("In pixels, default is 8", "Aione"),
						"id" 		=> "footer_social_links_boxed_padding",
						"std" 		=> "8",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Footer Social Icons Tooltip Position", "Aione"),
			"desc" => __("Controls the tooltip position of the social icons in the footer.", "Aione"),
			"id" => "footer_social_links_tooltip_placement",
			"std" => "Top",
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

		$of_options[] = array( "name" => __("Sidebars", "Aione"),
			"id" => "heading_sidebars",
			"type" => "heading");

		$of_options[] = array( "name" => __('Pages', "Aione"),
			"desc" => "",
			"id" => "pages_sidebars",
			"std" => "<h3 style='margin: 0;'>" . __("Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use a global sidebar on all pages. This option overrides the page options.", "Aione"),
			"id" => "pages_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on all pages.", "Aione"),
			"id" => "pages_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on all pages. Sidebar 2 can only be used if sidebar 1 is selected", "Aione"),
			"id" => "pages_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for pages. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "default_sidebar_pos",
			"std" => "Right",
			"options" => array('Right' => 'Right', 'Left' => 'Left'),
			"type" => "select");

		$of_options[] = array( "name" => __('Pages', "Aione"),
			"desc" => "",
			"id" => "pages",
			"std" => "<h3 style='margin: 0;'>" . __("Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Portfolio Posts", "Aione"),
			"desc" => "",
			"id" => "portfolio",
			"std" => "<h3 style='margin: 0;'>" . __("Portfolio Posts", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use a global sidebar on all single portfolio posts. This option overrides the portfolio options.", "Aione"),
			"id" => "portfolio_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on all single portfolio posts.", "Aione"),
			"id" => "portfolio_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on all single portfolio posts. Sidebar 2 can only be used if sidebar 1 is selected", "Aione"),
			"id" => "portfolio_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Portfolio Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for the portfolio. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "portfolio_sidebar_position",
			"std" => "Right",
			"type" => "select",
			"options" => array(
				'Right' => 'Right',
				'Left' => 'Left',
			));

		$of_options[] = array( "name" => __("Portfolio Posts", "Aione"),
			"desc" => "",
			"id" => "portfolio_posts",
			"std" => "<h3 style='margin: 0;'>" . __("Portfolio Posts", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Portfolio Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "portfolio_archive",
			"std" => "<h3 style='margin: 0;'>" . __("Portfolio Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Portfolio Archive/Category Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on the archive/category pages.", "Aione"),
			"id" => "portfolio_archive_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Portfolio Archive/Category Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on the archive/category pages. Sidebar 2 can only be used if sidebar 1 is selected.", "Aione"),
			"id" => "portfolio_archive_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Portfolio Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "portfolio_archive",
			"std" => "<h3 style='margin: 0;'>" . __("Portfolio Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Blog Posts", "Aione"),
			"desc" => "",
			"id" => "blog_posts",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Posts", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use a global sidebar on all single posts. This option overrides the post options.", "Aione"),
			"id" => "posts_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on all single posts.", "Aione"),
			"id" => "posts_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on all single posts.", "Aione"),
			"id" => "posts_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Blog Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for the blog pages. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "blog_sidebar_position",
			"std" => "Right",
			"type" => "select",
			"options" => array(
				'Right' => 'Right',
				'Left' => 'Left',
			));

		$of_options[] = array( "name" => __("Blog Posts", "Aione"),
			"desc" => "",
			"id" => "blog_posts",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Posts", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Blog Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "blog_archives",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Blog Archive/Category Sidebar 1", "Aione"),
			"desc" => __("Select the sidebar 1 that will display on the blog archive/category pages.", "Aione"),
			"id" => "blog_archive_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Blog Archive/Category Sidebar 2", "Aione"),
			"desc" => __("Select the sidebar 2 that will display on the blog archive/category pages. Sidebar 2 can only be used if sidebar 1 is selected.", "Aione"),
			"id" => "blog_archive_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Blog Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "blog_archives",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Woocommerce Products", "Aione"),
			"desc" => "",
			"id" => "woo_products",
			"std" => "<h3 style='margin: 0;'>" . __("Woocommerce Products", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use a global sidebar on the main shop page and all single product pages. This option overrides the woocommerce options.", "Aione"),
			"id" => "woo_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on all single product pages.", "Aione"),
			"id" => "woo_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on all single product pages. Sidebar 2 can only be used if sidebar 1 is selected", "Aione"),
			"id" => "woo_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Woocommerce Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for woocommerce. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "woo_sidebar_position",
			"std" => "Right",
			"type" => "select",
			"options" => array(
				'Right' => 'Right',
				'Left' => 'Left',
			));

		$of_options[] = array( "name" => __("Woocommerce Products", "Aione"),
			"desc" => "",
			"id" => "woo_products",
			"std" => "<h3 style='margin: 0;'>" . __("Woocommerce Products", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("WooCommerce Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "woo_archives",
			"std" => "<h3 style='margin: 0;'>" . __("WooCommerce Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Woocommerce Archive/Category Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on the archive/category pages.", "Aione"),
			"id" => "woocommerce_archive_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Woocommerce Archive/Category Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on the archive/category pages. Sidebar 2 can only be used if sidebar 1 is selected.", "Aione"),
			"id" => "woocommerce_archive_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("WooCommerce Archive/Category Pages", "Aione"),
			"desc" => "",
			"id" => "woo_archives",
			"std" => "<h3 style='margin: 0;'>" . __("WooCommerce Archive/Category Pages", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Search Page", "Aione"),
			"desc" => "",
			"id" => "search_only",
			"std" => "<h3 style='margin: 0;'>" . __("Search Page", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Search Page Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on the search results page.", "Aione"),
			"id" => "search_sidebar",
			"std" => "Blog Sidebar",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Search Page Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on the search results page. Sidebar 2 can only be used if sidebar 1 is selected.", "Aione"),
			"id" => "search_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Search Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for the search pages. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "search_sidebar_position",
			"std" => "Right",
			"type" => "select",
			"options" => array(
				'Right' => 'Right',
				'Left' => 'Left',
			));

		$of_options[] = array( "name" => __("Search Page", "Aione"),
			"desc" => "",
			"id" => "search_only",
			"std" => "<h3 style='margin: 0;'>" . __("Search Page", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Background", "Aione"),
			"id" => "heading_background",
			"type" => "heading");

		$of_options[] = array( "name" => __("Boxed Mode Only", "Aione"),
			"desc" => "",
			"id" => "boxed_mode_only",
			"std" => "<h3 style='margin: 0;'>" . __("Background options below only work in boxed mode", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Background Image For Outer Areas In Boxed Mode", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the backgroud.", "Aione"),
			"id" => "bg_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("100% Background Image", "Aione"),
			"desc" => __("Check this box to have the background image display at 100% in width and height and scale according to the browser size.", "Aione"),
			"id" => "bg_full",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Background Repeat", "Aione"),
			"desc" => __("Select how the background image repeats.", "Aione"),
			"id" => "bg_repeat",
			"std" => "",
			"type" => "select",
			"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$of_options[] = array( "name" => __("Background Color For Outer Areas In Boxed Mode", "Aione"),
			"desc" => __("Select a background color.", "Aione"),
			"id" => "bg_color",
			"std" => "#d7d6d6",
			"type" => "color");

		$of_options[] = array( "name" => __("Background Pattern", "Aione"),
			"desc" => __("Check the box to display a pattern in the background. If checked, select the pattern from below.", "Aione"),
			"id" => "bg_pattern_option",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Select a Background Pattern", "Aione"),
			"desc" => "",
			"id" => "bg_pattern",
			"std" => "pattern1",
			"type" => "images",
			"options" => array(
				"pattern1" => get_template_directory_uri()."/assets/images/patterns/pattern1.png",
				"pattern2" => get_template_directory_uri()."/assets/images/patterns/pattern2.png",
				"pattern3" => get_template_directory_uri()."/assets/images/patterns/pattern3.png",
				"pattern4" => get_template_directory_uri()."/assets/images/patterns/pattern4.png",
				"pattern5" => get_template_directory_uri()."/assets/images/patterns/pattern5.png",
				"pattern6" => get_template_directory_uri()."/assets/images/patterns/pattern6.png",
				"pattern7" => get_template_directory_uri()."/assets/images/patterns/pattern7.png",
				"pattern8" => get_template_directory_uri()."/assets/images/patterns/pattern8.png",
				"pattern9" => get_template_directory_uri()."/assets/images/patterns/pattern9.png",
				"pattern10" => get_template_directory_uri()."/assets/images/patterns/pattern10.png",
			));

		$of_options[] = array( "name" => __("Both Modes", "Aione"),
			"desc" => "",
			"id" => "both_modes_only",
			"std" => "<h3 style='margin: 0;'>" . __("Background Options Below Work For Boxed & Wide Mode", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Background Image For Main Content Area", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the main content area backgroud.", "Aione"),
			"id" => "content_bg_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("100% Background Image", "Aione"),
			"desc" => __("Check this box to have the background image display at 100% in width and height and scale according to the browser size.", "Aione"),
			"id" => "content_bg_full",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Background Repeat", "Aione"),
			"desc" => __("Select how the background image repeats.", "Aione"),
			"id" => "content_bg_repeat",
			"std" => "",
			"type" => "select",
			"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$of_options[] = array( "name" => __("Typography", "Aione"),
			"id" => "heading_typography",
			"type" => "heading");

	   $of_options[] = array( "name" => __("Custom Nav / Headings Font", "Aione"),
			"desc" => "",
			"id" => "custom_heading_font",
			"std" => "<h3 style='margin: 0;'>" . __("Custom Font For Menus And Headings", "Aione") . "</h3><p style='margin-bottom:0;'>" . __("This will override the google / standard font options. All 4 files are required.", "Aione") . "</p>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Custom Font .woff", "Aione"),
			"desc" => __("Upload the .woff font file.", "Aione"),
			"id" => "custom_font_woff",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Custom Font .ttf", "Aione"),
			"desc" => __("Upload the .ttf font file.", "Aione"),
			"id" => "custom_font_ttf",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Custom Font .svg", "Aione"),
			"desc" => __("Upload the .svg font file.", "Aione"),
			"id" => "custom_font_svg",
			"std" => "",
			"type" => "upload");

		$of_options[] = array( "name" => __("Custom Font .eot", "Aione"),
			"desc" => __("Upload the .eot font file.", "Aione"),
			"id" => "custom_font_eot",
			"std" => "",
			"type" => "upload");

	   $of_options[] = array( "name" => __("Custom Nav / Headings Font", "Aione"),
			"desc" => "",
			"id" => "custom_heading_font",
			"std" => "<h3 style='margin: 0;'>" . __("Custom Font For Menus And Headings", "Aione") . "</h3><p style='margin-bottom:0;'>" . __("This will override the google / standard font options. All 4 files are required.", "Aione") . "</p>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Google Fonts", "Aione"),
			"desc" => "",
			"id" => "google_fonts_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Google Fonts", "Aione") . "</h3><p style='margin-bottom:0;'>" . __("This will override standard font options.", "Aione" ) . "</p>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Select Body Font Family", "Aione"),
			"desc" => __("Select a font family for body text", "Aione"),
			"id" => "google_body",
			"std" => "PT Sans",
			"type" => "select",
			"options" => $google_fonts);

		$of_options[] = array( "name" => __("Select Menu Font", "Aione"),
			"desc" => __("Select a font family for navigation", "Aione"),
			"id" => "google_nav",
			"std" => "Antic Slab",
			"type" => "select",
			"options" => $google_fonts);

		$of_options[] = array( "name" => __("Select Headings Font", "Aione"),
			"desc" => __("Select a font family for headings", "Aione"),
			"id" => "google_headings",
			"std" => "Antic Slab",
			"type" => "select",
			"options" => $google_fonts);

		$of_options[] = array( "name" => __("Select Footer Headings Font", "Aione"),
			"desc" => __("Select a font family for footer headings", "Aione"),
			"id" => "google_footer_headings",
			"std" => "PT Sans",
			"type" => "select",
			"options" => $google_fonts);

		$of_options[] = array( "name" => __("Select Button Font", "Aione"),
			"desc" => __("Select a font family for button", "Aione"),
			"id" => "google_button",
			"std" => "PT Sans",
			"type" => "select",
			"options" => $google_fonts);

		$of_options[] = array( "name" => __("Google Font Settings", "Aione"),
			"desc" => __("Adjust the settings below to load different character sets and types for fonts. More character sets and types equals to slower page load. Please read <a href='http://oxosolutions.com/?p=275938'>How to configure google web fonts settings</a> for more info.", "Aione"),
			"id" => "gfont_settings",
			"std" => "400,400italic,700,700italic&subset=latin",
			"type" => "text");

	   $of_options[] = array( "name" => __("Google Fonts", "Aione"),
			"desc" => "",
			"id" => "google_fonts_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Google Fonts", "Aione") . "</h3><p style='margin-bottom:0;'>" . __("This will override standard font options.", "Aione" ) . "</p>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Standard Fonts", "Aione"),
			"desc" => "",
			"id" => "standard_fonts_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Standard Fonts", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Select Body Font Family", "Aione"),
			"desc" => __("Select a font family for body text", "Aione"),
			"id" => "standard_body",
			"std" => "",
			"type" => "select",
			"options" => $standard_fonts);

		$of_options[] = array( "name" => __("Select Menu Font Family", "Aione"),
			"desc" => __("Select a font family for menu / navigation", "Aione"),
			"id" => "standard_nav",
			"std" => "",
			"type" => "select",
			"options" => $standard_fonts);

		$of_options[] = array( "name" => __("Select Headings Font Family", "Aione"),
			"desc" => __("Select a font family for headings", "Aione"),
			"id" => "standard_headings",
			"std" => "",
			"type" => "select",
			"options" => $standard_fonts);

		$of_options[] = array( "name" => __("Select Footer Headings Font Family", "Aione"),
			"desc" => __("Select a font family for footer headings", "Aione"),
			"id" => "standard_footer_headings",
			"std" => "",
			"type" => "select",
			"options" => $standard_fonts);

		$of_options[] = array( "name" => __("Select Button Font Family", "Aione"),
			"desc" => __("Select a font family for button", "Aione"),
			"id" => "standard_button",
			"std" => "",
			"type" => "select",
			"options" => $standard_fonts);

		$of_options[] = array( "name" => __("Standard Fonts", "Aione"),
			"desc" => "",
			"id" => "standard_fonts_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Standard Fonts", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Sizes", "Aione"),
			"desc" => "",
			"id" => "font_size_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Font Sizes", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");


		$of_options[] = array( 	"name" => __("Body Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 13", "Aione"),
						"id" 		=> "body_font_size",
						"std" 		=> "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Main Menu Font Size", "Aione"),
			"desc" => __("In pixels, default is 14", "Aione"),
			"id" => "nav_font_size",
			"std" => "14",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Main Menu Dropdown Font Size", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "nav_dropdown_font_size",
			"std" => "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Secondary Menu & Top Contact Info Font Size", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "snav_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Side Menu Font Size", "Aione"),
			"desc" => __("In pixels, default is 14", "Aione"),
			"id" => "side_nav_font_size",
			"std" => "14",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( 	"name" => __("Mobile Menu Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 12", "Aione"),
						"id" 		=> "mobile_menu_font_size",
						"std" 		=> "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Breadcrumbs Font Size", "Aione"),
			"desc" => __("In pixels, default is 10", "Aione"),
			"id" => "breadcrumbs_font_size",
			"std" => "10",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Sidebar Widget Heading Font Size", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "sidew_font_size",
			"std" => "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Sliding Bar Widget Heading Font Size", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "slidingbar_font_size",
			"std" => "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Footer Widget Heading Font Size", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "footw_font_size",
			"std" => "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Copyright Font Size", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "copyright_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H1", "Aione"),
			"desc" => __("In pixels, default is 34", "Aione"),
			"id" => "h1_font_size",
			"std" => "34",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H2", "Aione"),
			"desc" => __("In pixels, default is 18", "Aione"),
			"id" => "h2_font_size",
			"std" => "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H3", "Aione"),
			"desc" => __("In pixels, default is 16", "Aione"),
			"id" => "h3_font_size",
			"std" => "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H4", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "h4_font_size",
			"std" => "13",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H5", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "h5_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Size H6", "Aione"),
			"desc" => __("In pixels, default is 11", "Aione"),
			"id" => "h6_font_size",
			"std" => "11",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Post Titles Font Size", "Aione"),
			"desc" => __("Controls the font size of all post titles. In pixels, default is 18", "Aione"),
			"id" => "post_titles_font_size",
			"std" => "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Post Titles Extras Font Size", "Aione"),
			"desc" => __("Controls Comment, Related Posts and Author Titles. H3 heading. In pixels, default is 18", "Aione"),
			"id" => "post_titles_extras_font_size",
			"std" => "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Header Tagline Font Size", "Aione"),
			"desc" => __("In pixels, default is 16", "Aione"),
			"id" => "tagline_font_size",
			"std" => "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Meta Data Font Size", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "meta_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Page Title Font Size", "Aione"),
			"desc" => __("In pixels, default is 18", "Aione"),
			"id" => "page_title_font_size",
			"std" => "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Page Title Subheader Font Size", "Aione"),
			"desc" => __("In pixels, default is 14", "Aione"),
			"id" => "page_title_subheader_font_size",
			"std" => "14",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Pagination Font Size", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "pagination_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("WooCommerce Icon Font Size", "Aione"),
			"desc" => __("In pixels, default is 12", "Aione"),
			"id" => "woo_icon_font_size",
			"std" => "12",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);


		$of_options[] = array( "name" => __("Font Size", "Aione"),
			"desc" => "",
			"id" => "font_size_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Font Sizes", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Line Heights", "Aione"),
			"desc" => "",
			"id" => "font_line_heights_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Font Line Heights", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Body Font Line Height", "Aione"),
			"desc" => __("In pixels, default is 20", "Aione"),
			"id" => "body_font_lh",
			"std" => "20",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H1", "Aione"),
			"desc" => __("In pixels, default is 48", "Aione"),
			"id" => "h1_font_lh",
			"std" => "48",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H2", "Aione"),
			"desc" => __("In pixels, default is 27", "Aione"),
			"id" => "h2_font_lh",
			"std" => "27",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H3", "Aione"),
			"desc" => __("In pixels, default is 24", "Aione"),
			"id" => "h3_font_lh",
			"std" => "24",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H4", "Aione"),
			"desc" => __("In pixels, default is 20", "Aione"),
			"id" => "h4_font_lh",
			"std" => "20",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H5", "Aione"),
			"desc" => __("In pixels, default is 18", "Aione"),
			"id" => "h5_font_lh",
			"std" => "18",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading Font Line Height H6", "Aione"),
			"desc" => __("In pixels, default is 17", "Aione"),
			"id" => "h6_font_lh",
			"std" => "17",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Post Titles Line Height H2", "Aione"),
			"desc" => __("H2 Heading. In pixels, default is 27", "Aione"),
			"id" => "post_titles_font_lh",
			"std" => "27",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Secondary Menu Line Height", "Aione"),
			"desc" => __("In pixels, default is 44", "Aione"),
			"id" => "sec_menu_lh",
			"std" => "44",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Font Line Heights", "Aione"),
			"desc" => "",
			"id" => "font_line_heights_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Font Line Heights", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Weights", "Aione"),
			"desc" => "",
			"id" => "font_weights_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Weights", "Aione") ),
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Weights Info", "Aione"),
			"desc" => "",
			"id" => "font_weights_description",
			"std" => "<ul class='list'><li>" . __("If you use a custom font, the font weight will correspond to the font weight of the uploaded files, thus these settings do not apply.</li><li>If you use a google font, make sure to load the font weight in 'Google Font Settings' field that corresponds to the one in parenthesis here.</li><li>Browser standard fonts in general support only 'Normal (400)' and 'Bold (700)' font weights.", "Aione") . "</li></ul>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Select Body Font Weight", "Aione"),
			"desc" => __("Select a font weight for the body font. ", "Aione"),
			"id" => "font_weight_body",
			"std" => "400",
			"type" => "select",
			"options" => $font_weights,
		);

		$of_options[] = array( "name" => __("Select Menu Font Weight", "Aione"),
			"desc" => __("Select a font weight of the menu font.", "Aione"),
			"id" => "font_weight_menu",
			"std" => "400",
			"type" => "select",
			"options" => $font_weights,
		);

		$of_options[] = array( "name" => __("Select Headings Font Weight", "Aione"),
			"desc" => __("Select a font weight for the headings font.", "Aione"),
			"id" => "font_weight_headings",
			"std" => "400",
			"type" => "select",
			"options" => $font_weights,
		);

		$of_options[] = array( "name" => __("Select Footer Headings Font Weight", "Aione"),
			"desc" => __("Select a font weight for the footer headings font.", "Aione"),
			"id" => "font_weight_footer_headings",
			"std" => "400",
			"type" => "select",
			"options" => $font_weights,
		);

		$of_options[] = array( "name" => __("Select Button Font Weight", "Aione"),
			"desc" => __("Select a font weight for the button font.", "Aione"),
			"id" => "font_weight_button",
			"std" => "700",
			"type" => "select",
			"options" => $font_weights,
		);

		$of_options[] = array( "name" => __("Font Weights", "Aione"),
			"desc" => "",
			"id" => "font_weights_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Weights", "Aione") ),
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Letter Spacing", "Aione"),
			"desc" => "",
			"id" => "font_letter_spacing_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Letter Spacing", "Aione") ),
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Heading H1 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h1 headings. In pixels, ex: 2", "Aione"),
			"id" => "h1_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading H2 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h2 headings. In pixels, ex: 2", "Aione"),
			"id" => "h2_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading H3 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h3 headings. In pixels, ex: 2", "Aione"),
			"id" => "h3_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading H4 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h4 headings. In pixels, ex: 2", "Aione"),
			"id" => "h4_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading H5 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h5 headings. In pixels, ex: 2", "Aione"),
			"id" => "h5_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Heading H6 Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of h6 headings. In pixels, ex: 2", "Aione"),
			"id" => "h6_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Menu Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of menu text. In pixels, ex: 2", "Aione"),
			"id" => "menu_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Button Letter Spacing", "Aione"),
			"desc" => __("Controls the letter spacing of button text. In pixels, ex: 2", "Aione"),
			"id" => "button_font_ls",
			"std" => "0",
						"min" 		=> "0",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Font Letter Spacing", "Aione"),
			"desc" => "",
			"id" => "font_letter_spacing_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Letter Spacing", "Aione") ),
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Font Margins", "Aione"),
			"desc" => "",
			"id" => "font_margins_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Margins", "Aione") ),
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("H1 Top Margin", "Aione"),
			"desc" => __('In ems, default is 0.67', 'Aione'),
			"id" => "h1_top_margin",
			"std" => "0.67",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H1 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 0.67', 'Aione'),
			"id" => "h1_bottom_margin",
			"std" => "0.67",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H2 Top Margin", "Aione"),
			"desc" => __('In ems, default is 0', 'Aione'),
			"id" => "h2_top_margin",
			"std" => "0",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H2 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 1.1', 'Aione'),
			"id" => "h2_bottom_margin",
			"std" => "1.1",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H3 Top Margin", "Aione"),
			"desc" => __('In ems, default is 1', 'Aione'),
			"id" => "h3_top_margin",
			"std" => "1",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H3 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 1', 'Aione'),
			"id" => "h3_bottom_margin",
			"std" => "1",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H4 Top Margin", "Aione"),
			"desc" => __('In ems, default is 1.33', 'Aione'),
			"id" => "h4_top_margin",
			"std" => "1.33",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H4 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 1.33', 'Aione'),
			"id" => "h4_bottom_margin",
			"std" => "1.33",
			"type" => "text"
				);


		$of_options[] = array( "name" => __("H5 Top Margin", "Aione"),
			"desc" => __('In ems, default is 1.67', 'Aione'),
			"id" => "h5_top_margin",
			"std" => "1.67",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H5 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 1.67', 'Aione'),
			"id" => "h5_bottom_margin",
			"std" => "1.67",
			"type" => "text"
				);


		$of_options[] = array( "name" => __("H6 Top Margin", "Aione"),
			"desc" => __('In ems, default is 2.33', 'Aione'),
			"id" => "h6_top_margin",
			"std" => "2.33",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("H6 Bottom Margin", "Aione"),
			"desc" => __('In ems, default is 2.33', 'Aione'),
			"id" => "h6_bottom_margin",
			"std" => "2.33",
			"type" => "text"
				);

		$of_options[] = array( "name" => __("Font Margins", "Aione"),
			"desc" => "",
			"id" => "font_margins_wrapper",
			"std" => sprintf( "<h3 style='margin: 0;'>%s</h3>", __("Font Margins", "Aione") ),
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Styling", "Aione"),
			"id" => "heading_styling",
			"type" => "heading");

		$of_options[] = array( "name" => __("Select Theme Skin", "Aione"),
			"desc" => __("Select a skin, all color options will automatically change to the defined skin.", "Aione"),
			"id" => "scheme_type",
			"std" => "Light",
			"type" => "select",
			"options" => array('Light' => 'Light', 'Dark' => 'Dark'));

		$of_options[] = array( "name" => __("Predefined Color Scheme", "Aione"),
			"desc" => __("Select a scheme, all color options will automatically change to the defined scheme.", "Aione"),
			"id" => "color_scheme",
			"std" => "Green",
			"type" => "select",
			"options" => array('Red' => 'Red', 'Light Red' => 'Light Red', 'Blue' => 'Blue', 'Light Blue' => 'Light Blue', 'Green' => 'Green', 'Dark Green' => 'Dark Green', 'Orange' => 'Orange', 'Pink' => 'Pink', 'Brown' => 'Brown', 'Light Grey' => 'Light Grey'));

	   $of_options[] = array( "name" => __("Background Colors", "Aione"),
			"desc" => "",
			"id" => "bg_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Background Colors", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Primary Color", "Aione"),
			"desc" => __("Controls several items, ex: link hovers, highlights, and more.", "Aione"),
			"id" => "primary_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Background Color and Opacity", "Aione"),
			"desc" => __("Controls the background color and opacity of the top sliding bar. Opacity ranges between 0 (transparent) and 1 (opaque). ex: .4", "Aione"),
			"id" => "slidingbar_bg_color",
			"std" => array(
						'color' => "#363839",
						'opacity' => '1'
					 ),
			"type" => "backgroundcolor");

		$of_options[] = array( "name" => __("Header Background Color and Opacity", "Aione"),
			"desc" => __("Controls the background color and opacity for the header. Opacity only works with header top position and ranges between 0 (transparent) and 1 (opaque). ex: .4", "Aione"),
			"id" => "header_bg_color",
			"std" => array(
						'color' => "#ffffff",
						'opacity' => '1'
					 ),
			"type" => "backgroundcolor");

		$of_options[] = array( "name" => __("Sticky Header Background Color and Opacity", "Aione"),
			"desc" => __("Controls the background color for the sticky header. Opacity ranges between 0 (transparent) and 1 (opaque). ex: .4", "Aione"),
			"id" => "header_sticky_bg_color",
			"std" => array(
						'color' => "#ffffff",
						'opacity' => '0.97'
					 ),
			"type" => "backgroundcolor");


		$of_options[] = array( "name" => __("Header Border Color", "Aione"),
			"desc" => __("Controls the border colors for the header. If using left or right header position it controls the menu divider lines.", "Aione"),
			"id" => "header_border_color",
			"std" => "#e5e5e5",
			"type" => "color");

		$of_options[] = array( "name" => __("Header Top Background Color", "Aione"),
			"desc" => __("Controls the background color of the top header section used in Headers 2-5.", "Aione"),
			"id" => "header_top_bg_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Page Title Bar Background Color", "Aione"),
			"desc" => __("Select a color for the page title bar background.", "Aione"),
			"id" => "page_title_bg_color",
			"std" => "#F6F6F6",
			"type" => "color");

		$of_options[] = array( "name" => __("Page Title Bar Borders Color", "Aione"),
			"desc" => __("Select a color for the page title bar borders.", "Aione"),
			"id" => "page_title_border_color",
			"std" => "#d2d3d4",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Background Color", "Aione"),
			"desc" => __("Controls the background color of the main content area.", "Aione"),
			"id" => "content_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Background Color", "Aione"),
			"desc" => __("Controls the background color of the sidebar.", "Aione"),
			"id" => "sidebar_bg_color",
			"std" => "transparent",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Widget Title Background Color", "Aione"),
			"desc" => __("Controls the background color of the sidebar widget title.", "Aione"),
			"id" => "sidebar_widget_bg_color",
			"std" => "transparent",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Background Color", "Aione"),
			"desc" => __("Controls the background color of the footer.", "Aione"),
			"id" => "footer_bg_color",
			"std" => "#363839",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Border Color", "Aione"),
			"desc" => __("Controls the border colors for the footer.", "Aione"),
			"id" => "footer_border_color",
			"std" => "#e9eaee",
			"type" => "color");

		$of_options[] = array( "name" => __("Copyright Background Color", "Aione"),
			"desc" => __("Controls the background color of the footer copyright.", "Aione"),
			"id" => "copyright_bg_color",
			"std" => "#282a2b",
			"type" => "color");

		$of_options[] = array( "name" => __("Copyright Border Color", "Aione"),
			"desc" => __("Controls the border colors for the footer copyright.", "Aione"),
			"id" => "copyright_border_color",
			"std" => "#4b4c4d",
			"type" => "color");

	   $of_options[] = array( "name" => __("Background Colors", "Aione"),
			"desc" => "",
			"id" => "bg_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Background Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Element Colors", "Aione"),
			"desc" => "",
			"id" => "element_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Element Colors", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Rollover Image Gradient Top Color and Opacity", "Aione"),
			"desc" => __("Controls the top color of the image rollover gradients. Opacity ranges between 0 (transparent) and 1 (opaque). ex: .4", "Aione"),
			"id" => "image_gradient_top_color",
			"std" => array(
						'color' => "#a0ce4e",
						'opacity' => '0.8'
					 ),
			"type" => "backgroundcolor");

		$of_options[] = array( "name" => __("Rollover Image Gradient Bottom Color", "Aione"),
			"desc" => __("Controls the bottom color of the image rollover gradients.", "Aione"),
			"id" => "image_gradient_bottom_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Rollover Image Element Color", "Aione"),
			"desc" => __("This option controls the color of image rollover text and the icon circle backgrounds.", "Aione"),
			"id" => "image_rollover_text_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Rollover Image Icon Color", "Aione"),
			"desc" => __("Controls the color of the icons in the rollover.", "Aione"),
			"id" => "image_rollover_icon_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Toggle Icon Color", "Aione"),
			"desc" => __("Controls the icon color of the sliding bar toggle.", "Aione"),
			"id" => "slidingbar_toggle_icon_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Item Divider Color", "Aione"),
			"desc" => __("Controls the divider color in the sliding bar.", "Aione"),
			"id" => "slidingbar_divider_color",
			"std" => "#282A2B",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Widget Divider Color", "Aione"),
			"desc" => __("Controls the divider color in the footer.", "Aione"),
			"id" => "footer_divider_color",
			"std" => "#505152",
			"type" => "color");

		$of_options[] = array( "name" => __("Form Background Color", "Aione"),
			"desc" => __("Controls the background color of form fields.", "Aione"),
			"id" => "form_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Form Text Color", "Aione"),
			"desc" => __("Controls the text color for forms.", "Aione"),
			"id" => "form_text_color",
			"std" => "#aaa9a9",
			"type" => "color");

		$of_options[] = array( "name" => __("Form Border Color", "Aione"),
			"desc" => __("Controls the border color of form fields.", "Aione"),
			"id" => "form_border_color",
			"std" => "#d2d2d2",

			"type" => "color");

		$of_options[] = array( "name" => __("Grid Box Color", "Aione"),
			"desc" => __("Controls blog grid, timeline, portfolio boxed items and Woocommerce post box background color.", "Aione"),
			"id" => "timeline_bg_color",
			"std" => "transparent",
			"type" => "color");

		$of_options[] = array( "name" => __("Grid Element Color", "Aione"),
			"desc" => __("Controls blog grid, timeline, portfolio boxed items, Woocommerce post box border, divider lines, date box and border, timeline dots, timeline icon, timeline arrow.", "Aione"),
			"id" => "timeline_color",
			"std" => "#ebeaea",
			"type" => "color");

		$of_options[] = array( "name" => __("Load More Posts Button Color", "Aione"),
			"desc" => __("Controls the background color of the load more button for ajax post loading.", "Aione"),
			"id" => "load_more_posts_button_bg_color",
			"std" => "#ebeaea",
			"type" => "color");

		$of_options[] = array( "name" => __("Woo Quantity Box Background Color", "Aione"),
			"desc" => __("Controls the background color of the woocommerce quantity box.", "Aione"),
			"id" => "qty_bg_color",
			"std" => "#fbfaf9",
			"type" => "color");

		$of_options[] = array( "name" => __("Woo Quantity Box Hover Background Color", "Aione"),
			"desc" => __("Controls the hover color of the woocommerce quantity box.", "Aione"),
			"id" => "qty_bg_hover_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("WooCommerce Dropdown Background Color", "Aione"),
			"desc" => __("Controls the background color.", "Aione"),
			"id" => "woo_dropdown_bg_color",
			"std" => "#fbfaf9",
			"type" => "color");

		$of_options[] = array( "name" => __("WooCommerce Dropdown Text Color", "Aione"),
			"desc" => __("Controls the color of the text and icons.", "Aione"),
			"id" => "woo_dropdown_text_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("WooCommerce Dropdown Border Color", "Aione"),
			"desc" => __("Controls the border color.", "Aione"),
			"id" => "woo_dropdown_border_color",
			"std" => "#dbdbdb",
			"type" => "color");

	   $of_options[] = array( "name" => __("Element Colors", "Aione"),
			"desc" => "",
			"id" => "element_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Element Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Layout Options", "Aione"),
			"desc" => "",
			"id" => "element_options_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Layout Options", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Page Content Top Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "main_top_padding",
			"std" => "55px",
			"type" => "text");

		$of_options[] = array( "name" => __("Page Content Bottom Padding", "Aione"),
			"desc" => __("In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "main_bottom_padding",
			"std" => "40px",
			"type" => "text");

		$of_options[] = array( "name" => __("100% Width Left/Right Padding", "Aione"),
			"desc" => __("This option controls the left/right padding for page content when using 100% site width or 100% width page template.  In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "hundredp_padding",
			"std" => "30px",
			"type" => "text");

		$of_options[] = array( "name" => __("Sidebar Padding", "Aione"),
			"desc" => __("Enter a pixel or percentage based value, ex: 5px or 5%", "Aione"),
			"id" => "sidebar_padding",
			"std" => "0",
			"type" => "text");

		$of_options[] = array( "name" => __("Column Top Margin", "Aione"),
			"desc" => __("Controls the top margin for all column sizes. In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "col_top_margin",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Column Bottom Margin", "Aione"),
			"desc" => __("Controls the bottom margin for all column sizes. In pixels or percentage, ex: 10px or 10%.", "Aione"),
			"id" => "col_bottom_margin",
			"std" => "20px",
			"type" => "text");

		$of_options[] = array( "name" => __("Disable Sliding Bar Text Shadow", "Aione"),
			"desc" => __("Check to disable the text shadow in the Sliding Bar.", "Aione"),
			"id" => "slidingbar_text_shadow",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Rollover Text Shadow", "Aione"),
			"desc" => __("Check to disable the text shadow on rollovers.", "Aione"),
			"id" => "rollover_text_shadow",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Footer Text Shadow", "Aione"),
			"desc" => __("Check to disable the text shadow in the footer.", "Aione"),
			"id" => "footer_text_shadow",
			"std" => 1,
			"type" => "checkbox");

	   $of_options[] = array( "name" => __("Layout Options", "Aione"),
			"desc" => "",
			"id" => "element_options_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Layout Options", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Font Colors", "Aione"),
			"desc" => "",
			"id" => "font_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Font Colors", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Header Tagline Font Color", "Aione"),
			"desc" => __("Controls the text color of the header tagline font.", "Aione"),
			"id" => "tagline_font_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Page Title Font Color", "Aione"),
			"desc" => __("Controls the text color of the page title font.", "Aione"),
			"id" => "page_title_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 1 (H1) Font Color", "Aione"),
			"desc" => __("Controls the text color of H1 headings.", "Aione"),
			"id" => "h1_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 2 (H2) Font Color", "Aione"),
			"desc" => __("Controls the text color of H2 headings.", "Aione"),
			"id" => "h2_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 3 (H3) Font Color", "Aione"),
			"desc" => __("Controls the text color of H3 headings.", "Aione"),
			"id" => "h3_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 4 (H4) Font Color", "Aione"),
			"desc" => __("Controls the text color of H4 headings.", "Aione"),
			"id" => "h4_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 5 (H5) Font Color", "Aione"),
			"desc" => __("Controls the text color of H5 headings.", "Aione"),
			"id" => "h5_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Heading 6 (H6) Font Color", "Aione"),
			"desc" => __("Controls the text color of H6 headings.", "Aione"),
			"id" => "h6_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Body Text Color", "Aione"),
			"desc" => __("Controls the text color of body font.", "Aione"),
			"id" => "body_text_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Link Color", "Aione"),
			"desc" => __("Controls the color of all text links as well as the '>' in certain areas.", "Aione"),
			"id" => "link_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Breadcrumbs Text Color", "Aione"),
			"desc" => __("Controls the text color of the breadcrumb font.", "Aione"),
			"id" => "breadcrumbs_text_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Headings Color", "Aione"),
			"desc" => __("Controls the text color of the sliding bar heading font.", "Aione"),
			"id" => "slidingbar_headings_color",
			"std" => "#DDDDDD",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Font Color", "Aione"),
			"desc" => __("Controls the font color of the sliding bar font.", "Aione"),
			"id" => "slidingbar_text_color",
			"std" => "#8C8989",
			"type" => "color");

		$of_options[] = array( "name" => __("Sliding Bar Link Color", "Aione"),
			"desc" => __("Controls the text color of the sliding bar link font.", "Aione"),
			"id" => "slidingbar_link_color",
			"std" => "#BFBFBF",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Widget Headings Color", "Aione"),
			"desc" => __("Controls the text color of the sidebar widget headings.", "Aione"),
			"id" => "sidebar_heading_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Headings Color", "Aione"),
			"desc" => __("Controls the text color of the footer heading font.", "Aione"),
			"id" => "footer_headings_color",
			"std" => "#DDDDDD",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Font Color", "Aione"),
			"desc" => __("Controls the text color of the footer font.", "Aione"),
			"id" => "footer_text_color",
			"std" => "#8C8989",
			"type" => "color");

		$of_options[] = array( "name" => __("Footer Link Color", "Aione"),
			"desc" => __("Controls the text color of the footer link font.", "Aione"),
			"id" => "footer_link_color",
			"std" => "#BFBFBF",
			"type" => "color");

	   $of_options[] = array( "name" => __("Font Colors", "Aione"),
			"desc" => "",
			"id" => "font_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Font Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Main Menu Colors", "Aione"),
			"desc" => "",
			"id" => "main_menu_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Main Menu Colors", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Main Menu Background Color For Header 4 & 5", "Aione"),
			"desc" => __("Controls the background color of the menu when using header 4 or 5.", "Aione"),
			"id" => "menu_h45_bg_color",
			"std" => "#FFFFFF",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Font Color - First Level", "Aione"),
			"desc" => __("Controls the text color of first level menu items.", "Aione"),
			"id" => "menu_first_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Font Hover Color - First Level", "Aione"),
			"desc" => __("Controls the main menu hover, hover border, dropdown border color & active menu item.", "Aione"),
			"id" => "menu_hover_first_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Background Color - Sublevels", "Aione"),
			"desc" => __("Controls the color of the menu sublevel background.", "Aione"),
			"id" => "menu_sub_bg_color",
			"std" => "#f2efef",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Background Hover Color - Sublevels", "Aione"),
			"desc" => __("Controls the hover color of the menu sublevel background.", "Aione"),
			"id" => "menu_bg_hover_color",
			"std" => "#f8f8f8",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Font Color - Sublevels", "Aione"),
			"desc" => __("Controls the color of the menu font sublevels.", "Aione"),
			"id" => "menu_sub_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Main Menu Separator - Sublevels", "Aione"),
			"desc" => __("Controls the color of the menu separator sublevels.", "Aione"),
			"id" => "menu_sub_sep_color",
			"std" => "#dcdadb",
			"type" => "color");

		$of_options[] = array( "name" => __("Woo Cart Menu Background Color", "Aione"),
			"desc" => __("Controls the bottom section background color of the woocommerce cart dropdown.", "Aione"),
			"id" => "woo_cart_bg_color",
			"std" => "#fafafa",
			"type" => "color");

	   $of_options[] = array( "name" => __("Main Menu Colors", "Aione"),
			"desc" => "",
			"id" => "main_menu_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Main Menu Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Secondary Menu Colors", "Aione"),
			"desc" => "",
			"id" => "menu_colors_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Secondary Menu Colors", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Secondary Menu Font Color - First Level & Contact Info", "Aione"),
			"desc" => __("Controls the color of the secondary menu first level and contact info font.", "Aione"),
			"id" => "snav_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Divider Color - First Level", "Aione"),
			"desc" => __("Controls the divider color of the first level secondary menu.", "Aione"),
			"id" => "header_top_first_border_color",
			"std" => "#e5e5e5",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Background Color - Sublevels", "Aione"),
			"desc" => __("Controls the background color of the secondary menu sublevels.", "Aione"),
			"id" => "header_top_sub_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Font Color - Sublevels", "Aione"),
			"desc" => __("Controls the text color of the secondary menu font sublevels.", "Aione"),
			"id" => "header_top_menu_sub_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Hover Background Color - Sublevels", "Aione"),
			"desc" => __("Controls the hover color of the secondary menu background sublevels.", "Aione"),
			"id" => "header_top_menu_bg_hover_color",
			"std" => "#fafafa",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Hover Font Color - Sublevels", "Aione"),
			"desc" => __("Controls the hover text color of the secondary menu font sublevels.", "Aione"),
			"id" => "header_top_menu_sub_hover_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Border  - Sublevels", "Aione"),
			"desc" => __("Controls the border color of the secondary menu sublevels.", "Aione"),
			"id" => "header_top_menu_sub_sep_color",
			"std" => "#e5e5e5",
			"type" => "color");

		$of_options[] = array( "name" => __("Secondary Menu Colors", "Aione"),
			"desc" => "",
			"id" => "menu_colors_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Secondary Menu Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Mobile Menu Colors", "Aione"),
			"desc" => "",
			"id" => "mobile_menu_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Menu Colors", "Aione"). "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Mobile Header Background Color", "Aione"),
			"desc" => __("Controls the background color of the header on mobile devices.", "Aione"),
			"id" => "mobile_header_bg_color",
			"std" => '#ffffff',
			"type" => "color");

		$of_options[] = array( "name" => __("Mobile Menu Background Color", "Aione"),
			"desc" => __("Controls the background color of the mobile menu box and dropdown.", "Aione"),
			"id" => "mobile_menu_background_color",
			"std" => "#f9f9f9",
			"type" => "color");

		$of_options[] = array( "name" => __("Mobile Menu Border Color", "Aione"),
			"desc" => __("Controls the border and divider of the mobile menu.", "Aione"),
			"id" => "mobile_menu_border_color",
			"std" => "#dadada",
			"type" => "color");

		$of_options[] = array( "name" => __("Mobile Menu Hover Color", "Aione"),
			"desc" => __("Controls the background hover color of the mobile menu items.", "Aione"),
			"id" => "mobile_menu_hover_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Mobile Menu Font Color", "Aione"),
			"desc" => __("Controls the text color of mobile menu items.", "Aione"),
			"id" => "mobile_menu_font_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Mobile Menu Toggle Color", "Aione"),
			"desc" => __("Controls the color of the mobile menu toggle icon", "Aione"),
			"id" => "mobile_menu_toggle_color",
			"std" => ( isset( $smof_data['mobile_menu_border_color'] ) ) ? $smof_data['mobile_menu_border_color'] : "#dadada",
			"type" => "color");


	   $of_options[] = array( "name" => __("Mobile Menu Colors", "Aione"),
			"desc" => "",
			"id" => "mobile_menu_colors_wrapper",
			"std" => "<h3 style='margin: 0;'>" . __("Mobile Menu Colors", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Shortcodes", "Aione"),
			"id" => "heading_shortcode_styling",
			"type" => "heading");

		$of_options[] = array( "name" => __("Animation Offset", "Aione"),
			"desc" => __("Choose when the animation should start.", "Aione"),
			"id" => "animation_offset",
			"std" => 'top-into-view',
			"type" => "select",
			"options" => array(
					'top-into-view' 	=> 'Top of element hits bottom of viewport',
					'top-mid-of-view' 	=> 'Top of element hits middle of viewport',
					'bottom-in-view' 	=> 'Bottom of element enters viewport',
					)
			);

	   $of_options[] = array( "name" => __("Blog Shortcode", "Aione"),
			"desc" => "",
			"id" => "blog_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Blog Date Box Color", "Aione"),
			"desc" => __("Controls the color of the date box in blog alternate and recent posts layouts.", "Aione"),
			"id" => "dates_box_color",
			"std" => "#eef0f2",
			"type" => "color");

	   $of_options[] = array( "name" => __("Blog Shortcode", "Aione"),
			"desc" => "",
			"id" => "blog_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Button Shortcode", "Aione"),
			"desc" => "",
			"id" => "button_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Button Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Button Size", "Aione"),
			"desc" => __("Select the default button size.", "Aione"),
			"id" => "button_size",
			"std" => "Large",
			"type" => "select",
			"options" => array('Small' => 'Small', 'Medium' => 'Medium', 'Large' => 'Large', 'XLarge' => 'XLarge'));

		$of_options[] = array( "name" => __("Button Span", "Aione"),
			"desc" => __("Choose to have the button span the full width of its container.", "Aione"),
			"id" => "button_span",
			"std" => "no",
			"type" => "select",
			"options" => array('yes' => 'Yes', 'no' => 'No'));

		$of_options[] = array( "name" => __("Button Shape", "Aione"),
			"desc" => __("Select the default shape for buttons.", "Aione"),
			"id" => "button_shape",
			"std" => "Round",
			"type" => "select",
			"options" => array('Square' => 'Square', 'Round' => 'Round', 'Pill' => 'Pill'));

		$of_options[] = array( "name" => __("Button Type", "Aione"),
			"desc" => __("Select the default button type.", "Aione"),
			"id" => "button_type",
			"std" => "Flat",
			"type" => "select",
			"options" => array('Flat' => 'Flat', '3d' => '3d'));

		$of_options[] = array( "name" => __("Button Gradient Top Color", "Aione"),
			"desc" => __("Set the top color of the button background.", "Aione"),
			"id" => "button_gradient_top_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Gradient Bottom Color", "Aione"),
			"desc" => __("Set the bottom color of the button background or leave empty for solid color.", "Aione"),
			"id" => "button_gradient_bottom_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Gradient Top Hover Color", "Aione"),
			"desc" => __("Set the top hover color of the button background.", "Aione"),
			"id" => "button_gradient_top_color_hover",
			"std" => "#96c346",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Gradient Bottom Hover Color", "Aione"),
			"desc" => __("Set the bottom hover color of the button background or leave empty for solid color. ", "Aione"),
			"id" => "button_gradient_bottom_color_hover",
			"std" => "#96c346",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Accent Color", "Aione"),
			"desc" => __("This option controls the color of the button border, divider, text and icon.", "Aione"),
			"id" => "button_accent_color",
			"std" => "#fff",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Accent Hover Color", "Aione"),
			"desc" => __("This option controls the hover color of the button border, divider, text and icon.", "Aione"),
			"id" => "button_accent_hover_color",
			"std" => "#fff",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Bevel Color (3D Mode only)", "Aione"),
			"desc" => __("Controls the default bevel color of the buttons.", "Aione"),
			"id" => "button_bevel_color",
			"std" => "#54770F",
			"type" => "color");

		$of_options[] = array( "name" => __("Button Border Width", "Aione"),
			"desc" => __("Select the border width for buttons. Enter value in px. ex: 1px", "Aione"),
			"id" => "button_border_width",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Button Shortcode", "Aione"),
			"desc" => "",
			"id" => "button_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Button Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Carousel Shortcode", "Aione"),
			"desc" => "",
			"id" => "carousel_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Carousel Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Carousel Default Nav Box Color", "Aione"),
			"desc" => __("Controls the color of the default navigation box for carousel sliders.", "Aione"),
			"id" => "carousel_nav_color",
			"std" => "rgba(0,0,0,0.6)",
			"type" => "color");

		$of_options[] = array( "name" => __("Carousel Hover Nav Box Color", "Aione"),
			"desc" => __("Controls the color of the hover navigation box for carousel sliders.", "Aione"),
			"id" => "carousel_hover_color",
			"std" => "rgba(0,0,0,0.7)",
			"type" => "color");

		$of_options[] = array( "name" => __("Carousel Speed", "Aione"),
			"desc" => __("Controls the speed of all carousel elements.  ex: 1000 = 1 second.", "Aione"),
			"id" => "carousel_speed",
			"std" => "2500",
			"type" => "text");

		$of_options[] = array( "name" => __("Carousel Shortcode", "Aione"),
			"desc" => "",
			"id" => "carousel_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Carousel Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Checklist Shortcode", "Aione"),
			"desc" => "",
			"id" => "checklist_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Checklist Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Checklist Circle", "Aione"),
			"desc" => __("Check the box if you want to use circles on checklists.", "Aione"),
			"id" => "checklist_circle",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Checklist Circle Color", "Aione"),
			"desc" => __("Controls the color of the checklist circle.", "Aione"),
			"id" => "checklist_circle_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Checklist Icon Color", "Aione"),
			"desc" => __("Controls the color of the checklist icon.", "Aione"),
			"id" => "checklist_icons_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Checklist Shortcode", "Aione"),
			"desc" => "",
			"id" => "checklist_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Checklist Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Content Box Shortcode", "Aione"),
			"desc" => "",
			"id" => "cb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Content Box Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Content Box Background Color", "Aione"),
			"desc" => __("Controls the color of the background for content boxes. Only use for 'icon-boxed' style. Leave transparent for other styles.", "Aione"),
			"id" => "content_box_bg_color",
			"std" => "transparent",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Title Font Size", "Aione"),
			"desc" => __("Controls the size of the title text. In pixels. Default is 18.", "Aione"),
			"id" => "content_box_title_size",
			"std" => "18",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Title Font Color", "Aione"),
			"desc" => __("Controls the color of the title font.", "Aione"),
			"id" => "content_box_title_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Body Font Color", "Aione"),
			"desc" => __("Controls the color of the body font.", "Aione"),
			"id" => "content_box_body_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Icon Background", "Aione"),
			"desc" => __("Controls the background behind the icon.", "Aione"),
			"id" => "content_box_icon_circle",
			"std" => "yes",
			"type" => "select",
			"options" => array('yes' => 'Yes', 'no' => 'No'));

		$of_options[] = array( "name" => __("Content Box Icon Background Radius", "Aione"),
			"desc" => __("Choose the border radius of the icon background. In pixels (px), ex: 1px, or \"round\".", "Aione"),
			"id" => "content_box_icon_circle_radius",
			"std" => "round",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Icon Color", "Aione"),
			"desc" => __("Controls the color of the content box icon.", "Aione"),
			"id" => "content_box_icon_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Icon Background Color", "Aione"),
			"desc" => __("Controls the background color of the content box icon.", "Aione"),
			"id" => "content_box_icon_bg_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Icon Background Inner Border Color", "Aione"),
			"desc" => __("Controls the inner border color of the content box icon border.", "Aione"),
			"id" => "content_box_icon_bg_inner_border_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Icon Background Inner Border Size", "Aione"),
			"desc" => __("Controls the inner border size of the content box icon border.", "Aione"),
			"id" => "content_box_icon_bg_inner_border_size",
			"std" => "1px",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Icon Background Outer Border Color", "Aione"),
			"desc" => __("Controls the outer boreder color of the content box icon border.", "Aione"),
			"id" => "content_box_icon_bg_outer_border_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Icon Background Outer Border Size", "Aione"),
			"desc" => __("Controls the outer border size of the content box icon border.", "Aione"),
			"id" => "content_box_icon_bg_outer_border_size",
			"std" => "",
			"type" => "text");


		$of_options[] = array( "name" => __("Content Box Icon Font Size", "Aione"),
			"desc" => __("Controls the size of the icon. In pixels. Default is 21.", "Aione"),
			"id" => "content_box_icon_size",
			"std" => "21",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Icon Hover Animation Type", "Aione"),
			"desc" => __("Controls the hover effect of the icon.", "Aione"),
			"id" => "content_box_icon_hover_type",
			"std" => "fade",
			"type" => "select",
			"options" => array('none' => __('None', 'Aione'), 'fade' => __('Fade', 'Aione'), 'slide' => __('Slide', 'Aione'), 'pulsate' => __('Pulsate', 'Aione')));

		$of_options[] = array( "name" => __("Content Box Hover Animation Accent Color", "Aione"),
			"desc" => __("Controls the accent color for the hover animation.", "Aione"),
			"id" => "content_box_hover_animation_accent_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Content Box Link Type", "Aione"),
			"desc" => __("Select the type of link that should show in the content box.", "Aione"),
			"id" => "content_box_link_type",
			"std" => "text",
			"type" => "select",
			"options" => array('text' => 'Text', 'button-bar' => 'Button Bar', 'button' => 'Button'));

		$of_options[] = array( "name" => __("Content Box Link Area", "Aione"),
			"desc" => __("Select which area the link will be assigned to.", "Aione"),
			"id" => "content_box_link_area",
			"std" => "link-icon",
			"type" => "select",
			"options" => array('link-icon' => 'Link+Icon', 'box' => 'Entire Content Box'));

		$of_options[] = array( "name" => __("Content Box Link Target", "Aione"),
			"desc" => __("_self = open in same window<br>_blank = open in new window. Select default for theme option selection.", "Aione"),
			"id" => "content_box_link_target",
			"std" => "_self",
			"type" => "select",
			"options" => array('_self' => '_self', '_blank' => '_blank'));

		$of_options[] = array( "name" => __("Content Box Margin Top", "Aione"),
			"desc" => __("In pixels, ex: 1px.", "Aione"),
			"id" => "content_box_margin_top",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Margin Bottom", "Aione"),
			"desc" => __("In pixels, ex: 1px.", "Aione"),
			"id" => "content_box_margin_bottom",
			"std" => "60px",
			"type" => "text");

		$of_options[] = array( "name" => __("Content Box Shortcode", "Aione"),
			"desc" => "",
			"id" => "cb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Content Box Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Countdown Shortcode", "Aione"),
			"desc" => "",
			"id" => "countdown_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Countdown Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Countdown Timezone", "Aione"),
			"desc" => __("Choose which timezone should be used for the countdown calculation.", "Aione"),
			"id" => "countdown_timezone",
			"std" => 'site_time',
			"type" => "select",
			"options" => array( 'site_time' => 'Site Timezone', 'user_time' => 'User Timezone' ));

		$of_options[] = array( "name" => __("Countdown Show Weeks", "Aione"),
			"desc" => __("Select 'yes' to show weeks for longer countdowns.", "Aione"),
			"id" => "countdown_show_weeks",
			"std" => 'no',
			"type" => "select",
			"options" => array( 'no' => 'No', 'yes' => 'Yes' ));

		$of_options[] = array( "name" => __("Countdown Background Color", "Aione"),
			"desc" => __("Choose a background color for the countdown wrapping box.", "Aione"),
			"id" => "countdown_background_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Background Image", "Aione"),
			"desc" => __("Select an image or insert an image url to use for the background of the countdown wrapping box.", "Aione"),
			"id" => "countdown_background_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("Countdown Background Repeat", "Aione"),
			"desc" => __("Select how the background image repeats.", "Aione"),
			"id" => "countdown_background_repeat",
			"std" => "no-repeat",
			"type" => "select",
			"options" => array('repeat' => 'repeat', 'repeat-x' => 'repeat-x', 'repeat-y' => 'repeat-y', 'no-repeat' => 'no-repeat'));

		$of_options[] = array( "name" => __("Countdown Background Position", "Aione"),
			"desc" => __("Select the position from where background image starts.", "Aione"),
			"id" => "countdown_background_position",
			"std" => "center center",
			"type" => "select",
			"options" => $body_pos);

		$of_options[] = array( "name" => __("Countdown Counter Box Color", "Aione"),
			"desc" => __("Choose a background color for the counter boxes.", "Aione"),
			"id" => "countdown_counter_box_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Counter Text Color", "Aione"),
			"desc" => __("Choose a text color for the countdown timer.", "Aione"),
			"id" => "countdown_counter_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Heading Text Color", "Aione"),
			"desc" => __("Choose a heading text color for the countdown.", "Aione"),
			"id" => "countdown_heading_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Subheading Text Color", "Aione"),
			"desc" => __("Choose a subheading text color for the countdown.", "Aione"),
			"id" => "countdown_subheading_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Link Text Color", "Aione"),
			"desc" => __("Choose a text color for the countdown link.", "Aione"),
			"id" => "countdown_link_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Countdown Link Target", "Aione"),
			"desc" => __("_self = open in same window<br>_blank = open in new window.", "Aione"),
			"id" => "countdown_link_target",
			"std" => "_self",
			"type" => "select",
			"options" => array('_self' => '_self', '_blank' => '_blank'));

		$of_options[] = array( "name" => __("Countdown Shortcode", "Aione"),
			"desc" => "",
			"id" => "countdown_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Countdown Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Counter Boxes Shortcode", "Aione"),
			"desc" => "",
			"id" => "counterb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Counter Boxes Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Counter Box Title Font Color", "Aione"),
			"desc" => __("Controls the color of the counter \"value\" and icon.", "Aione"),
			"id" => "counter_box_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Counter Box Title Font Size", "Aione"),
			"desc" => __("Controls the size of the counter \"value\" and icon. Enter the font size without 'px'. Default is 50.", "Aione"),
			"id" => "counter_box_title_size",
			"std" => "50",
			"type" => "text");

		$of_options[] = array( "name" => __("Counter Box Icon Size", "Aione"),
			"desc" => __("Controls the size of the icon. Enter the font size without 'px'. Default is 50.", "Aione"),
			"id" => "counter_box_icon_size",
			"std" => "50",
			"type" => "text");

		$of_options[] = array( "name" => __("Counter Box Body Font Color", "Aione"),
			"desc" => __("Controls the color of the counter body text.", "Aione"),
			"id" => "counter_box_body_color",
			"std" => '#747474',
			"type" => "color");

		$of_options[] = array( "name" => __("Counter Box Body Font Size", "Aione"),
			"desc" => __("Controls the size of the counter body text. Enter the font size without 'px'. Default is 13.", "Aione"),
			"id" => "counter_box_body_size",
			"std" => "13",
			"type" => "text");

		$of_options[] = array( "name" => __("Counter Box Border Color", "Aione"),
			"desc" => __("Controls the color of the border.", "Aione"),
			"id" => "counter_box_border_color",
			"std" => "#e0dede",
			"type" => "color");

		$of_options[] = array( "name" => __("Counter Box Icon on Top", "Aione"),
			"desc" => __("Controls the position of the icon.", "Aione"),
			"id" => "counter_box_icon_top",
			"std" => 'no',
			"type" => "select",
			"options" => array( 'no' => 'No', 'yes' => 'Yes' ));

		$of_options[] = array( "name" => __("Counter Boxes Shortcode", "Aione"),
			"desc" => "",
			"id" => "counterb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Counter Boxes Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Counter Circle Shortcode", "Aione"),
			"desc" => "",
			"id" => "cc_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Counter Circles Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Counter Circle Filled Color", "Aione"),
			"desc" => __("Controls the color of the unfilled circle.", "Aione"),
			"id" => "counter_filled_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Counter Circle Unfilled Color", "Aione"),
			"desc" => __("Controls the color of the filled circle.", "Aione"),
			"id" => "counter_unfilled_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Counter Circle Shortcode", "Aione"),
			"desc" => "",
			"id" => "cc_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Counter Circle Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Dropcap Shortcode", "Aione"),
			"desc" => "",
			"id" => "dropcap_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Dropcap Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Dropcap Color", "Aione"),
			"desc" => __("Controls the color of the dropcap text, or the dropcap box if a box is used.", "Aione"),
			"id" => "dropcap_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Dropcap Shortcode", "Aione"),
			"desc" => "",
			"id" => "dropcap_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Dropcap Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Flip Boxes Shortcode", "Aione"),
			"desc" => "",
			"id" => "flipb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Flip Boxes Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Flip Box Background Color Frontside", "Aione"),
			"desc" => __("Controls the color of frontside background color.", "Aione"),
			"id" => "flip_boxes_front_bg",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Heading Color Frontside", "Aione"),
			"desc" => __("Controls the color of frontside heading color.", "Aione"),
			"id" => "flip_boxes_front_heading",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Text Color Frontside", "Aione"),
			"desc" => __("Controls the color of frontside text color.", "Aione"),
			"id" => "flip_boxes_front_text",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Background Color Backside", "Aione"),
			"desc" => __("Controls the color of backside background color.", "Aione"),
			"id" => "flip_boxes_back_bg",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Heading Color Backside", "Aione"),
			"desc" => __("Controls the color of backside heading color.", "Aione"),
			"id" => "flip_boxes_back_heading",
			"std" => "#eeeded",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Text Color Backside", "Aione"),
			"desc" => __("Controls the color of backside text color.", "Aione"),
			"id" => "flip_boxes_back_text",
			"std" => "#ffffff",
			"type" => "color");


		$of_options[] = array( "name" => __("Flip Box Border Size", "Aione"),
			"desc" => __("Controls the border size of flip boxes.", "Aione"),
			"id" => "flip_boxes_border_size",
			"std" => "1px",
			"type" => "text");

		$of_options[] = array( "name" => __("Flip Box Border Color", "Aione"),
			"desc" => __("Controls the border color of flip boxes.", "Aione"),
			"id" => "flip_boxes_border_color",
			"std" => "transparent",
			"type" => "color");

		$of_options[] = array( "name" => __("Flip Box Border Radius", "Aione"),
			"desc" => __("Controls the border radius (roundness) of flip boxes.", "Aione"),
			"id" => "flip_boxes_border_radius",
			"std" => "4px",
			"type" => "text");

		$of_options[] = array( "name" => __("Flip Boxes Shortcode", "Aione"),
			"desc" => "",
			"id" => "flipb_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Flip Boxes Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Full Width Shortcode", "Aione"),
			"desc" => "",
			"id" => "fullwidth_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Full Width Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Full Width Background Color", "Aione"),
			"desc" => __("Controls the background color of the full width section.", "Aione"),
			"id" => "full_width_bg_color",
			"std" => "",
			"type" => "color");

	   $of_options[] = array( "name" => __("Full Width Border Size", "Aione"),
			"desc" => __("Controls the border size of the full width section.", "Aione"),
			"id" => "full_width_border_size",
			"std" => "0px",
			"type" => "text");

	   $of_options[] = array( "name" => __("Full Width Border Color", "Aione"),
			"desc" => __("Controls the border color of the full width section.", "Aione"),
			"id" => "full_width_border_color",
			"std" => "#eae9e9",
			"type" => "color");

		$of_options[] = array( "name" => __("Full Width Shortcode", "Aione"),
			"desc" => "",
			"id" => "fullwidth_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Full Width Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Icon Shortcode", "Aione"),
			"desc" => "",
			"id" => "icon_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Icon Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Icon Circle Background Color", "Aione"),
			"desc" => __("Controls the color of the circle when used with icons.", "Aione"),
			"id" => "icon_circle_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Icon Circle Border Color", "Aione"),
			"desc" => __("Controls the color of the circle border when used with icons.", "Aione"),
			"id" => "icon_border_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Icon Color", "Aione"),
			"desc" => __("Controls the color of the icons.", "Aione"),
			"id" => "icon_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Icon Shortcode", "Aione"),
			"desc" => "",
			"id" => "icon_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Icon Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Image Frame Shortcode", "Aione"),
			"desc" => "",
			"id" => "imgf_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Image Frame Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Image Frame Border Color", "Aione"),
			"desc" => __("Controls the border color of the image frame.", "Aione"),
			"id" => "imgframe_border_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Image Frame Border Size", "Aione"),
			"desc" => __("Controls the border size of the image. In pixels, ex: 4px.", "Aione"),
			"id" => "imageframe_border_size",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Image Frame Border Radius", "Aione"),
			"desc" => __("Controls the border radius of the image. In pixels, ex: 4px.", "Aione"),
			"id" => "imageframe_border_radius",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Image Frame Style Color", "Aione"),
			"desc" => __("Controls the style color of the image frame. Only works for glow and dropshadow style.", "Aione"),
			"id" => "imgframe_style_color",
			"std" => "#000000",
			"type" => "color");

		$of_options[] = array( "name" => __("Image Frame Shortcode", "Aione"),
			"desc" => "",
			"id" => "imgf_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Image Frame Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Modal Shortcode", "Aione"),
			"desc" => "",
			"id" => "modal_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Modal Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Modal Background Color", "Aione"),
			"desc" => __("Controls the background color of the modal popup box", "Aione"),
			"id" => "modal_bg_color",
			"std" => "#f6f6f6",
			"type" => "color");

	   $of_options[] = array( "name" => __("Modal Border Color", "Aione"),
			"desc" => __("Controls the border color of the modal popup box", "Aione"),
			"id" => "modal_border_color",
			"std" => "#ebebeb",
			"type" => "color");

		$of_options[] = array( "name" => __("Modal Shortcode", "Aione"),
			"desc" => "",
			"id" => "modal_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Modal Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Person Shortcode", "Aione"),
			"desc" => "",
			"id" => "person_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Person Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Person Background Color", "Aione"),
			"desc" => __("Controls the background color.", "Aione"),
			"id" => "person_background_color",
			"std" => "",
			"type" => "color");

			$of_options[] = array( "name" => __("Person Text Color", "Aione"),
			"desc" => __("Controls the text color.", "Aione"),
			"id" => "person_text_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Person Border Color", "Aione"),
			"desc" => __("Controls the border color of the of the image.", "Aione"),
			"id" => "person_border_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Person Border Size", "Aione"),
			"desc" => __("Controls the border size of the image. In pixels, ex: 4px.", "Aione"),
			"id" => "person_border_size",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Person Border Radius", "Aione"),
			"desc" => __("Controls the border radius of the image. In pixels, ex: 4px.", "Aione"),
			"id" => "person_border_radius",
			"std" => "0px",
			"type" => "text");

		$of_options[] = array( "name" => __("Person Style Color", "Aione"),
			"desc" => __("For all style types except border. Controls the style color. ", "Aione"),
			"id" => "person_style_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Person Content Alignment", "Aione"),
			"desc" => __("Choose the alignment of content.", "Aione"),
			"id" => "person_alignment",
			"std" => "Left",
			"type" => "select",
			"options" => array( 'Left' => 'Left', 'Center' => 'Center', 'Right' => 'Right' ));

		$of_options[] = array( "name" => __("Person Icons Position", "Aione"),
			"desc" => __("Choose the social icon position.", "Aione"),
			"id" => "person_icon_position",
			"std" => 'Top',
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Bottom' => 'Bottom' ));

		$of_options[] = array( "name" => __("Person Shortcode", "Aione"),
			"desc" => "",
			"id" => "person_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Person Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Popover Shortcode", "Aione"),
			"desc" => "",
			"id" => "popover_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Popover Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Popover Heading Background Color", "Aione"),
			"desc" => __("Controls the background color of popover heading area.", "Aione"),
			"id" => "popover_heading_bg_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Popover Content Background Color", "Aione"),
			"desc" => __("Controls the background color of popover content area.", "Aione"),
			"id" => "popover_content_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Popover Border Color", "Aione"),
			"desc" => __("Controls the border color of popover box.", "Aione"),
			"id" => "popover_border_color",
			"std" => "#ebebeb",
			"type" => "color");

		$of_options[] = array( "name" => __("Popover Text Color", "Aione"),
			"desc" => __("Controls the text color inside the popover box. ", "Aione"),
			"id" => "popover_text_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Popover Position", "Aione"),
			"desc" => __("Controls the position of the popover in reference to the triggering text.", "Aione"),
			"id" => "popover_placement",
			"std" => "Top",
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left' ));

		$of_options[] = array( "name" => __("Popover Shortcode", "Aione"),
			"desc" => "",
			"id" => "popover_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Popover Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Pricing Table Shortcode", "Aione"),
			"desc" => "",
			"id" => "pricingtable_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Pricing Table Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Pricing Box Style 1 Heading Color", "Aione"),
			"desc" => __("Controls the heading color of full boxed (style 1) pricing tables.", "Aione"),
			"id" => "full_boxed_pricing_box_heading_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Box Style 2 Heading Color", "Aione"),
			"desc" => __("Controls the heading color of separate (style 2) pricing boxes.", "Aione"),
			"id" => "sep_pricing_box_heading_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Box Color", "Aione"),
			"desc" => __("Controls the color portions of pricing boxes.", "Aione"),
			"id" => "pricing_box_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Box Background Color", "Aione"),
			"desc" => __("Controls the color of main background and title background.", "Aione"),
			"id" => "pricing_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Box Border Color", "Aione"),
			"desc" => __("Controls the color of the outer border, pricing row and footer row backgrounds.", "Aione"),
			"id" => "pricing_border_color",
			"std" => "#f8f8f8",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Box Divider Color", "Aione"),
			"desc" => __("Controls the color of the dividers in-between pricing rows.", "Aione"),
			"id" => "pricing_divider_color",
			"std" => "#ededed",
			"type" => "color");

		$of_options[] = array( "name" => __("Pricing Table Shortcode", "Aione"),
			"desc" => "",
			"id" => "pricingtable_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Pricing Table Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Progress Bar Shortcode", "Aione"),
			"desc" => "",
			"id" => "progressbar_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Progress Bar Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Progress Bar Filled Color", "Aione"),
			"desc" => __("Controls the color of the filled area in progress bars.", "Aione"),
			"id" => "progressbar_filled_color",
			"std" => "#a0ce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Progress Bar Filled Border Color", "Aione"),
			"desc" => __("Controls the border color of the filled area in progress bars.", "Aione"),
			"id" => "progressbar_filled_border_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Progress Bar Filled Border Size", "Aione"),
			"desc" => __("In pixels (px), ex: 1px.", "Aione"),
			"id" => "progressbar_filled_border_size",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Progress Bar Unfilled Color", "Aione"),
			"desc" => __("Controls the color of the unfilled area in progress bars.", "Aione"),
			"id" => "progressbar_unfilled_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Progress Bar Text Color", "Aione"),
			"desc" => __("Controls the color of the text in progress bars.", "Aione"),
			"id" => "progressbar_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Progress Bar Shortcode", "Aione"),
			"desc" => "",
			"id" => "progressbar_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Progress Bar Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Section Separator Shortcode", "Aione"),
			"desc" => "",
			"id" => "sectionseparator_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Section Separator Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Section Separator Border Size", "Aione"),
			"desc" => __("Controls the border size of the section separator.", "Aione"),
			"id" => "section_sep_border_size",
			"std" => "1px",
			"type" => "text");


		$of_options[] = array( "name" => __("Section Separator Background Color of Divider Candy", "Aione"),
			"desc" => __("Controls the background color of the divider candy.", "Aione"),
			"id" => "section_sep_bg",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Section Separator Border Color", "Aione"),
			"desc" => __("Controls the border color of the separator.", "Aione"),
			"id" => "section_sep_border_color",
			"std" => '#f6f6f6',
			"type" => "color");

	   $of_options[] = array( "name" => __("Section Separator Shortcode", "Aione"),
			"desc" => "",
			"id" => "sectionseparator_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Section Separator Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Separator Shortcode", "Aione"),
			"desc" => "",
			"id" => "separator_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Separator Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Separators Color", "Aione"),
			"desc" => __("Controls the color of all separators, divider lines and borders for meta, previous & next, filters, category page, boxes around number pagination, sidebar widgets, accordion divider lines, counter boxes and more.", "Aione"),
			"id" => "sep_color",
			"std" => "#e0dede",
			"type" => "color");

		$of_options[] = array( "name" => __("Separator Circle", "Aione"),
			"desc" => __("Check the box if you want to use circles around the icons on separators.", "Aione"),
			"id" => "separator_circle",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Border Size", "Aione"),
			"desc" => __("In pixels, ex: 1px.", "Aione"),
			"id" => "separator_border_size",
			"std" => "1px",
			"type" => "text");

		$of_options[] = array( "name" => __("Separator Shortcode", "Aione"),
			"desc" => "",
			"id" => "separator_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Separator Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Sharing Box Shortcode", "Aione"),
			"desc" => "",
			"id" => "sharingbox_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Sharing Box Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Sharing Box Background Color", "Aione"),
			"desc" => __("Controls the background color of the sharing box.", "Aione"),
			"id" => "sharing_box_bg_color",
			"std" => '#f6f6f6',
			"type" => "color");

		$of_options[] = array( "name" => __("Sharing Box Tagline Text Color", "Aione"),
			"desc" => __("Controls the text color of the tagline text.", "Aione"),
			"id" => "sharing_box_tagline_text_color",
			"std" => '#333333',
			"type" => "color");

	   $of_options[] = array( "name" => __("Sharing Box Shortcode", "Aione"),
			"desc" => "",
			"id" => "sharingbox_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Sharing Box Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Social Links Shortcode", "Aione"),
			"desc" => "",
			"id" => "sociallinks_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Social Links Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( 	"name" => __("Social Links Icons Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 16", "Aione"),
						"id" 		=> "social_links_font_size",
						"std" 		=> "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Social Links Custom Icons Color", "Aione"),
			"desc" => __("Select a custom social icon color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "social_links_icon_color",
			"std" => "#bebdbd",
			"type" => "color");

		$of_options[] = array( "name" => __("Social Links Icons Boxed", "Aione"),
			"desc" => __("Controls whether each icon is displayed in a small box.", "Aione"),
			"id" => "social_links_boxed",
			"std" => "No",
			"type" => "select",
			"options" => array('No' => 'No', 'Yes' => 'Yes'));

		$of_options[] = array( "name" => __("Social Links Icons Custom Box Color", "Aione"),
			"desc" => __("Select a custom social icon box color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "social_links_box_color",
			"std" => "#e8e8e8",
			"type" => "color");

		$of_options[] = array( "name" => __("Social Links Icons Boxed Radius", "Aione"),
			"desc" => __('Box radius for the social icons. In px or %, ex: 5px or 10% or "round".', "Aione"),
			"id" => "social_links_boxed_radius",
			"std" => "4px",
			"type" => "text");

		$of_options[] = array( 	"name" => __("Social Links Icons Boxed Padding", "Aione"),
						"desc" 		=> __("In pixels, default is 8", "Aione"),
						"id" 		=> "social_links_boxed_padding",
						"std" 		=> "8",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Social Links Icons Tooltip Position", "Aione"),
			"desc" => __("Controls the tooltip position of the social links icons.", "Aione"),
			"id" => "social_links_tooltip_placement",
			"std" => "Top",
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

	   $of_options[] = array( "name" => __("Social Links Shortcode", "Aione"),
			"desc" => "",
			"id" => "sociallinks_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Social Links Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Tabs Shortcode", "Aione"),
			"desc" => "",
			"id" => "tabs_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Tabs Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Tabs Background Color + Hover Color", "Aione"),
			"desc" => __("Controls the color of the active tab, content background color and tab hover.", "Aione"),
			"id" => "tabs_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Tabs Inactive Color", "Aione"),
			"desc" => __("Controls the color of the inactive tabs.", "Aione"),
			"id" => "tabs_inactive_color",
			"std" => "#ebeaea",
			"type" => "color");

		$of_options[] = array( "name" => __("Tabs Border Color", "Aione"),
			"desc" => __("Controls the color of the outer tab border.", "Aione"),
			"id" => "tabs_border_color",
			"std" => "#ebeaea",
			"type" => "color");

	   $of_options[] = array( "name" => __("Tabs Shortcode", "Aione"),
			"desc" => "",
			"id" => "tabs_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Tabs Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Tagline Shortcode", "Aione"),
			"desc" => "",
			"id" => "tagline_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Tagline Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Tagline Box Background Color", "Aione"),
			"desc" => __("Controls the background color of the tagline box.", "Aione"),
			"id" => "tagline_bg",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Tagline Box Border Color", "Aione"),
			"desc" => __("Controls the border color of the tagline box.", "Aione"),
			"id" => "tagline_border_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Tagline Margin Top", "Aione"),
			"desc" => __("Controls the top margin of the tagline box. In pixels.", "Aione"),
			"id" => "tagline_margin_top",
			"std" => "",
			"type" => "text" );

		$of_options[] = array( "name" => __("Tagline Margin Bottom", "Aione"),
			"desc" => __("Controls the bottom margin of the tagline box. In pixels.", "Aione"),
			"id" => "tagline_margin_bottom",
			"std" => "84",
			"type" => "text" );

	   $of_options[] = array( "name" => __("Tagline Shortcode", "Aione"),
			"desc" => "",
			"id" => "tagline_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Tagline Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Testimonials Shortcode", "Aione"),
			"desc" => "",
			"id" => "testimonials_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Testimonials Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Testimonial Background Color", "Aione"),
			"desc" => __("Controls the background color of the testimonial.", "Aione"),
			"id" => "testimonial_bg_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Testimonial Text Color", "Aione"),
			"desc" => __("Controls the text color of the testimonial font.", "Aione"),
			"id" => "testimonial_text_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Testimonials Speed", "Aione"),
			"desc" => __("Select the slideshow speed, 1000 = 1 second.", "Aione"),
			"id" => "testimonials_speed",
			"std" => "4000",
			"type" => "text");

		$of_options[] = array( "name" => __("Random Order", "Aione"),
			"desc" => __("Check the box to display testimonials in random order.", "Aione"),
			"id" => "testimonials_random",
			"std" => 0,
			"type" => "checkbox");

	   $of_options[] = array( "name" => __("Testimonials Shortcode", "Aione"),
			"desc" => "",
			"id" => "testimonials_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Testimonials Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Title Shortcode", "Aione"),
			"desc" => "",
			"id" => "title_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Title Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Title Separator", "Aione"),
			"desc" => __("Choose the kind of the title separator you want to use.", "Aione"),
			"id" => "title_style_type",
			"std" => "double",
			"type" => "select",
			"options" => array(
				'single'		  	=> __('Single', 'Aione'),
				'single solid'		=> __('Single Solid', 'Aione'),
				'single dashed'		=> __('Single Dashed', 'Aione'),
				'single dotted'		=> __('Single Dotted', 'Aione'),
				'double'	 		=> __('Double', 'Aione'),
				'double solid'	 	=> __('Double Solid', 'Aione'),
				'double dashed'		=> __('Double Dashed', 'Aione'),
				'double dotted'		=> __('Double Dotted', 'Aione'),
				'underline'			=> __('Underline', 'Aione'),
				'underline solid'	=> __('Underline Solid', 'Aione'),
				'underline dashed'	=> __('Underline Dashed', 'Aione'),
				'underline dotted'	=> __('Underline Dotted', 'Aione'),
				'none'				=> __('None', 'Aione')
			));

		$of_options[] = array( "name" => __("Title Separator Color", "Aione"),
			"desc" => __("Controls the color of the title separators", "Aione"),
			"id" => "title_border_color",
			"std" => "#e0dede",
			"type" => "color");

		$of_options[] = array( "name" => __("Title Top Margin", "Aione"),
			"desc" => __("Spacing above the title. In px or em, e.g. 10px.", "Aione"),
			"id" => "title_top_margin",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Title Bottom Margin", "Aione"),
			"desc" => __("Spacing below the title. In px or em, e.g. 10px.", "Aione"),
			"id" => "title_bottom_margin",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Title Shortcode", "Aione"),
			"desc" => "",
			"id" => "title_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Title Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Toggles Shortcode", "Aione"),
			"desc" => "",
			"id" => "accordion_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Toggles Shortcode", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Toggle Divider Line", "Aione"),
			"desc" => __("Choose to display a divider line between each item.", "Aione"),
			"id" => "accordion_divider_line",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Toggles Inactive Box Color", "Aione"),
			"desc" => __("Controls the color of the inactive boxes behind the '+' icons.", "Aione"),
			"id" => "accordian_inactive_color",
			"std" => "#333333",
			"type" => "color");

	   $of_options[] = array( "name" => __("Toggles Shortcode", "Aione"),
			"desc" => "",
			"id" => "accordion_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("Toggles Shortcode", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("User Login Shortcodes", "Aione"),
			"desc" => "",
			"id" => "login_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("User Login Shortcodes", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("User Login Text Align", "Aione"),
			"desc" => __('Choose the alignment of all content parts. "Text Flow" follows the default text align of the site. "Center" will center all elements.', "Aione"),
			"id" => "user_login_text_align",
			"std" => "center",
			"type" => "select",
			"options" => array(
				'textflow' => 'Text Flow',
				'center' => 'Center',
			));

		$of_options[] = array( "name" => __("User Login Form Backgound Color", "Aione"),
			"desc" => __("Choose a background color for the form wrapping box.", "Aione"),
			"id" => "user_login_form_background_color",
			"std" => "#f6f6f6",
			"type" => "color");

	   $of_options[] = array( "name" => __("User Login Shortcodes", "Aione"),
			"desc" => "",
			"id" => "login_shortcode",
			"std" => "<h3 style='margin: 0;'>" . __("User Login Shortcodes", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");


		$of_options[] = array( "name" => __("Blog", "Aione"),
			"id" => "heading_blog",
			"type" => "heading");

		$of_options[] = array( "name" => __("General Blog Options", "Aione"),
			"desc" => "",
			"id" => "blog_single_post",
			"std" => "<h3 style='margin: 0;'>" . __("General Blog Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Blog Page Title", "Aione"),
			"desc" => __("This text will display in the page title bar of the assigned blog page. Note: This option only works if your front page is set to display your latest post in reading settings.", "Aione"),
			"id" => "blog_title",
			"std" => "Blog",
			"type" => "text");

		$of_options[] = array( "name" => __("Blog Page Subtitle", "Aione"),
			"desc" => __("This text will display as subheading in the page title bar of the assigned blog page. Note: This option only works if your front page is set to display your latest post in reading settings.", "Aione"),
			"id" => "blog_subtitle",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Page Title Bar", "Aione"),
			"desc" => __("Check the box to show the page title bar for the assigned blog page.", "Aione"),
			"id" => "blog_show_page_title_bar",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Blog Layout", "Aione"),
			"desc" => __("Select the layout for the assigned blog page in settings > reading.", "Aione"),
			"id" => "blog_layout",
			"std" => "Large",
			"type" => "select",
			"options" => array(
				'Large' => 'Large',
				'Medium' => 'Medium',
				'Large Alternate' => 'Large Alternate',
				'Medium Alternate' => 'Medium Alternate',
				'Grid' => 'Grid',
				'Timeline' => 'Timeline'
			));

		$of_options[] = array( "name" => __("Blog Archive/Category Layout", "Aione"),
			"desc" => __("Select the layout for the blog archive/category pages.", "Aione"),
			"id" => "blog_archive_layout",
			"std" => "Large",
			"type" => "select",
			"options" => array(
				'Large' => 'Large',
				'Medium' => 'Medium',
				'Large Alternate' => 'Large Alternate',
				'Medium Alternate' => 'Medium Alternate',
				'Grid' => 'Grid',
				'Timeline' => 'Timeline'
			));

		$of_options[] = array( "name" => __("Pagination Type", "Aione"),
			"desc" => __("Select the pagination type for the assigned blog page in settings > reading.", "Aione"),
			"id" => "blog_pagination_type",
			"std" => "Pagination",
			"type" => "select",
			"options" => array(
				'Pagination' => 'Pagination',
				'Infinite Scroll' => 'Infinite Scroll',
				'load_more_button' => 'Load More Button'
			));

		$of_options[] = array( "name" => __("Grid Layout # of Columns", "Aione"),
			"desc" => __("Select the amount of columns for the grid layout.", "Aione"),
			"id" => "blog_grid_columns",
			"std" => "3",
			"type" => "select",
			"options" => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			));

		$of_options[] = array( "name" => __("Grid Layout Column Spacing", "Aione"),
			"desc" => __("Insert the amount of spacing between grid items without 'px'. ex: 40", "Aione"),
			"id" => "blog_grid_column_spacing",
			"std" => "40",
			"type" => "text");

		$of_options[] = array( "name" => __("Excerpt or Full Blog Content", "Aione"),
			"desc" => __("Choose to display an excerpt or full content on blog pages.", "Aione"),
			"id" => "content_length",
			"std" => "Excerpt",
			"type" => "select",
			"options" => array('Excerpt' => 'Excerpt', 'Full Content' => 'Full Content'));

		$of_options[] = array( "name" => __("Excerpt Length", "Aione"),
			"desc" => __("Insert the number of words you want to show in the post excerpts.", "Aione"),
			"id" => "excerpt_length_blog",
			"std" => "55",
			"type" => "text");

		$of_options[] = array( "name" => __("Strip HTML from Excerpt", "Aione"),
			"desc" => __("Check the box if you want to strip HTML from the excerpt content only.", "Aione"),
			"id" => "strip_html_excerpt",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Featured Image / Video on Blog Archive Page", "Aione"),
			"desc" => __("Check the box to display featured images and videos on blog archive page.", "Aione"),
			"id" => "featured_images",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Blog Alternate Date Format - Month and Year", "Aione"),
			"desc" => __("<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>", "Aione"),
			"id" => "alternate_date_format_month_year",
			"std" => "m, Y",
			"type" => "text");

		$of_options[] = array( "name" => __("Blog Alternate Date Format - Day", "Aione"),
			"desc" => __("<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>", "Aione"),
			"id" => "alternate_date_format_day",
			"std" => "j",
			"type" => "text");

		$of_options[] = array( "name" => __("Blog Timeline Date Format - Timeline Labels", "Aione"),
			"desc" => __("<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date</a>", "Aione"),
			"id" => "timeline_date_format",
			"std" => "F Y",
			"type" => "text");

		$of_options[] = array( "name" => __("Blog Single Post", "Aione"),
			"desc" => "",
			"id" => "blog_single_post",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Single Post Page Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Use 100% Width Page", "Aione"),
			"desc" => __("Choose to set posts to 100% browser width.", "Aione"),
			"id" => "blog_width_100",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Featured Image / Video on Single Post Page", "Aione"),
			"desc" => __("Check the box to display featured images and videos on single post pages.", "Aione"),
			"id" => "featured_images_single",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Previous/Next Pagination", "Aione"),
			"desc" => __("Check the box to disable previous/next pagination.", "Aione"),
			"id" => "blog_pn_nav",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Post Title", "Aione"),
			"desc" => __("Check the box to display the post title that goes below the featured images.", "Aione"),
			"id" => "blog_post_title",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Author Info Box", "Aione"),
			"desc" => __("Check the box to display the author info box below posts.", "Aione"),
			"id" => "author_info",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Sharing Box", "Aione"),
			"desc" => __("Check the box to display the social sharing box.", "Aione"),
			"id" => "social_sharing_box",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Related Posts", "Aione"),
			"desc" => __("Check the box to display related posts.", "Aione"),
			"id" => "related_posts",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Comments", "Aione"),
			"desc" => __("Check the box to display comments.", "Aione"),
			"id" => "blog_comments",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Blog Meta", "Aione"),
			"desc" => "",
			"id" => "blog_meta",
			"std" => "<h3 style='margin: 0;'>" . __("Blog Meta Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Post Meta", "Aione"),
			"desc" => __("Check the box to display post meta on blog posts.", "Aione"),
			"id" => "post_meta",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Author", "Aione"),
			"desc" => __("Check the box to hide the author name from post meta.", "Aione"),
			"id" => "post_meta_author",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Date", "Aione"),
			"desc" => __("Check the box to hide the date from post meta.", "Aione"),
			"id" => "post_meta_date",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Categories", "Aione"),
			"desc" => __("Check the box to hide the categories from post meta.", "Aione"),
			"id" => "post_meta_cats",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Comments", "Aione"),
			"desc" => __("Check the box to hide the comments from post meta.", "Aione"),
			"id" => "post_meta_comments",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Read More Link", "Aione"),
			"desc" => __("Check the box to hide the read more link from post meta.", "Aione"),
			"id" => "post_meta_read",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Post Meta Tags", "Aione"),
			"desc" => __("Check the box to hide the tags from post meta.", "Aione"),
			"id" => "post_meta_tags",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Date Format", "Aione"),
			"desc" => __("<a href='http://codex.wordpress.org/Formatting_Date_and_Time'>Formatting Date and Time</a>", "Aione"),
			"id" => "date_format",
			"std" => "F jS, Y",
			"type" => "text");

		$of_options[] = array( "name" => __("Portfolio", "Aione"),
			"id" => "heading_portfolio",
			"type" => "heading");

		$of_options[] = array( "name" => __("General Portfolio Options", "Aione"),
			"desc" => "",
			"id" => "blog_single_post",
			"std" => "<h3 style='margin: 0;'>" . __("General Portfolio Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Number of Portfolio Items Per Page", "Aione"),
			"desc" => __("Insert the number of posts to display per page.", "Aione"),
			"id" => "portfolio_items",
			"std" => "10",
			"type" => "text");

		$of_options[] = array( "name" => __("Portfolio Archive/Category Layout", "Aione"),
			"desc" => __("Select the layout for only the archive/category pages.", "Aione"),
			"id" => "portfolio_archive_layout",
			"std" => "Portfolio One Column",
			"type" => "select",
			"options" => array(
				'Portfolio One Column' => 'Portfolio One Column',
				'Portfolio Two Column' => 'Portfolio Two Column',
				'Portfolio Three Column' => 'Portfolio Three Column',
				'Portfolio Four Column' => 'Portfolio Four Column',
				'Portfolio Five Column' => 'Portfolio Five Column',
				'Portfolio Six Column' => 'Portfolio Six Column',
				'Portfolio One Column Text' => 'Portfolio One Column Text',
				'Portfolio Two Column Text' => 'Portfolio Two Column Text',
				'Portfolio Three Column Text' => 'Portfolio Three Column Text',
				'Portfolio Four Column Text' => 'Portfolio Four Column Text',
				'Portfolio Five Column Text' => 'Portfolio Five Column Text',
				'Portfolio Six Column Text' => 'Portfolio Six Column Text',
				'Portfolio Grid' => 'Portfolio Grid',
			));

		$of_options[] = array( "name" => __("Portfolio Archive/Category Column Spacing", "Aione"),
			"desc" => __("Insert the amount of spacing between portfolio items without 'px'.<br />ex: 12", "Aione"),
			"id" => "portfolio_column_spacing",
			"std" => "12",
			"type" => "text");

		$of_options[] = array( "name" => __("Excerpt or Full Portfolio Content", "Aione"),
			"desc" => __("Choose to show a text excerpt or full content.", "Aione"),
			"id" => "portfolio_content_length",
			"std" => "Excerpt",
			"type" => "select",
			"options" => array('Excerpt' => 'Excerpt', 'Full Content' => 'Full Content'));

		$of_options[] = array( "name" => __("Excerpt Length", "Aione"),
			"desc" => __("Insert the number of words you want to show in the post excerpts.", "Aione"),
			"id" => "excerpt_length_portfolio",
			"std" => "55",
			"type" => "text");

		$of_options[] = array( "name" => __("Strip HTML from Excerpt", "Aione"),
			"desc" => __("Check the box if you want to strip HTML from the excerpt content only.", "Aione"),
			"id" => "portfolio_strip_html_excerpt",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Pagination Type", "Aione"),
			"desc" => __("Select the pagination type for Portfolio layouts.", "Aione"),
			"id" => "grid_pagination_type",
			"std" => "Pagination",
			"type" => "select",
			"options" => array(
				'Pagination' => 'Pagination',
				'Infinite Scroll' => 'Infinite Scroll',
				'load_more_button' => 'Load More Button',
			));

		$of_options[] = array( "name" => __("Portfolio Text Layout", "Aione"),
			"desc" => __("Select if the portfolio text layouts are boxed or unboxed.", "Aione"),
			"id" => "portfolio_text_layout",
			"std" => "unboxed",
			"type" => "select",
			"options" => array(
				'boxed' => 'Boxed',
				'unboxed' => 'Unboxed',
			));

		$of_options[] = array( "name" => __("Portfolio Slug", "Aione"),
			"desc" => __("The slug name cannot be the same name as your portfolio page or the layout will break. This option changes the permalink when you use the permalink type as %postname%. <strong>Make sure to regenerate permalinks.</strong>", "Aione"),
			"id" => "portfolio_slug",
			"std" => "portfolio-items",
			"type" => "text");

		$of_options[] = array( "name" => __("Portfolio Featured Image Size ", "Aione"),
			"desc" => __("Choose if the featured images are fixed (cropped) or auto (full image ratio) for all portfolio column page templates. IMPORTANT: Fixed images work best with smaller site widths. Auto images work best with larger site widths.", "Aione"),
			"id" => "portfolio_featured_image_size",
			"std" => "cropped",
			"type" => "select",
			"options" => array(
				'cropped' => 'Fixed',
				'full' => 'Auto',
			));

		$of_options[] = array( "name" => __("Portfolio Single Post Page Options", "Aione"),
			"desc" => "",
			"id" => "blog_single_post",
			"std" => "<h3 style='margin: 0;'>" . __("Portfolio Single Post Page Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Disable Previous/Next Pagination", "Aione"),
			"desc" => __("Check the box to disable previous/next pagination.", "Aione"),
			"id" => "portfolio_pn_nav",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Featured Image / Video on Single Post Page", "Aione"),
			"desc" => __("Check the box to display featured images and videos on single post pages.", "Aione"),
			"id" => "portfolio_featured_images",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable First Featured Image", "Aione"),
			"desc" => __("Disable the 1st featured image on single post pages.", "Aione"),
			"id" => "portfolio_disable_first_featured_image",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Width (Content Columns for Featured Image)", "Aione"),
			"desc" => __("Choose if the featured image is full or half width.", "Aione"),
			"id" => "portfolio_featured_image_width",
			"std" => "No",
			"type" => "select",
			"options" => array('full' => 'Full Width', 'half' => 'Half Width'));


		$of_options[] = array( "name" => __("Use 100% Width Page", "Aione"),
			"desc" => __("Choose to set posts to 100% browser width.", "Aione"),
			"id" => "portfolio_width_100",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Project Description Title", "Aione"),
			"desc" => __("Choose to show or hide the project description title.", "Aione"),
			"id" => "portfolio_project_desc_title",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Project Details", "Aione"),
			"desc" => __("Choose to show or hide the project details text.", "Aione"),
			"id" => "portfolio_project_details",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Open Post Links In New Window", "Aione"),
			"desc" => __("Choose to open the single post page, project url and copyright url links in a new window..", "Aione"),
			"id" => "portfolio_link_icon_target",
			"std" => 0,
			"type" => "checkbox");


		$of_options[] = array( "name" => __("Show Comments", "Aione"),
			"desc" => __("Check the box to enable comments on portfolio items.", "Aione"),
			"id" => "portfolio_comments",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Author", "Aione"),
			"desc" => __("Check the box to enable Author on portfolio items.", "Aione"),
			"id" => "portfolio_author",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Sharing Box", "Aione"),
			"desc" => __("Check the box to display the social sharing box.", "Aione"),
			"id" => "portfolio_social_sharing_box",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Related Posts", "Aione"),
			"desc" => __("Check the box to display related posts.", "Aione"),
			"id" => "portfolio_related_posts",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Sharing Box", "Aione"),
			"id" => "heading_social_sharing_box",
			"type" => "heading");

		$of_options[] = array( "name" => __("Social Share Box Icon Options", "Aione"),
			"desc" => "",
			"id" => "social_share_box_icon_options_title",
			"std" => "<h3 style='margin: 0;'>" . __("Social Share Box Icon Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Social Sharing Box Tagline", "Aione"),
			"desc" => __("Insert a tagline for the social sharing boxes.", "Aione"),
			"id" => "sharing_social_tagline",
			"std" => "Share This Story, Choose Your Platform!",
			"type" => "text");

		$of_options[] = array( "name" => __("Social Share Box Background Color", "Aione"),
			"desc" => __("Controls the background color of the social share box.", "Aione"),
			"id" => "social_bg_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( 	"name" => __("Social Sharing Box Icons Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 16", "Aione"),
						"id" 		=> "sharing_social_links_font_size",
						"std" 		=> "16",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Social Sharing Box Custom Icons Color", "Aione"),
			"desc" => __("Select a custom social icon color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "sharing_social_links_icon_color",
			"std" => "#bebdbd",
			"type" => "color");

		$of_options[] = array( "name" => __("Social Sharing Box Icons Boxed", "Aione"),
			"desc" => __("Controls whether each icon is displayed in a small box.", "Aione"),
			"id" => "sharing_social_links_boxed",
			"std" => "No",
			"type" => "select",
			"options" => array('No' => 'No', 'Yes' => 'Yes'));

		$of_options[] = array( "name" => __("Social Sharing Box Icons Custom Box Color", "Aione"),
			"desc" => __("Select a custom social icon box color. Use one hex value for all or separate by | symbol for multi-color. ex: #AA0000|#00AA00|#0000AA", "Aione"),
			"id" => "sharing_social_links_box_color",
			"std" => "#e8e8e8",
			"type" => "color");

		$of_options[] = array( "name" => __("Social Sharing Box Icons Boxed Radius", "Aione"),
			"desc" => __("Box radius for the social icons. In pixels, ex: 4px.", "Aione"),
			"id" => "sharing_social_links_boxed_radius",
			"std" => "4px",
			"type" => "text");

		$of_options[] = array( 	"name" => __("Social Sharing Box Icons Boxed Padding", "Aione"),
						"desc" 		=> __("In pixels, default is 8", "Aione"),
						"id" 		=> "sharing_social_links_boxed_padding",
						"std" 		=> "8",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Social Sharing Box Icons Tooltip Position", "Aione"),
			"desc" => __("Controls the tooltip position of the social icons in the sharing box.", "Aione"),
			"id" => "sharing_social_links_tooltip_placement",
			"std" => "Top",
			"type" => "select",
			"options" => array( 'Top' => 'Top', 'Right' => 'Right', 'Bottom' => 'Bottom', 'Left' => 'Left', 'None' => 'None' ));

		$of_options[] = array( "name" => __("Social Share Box Links", "Aione"),
			"desc" => "",
			"id" => "social_share_box_links_title",
			"std" => "<h3 style='margin: 0;'>" . __("Social Share Box Links", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Facebook", "Aione"),
			"desc" => __("Check the box to show the facebook sharing icon in blog posts.", "Aione"),
			"id" => "sharing_facebook",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Twitter", "Aione"),
			"desc" => __("Check the box to show the twitter sharing icon in blog posts.", "Aione"),
			"id" => "sharing_twitter",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Reddit", "Aione"),
			"desc" => __("Check the box to show the reddit sharing icon in blog posts.", "Aione"),
			"id" => "sharing_reddit",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("LinkedIn", "Aione"),
			"desc" => __("Check the box to show the linkedin sharing icon in blog posts.", "Aione"),
			"id" => "sharing_linkedin",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Google Plus", "Aione"),
			"desc" => __("Check the box to show the g+ sharing icon in blog posts.", "Aione"),
			"id" => "sharing_google",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Tumblr", "Aione"),
			"desc" => __("Check the box to show the tumblr sharing icon in blog posts.", "Aione"),
			"id" => "sharing_tumblr",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Pinterest", "Aione"),
			"desc" => __("Check the box to show the pinterest sharing icon in blog posts.", "Aione"),
			"id" => "sharing_pinterest",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("VK", "Aione"),
			"desc" => __("Check the box to show the vk sharing icon in blog posts.", "Aione"),
			"id" => "sharing_vk",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Email", "Aione"),
			"desc" => __("Check the box to show the email sharing icon in blog posts.", "Aione"),
			"id" => "sharing_email",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Media", "Aione"),
			"id" => "heading_social_media",
			"type" => "heading");

		$social_links[] = array( "name" => __("Facebook", "Aione"),
			"desc" => __("Insert your custom link to show the Facebook icon. Leave blank to hide icon.", "Aione"),
			"id" => "facebook_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Flickr", "Aione"),
			"desc" => __("Insert your custom link to show the Flickr icon. Leave blank to hide icon.", "Aione"),
			"id" => "flickr_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("RSS", "Aione"),
			"desc" => __("Insert your custom link to show the RSS icon. Leave blank to hide icon.", "Aione"),
			"id" => "rss_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Twitter", "Aione"),
			"desc" => __("Insert your custom link to show the Twitter icon. Leave blank to hide icon.", "Aione"),
			"id" => "twitter_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Vimeo", "Aione"),
			"desc" => __("Insert your custom link to show the Vimeo icon. Leave blank to hide icon.", "Aione"),
			"id" => "vimeo_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Youtube", "Aione"),
			"desc" => __("Insert your custom link to show the Youtube icon. Leave blank to hide icon.", "Aione"),
			"id" => "youtube_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Instagram", "Aione"),
			"desc" => __("Insert your custom link to show the Instagram icon. Leave blank to hide icon.", "Aione"),
			"id" => "instagram_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Pinterest", "Aione"),
			"desc" => __("Insert your custom link to show the Pinterest icon. Leave blank to hide icon.", "Aione"),
			"id" => "pinterest_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Tumblr", "Aione"),
			"desc" => __("Insert your custom link to show the Tumblr icon. Leave blank to hide icon.", "Aione"),
			"id" => "tumblr_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Google+", "Aione"),
			"desc" => __("Insert your custom link to show the Google+ icon. Leave blank to hide icon.", "Aione"),
			"id" => "google_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Dribbble", "Aione"),
			"desc" => __("Insert your custom link to show the Dribbble icon. Leave blank to hide icon.", "Aione"),
			"id" => "dribbble_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Digg", "Aione"),
			"desc" => __("Insert your custom link to show the Digg icon. Leave blank to hide icon.", "Aione"),
			"id" => "digg_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("LinkedIn", "Aione"),
			"desc" => __("Insert your custom link to show the LinkedIn icon. Leave blank to hide icon.", "Aione"),
			"id" => "linkedin_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Blogger", "Aione"),
			"desc" => __("Insert your custom link to show the Blogger icon. Leave blank to hide icon.", "Aione"),
			"id" => "blogger_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Skype", "Aione"),
			"desc" => __("Insert your custom link to show the Skype icon. Leave blank to hide icon.", "Aione"),
			"id" => "skype_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Forrst", "Aione"),
			"desc" => __("Insert your custom link to show the Forrst icon. Leave blank to hide icon.", "Aione"),
			"id" => "forrst_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Myspace", "Aione"),
			"desc" => __("Insert your custom link to show the Myspace icon. Leave blank to hide icon.", "Aione"),
			"id" => "myspace_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Deviantart", "Aione"),
			"desc" => __("Insert your custom link to show the Deviantart icon. Leave blank to hide icon.", "Aione"),
			"id" => "deviantart_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Yahoo", "Aione"),
			"desc" => __("Insert your custom link to show the Yahoo icon. Leave blank to hide icon.", "Aione"),
			"id" => "yahoo_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Reddit", "Aione"),
			"desc" => __("Insert your custom link to show the Reddit icon. Leave blank to hide icon.", "Aione"),
			"id" => "reddit_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Paypal", "Aione"),
			"desc" => __("Insert your custom link to show the Paypal icon. Leave blank to hide icon.", "Aione"),
			"id" => "paypal_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Dropbox", "Aione"),
			"desc" => __("Insert your custom link to show the Dropbox icon. Leave blank to hide icon.", "Aione"),
			"id" => "dropbox_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Soundcloud", "Aione"),
			"desc" => __("Insert your custom link to show the Soundcloud icon. Leave blank to hide icon.", "Aione"),
			"id" => "soundcloud_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("VK", "Aione"),
			"desc" => __("Insert your custom link to show the VK icon. Leave blank to hide icon.", "Aione"),
			"id" => "vk_link",
			"std" => "",
			"type" => "text");

		$social_links[] = array( "name" => __("Email Address", "Aione"),
			"desc" => __("Insert your custom link to show the mail icon. Leave blank to hide icon.", "Aione"),
			"id" => "email_link",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => "",
			"desc" => "",
			"id" => "social_sorter",
			"std" => "",
			"type" => "oxo_sorter",
			"fields" => $social_links,
		);

		$of_options[] = array( "name" => __("Custom Social Icon", "Aione"),
			"desc" => "",
			"id" => "custom_color_scheme_element",
			"std" => "<h3 style='margin: 0;'>" . __("Custom Social Icon", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Custom Icon Name", "Aione"),
			"desc" => __("This is the icon name that shows in the hover tooltip.", "Aione"),
			"id" => "custom_icon_name",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Custom Icon Image", "Aione"),
			"desc" => __("Select an image file for your custom icon.", "Aione"),
			"id" => "custom_icon_image",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("Custom Icon Image Retina", "Aione"),
			"desc" => __("Select an image file for the retina version of the icon. It should be 2x the size of main icon.", "Aione"),
			"id" => "custom_icon_image_retina",
			"std" => "",
			"mod" => "",
			"type" => "media");

		$of_options[] = array( "name" => __("Standard Icon Width for Retina Icon", "Aione"),
			"desc" => __("If retina icon is added, enter the standard icon (1x) version width, do not enter the retina icon width.", "Aione"),
			"id" => "retina_icon_width",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Standard Icon Height for Retina Icon", "Aione"),
			"desc" => __("If retina icon is added, enter the standard icon (1x) version height, do not enter the retina icon height.", "Aione"),
			"id" => "retina_icon_height",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Custom Icon Link", "Aione"),
			"desc" => __("Insert a link for your custom icon.", "Aione"),
			"id" => "custom_icon_link",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Slideshows", "Aione"),
			"id" => "heading_slideshows",
			"type" => "heading");

		$of_options[] = array( "name" => __("Posts Slideshow Images", "Aione"),
			"desc" => __("This option controls the number of featured image boxes for blog/portfolio slideshows.", "Aione"),
			"id" => "posts_slideshow_number",
			"std" => "5",
			"type" => "text");

		$of_options[] = array( "name" => __("Autoplay", "Aione"),
			"desc" => __("Check the box to autoplay the slideshow.", "Aione"),
			"id" => "slideshow_autoplay",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable Smooth Height", "Aione"),
			"desc" => __("Check the box to enable smooth height on slideshows when using images with different heights. Please note, smooth height is disabled on blog grid layout.", "Aione"),
			"id" => "slideshow_smooth_height",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Slideshow Speed", "Aione"),
			"desc" => __("Controls the speed of slideshows for the [slider] shortcode and sliders within posts. ex: 1000 = 1 second.", "Aione"),
			"id" => "slideshow_speed",
			"std" => "7000",
			"type" => "text");

		$of_options[] = array( "name" => __("Pagination Circles Below Video Slides", "Aione"),
			"desc" => __("Check the box if you want to show pagination circles below a video slide for the slider shortcode. Leave it unchecked to hide them on video slides.", "Aione"),
			"id" => "pagination_video_slide",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Navigation Box Width", "Aione"),
			"desc" => __("Enter a pixel value for width, ex: 30px", "Aione"),
			"id" => "slider_nav_box_width",
			"std" => "30px",
			"type" => "text");

		$of_options[] = array( "name" => __("Navigation Box Height", "Aione"),
		"desc" => __("Enter a pixel value for height, ex: 30px", "Aione"),
		"id" => "slider_nav_box_height",
		"std" => "30px",
		"type" => "text");

		$of_options[] = array( "name" => __("Navigation Arrow Size", "Aione"),
		"desc" => __("Enter a pixel value for the arrow size, ex: 14px", "Aione"),
		"id" => "slider_arrow_size",
		"std" => "14px",
		"type" => "text");

		$of_options[] = array( "name" => __("Elastic Slider", "Aione"),
			"id" => "heading_elastic_slider",
			"type" => "heading");

		$of_options[] = array( "name" => __("Slider Width", "Aione"),
			"desc" => __("In pixels or percentage, ex: 100% or 100.", "Aione"),
			"id" => "tfes_slider_width",
			"std" => "100%",
			"type" => "text");

		$of_options[] = array( "name" => __("Slider Height", "Aione"),
			"desc" => __("In pixels, ex: 100px.", "Aione"),
			"id" => "tfes_slider_height",
			"std" => "400px",
			"type" => "text");

		$of_options[] = array( "name" => __("Animation", "Aione"),
			"desc" => __("Slides animate from sides or center.", "Aione"),
			"id" => "tfes_animation",
			"std" => "sides",
			"options" => array('sides' => 'sides', 'center' => 'center'),
			"type" => "select");

		$of_options[] = array( "name" => __("Autoplay", "Aione"),
			"desc" => __("Check the box to autoplay the slides.", "Aione"),
			"id" => "tfes_autoplay",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Slideshow Interval", "Aione"),
			"desc" => __("Select the slideshow speed, 1000 = 1 second.", "Aione"),
			"id" => "tfes_interval",
			"std" => "3000",
			"type" => "text");

		$of_options[] = array( "name" => __("Sliding Speed", "Aione"),
			"desc" => __("Select the animation speed, 1000 = 1 second.", "Aione"),
			"id" => "tfes_speed",
			"std" => "800",
			"type" => "text");

		$of_options[] = array( "name" => __("Thumbnail Width", "Aione"),
			"desc" => __("Enter the width for thumbnail without 'px' ex: 100.", "Aione"),
			"id" => "tfes_width",
			"std" => "150",
			"type" => "text");

		$of_options[] = array( 	"name" => __("Title Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 42", "Aione"),
						"id" 		=> "es_title_font_size",
						"std" 		=> "42",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( 	"name" => __("Caption Font Size", "Aione"),
						"desc" 		=> __("In pixels, default is 20", "Aione"),
						"id" 		=> "es_caption_font_size",
						"std" 		=> "20",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Title Color", "Aione"),
			"desc" => __("Controls the text color of the title font.", "Aione"),
			"id" => "es_title_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Caption Color", "Aione"),
			"desc" => __("Controls the text color of the caption font.", "Aione"),
			"id" => "es_caption_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Lightbox", "Aione"),
			"id" => "heading_lightbox",
			"type" => "heading");

		$of_options[] = array( "name" => __("Lightbox", "Aione"),
			"desc" => "",
			"id" => "lightbox",
			"std" => "<h3 style='margin: 0;'>" . __("Lightbox Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Disable Lightbox", "Aione"),
			"desc" => __("Check to disable Lightbox.", "Aione"),
			"id" => "status_lightbox",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Lightbox On Single Post Pages Only", "Aione"),
			"desc" => __("Check the box to disable Lightbox only on single posts and portfolio pages.", "Aione"),
			"id" => "status_lightbox_single",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Lightbox Behavior", "Aione"),
			"desc" => __("Select what the lightbox will display for portfolio and blog posts.", "Aione"),
			"id" => "lightbox_behavior",
			"std" => "all",
			"type" => "select",
			"options" => array('all' => 'First featured image of every post', 'individual' => 'Only featured images of individual post'));


		$of_options[] = array( "name" => __("Lightbox Skin", "Aione"),
			"desc" => __("Choose a skin for the lightbox.", "Aione"),
			"id" => "lightbox_skin",
			"std" => "metro-white",
			"type" => "select",
			"options" => array('light' => 'Light', 'dark' => 'Dark', 'mac' => 'Mac', 'metro-black' => 'Metro Black', 'metro-white' => 'Metro White', 'parade' => 'Parade', 'smooth' => 'Smooth'));

		$of_options[] = array( "name" => __("Thumbnails Position", "Aione"),
			"desc" => __("Choose position of thumbnails.", "Aione"),
			"id" => "lightbox_path",
			"std" => "vertical",
			"type" => "select",
			"options" => array('vertical' => 'Right', 'horizontal' => 'Bottom'));

		$of_options[] = array( "name" => __("Animation Speed", "Aione"),
			"desc" => __("Set the speed of the animation.", "Aione"),
			"id" => "lightbox_animation_speed",
			"std" => "Normal",
			"type" => "select",
			"options" => array('Fast' => 'Fast', 'Slow' => 'Slow', 'Normal' => 'Normal'));

		$of_options[] = array( "name" => __("Show Arrows", "Aione"),
			"desc" => __("Check the box to show arrows.", "Aione"),
			"id" => "lightbox_arrows",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Gallery Start/Stop Button", "Aione"),
			"desc" => __("Check the box to show the gallery start and stop button.", "Aione"),
			"id" => "lightbox_gallery",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Autoplay the Lightbox Gallery", "Aione"),
			"desc" => __("Check the box to autoplay the lightbox gallery.", "Aione"),
			"id" => "lightbox_autoplay",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Slideshow Speed", "Aione"),
			"desc" => __("If autoplay is enabled, set the slideshow speed, 1000 = 1 second. Speed needs to be 1000ms at least.", "Aione"),
			"id" => "lightbox_slideshow_speed",
			"std" => "5000",
			"type" => "text");

		$of_options[] = array( "name" => __("Background Opacity", "Aione"),
			"desc" => __("Set the opacity of background, <br />0.1 (lowest) to 1 (highest).", "Aione"),
			"id" => "lightbox_opacity",
			"std" => "0.9",
			"type" => "text");

		$of_options[] = array( "name" => __("Show Title", "Aione"),
			"desc" => __("Check the box to show the image title in the lightbox.", "Aione"),
			"id" => "lightbox_title",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Caption", "Aione"),
			"desc" => __("Check the box to show the image caption in the lightbox.", "Aione"),
			"id" => "lightbox_desc",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Social Sharing", "Aione"),
			"desc" => __("Check the box to show social sharing buttons on lightbox.", "Aione"),
			"id" => "lightbox_social",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Deeplinking", "Aione"),
			"desc" => __("Check the box to deeplink images in the lightbox.", "Aione"),
			"id" => "lightbox_deeplinking",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Post Images in Lightbox", "Aione"),
			"desc" => __("Check the box to show post images that are inside the post content area in the lightbox.", "Aione"),
			"id" => "lightbox_post_images",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Slideshow Video Width", "Aione"),
			"desc" => __("Set the width that will be used for videos inside the lightbox. In pixel, ex. 800px", "Aione"),
			"id" => "lightbox_video_width",
			"std" => "1280px",
			"type" => "text");

		$of_options[] = array( "name" => __("Slideshow Video Height", "Aione"),
			"desc" => __("Set the height that will be used for videos inside the lightbox. In pixel, ex. 600px", "Aione"),
			"id" => "lightbox_video_height",
			"std" => "720px",
			"type" => "text");

		$of_options[] = array( "name" => __("Contact", "Aione"),
			"id" => "heading_contact",
			"type" => "heading");

		$of_options[] = array( "name" => __("Email Address", "Aione"),
			"desc" => __("Enter the email adress the form will be sent to.", "Aione"),
			"id" => "email_address",
			"std" => "",
			"type" => "text");
			
		$of_options[] = array( "name" => __("Contact Form Commment Area Position", "Aione"),
			"desc" => __("Set the position of the contact form comment area with respect to the other input fields.", "Aione"),
			"id" => "contact_comment_position",
			"std" => "below",
			"type" => "select",
			"options" => array('above' => 'Above', 'below' => 'Below'));			
			
			

		$of_options[] = array( "name" => __("ReCaptcha", "Aione"),
			"desc" => "",
			"id" => "recaptcha",
			"std" => "<h3 style='margin: 0;'>" . __("ReCaptcha Spam Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("ReCaptcha Site Key", "Aione"),
			"desc" => __("Follow the steps in <a href='http://oxosolutions.com/products/wordpress-themes/aione/'> our docs</a> to get key.", "Aione"),
			"id" => "recaptcha_public",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("ReCaptcha Secret Key", "Aione"),
			"desc" => __("Follow the steps in <a href='http://oxosolutions.com/products/wordpress-themes/aione/'> our docs</a> to get key.", "Aione"),
			"id" => "recaptcha_private",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("ReCaptcha Color Scheme", "Aione"),
			"desc" => __("Select the recaptcha color scheme.", "Aione"),
			"id" => "recaptcha_color_scheme",
			"std" => "Clean",
			"type" => "select",
			"options" => array('light' => 'Light', 'dark' => 'Dark'));

		$of_options[] = array( "name" => __("ReCaptcha", "Aione"),
			"desc" => "",
			"id" => "recaptcha",
			"std" => "<h3 style='margin: 0;'>" . __("ReCaptcha Spam Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Google Map", "Aione"),
			"desc" => "",
			"id" => "google_map",
			"std" => "<h3 style='margin: 0;'>" . __("Google Map Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Google Map Type", "Aione"),
			"desc" => __("Select the type of google map to show on the contact page.", "Aione"),
			"id" => "gmap_type",
			"std" => "roadmap",
			"options" => array('roadmap' => 'roadmap', 'satellite' => 'satellite', 'hybrid' => 'hybrid', 'terrain' => 'terrain'),
			"type" => "select");

		$of_options[] = array( "name" => __("Google Map Width", "Aione"),
			"desc" => __("In pixels or percentage, ex: 100% or 100px.", "Aione"),
			"id" => "gmap_width",
			"std" => "100%",
			"type" => "text");

		$of_options[] = array( "name" => __("Google Map Height", "Aione"),
			"desc" => __("In pixels, ex: 100px.", "Aione"),
			"id" => "gmap_height",
			"std" => "415px",
			"type" => "text");

		$of_options[] = array( "name" => __("Google Map Top Margin", "Aione"),
			"desc" => __("This will only be applied to maps that are not 100% width. It controls the distance to menu/page title. In pixels, ex: 100px.", "Aione"),
			"id" => "gmap_topmargin",
			"std" => "55px",
			"type" => "text");

		$of_options[] = array( "name" => __("Google Map Address", "Aione"),
			"desc" => __("Add your address to the location you wish to show on the map. Single address ex: 775 New York Ave, Brooklyn, Kings, New York 11203. If the location is off, please try to use long/lat coordinates with latlng=. ex: latlng=12.381068,-1.492711.<br />For multiple addresses, separate addresses by using the | symbol. ex: Address 1|Address 2|Address 3.", "Aione"),
			"id" => "gmap_address",
			"std" => "775 New York Ave, Brooklyn, Kings, New York 11203",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Map Zoom Level", "Aione"),
			"desc" => __("Higher number will be more zoomed in.", "Aione"),
			"id" => "map_zoom_level",
			"std" => "8",
			"type" => "text");

		$of_options[] = array( "name" => __("Hide Address Pin", "Aione"),
			"desc" => __("Check the box to hide the address pin.", "Aione"),
			"id" => "map_pin",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Address Pin Animation", "Aione"),
			"desc" => __("Check the box to enable address pin animation.", "Aione"),
			"id" => "gmap_pin_animation",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Map Popup On Click", "Aione"),
			"desc" => __("Check the box to keep the popup graphic with address info hidden when the google map loads. It will only show when the pin on the map is clicked.", "Aione"),
			"id" => "map_popup",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Map Scrollwheel", "Aione"),
			"desc" => __("Check the box to disable scrollwheel on google maps.", "Aione"),
			"id" => "map_scrollwheel",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Map Scale", "Aione"),
			"desc" => __("Check the box to disable scale on google maps.", "Aione"),
			"id" => "map_scale",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Map Zoom & Pan Control Icons", "Aione"),
			"desc" => __("Check the box to disable zoom control icon and pan control icon on google maps.", "Aione"),
			"id" => "map_zoomcontrol",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Google Map", "Aione"),
			"desc" => "",
			"id" => "google_map",
			"std" => "<h3 style='margin: 0;'>" . __("Google Map Options", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Google Map Design Styling", "Aione"),
			"desc" => "",
			"id" => "google_map",
			"std" => "<h3 style='margin: 0;'>" . __("Google Map Design Styling", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Select the Map Styling", "Aione"),
			"desc" => __("Choose default styling for classic google map styles. Choose theme styling for our custom style. Choose custom styling to make your own with the advanced options below.", "Aione"),
			"id" => "map_styling",
			"std" => "default",
			"options" => array('default' => 'Default Styling', 'theme' => 'Theme Styling', 'custom' => 'Custom Styling'),
			"type" => "select");

		$of_options[] = array( "name" => __("Map Overlay Color", "Aione"),
			"desc" => __("Custom styling setting only. Pick an overlaying color for the map. Works best with \"roadmap\" type.", "Aione"),
			"id" => "map_overlay_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Info Box Styling", "Aione"),
			"desc" => __("Custom styling setting only. Choose between default or custom info box.", "Aione"),
			"id" => "map_infobox_styling",
			"std" => "default",
			"options" => array('default' => 'Default Infobox', 'custom' => 'Custom Infobox'),
			"type" => "select");

		$of_options[] = array( "name" => __("Info Box Content", "Aione"),
			"desc" => __("Custom styling setting only. Type in custom info box content to replace address string. For multiple addresses, separate info box contents by using the | symbol. ex: InfoBox 1|InfoBox 2|InfoBox 3", "Aione"),
			"id" => "map_infobox_content",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Info Box Background Color", "Aione"),
			"desc" => __("Custom styling setting only. Pick a color for the info box background.", "Aione"),
			"id" => "map_infobox_bg_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Info Box Text Color", "Aione"),
			"desc" => __("Custom styling setting only. Pick a color for the info box text.", "Aione"),
			"id" => "map_infobox_text_color",
			"std" => "",
			"type" => "color");

		$of_options[] = array( "name" => __("Custom Marker Icon", "Aione"),
			"desc" => __("Custom styling setting only. Use full image urls for custom marker icons or input \"theme\" for our custom marker. For multiple addresses, separate icons by using the | symbol or use one for all. ex: Icon 1|Icon 2|Icon 3", "Aione"),
			"id" => "map_custom_marker_icon",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Google Map Design Styling", "Aione"),
			"desc" => "",
			"id" => "google_map",
			"std" => "<h3 style='margin: 0;'>" . __("Google Map Design Styling", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Search Page", "Aione"),
			"id" => "heading_search_page",
			"type" => "heading");

		$of_options[] = array( "name" => __("Search", "Aione"),
			"desc" => "",
			"id" => "search",
			"std" => "<h3 style='margin: 0;'>" . __("Search Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Search Results Layout", "Aione"),
			"desc" => __("Select the layout for the search results page.", "Aione"),
			"id" => "search_layout",
			"std" => "Grid",
			"type" => "select",
			"options" => array(
				'Large' => 'Large',
				'Medium' => 'Medium',
				'Large Alternate' => 'Large Alternate',
				'Medium Alternate' => 'Medium Alternate',
				'Grid' => 'Grid',
				'Timeline' => 'Timeline'
			));

		$of_options[] = array( "name" => __("Search Results Content", "Aione"),
			"desc" => __("Select the type of content to display in search results.", "Aione"),
			"id" => "search_content",
			"std" => "Posts and Pages",
			"type" => "select",
			"options" => array('Posts and Pages' => 'Posts and Pages', 'Only Posts' => 'Only Posts', 'Only Pages' => 'Only Pages'));

		$of_options[] = array( "name" => __("Hide Search Results Excerpt", "Aione"),
			"desc" => __("Check the box if you want to hide excerpt for search results.", "Aione"),
			"id" => "search_excerpt",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Number of Search Results Per Page", "Aione"),
			"desc" => __("Set the number of search results per page.", "Aione"),
			"id" => "search_results_per_page",
			"std" => "10",
			"type" => "text");

		$of_options[] = array( "name" => __("Hide Featured Images from Search Results", "Aione"),
			"desc" => __("Check the box if you want to hide featured images for search results.", "Aione"),
			"id" => "search_featured_images",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Search Field Position", "Aione"),
			"desc" => __("Select the position of the search bar on the search results page.", "Aione"),
			"id" => "search_new_search_position",
			"std" => "top",
			"type" => "select",
			"options" => array('top' => 'Above Search Results', 'bottom' => 'Below Search Results', 'hidden' => 'Hide'));

// Theme Specific Options
		$of_options[] = array( "name" => __("Extra", "Aione"),
			"id" => "heading_extra",
			"type" => "heading");

		$of_options[] = array( "name" => __("Misc Options", "Aione"),
			"desc" => "",
			"id" => "misc_options",
			"std" => "<h3 style='margin: 0;'>" . __("Miscellaneous Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Sidenav Behavior", "Aione"),
			"desc" => __("Controls the side navigation animation for child pages, on click or hover.", "Aione"),
			"id" => "sidenav_behavior",
			"std" => "hover",
			"options" => array('Hover' => 'Hover', 'Click' => 'Click'),
			"type" => "select");

		$of_options[] = array(
			"name" => __("Image Placeholders", "Aione"),
			"desc" => __("Check the box to enable the showing of posts without a featured image on portfolio archives and related posts/projects carousels.", "Aione"),
			"id" => "featured_image_placeholder",
			"std" => 1,
			"type" => "checkbox");

		  $of_options[] = array( "name" => __("Basis for Excerpt Length", "Aione"),
			"desc" => __("Choose if the excerpt length should be based on words or characters.", "Aione"),
			"id" => "excerpt_base",
			"std" => "words",
			"options" => array('Words' => 'Words', 'Characters' => 'Characters'),
			"type" => "select");

		$of_options[] = array( "name" => __("Disable [...] on Excerpts", "Aione"),
			"desc" => __("Check the box to disable the read more sign [...] on excerpts throughout the site.", "Aione"),
			"id" => "disable_excerpts",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Make [...] Link to Single Post Page", "Aione"),
			"desc" => __("Check the box to have the read more sign [...] on excerpts link to single post page.", "Aione"),
			"id" => "link_read_more",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Allow Comments on Pages", "Aione"),
			"desc" => __("Check the box to allow comments on regular pages.", "Aione"),
			"id" => "comments_pages",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Featured Images on Pages", "Aione"),
			"desc" => __("Check the box to disable featured images on regular pages.", "Aione"),
			"id" => "featured_images_pages",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("FAQ Featured Images", "Aione"),
			"desc" => __("Check the box to show featured images on FAQ archive page.", "Aione"),
			"id" => "faq_featured_image",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("FAQ Filters", "Aione"),
			"desc" => __("Choose to show or hide filters, or to display them without 'All'.", "Aione"),
			"id" => "faq_filters",
			"std" => 'show',
			"options" => array('yes' => 'Show', 'yes_without_all' => 'Show without "All"', 'no' => 'Hide'),
			"type" => "select");

		$of_options[] = array( "name" => __("Add 'nofollow' to social links", "Aione"),
			"desc" => __("Check to add 'nofollow' attribute to all social links.", "Aione"),
			"id" => "nofollow_social_links",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Open Social Icons in a New Window", "Aione"),
			"desc" => __("Check the box to allow social icons to open in a new window.", "Aione"),
			"id" => "social_icons_new",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Form Input and Select Height", "Aione"),
			"desc" => __("This option controls the height of all search, form input and select fields. ex: 20px.", "Aione"),
			"id" => "form_input_height",
			"std" => "29px",
			"type" => "text");

		$of_options[] = array( "name" => __("WordPress jpeg Quality", "Aione"),
			"desc" 		=> __("This option controls the quality of the generated image sizes for every uploaded image. Ranges between 0 and 100 percent. Higher values lead to better image qualities but also higher file sizes.<br />NOTE: After changing this value, please (install and) run", "Aione" ) . ' <a href="' . admin_url() . 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472" class="thickbox" title="' . __( "Regenerate Thumbnails", "Aione" ) . '">' . __( "Regenerate Thumbnails", "Aione" ) .'</a>',
			"id" 		=> "pw_jpeg_quality",
			"std" 		=> "90",
			"min" 		=> "1",
			"step"		=> "1",
			"max" 		=> "100",
			"edit"		=> "yes",
			"type" 		=> "sliderui"
		);

		$of_options[] = array( "name" => __( "Related Posts / Projects", "Aione" ),
			"desc" => "",
			"id" => "related_posts",
			"std" => "<h3 style='margin: 0;'>" . __( "Related Posts / Projects", "Aione" ) . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Number of Related Posts / Projects", "Aione"),
			"desc" => __("This option controls the amount of related posts / projects that show up on each single portfolio and blog post. ex: 5", "Aione"),
			"id" => "number_related_posts",
			"std" => "5",
			"type" => "text");

		$of_options[] = array( "name" => __("Related Posts / Projects Maximum Columns", "Aione"),
			"desc" => __("Select the number of max columns to display.", "Aione"),
			"id" => "related_posts_columns",
			"std" => "5",
			"options" => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'),
			"type" => "select");

		$of_options[] = array( "name" => __("Related Posts / Projects Column Spacing", "Aione"),
			"desc" => __("Insert the amount of spacing between items without 'px'. ex: 40", "Aione"),
			"id" => "related_posts_column_spacing",
			"std" => "44",
			"type" => "text");

		$of_options[] = array( "name" => __("Related Posts / Projects Layout", "Aione"),
			"desc" => __("Choose to show titles on rollover image, or below image.", "Aione"),
			"id" => "related_posts_layout",
			"std" => "title_on_rollover",
			"type" => "select",
			"options" => array(
				'title_on_rollover' => 'Title on rollover',
				'title_below_image' => 'Title below image',
			));

		$of_options[] = array( "name" => __("Related Posts / Projects Image Size", "Aione"),
			"desc" => __("Choose if the images are fixed (cropped) or auto (full image ratio) for related posts / projects. IMPORTANT: Fixed images work best with smaller site widths. Auto images work best with larger site widths.", "Aione"),
			"id" => "related_posts_image_size",
			"std" => "cropped",
			"type" => "select",
			"options" => array(
				'cropped' => 'Fixed',
				'full' => 'Auto',
			));

		$of_options[] = array( "name" => __("Related Posts / Projects Autoplay", "Aione"),
			"desc" => __("Check the box to enable to autoplay on the carousel.", "Aione"),
			"id" => "related_posts_autoplay",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Related Posts / Projects Speed", "Aione"),
			"desc" => __("Controls the speed of all carousel elements.  ex: 1000 = 1 second.", "Aione"),
			"id" => "related_posts_speed",
			"std" => "2500",
			"type" => "text");

		$of_options[] = array( "name" => __("Related Posts / Projects Show Navigation", "Aione"),
			"desc" => __("Check the box to enable navigation buttons on the carousel.", "Aione"),
			"id" => "related_posts_navigation",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Related Posts / Projects Mouse Scroll", "Aione"),
			"desc" => __("Check the box to enable mouse drag control on the carousel.", "Aione"),
			"id" => "related_posts_swipe",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Related Posts / Projects Scroll Items", "Aione"),
			"desc" => __("Insert the amount of items to scroll. Leave empty to scroll number of visible items.", "Aione"),
			"id" => "related_posts_swipe_items",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Rollover", "Aione"),
			"desc" => "",
			"id" => "rollovers",
			"std" => "<h3 style='margin: 0;'>" . __("Image Rollover Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Image Rollover", "Aione"),
			"desc" => __("Check the box to show the rollover box on images.", "Aione"),
			"id" => "image_rollover",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Rollover Image Direction", "Aione"),
			"desc" => __("Select from which direction the rollover should start.", "Aione"),
			"id" => "image_rollover_direction",
			"std" => 'left',
			"options" => array('fade' => 'Fade', 'left' => 'Left', 'right' => 'Right', 'bottom' => 'Bottom', 'top' => 'Top', 'center_horiz' => 'Center Horizontal', 'center_vertical' => 'Center Vertical'),
			"type" => "select");

		$of_options[] = array( "name" => __("Rollover Image Icon Font Size", "Aione"),
			"desc" => __("Controls the font size of the icons in the rollover. In pixels, default is 15.", "Aione"),
			"id" => "image_rollover_icon_size",
			"std" => "15",
			"type" => "text");

		$of_options[] = array( "name" => __("Disable Link Icon From Image Rollover", "Aione"),
			"desc" => __("Check the box to disable the link icon from image rollovers.", "Aione"),
			"id" => "link_image_rollover",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Image Icon From Image Rollover", "Aione"),
			"desc" => __("Check the box to disable the image icon from image rollovers.", "Aione"),
			"id" => "zoom_image_rollover",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Title From Image Rollover", "Aione"),
			"desc" => __("Check the box to disable the title from image rollovers.", "Aione"),
			"id" => "title_image_rollover",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Categories From Image Rollover", "Aione"),
			"desc" => __("Check the box to disable the categories from image rollovers.", "Aione"),
			"id" => "cats_image_rollover",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Icon Circle From Image Rollover", "Aione"),
			"desc" => __("Check the box to disable the icon circle from images.", "Aione"),
			"id" => "icon_circle_image_rollover",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Pagination Options", "Aione"),
			"desc" => "",
			"id" => "rollovers",
			"std" => "<h3 style='margin: 0;'>" . __("Pagination Options", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Pagination Box Padding", "Aione"),
			"desc" => __("Controls the padding inside the box, ex: 10px or 10%.", "Aione"),
			"id" => "pagination_box_padding",
			"std" => "2px 6px",
			"type" => "text");

		$of_options[] = array( "name" => __("Pagination Text Display", "Aione"),
			"desc" => __("Controls if \"Previous\" and \"Next\" text is displayed or not.", "Aione"),
			"id" => "pagination_text_display",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Advanced", "Aione"),
			"id" => "heading_advanced",
			"type" => "heading");

		$of_options[] = array( "name" => __("enable_disable_heading", "Aione"),
			"desc" => "",
			"id" => "enable_disable_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Enable / Disable Theme Features & Plugin Support", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array(
			"name" => __("Disable Smooth Scrolling", "Aione"),
			"desc" => __("Check to disable smooth scrolling. This will remove the dark scrollbar and revert to the default browser scrollbar style.", "Aione"),
			"id" => "smooth_scrolling",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Oxo Builder", "Aione"),
			"desc" => __("Check to disable the oxo builder button on pages/posts.", "Aione"),
			"id" => "disable_builder",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Code Block Encoding", "Aione"),
			"desc" => __("Check to disable encoding in the Oxo Builder code block element.", "Aione"),
			"id" => "disable_code_block_encoding",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Mega Menu", "Aione"),
			"desc" => __("Check to disable the theme's mega menu.", "Aione"),
			"id" => "disable_megamenu",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Aione Styles For Revolution Slider", "Aione"),
			"desc" => __("Check the box to disable the Aione styles and use the default Revolution Slider styles.", "Aione"),
			"id" => "aione_rev_styles",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Aione Dropdown Styles", "Aione"),
			"desc" => __("Check the box to disable the Aione styles for dropdown/select fields site wide. This should be done if you experience any issues with 3rd party plugin dropdowns.", "Aione"),
			"id" => "aione_styles_dropdowns",
			"std" => 0,
			"type" => "checkbox");


		$of_options[] = array( "name" => __("Disable CSS Animations", "Aione"),
			"desc" => __("Check the box to disable CSS animations on shortcode items.", "Aione"),
			"id" => "use_animate_css",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable CSS Animations on Mobiles Only", "Aione"),
			"desc" => __("Check the box to disable CSS animations on mobiles only.", "Aione"),
			"id" => "disable_mobile_animate_css",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable CSS Image Hover Animations on Mobiles", "Aione"),
			"desc" => __("Check the box to disable CSS image hover animations on mobiles.", "Aione"),
			"id" => "disable_mobile_image_hovers",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Youtube API Scripts", "Aione"),
			"desc" => __("Check the box to disable Youtube API scripts.", "Aione"),
			"id" => "status_yt",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Vimeo API Scripts", "Aione"),
			"desc" => __("Check the box to disable Vimeo API scripts.", "Aione"),
			"id" => "status_vimeo",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Google Map Scripts", "Aione"),
			"desc" => __("Check the box to disable google map.", "Aione"),
			"id" => "status_gmap",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable ToTop Script", "Aione"),
			"desc" => __("Check the box to disable the ToTop script which adds the scrolling to top functionality.", "Aione"),
			"id" => "status_totop",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Enable ToTop Script on mobile", "Aione"),
			"desc" => __("Check the box to enable the ToTop script on mobile devices.", "Aione"),
			"id" => "status_totop_mobile",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Oxo Slider", "Aione"),
			"desc" => __("Check the box to disable oxo slider.", "Aione"),
			"id" => "status_oxo_slider",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Elastic Slider", "Aione"),
			"desc" => __("Check the box to disable elastic slider.", "Aione"),
			"id" => "status_eslider",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable FontAwesome", "Aione"),
			"desc" => __("Check the box to disable font awesome.", "Aione"),
			"id" => "status_fontawesome",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Open Graph Meta Tags", "Aione"),
			"desc" => __("Check the box to disable open graph meta tags which is mainly used when sharing pages on social networking sites like Facebook.", "Aione"),
			"id" => "status_opengraph",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Rich Snippets Sitewide", "Aione"),
			"desc" => __("Check the box to disable rich snippets data sitewide.", "Aione"),
			"id" => "disable_date_rich_snippet_pages",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Aione's Woocommerce Product Gallery Slider", "Aione"),
			"desc" => __("Enable / disable product gallery slider that is built-in with Aione. This is only useful for plugin compatibility.", "Aione"),
			"id" => "disable_woo_gallery",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Activate Developers Mode", "Aione"),
			"desc" => __("<strong>Notice:</strong> By default, all the javascript files are combined and minified. Activating this mode will load non-combined and non-minified javascript files, which is used for development only. This will have an impact on the performance of your site.", "Aione"),
			"id" => "dev_mode",
			"std" => 0,
			"type" => "checkbox");


		$of_options[] = array( "name" => __("Dynamic CSS", "Aione"),
			"desc" => "",
			"id" => "dynamic_css_compiler_heading",
			"std" => "<h3 style='margin: 0;'>Dynamic CSS</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Compiler", "Aione"),
			"desc" => __('Check the box to compile the dynamic CSS within the tag into a file. Please note that a separate file will be created for each of your pages & posts inside of the uploads/aione-styles folder.', "Aione"),
			"id" => "dynamic_css_compiler",
			"std" => 0,
			"type" => "checkbox");

		$count_posts = wp_count_posts( 'post' );
		$count_pages = wp_count_posts( 'page' );
		$count_totals = ( intval( $count_posts->publish ) + intval( $count_pages->publish ) );

		$of_options[] = array( "name" => __("Enable db-caching for dynamic CSS", "Aione"),
			"desc" => __('Check the box to enable caching the dynamic CSS in your database.', "Aione"),
			"id" => "dynamic_css_db_caching",
			"std" => ( 200 < $count_totals ) ? 0 : 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Advanced: Cache Server IP", "Aione"),
			"desc" => __("For unique cases where you are using cloudflare and a cache server e.g. Varnish. Please enter your cache server IP to clear the theme options dynamic CSS cache. Please consult with your server admin for help.", "Aione"),
			"id" => "cache_server_ip",
			"std" => "",
			"type" => "text");

		$of_options[] = array( "name" => __("Dynamic CSS", "Aione"),
			"desc" => "",
			"id" => "dynamic_css_compiler_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Dynamic CSS.", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("WooCommerce", "Aione"),
			"id" => "heading_woocommerce",
			"type" => "heading");

		$of_options[] = array( "name" => __("WooCommerce Product Box Design", "Aione"),
			"desc" => __("Select the design for the product boxes. This will automatically alter the grid element and grid box colors.", "Aione"),
			"id" => "woocommerce_product_box_design",
			"std" => "classic",
			"type" => "select",
			"options" => array(
				"classic" => "Classic",
				"clean" => "Clean"
				)
			);

		$of_options[] = array( "name" => __("Woocommerce Number of Products per Page", "Aione"),
			"desc" => __("Insert the number of products to display per page.", "Aione"),
			"id" => "woo_items",
			"std" => "12",
			"type" => "text");

		$of_options[] = array( "name" => __("Woocommerce Number of Product Columns", "Aione"),
			"desc" => __("Select the number of columns for the main shop page.", "Aione"),
			"id" => "woocommerce_shop_page_columns",
			"std" => "4",
			"type" => "select",
			"options" => array(
				  "1" => "1",
				  "2" => "2",
				  "3" => "3",
				  "4" => "4",
				  "5" => "5",
				  "6" => "6",
			)
		);

		$of_options[] = array( "name" => __("Woocommerce Related/Up-Sell/Cross-Sell Product Number of Columns", "Aione"),
			"desc" => __("Select the number of columns for the related and up-sell products on single post pages and cross-sells on cart page.", "Aione"),
			"id" => "woocommerce_related_columns",
			"std" => "4",
			"type" => "select",
			"options" => array(
				  "1" => "1",
				  "2" => "2",
				  "3" => "3",
				  "4" => "4",
				  "5" => "5",
				  "6" => "6",
			)
		);

		$of_options[] = array( "name" => __("Woocommerce Archive/Category Number of Product Columns", "Aione"),
			"desc" => __("Select the number of columns for the archive/category pages.", "Aione"),
			"id" => "woocommerce_archive_page_columns",
			"std" => "3",
			"type" => "select",
			"options" => array(
				  "1" => "1",
				  "2" => "2",
				  "3" => "3",
				  "4" => "4",
						"5" => "5",
						"6" => "6",
			)
		);

		$of_options[] = array( "name" => __("WooCommerce Product Tab Design", "Aione"),
			"desc" => __("Choose if the product tabs on the single product page are vertical or horizontal.", "Aione"),
			"id" => "woocommerce_product_tab_design",
			"std" => "vertical",
			"type" => "select",
			"options" => array(
				"horizontal" => "Horizontal Tabs",
				"vertical" => "Vertical Tabs"
				)
			);

		$of_options[] = array( "name" => __("Disable Woocommerce Shop Page Ordering Boxes", "Aione"),
			"desc" => __("Check the box to disable the ordering boxes displayed on the shop page.", "Aione"),
			"id" => "woocommerce_aione_ordering",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Disable Woocommerce Shop Page Crossfade Image Effect", "Aione"),
			"desc" => __("Check the box to disable the product crossfade image effect on the shop page.", "Aione"),
			"id" => "woocommerce_disable_crossfade_effect",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Use Woocommerce One Page Checkout", "Aione"),
			"desc" => __("Check the box to use Aione's one page checkout template.", "Aione"),
			"id" => "woocommerce_one_page_checkout",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce Order Notes on Checkout", "Aione"),
			"desc" => __("Check the box to show the order notes on the checkout page.", "Aione"),
			"id" => "woocommerce_enable_order_notes",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("WooCommerce Menu Cart Icon Counter", "Aione"),
			"desc" => __("Choose to show or hide the cart counter circle.", "Aione"),
			"id" => "woocommerce_cart_counter",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce My Account Link in Main Menu", "Aione"),
			"desc" => __("Check the box to show My Account link, uncheck to disable. Please note these will not show with Ubermenu.", "Aione"),
			"id" => "woocommerce_acc_link_main_nav",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce Cart Icon in Main Menu", "Aione"),
			"desc" => __("Check the box to show the Cart icon, uncheck to disable. Please note these will not show with Ubermenu.", "Aione"),
			"id" => "woocommerce_cart_link_main_nav",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce My Account Link in Secondary Menu", "Aione"),
			"desc" => __("Check the box to show My Account link, uncheck to disable. Only works if a top menu is assigned in header content 1-2.  Not compatible with Ubermenu.", "Aione"),
			"id" => "woocommerce_acc_link_top_nav",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce Cart Icon in Secondary Menu", "Aione"),
			"desc" => __("Check the box to show the Cart icon, uncheck to disable. Only works if a top menu is assigned in header content 1-2.  Not compatible with Ubermenu. ", "Aione"),
			"id" => "woocommerce_cart_link_top_nav",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Show Woocommerce Social Icons", "Aione"),
			"desc" => __("Check the box to show the social icons on product pages, uncheck to disable.", "Aione"),
			"id" => "woocommerce_social_links",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Product Grid / List View", "Aione"),
			"desc" => __("Select the box to display the grid/list toggle on the main shop page and category/archive shop pages.", "Aione"),
			"id" => "woocommerce_toggle_grid_list",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Account Area Message 1", "Aione"),
			"desc" => __("Insert your text and it will appear in the first message box on the acount page.", "Aione"),
			"id" => "woo_acc_msg_1",
			"std" => "Need Assistance? Call customer service at 888-555-5555.",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Account Area Message 2", "Aione"),
			"desc" => __("Insert your text and it will appear in the second message box on the acount page.", "Aione"),
			"id" => "woo_acc_msg_2",
			"std" => "E-mail them at info@yourshop.com",
			"type" => "textarea");

		$of_options[] = array( "name" => __("bbPress", "Aione"),
			"id" => "heading_bbpress",
			"type" => "heading");

		$of_options[] = array( "name" => __("bbPress Forum Header Background Color", "Aione"),
			"desc" => __("Controls the background color for forum header rows.", "Aione"),
			"id" => "bbp_forum_header_bg",
			"std" => "#ebeaea",
			"type" => "color");

		$of_options[] = array( "name" => __("bbPress Forum Header Font Color", "Aione"),
			"desc" => __("CControls the font color for the text in the forum header rows.", "Aione"),
			"id" => "bbp_forum_header_font_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("bbPress Forum Border Color", "Aione"),
			"desc" => __("Controls the border color for all forum surrounding borders.", "Aione"),
			"id" => "bbp_forum_border_color",
			"std" => "#ebeaea",
			"type" => "color");

		$of_options[] = array( "name" => __("BBPress/BuddyPress", "Aione"),
			"desc" => "",
			"id" => "bbpress_sidebars",
			"std" => "<h3 style='margin: 0;'>" . __("BBPress/BuddyPress", "Aione") . "</h3>",
			"icon" => true,
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use global sidebars on all forum pages. Forums index page, profile page and search page does not need this option checked to display the sidebars selected below.", "Aione"),
			"id" => "bbpress_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on forum and BuddyPress pages globally.", "Aione"),
			"id" => "ppbress_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on forum and BuddyPress pages globally. Sidebar 2 can only be used if sidebar 1 is selected.", "Aione"),
			"id" => "ppbress_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global bbPress/BuddyPress Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for bbPress/BuddyPress pages. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "bbpress_sidebar_position",
			"std" => "Right",
			"type" => "select",
			"options" => array(
				'Right' => 'Right',
				'Left' => 'Left',
			));

		$of_options[] = array( "name" => __("BBPress", "Aione"),
			"desc" => "",
			"id" => "bbpress_sidebars",
			"std" => "<h3 style='margin: 0;'>" . __("BBPress", "Aione") . "</h3>",
			"icon" => true,
			"position" => "end",
			"type" => "accordion");


		$of_options[] = array( "name" => __("Events Calendar", "Aione"),
			"id" => "heading_ec",
			"type" => "heading");

		$of_options[] = array( "name" => __("Primary Color Overlay Text Color", "Aione"),
			"desc" => __("Text color for when primary color is in the background.", "Aione"),
			"id" => "primary_overlay_text_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Events Filter Bar Background Color", "Aione"),
			"desc" => __("Controls the background color for the events calendar filter bar.", "Aione"),
			"id" => "ec_bar_bg_color",
			"std" => "#efeded",
			"type" => "color");

		$of_options[] = array( "name" => __("Event Filter Bar Text Color", "Aione"),
			"desc" => __("Controls the color of the event filter bar text.", "Aione"),
			"id" => "ec_bar_text_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Monthly Calendar Heading Background Color", "Aione"),
			"desc" => __("Controls the background color for the numbered heading.", "Aione"),
			"id" => "ec_calendar_heading_bg_color",
			"std" => "#b2b2b2",
			"type" => "color");

		$of_options[] = array( "name" => __("Monthly Calendar Background Color", "Aione"),
			"desc" => __("Controls the background color of each day in the calendar.", "Aione"),
			"id" => "ec_calendar_bg_color",
			"std" => "#b2b2b2",
			"type" => "color");

		$of_options[] = array( "name" => __("Tooltip Background Color", "Aione"),
			"desc" => __("Controls the background color for the event tooltip.", "Aione"),
			"id" => "ec_tooltip_bg_color",
			"std" => "#ffffff",
			"type" => "color");

		$of_options[] = array( "name" => __("Tooltip Body Text Color", "Aione"),
			"desc" => __("Controls the body text color of the tooltip.", "Aione"),
			"id" => "ec_tooltip_body_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Border Color", "Aione"),
			"desc" => __("Controls the various border color around events calendar.", "Aione"),
			"id" => "ec_border_color",
			"std" => "#e0dede",
			"type" => "color");

		$of_options[] = array( "name" => __("Featured Image Hover Type", "Aione"),
			"desc" => __("Choose the hover type for featured images.", "Aione"),
			"id" => "ec_hover_type",
			"std" => "none",
			"type" => "select",
			"options" => array( 'none' => 'none', 'zoomin' => 'Zoom In', 'zoomout' => 'Zoom Out', 'liftup' => 'Lift Up' ));

		$of_options[] = array( "name" => __("Image Background Size For List View", "Aione"),
			"desc" => __("Select if the event image displays auto or covered in the list view. All other areas show the image as auto.", "Aione"),
			"id" => "ec_bg_list_view",
			"std" => "cover",
			"type" => "select",
			"options" => array( 'cover' => 'cover', 'auto' => 'auto' ));

	   $of_options[] = array( "name" => __("Single Event Detail Section", "Aione"),
			"desc" => "",
			"id" => "ec_single_event_detail_section_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Single Event Detail Section", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Social Sharing Box", "Aione"),
			"desc" => __("Check the box to display the social sharing box.", "Aione"),
			"id" => "events_social_sharing_box",
			"std" => 1,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Sidebar Background Color", "Aione"),
			"desc" => __("Controls the background color of the sidebar.", "Aione"),
			"id" => "ec_sidebar_bg_color",
			"std" => "#f6f6f6",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Padding", "Aione"),
			"desc" => __("Enter a pixel or percentage based value, ex: 5px or 5%", "Aione"),
			"id" => "ec_sidebar_padding",
			"std" => "4%",
			"type" => "text");

		$of_options[] = array( "name" => __("Sidebar Widget Heading Font Size", "Aione"),
			"desc" => __("In pixels, default is 13", "Aione"),
			"id" => "ec_sidew_font_size",
			"std" => "17",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Sidebar Widget Title Background Color", "Aione"),
			"desc" => __("Controls the background color of the sidebar widget title.", "Aione"),
			"id" => "ec_sidebar_widget_bg_color",
			"std" => "#aoce4e",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Widget Headings Color", "Aione"),
			"desc" => __("Controls the text color of the sidebar widget headings.", "Aione"),
			"id" => "ec_sidebar_heading_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Text Font Size", "Aione"),
			"desc" => __("In pixels, default is 14", "Aione"),
			"id" => "ec_text_font_size",
			"std" => "14",
						"min" 		=> "1",
						"step"		=> "1",
						"max" 		=> "100",
						"edit"		=> "yes",
						"type" 		=> "sliderui"
				);

		$of_options[] = array( "name" => __("Sidebar Text Color", "Aione"),
			"desc" => __("Controls the text color of the sidebar.", "Aione"),
			"id" => "ec_sidebar_text_color",
			"std" => "#747474",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Link Color", "Aione"),
			"desc" => __("Controls the link color of the sidebar.", "Aione"),
			"id" => "ec_sidebar_link_color",
			"std" => "#333333",
			"type" => "color");

		$of_options[] = array( "name" => __("Sidebar Divider Color", "Aione"),
			"desc" => __("Controls the divider color of the sidebar.", "Aione"),
			"id" => "ec_sidebar_divider_color",
			"std" => "#e8e8e8",
			"type" => "color");
	   $of_options[] = array( "name" => __("Single Event Detail Section", "Aione"),
			"desc" => "",
			"id" => "ec_single_event_detail_section_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Single Event Detail Section", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Events Content + Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "ec_content_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Events Content + Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 1 sidebar. Total values must add up to 100.", "Aione") . "</p>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Sidebar Width", "Aione"),
			"desc" => __("Controls the width of the sidebar. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "ec_sidebar_width",
			"std" => "32%",
			"type" => "text");

	   $of_options[] = array( "name" => __("Events Content + Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "ec_content_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Events Content + Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 1 sidebar. Total values must add up to 100.", "Aione") . "</p>",
			"position" => "end",
			"type" => "accordion");

	   $of_options[] = array( "name" => __("Events Content + Sidebar + Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "ec_content_sidebar_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Events Content + Sidebar + Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 2 sidebars. Total values must add up to 100.", "Aione") . "</p>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Sidebar 1 Width", "Aione"),
			"desc" => __("Controls the width of the sidebar 1. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "ec_sidebar_2_1_width",
			"std" => "21%",
			"type" => "text");

		$of_options[] = array( "name" => __("Sidebar 2 Width", "Aione"),
			"desc" => __("Controls the width of the sidebar 2. In px or %, ex: 100% or 1170px.", "Aione"),
			"id" => "ec_sidebar_2_2_width",
			"std" => "21%",
			"type" => "text");

	   $of_options[] = array( "name" => __("Events Content + Sidebar + Sidebar Width", "Aione"),
			"desc" => "",
			"id" => "ec_content_sidebar_sidebar_width",
			"std" => "<h3 style='margin: 0;'>" . __("Events Content + Sidebar + Sidebar Width", "Aione") . "</h3><p>" . __("These settings are used on pages with 2 sidebars. Total values must add up to 100.", "Aione") . "</p>",
			"position" => "end",
			"type" => "accordion");


	   $of_options[] = array( "name" => __("Events Global Sidebar", "Aione"),
			"desc" => "",
			"id" => "ec_global_sidebar_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Events Global Sidebar", "Aione") . "</h3>",
			"position" => "start",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Activate Global Sidebar", "Aione"),
			"desc" => __("Check the box if you want to use a global sidebar on all event pages. This option overrides the page options.", "Aione"),
			"id" => "ec_global_sidebar",
			"std" => 0,
			"type" => "checkbox");

		$of_options[] = array( "name" => __("Global Sidebar 1", "Aione"),
			"desc" => __("Select sidebar 1 that will display on all event pages.", "Aione"),
			"id" => "ec_sidebar",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar 2", "Aione"),
			"desc" => __("Select sidebar 2 that will display on all event pages. Sidebar 2 can only be used if sidebar 1 is selected", "Aione"),
			"id" => "ec_sidebar_2",
			"std" => "None",
			"type" => "select",
			"options" => $sidebar_options
		);

		$of_options[] = array( "name" => __("Global Sidebar Position", "Aione"),
			"desc" => __("Select the sidebar 1 position for event pages. If sidebar 2 is selected, it will display on the opposite side.", "Aione"),
			"id" => "ec_sidebar_pos",
			"std" => "Right",
			"options" => array('Right' => 'Right', 'Left' => 'Left'),
			"type" => "select");

	   $of_options[] = array( "name" => __("Events Global Sidebar", "Aione"),
			"desc" => "",
			"id" => "ec_global_sidebar_heading",
			"std" => "<h3 style='margin: 0;'>" . __("Events Global Sidebar", "Aione") . "</h3>",
			"position" => "end",
			"type" => "accordion");

		$of_options[] = array( "name" => __("Custom CSS", "Aione"),
			"id" => "heading_custom_css",
			"type" => "heading");

		$of_options[] = array( "name" => __("Advanced CSS Customizations", "Aione"),
			"desc" => "",
			"id" => "advanced_css_intro",
			"std" => "<h3 style='margin: 0;'>" . __("Advanced CSS Customizations", "Aione") . "</h3>",
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("Custom CSS Info", "Aione"),
			"desc" => "",
			"id" => "custom_css_info",
			"std" => __("Paste your CSS code, do not include any tags or HTML in the field. Any custom CSS entered here will override the theme CSS. In some cases, the !important tag may be needed. Don't URL encode image or svg paths. Contents of this field will be auto encoded.", "Aione"),
			"icon" => true,
			"type" => "info");

		$of_options[] = array( "name" => __("CSS Code", "Aione"),
			"desc" => "",
			"id" => "custom_css",
			"std" => "",
			"type" => "textarea");

		$of_options[] = array( "name" => __("Backup", "Aione"),
			"id" => "heading_backup",
			"type" => "heading");

		$of_options[] = array( "name" => __("Backup and Restore Options", "Aione"),
			"id" => "of_backup",
			"std" => "",
			"type" => "backup",
			"desc" => __('You can use the two buttons below to backup your current options, and then restore it back at a later time. This is useful if you want to experiment on the options but would like to keep the old settings in case you need it back.', 'Aione'),
		);

		$of_options[] = array( "name" => __("Transfer Theme Options Data", "Aione"),
			"id" => "of_transfer",
			"std" => "",
			"type" => "transfer",
			"desc" => __("Import Options", "Aione"),
		);

		return $of_options;
	}
}

if (!function_exists('of_options'))
{
	  function of_options()
	  {
		global $of_options;

		$of_options = of_options_array();
		// End Aione Edit
	  }//End function: of_options()
}//End chack if function exists: of_options()


// Omit closing PHP tag to avoid "Headers already sent" issues.
