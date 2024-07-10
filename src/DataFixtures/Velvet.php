<?php
/**
 * Export to PHP Array plugin for PHPMyAdmin
 * @version 5.1.1deb5ubuntu1
 */


//Database `velvet`


//`velvet`.`artist`
$artist = array(
  array('artist_id' => '1','artist_name' => 'Neil Young','artist_url' => NULL),
  array('artist_id' => '2','artist_name' => 'YES','artist_url' => NULL),
  array('artist_id' => '3','artist_name' => 'Rolling Stones','artist_url' => NULL),
  array('artist_id' => '4','artist_name' => 'Queens of the Stone Age','artist_url' => NULL),
  array('artist_id' => '5','artist_name' => 'Serge Gainsbourg','artist_url' => NULL),
  array('artist_id' => '6','artist_name' => 'AC/DC','artist_url' => NULL),
  array('artist_id' => '7','artist_name' => 'Marillion','artist_url' => NULL),
  array('artist_id' => '8','artist_name' => 'Bob Dylan','artist_url' => NULL),
  array('artist_id' => '9','artist_name' => 'Fleshtones','artist_url' => NULL),
  array('artist_id' => '10','artist_name' => 'The Clash','artist_url' => NULL)
);

/* `velvet`.`commande` */
$commande = array(
  array('id' => '2', 'user_id' => '1','id_disc' => '4','quantite' => '4','total' => '16.00','date_commande' => '2020-11-30 03:52:43','etat' => 'Livrée'),
  array('id' => '3',  'user_id' => '2','id_disc' => '5','quantite' => '2','total' => '20.00','date_commande' => '2020-11-30 04:07:17','etat' => 'Livrée','nom_client' => 'Thomas Gilchrist','telephone_client' => '7410001450','email_client' => 'thom@gmail.com','adresse_client' => '1277 Sunburst Drive'),
  array('id' => '4', 'user_id' => '3', 'id_disc' => '5','quantite' => '1','total' => '10.00','date_commande' => '2021-05-04 01:35:34','etat' => 'Livrée','nom_client' => 'Martha Woods','telephone_client' => '78540001200','email_client' => 'marthagmail.com','adresse_client' => '478 Avenue Street'),
  array('id' => '6',  'user_id' => '4', 'id_disc' => '9','quantite' => '1','total' => '7.00','date_commande' => '2021-07-20 06:10:37','etat' => 'Livrée','nom_client' => 'Charlie','telephone_client' => '7458965550','email_client' => 'charlie@gmail.com','adresse_client' => '3140 Bartlett Avenue'),
  array('id' => '7',  'user_id' => '5', 'id_disc' => '10','quantite' => '2','total' => '8.00','date_commande' => '2021-07-20 06:40:21','etat' => 'En cours de livraison','nom_client' => 'Claudia Hedley','telephone_client' => '7451114400','email_client' => 'hedley@gmail.com','adresse_client' => '1119 Kinney Street'),
  array('id' => '8',  'user_id' => '6', 'id_disc' => '14','quantite' => '1','total' => '6.00','date_commande' => '2021-07-20 06:40:57','etat' => 'En préparation','nom_client' => 'Vernon Vargas','telephone_client' => '7414744440','email_client' => 'venno@gmail.com','adresse_client' => '1234 Hazelwood Avenue'),
  array('id' => '9',  'user_id' => '7', 'id_disc' => '9','quantite' => '4','total' => '20.00','date_commande' => '2021-07-20 07:06:06','etat' => 'Annulée','nom_client' => 'Carlos Grayson','telephone_client' => '7401456980','email_client' => 'carlos@gmail.com','adresse_client' => '2969 Hartland Avenue'),
  array('id' => '10',  'user_id' => '8', 'id_disc' => '16','quantite' => '4','total' => '12.00','date_commande' => '2021-07-20 07:11:06','etat' => 'Livrée','nom_client' => 'Jonathan Caudill','telephone_client' => '7410256996','email_client' => 'jonathan@gmail.com','adresse_client' => '1959 Limer Street')
);

