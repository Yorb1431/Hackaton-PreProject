document.addEventListener("DOMContentLoaded", () => {
  const form = document.getElementById("emailForm");
  const emailInput = document.getElementById("emailInput");
  const errorMessage = document.getElementById("errorMessage");
  const loading = document.getElementById("loading");
  const result = document.getElementById("result");

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    result.innerHTML = "";
    errorMessage.classList.add("hidden");

    const emailText = emailInput.value.trim();
    if (emailText === "") {
      errorMessage.classList.remove("hidden");
      return;
    }

    loading.classList.remove("hidden");

    try {
      const response = await fetch("analyze.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email: emailText }),
      });

      const data = await response.json();
      loading.classList.add("hidden");

      if (response.ok) {
        result.innerHTML = `<span class="text-green-400">✅ Analyse voltooid:</span> ${data.is_phishing}`;
      } else {
        result.innerHTML = `<span class="text-red-500">❌ Fout:</span> ${data.error}`;
      }
    } catch (error) {
      loading.classList.add("hidden");
      result.innerHTML = `<span class="text-red-500">❌ Netwerkfout. Probeer opnieuw.</span>`;
    }
  });
});
