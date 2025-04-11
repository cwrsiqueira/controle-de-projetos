$("#faturamento").mask("#.##0,00", { reverse: true });

if ("serviceWorker" in navigator) {
  window.addEventListener("load", function () {
    navigator.serviceWorker.register("/service-worker.js").then(
      function (registration) {
        console.log(
          "ServiceWorker registrado com sucesso:",
          registration.scope
        );
      },
      function (error) {
        console.log("Falha ao registrar o ServiceWorker:", error);
      }
    );
  });
}
