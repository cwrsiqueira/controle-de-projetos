const CACHE_NAME = "my-pwa-cache-v1";
const urlsToCache = [
  "/",
  "/index.php",
  "/192icon.png",
  "/512icon.png",
  "/add-project-action.php",
  "/add-project.php",
  "/archive-project.php",
  "/conn.php",
  "/edit-project-action.php",
  "/edit-project.php",
  "/footer.php",
  "/header.php",
  "/jquery.mask.min.js",
  "/script.js",
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});
