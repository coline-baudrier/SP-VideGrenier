// Écouteur d'événement pour l'installation du service worker
self.addEventListener("install",event=>{
    // ça attend jusqu'à ce que les ressources soient mises en cache
    event.waitUntil(
        //on ouvre un cache nommé "static"
        caches.open("static").then(cache=>{
            //on ajoute des ressources spécifiques au cache (ici la ressource principale et le logo)
            return cache.addAll(["./",'./images/logo.png']);
        })
    );
});

// Écouteur d'événement pour la récupération des ressources. Il est déclenché chaque fois qu'une requête réseau est faite. Il permet d'intercepter les requêtes et de fournir une réponse mise en cache si possible.
self.addEventListener("fetch",event=>{
    // Répond avec une ressource mise en cache si disponible, sinon récupérer depuis le réseau
    event.respondWith(
        caches.match(event.request).then(response=>{
            // Retourne la réponse mise en cache ou faire une requête réseau si la ressource n'est pas en cache
            return response||fetch(event.request);
        })
    );
});
