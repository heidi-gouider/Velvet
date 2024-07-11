<!-- Les codes de touches sont : 38 (haut), 40 (bas), 37 (gauche), 39 (droite). -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konami Code Redirect</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            margin: 0;
            overflow: hidden;
            /* Pour empêcher le défilement vertical */
            background-color: #222;
            color: white;
            font-family: Arial, sans-serif;
        }

        .contenu {
            position: relative;
        }

        #rain-container {
            position: absolute;
            top: 50;
            /* top: calc(100% + 20px); Décaler le conteneur de la pluie de 20px en dessous du bas du titre */
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .rain {
            position: absolute;
            width: 1px;
            /* Largeur initiale du chiffre */
            height: 20px;
            /* Hauteur du chiffre */
            background-color: white;
            left: 0;
            top: -2rem;
            font-size: 1.5rem;
            opacity: 0.8;
            /* Animation de chute infinie */
            /* animation: scoll-up 10s linear infinite; */
            animation: fall 8s linear infinite;
            /* transform-origin: center; */
        }

        @keyframes fall {
            0% {
                transform: translateY(-100%);
                /*Départ hors de l'écran en haut*/
                /* transform: translateY(-100vh) rotate(0deg); */
                /* Départ en haut sans rotation */
            }

            100% {
                transform: translateY(100vh);
                /* Arrivée hors de l'écran en bas */
                /* transform: translateY(100vh) rotate(720deg); */
                /* Arrivée en bas avec 2 tours complets */
            }
        }

        .stop-button {
            position: absolute;
            /* top: 20px; */
            bottom: 250px;
            /* right: 20px; */
            padding: 10px 20px;
            background-color: #f00;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .stop-button:hover {
            background-color: #c00;
        }
    </style>
</head>

<body>
    <div class="contenu">

        <h2 class="text-white text-center">Bienvenue sur la page cachée de Velvet !!</h2>
        <div class="container">

            <!-- Ajouter un bouton pour revenir à l'accueil -->
            <!-- <button onclick="window.location.href='/'">Retour à l'accueil</button> -->
            <a href="{{ path('app_accueil') }}" class="btn btn-primary">Retour à l'accueil</a>
            <i class="bi bi-arrow-right-square-fill" style="font-size: 2rem;"></i>

            <!-- Le code secret -->
            <script>
                // Le code Konami
                const konamiCode = [38, 38, 40, 40, 37, 39, 37, 39];
                let konamiCodePosition = 0;

                // Ajout d'un écouteur d'événements pour le clavier
                document.addEventListener('keydown', function(e) {
                    // Vérifier si la touche pressée est la suivante dans le code Konami
                    if (e.keyCode === konamiCode[konamiCodePosition]) {
                        konamiCodePosition++;
                        // Si toute la séquence a été complétée
                        if (konamiCodePosition === konamiCode.length) {
                            // Alert the user before redirecting
                            if (confirm("Tu as entrer le Konami code! Click OK pour être redirigé ou Retour pour retourner à l'accueil.")) {
                                // Rediriger vers le lien externe
                                window.location.href = 'https://petitemaisonutopique.wixsite.com/petitemaisonutopique';
                            }
                            // Réinitialiser la position après confirmation
                            konamiCodePosition = 0;
                        }
                    } else {
                        konamiCodePosition = 0; // Réinitialiser si la séquence est incorrecte
                    }
                });
            </script>
            <i class="bi bi-arrow-up-square-fill text-primary" style="font-size: 2rem"></i>

            <!-- Annimation pluie -->
            <!-- Conteneur pour la pluie de chiffres -->
            <div id="rain-container"></div>
            <script>
                // Fonction pour générer un chiffre aléatoire entre 0 et 9
                function getRandomNumber() {
                    return Math.floor(Math.random() * 10);
                }

                // Fonction pour créer un chiffre en tant qu'élément HTML et l'animer
                function createNumber() {
                    const number = getRandomNumber();
                    const element = document.createElement('div');
                    element.textContent = number;
                    element.classList.add('rain');
                    element.style.left = `${Math.random() * 100}vw`; // Position horizontale aléatoire
                    document.getElementById('rain-container').appendChild(element);

                    // Supprimer l'élément après son animation complète
                    element.addEventListener('animationend', function() {
                        element.remove();
                    });
                }


                // Générer des chiffres à intervalles réguliers
                const intervalId = setInterval(createNumber, 200); // Chaque 200 millisecondes (5 chiffres par seconde)

                // Fonction pour arrêter la pluie
                function stopRain() {
                    clearInterval(intervalId);
                    const rainElements = document.querySelectorAll('.rain');
                    rainElements.forEach(element => {
                        element.style.animation = 'none';
                    });
                    document.querySelector('.stop-button').disabled = true;
                }
            </script>
<div class="text-center mt-3">        
    <button class="stop-button text-right" onclick="stopRain()">Stop the rain !</button>
</div>
        </div>

    </div>
</body>

</html>