//`velvet`.`disc`
$disc = array(
  array('disc_id' => '1','disc_title' => 'Fugazi','disc_year' => '1984','disc_picture' => 'Fugazi.jpeg','disc_label' => 'EMI','disc_prix' => '14.99', 'disc_genre' => 'Prog','artist_id' => '7'),
  array('disc_id' => '2','disc_title' => 'Songs for the Deaf','disc_year' => '2002','disc_picture' => 'Songs for the Deaf.jpeg','disc_label' => 'Interscope Records', 'disc_prix' => '12.50', 'disc_genre' => 'Rock/Stoner','artist_id' => '4'),
  array('disc_id' => '3','disc_title' => 'Harvest Moon','disc_year' => '1992','disc_picture' => 'Harvest Moon.jpeg','disc_label' => 'Reprise Records','disc_genre' => 'Rock','disc_prix' => '4','artist_id' => '1'),
  array('disc_id' => '4','disc_title' => 'Initials BB','disc_year' => '1968','disc_picture' => 'Initials BB.jpeg','disc_label' => 'Philips','disc_genre' => ' Chanson, Pop Rock','disc_prix' => '12','artist_id' => '5'),
  array('disc_id' => '5','disc_title' => 'After the Gold Rush','disc_year' => '1970','disc_picture' => 'After the Gold Rush.jpeg','disc_label' => ' Reprise Records','disc_genre' => 'Country Rock','disc_prix' => '20','artist_id' => '1'),
  array('disc_id' => '6','disc_title' => 'Broken Arrow','disc_year' => '1996','disc_picture' => 'Broken Arrow.jpeg','disc_label' => 'Reprise Records','disc_genre' => ' Country Rock, Classic Rock','disc_prix' => '15','artist_id' => '1'),
  array('disc_id' => '7','disc_title' => 'Highway To Hell','disc_year' => '1979','disc_picture' => 'Highway To Hell.jpeg','disc_label' => 'Atlantic','disc_genre' => 'Hard Rock','disc_prix' => '15','artist_id' => '6'),
  array('disc_id' => '8','disc_title' => 'Drama','disc_year' => '1980','disc_picture' => 'Drama.jpeg','disc_label' => 'Atlantic','disc_genre' => 'Prog','disc_prix' => '15','artist_id' => '2'),
  array('disc_id' => '9','disc_title' => 'Year of the Horse','disc_year' => '1997','disc_picture' => 'Year of the Horse.jpeg','disc_label' => 'Reprise Records','disc_genre' => 'Country Rock, Classic Rock','disc_prix' => '7','artist_id' => '1'),
  array('disc_id' => '10','disc_title' => 'Ragged Glory','disc_year' => '1990','disc_picture' => 'Ragged Glory.jpeg','disc_label' => 'Reprise Records','disc_genre' => 'Country Rock, Grunge','disc_prix' => '11','artist_id' => '1'),
  array('disc_id' => '11','disc_title' => 'Rust Never Sleeps','disc_year' => '1979','disc_picture' => 'Rust Never Sleeps.jpeg','disc_label' => 'Reprise Records','disc_genre' => 'Classic Rock, Arena Rock','disc_prix' => '15','artist_id' => '1'),
  array('disc_id' => '12','disc_title' => 'Exile on main street','disc_year' => '1972','disc_picture' => 'Exile on main street.jpeg','disc_label' => 'Rolling Stones Records','disc_genre' => 'Blues Rock, Classic Rock','disc_prix' => '33','artist_id' => '1'),
  array('disc_id' => '13','disc_title' => 'London Calling','disc_year' => '1971','disc_picture' => 'London Calling.jpeg','disc_label' => 'CBS','disc_genre' => 'Punk, New Wave','disc_prix' => '33','artist_id' => '10'),
  array('disc_id' => '14','disc_title' => 'Beggars Banquet','disc_year' => '1968','disc_picture' => 'Beggars Banquet.jpeg','disc_label' => 'Rolling Stones Records','disc_genre' => 'Blues Rock, Classic Rock','disc_prix' => '33','artist_id' => '1'),
  array('disc_id' => '15','disc_title' => 'Laboratory of sound','disc_year' => '1995','disc_picture' => 'Laboratory of sound.jpeg','disc_label' => 'Rebel Rec.','disc_genre' => 'Rock','disc_prix' => '33','artist_id' => '9'),
);

//`velvet`.`user`
$user = array(
  // array('user_id' => '1','user_email' => 'kelly@gmail.com', 'user_roles' => '')
  array('')

);
