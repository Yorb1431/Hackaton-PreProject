async function analyzeEmail() {
  const emailInput = document.getElementById("emailInput");
  const resultText = document.getElementById("result");

  if (!validateEmailInput(emailInput.value)) {
    resultText.innerText =
      "⚠️ Ongeldige invoer. Voer een geldige e-mailtekst in.";
    resultText.classList.add("text-red-500");
    return;
  }

  resultText.innerText = "⏳ Bezig met analyseren...";
  resultText.classList.remove("text-red-500", "text-green-500");

  try {
    const response = await fetch("http://localhost/backend/analyze.php", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({ email: emailInput.value }),
    });

    const data = await response.json();

    if (data.error) {
      resultText.innerText = `❌ Fout: ${data.error}`;
      resultText.classList.add("text-red-500");
    } else {
      resultText.innerText = `🔍 Is phishing: ${data.is_phishing}`;
      resultText.classList.add(
        data.is_phishing === "Ja" ? "text-red-500" : "text-green-500"
      );
    }
  } catch (error) {
    resultText.innerText =
      "⚠️ Er is een fout opgetreden bij het ophalen van de analyse.";
    resultText.classList.add("text-red-500");
  }
}
