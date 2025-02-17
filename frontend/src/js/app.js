document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("emailForm");
  const emailInput = document.getElementById("emailInput");
  const resultText = document.getElementById("result");

  form.addEventListener("submit", async function (event) {
    event.preventDefault();
    analyzeEmail();
  });

  async function analyzeEmail() {
    const email = emailInput.value.trim();

    // Controleer of de invoer geldig is
    if (!validateEmailInput(email)) {
      showMessage(
        resultText,
        "⚠️ Ongeldige invoer. Voer een correcte e-mailtekst in.",
        "text-red-500"
      );
      return;
    }

    // Laad-indicator tonen
    showMessage(resultText, "⏳ Bezig met analyseren...", "text-blue-500");

    try {
      const response = await fetch("http://localhost/backend/analyze.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ email }),
      });

      const data = await response.json();

      if (response.ok) {
        const isPhishing = data.is_phishing === "Ja";
        showMessage(
          resultText,
          `🔍 Phishing gedetecteerd: ${data.is_phishing}`,
          isPhishing ? "text-red-500" : "text-green-500"
        );
      } else {
        showMessage(
          resultText,
          `❌ Fout: ${data.error || "Onbekende fout"}`,
          "text-red-500"
        );
      }
    } catch (error) {
      showMessage(
        resultText,
        "⚠️ Er is een fout opgetreden bij de analyse.",
        "text-red-500"
      );
      console.error("Fout bij API-call:", error);
    }
  }

  function showMessage(element, message, colorClass) {
    element.innerText = message;
    element.className = `mt-2 font-semibold ${colorClass}`;
  }
});
